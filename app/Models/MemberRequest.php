<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MemberRequest extends Model
{
    protected $table = 'membership_request';

    protected $fillable = [
        'name',
        'user_id',
        'member_role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
