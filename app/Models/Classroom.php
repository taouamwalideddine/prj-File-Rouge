<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
public function teacher(){
    return $this->belongsTo(User::class, 'teacher_id');
}
public function students(){
    return $this->belongsTo(User::class, 'classroom_user');
}
}
