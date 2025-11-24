<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concern extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'concerns';
    protected $primaryKey = 'concern_id';

    protected $fillable = [
        'agenda_id',
        'description',
        'responsible_person_id',
        'status',
        'due_date',
    ];

    // ✅ Each concern belongs to an agenda
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    // ✅ Each concern belongs to a responsible user
    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_person_id');
    }

    // ✅ Optional: if you have comments or attachments
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'concern_id');
    }

    public function commentList()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
