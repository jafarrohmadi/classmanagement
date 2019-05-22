<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Teacher extends Model
{
	protected $table = 'teachers';
    protected $fillable = ['teacher_nip', 'name','gender','experience', 'picture','dob', 'phone', 'address'];

    public function class()
    {
        return $this->belongsTo(Classroom::class, "teacher_id", "id");
    }
    
    public static function generateTeacherNip($nip = null)
    {
        $newnip = 'NIP';
        $year = date("Y");
        if($nip){
            $lastnip =  $nip + 1;
        }else{
            $lastnip = Teacher::query()->count() + 1;
        }
        
        if($lastnip <= 9){
          $lastnip = '000'.$lastnip;
        }else if($lastnip <= 99){
          $lastnip = '00'.$lastnip;
        }else{
          $lastnip = '0'.$lastnip;
        }

        $findsamenip = Teacher::where('teacher_nip', $newnip.$year.$lastnip)->first();
        if($findsamenip){
            return Teacher::generateTeacherNip($lastnip);
        }
        return $newnip.$year.$lastnip;
    }

    public function imageUrl()
    {
        $url = url('/desain/images/user.png');
        if (file_exists(public_path('/uploads/teacher/') . $this->picture)) {
            $url = url('/uploads/teacher/' . $this->picture);
        }
        return $url;
    }

    public function upload($picture)
    {
        $fileName = rand(11111, 99999) . '.' . $picture->getClientOriginalExtension();
        $image_resize = Image::make($picture->getRealPath());              
        $image_resize->resize(300, 300);
        if ( $image_resize->save(public_path('/uploads/teacher/' .$fileName))) {
            $this->picture = $fileName;
        }
    }

}
