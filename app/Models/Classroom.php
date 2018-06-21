<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
	protected $table = 'class';
    protected $fillable = ['name', 'room','from_hour', 'to_hour','date','teacher_id'];

	public function students()
    {
        return $this->hasMany(Students::class, "class_id", "id");
    }

	public function teacher()
    {
        return $this->belongsTo(Teacher::class, "teacher_id");
    }

}
