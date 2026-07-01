<?php

namespace Src\Modules\PQRS\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;

final class VO
{
    private ?int $id;
    private ?int $user_id;
    private ?int $ranking;
    private ?string $improvement_idea;
    private string $type;
    private ?string $subject;
    private ?string $message;

    public function __construct()
    {
    }

    public function set_id(?int $id): void
    {
        $this->id = $id;
    }

    public function get_id(): ?int
    {
        return $this->id;
    }

    public function set_user_id(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function get_user_id(): ?int
    {
        return $this->user_id;
    }

    public function set_ranking(?int $ranking): void
    {
        $this->ranking = $ranking;
    }

    public function get_ranking(): ?int
    {
        return $this->ranking;
    }

    public function set_improvement_idea(?string $improvement_idea): void
    {
        $this->improvement_idea = $improvement_idea;
    }

    public function get_improvement_idea(): ?string
    {
        return $this->improvement_idea;
    }

    public function set_type(string $type): void
    {
        $this->type = $type;
    }

    public function get_type(): string
    {
        return $this->type;
    }

    public function set_subject(?string $subject): void
    {
        $this->subject = $subject;
    }

    public function get_subject(): ?string
    {
        return $this->subject;
    }

    public function set_message(?string $message): void
    {
        $this->message = $message;
    }

    public function get_message(): ?string
    {
        return $this->message;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            '_id' => $this->get_id(),
            'user_id' => $this->get_user_id(),
            'ranking' => $this->get_ranking(),
            'improvement_idea' => $this->get_improvement_idea(),
            'type' => $this->get_type(),
            'subject' => $this->get_subject(),
            'message' => $this->get_message(),
        ]);
    }
}
