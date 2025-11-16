<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;
=======
// use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory;
>>>>>>> 969e263 (Your commit message)

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
        return $this->hasMany(Attachment::class, 'agenda_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}

}