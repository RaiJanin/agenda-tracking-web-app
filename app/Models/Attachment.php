<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['file_path'];

    public function attachable()
    {
        return $this->morphTo();
    }
}
