<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['body','skills_id','user_id'];
    protected $with = ['owner'];


    public function skill(){

        return $this->belongsto(Skill::class);

    }

    public function owner(){

        return $this->belongsto(User::class, 'user_id');

    }
}
