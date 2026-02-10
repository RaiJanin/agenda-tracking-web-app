<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'agendas';
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'title',
        'date',
        'created_by',
        'notes',
        'file_path',
        'status',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function concerns()
    {
        return $this->hasMany(Concern::class, 'agenda_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted()
    {
        static::deleting(function ($agenda) {
            if($agenda->isForceDeleting())
            {
                $agenda->concerns()->withTrashed()->get()->each(function ($c) {
                    $c->commentList()->forceDelete();
                });

                $agenda->concerns()->withTrashed()->forceDelete();

                $agenda->attachments()->withTrashed()->get()->each(function ($attachment) {
                    if(file_exists(storage_path('app/public/'.$attachment->file_path)))
                    {
                        unlink(storage_path('app/public/'.$attachment->file_path));
                    }
                });
                
                $agenda->attachments()->withTrashed()->forceDelete();
            }
            else
            {
                $agenda->concerns()->delete();
                $agenda->attachments()->delete();
            }
        });

        static::restoring(function ($agenda) {
            $agenda->concerns()->withTrashed()->restore();
            $agenda->attachments()->withTrashed()->restore();
        });
    }

}