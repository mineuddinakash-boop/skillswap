<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // You'll need to add this use statement for the relationships to work

class SkillRequest extends Model
{
    protected $fillable = ['from_user_id', 'to_user_id', 'status'];

    public function fromUser() {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser() {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}