<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','body','user_id'];
    protected $with = ['owner'];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
