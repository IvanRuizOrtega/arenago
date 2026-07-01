<?php

namespace Src\Resources\Constants;

final class Routes
{
    public const GOOGLE_LOGIN = 'google.auth';
    public const GOOGLE_CALLBACK = 'google.callback';
    public const LOGOUT = 'logout';
    public const WELCOME = 'welcome';
    public const CHANGE_ROLE = 'change.role';

    public const SPORT_CENTER = 'sportcenters';
    public const SPORT_CENTER_INDEX = Routes::SPORT_CENTER . 'index';
    public const SPORT_CENTER_SHOW = Routes::SPORT_CENTER . '.show';
    public const SPORT_CENTER_CREATE = 'my-sportcenters.create';
    public const SPORT_CENTER_CREATE_FORM = Routes::SPORT_CENTER . '.create.form';
    public const SPORT_CENTER_EDIT_FORM = Routes::SPORT_CENTER . '.edit.form';
    public const SPORT_CENTER_EDIT = Routes::SPORT_CENTER . '.edit';
    public const SPORT_CENTER_FORGET = Routes::SPORT_CENTER . '.forget';

    public const MY_SPORT_CENTER = 'my-sportcenters';
    public const MY_SPORT_CENTER_INDEX = Routes::MY_SPORT_CENTER . '.index';
    public const MY_SPORT_CENTER_SHOW = Routes::MY_SPORT_CENTER . '.show';
    public const MY_SPORT_CENTER_CREATE_FORM = Routes::MY_SPORT_CENTER . '.create.form';
    public const MY_SPORT_CENTER_CREATE = Routes::MY_SPORT_CENTER . '.create.playing.field';
    public const MY_SPORT_CENTER_PLAYING_FIELD_SHOW = Routes::MY_SPORT_CENTER . '.playing.field.show';
    public const MY_SPORT_CENTER_EDIT_FORM = Routes::MY_SPORT_CENTER . '.create.playing.field.edit.form';
    public const MY_SPORT_CENTER_EDIT_FORGET = Routes::MY_SPORT_CENTER . '.create.playing.field.forget';

    public const PLAYING_FIELD = 'playing-fields';
    public const PLAYING_FIELD_TIME = Routes::PLAYING_FIELD . '.time';

    public const MY_STAFF = 'my-staff';
    public const MY_MATCHDAY_HUB = 'my-matchday-hub';
    public const MY_STAFF_INDEX = Routes::MY_STAFF . '.index';
    public const MY_MATCHDAY_HUB_INDEX = Routes::MY_MATCHDAY_HUB . '.index';

    public const BOOKING = 'bookings';
    public const BOOKING_CREATE = Routes::BOOKING . '.create';
    public const BOOKING_INDEX = Routes::BOOKING . '.index';
    public const BOOKING_EDIT = Routes::BOOKING . '.edit';
    public const BOOKING_TEAM = Routes::BOOKING . '.teams';
    public const BOOKING_TEAM_UPDATE = Routes::BOOKING . '.teams.update';
    public const BOOKING_TEAM_CLOSE_FORM = Routes::BOOKING . '.teams.close.form';
    public const BOOKING_TEAM_CLOSE = Routes::BOOKING . '.teams.close';

    public const PQRS = 'pqrs';
    public const PQRS_CREATE = Routes::PQRS . '.create';
    public const PQRS_CREATE_FORM = Routes::PQRS . '.create.form';

    public const USERS = 'users';
    public const USERS_INDEX = Routes::USERS . 'index';
    public const USERS_SHOW = Routes::USERS . 'show';
    public const USERS_UPDATE = Routes::USERS . 'update';
    public const USERS_FRIENDS = Routes::USERS . 'toggle';
}
