<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\User as UserModel;
use App\Models\UserFriend as UserFriendModel;
use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\Contracts\Player as PlayerContract;
use Src\Resources\Constants\Roles;

final class Player
implements PlayerContract
{
    private UserModel $model;
    private UserFriendModel $user_friend_model;
    private BookingModel $booking_model;

    public function __construct(
        UserModel $model,
        UserFriendModel $user_friend_model,
        BookingModel $booking_model,
    ) {
        $this->model = $model;
        $this->user_friend_model = $user_friend_model;
        $this->booking_model = $booking_model;
    }

    public function player(
        int $booking_id,
        string | NULL $search = NULL,
        int | null $user_id = NULL
    ) {
        $search_player = $search ? $this->model->select('id', 'name', 'username')
            ->with(['ranking' => function ($query) {
                $query->select('id', 'user_id', 'rating');
            }])->where('username', $search)
            ->whereHas('roles', function ($query) {
                $query->where('key', Roles::CLIENT);
            })
            ->limit(2)->get()
            ->map(function ($user) use ($user_id) {
                $is_friend = $this->user_friend_model->where(
                    [
                        ['user_id', $user_id],
                        ['friend_id', $user->id]
                    ]
                )->exists();
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'rating' => (float) ($user->ranking->rating ?? 0.0),
                    'is_friend' => $is_friend,
                    'team_id' => null
                ];
            }) : [];

        if (!$search) {
            $current_user = $this->model->where('id', $user_id)->first()->load('friends:id,name,username');
            $search_player = $current_user ?  $current_user->friends()
                ->select('users.id', 'users.name', 'users.username')
                ->with(['ranking' => function ($query) {
                    $query->select('id', 'user_id', 'rating');
                }])
                ->whereHas('roles', function ($query) {
                    $query->where('key', Roles::CLIENT);
                })
                ->limit(50)->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'rating' => (float) ($user->ranking->rating ?? 0.0),
                        'is_friend' => true,
                        'team_id' => null
                    ];
                }) : [];
        }

        $assigned_players = $this->booking_model->where('id', $booking_id)->with(
            'players:id,name,username',
            'players.ranking:id,user_id,rating'
        )->first()->players()->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'rating' => (float) ($user->ranking->rating ?? 0.0),
                    'team_id' => (int) $user->pivot->team_id
                ];
            });

        $team_a = $assigned_players->where('team_id', 1)->values();
        $team_b = $assigned_players->where('team_id', 2)->values();

        return [
            'players' => $search_player,
            'teamA' => $team_a,
            'teamB' => $team_b
        ];
    }
}
