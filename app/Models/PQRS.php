<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['ranking', 'improvement_idea', 'type', 'subject', 'message', 'user_id'])]
#[Table('pqrs')]
class PQRS extends Model
{
    use HasFactory;
}
