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
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function commentList()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected static function booted()
    {
        static::deleting(function ($concern) {
            if($concern->isForceDeleting())
            {
                $concern->attachments()->withTrashed()->get()->each(function ($attachment) {
                    if(file_exists(storage_path('app/public/'.$attachment->file_path)))
                    {
                        unlink(storage_path('app/public/'.$attachment->file_path));
                    }
                });
                
                $concern->attachments()->withTrashed()->forceDelete();
                $concern->commentList()->forceDelete();
            }
            else
            {
                $concern->attachments()->delete();
            }
        });

        static::restoring(function ($concern) {
            $concern->attachments()->withTrashed()->restore();
        });
    }
}
