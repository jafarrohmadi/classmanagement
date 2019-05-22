<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Students extends Model
{
	protected $table = 'students';
    protected $fillable = ['student_nis', 'name','gender', 'picture','dob', 'phone', 'address','class_id'];


    public function class()
    {
        return $this->belongsTo(Classroom::class, "class_id");
    }

    public static function generateStudentNis($nis = null)
    {
        $newnis = 'NIS';
        $year = date("Y");
        if($nis){
            $lastnis =  $nis + 1;
        }else{
            $lastnis = Students::query()->count() + 1;
        }
        
        if($lastnis <= 9){
          $lastnis = '000'.$lastnis;
        }else if($lastnis <= 99){
          $lastnis = '00'.$lastnis;
        }else{
          $lastnis = '0'.$lastnis;
        }

        $findsamenis = Students::where('student_nis', $newnis.$year.$lastnis)->first();
        if($findsamenis){
            return Students::generateStudentNis($lastnis);
        }
        return $newnis.$year.$lastnis;
    }

    public function imageUrl()
    {
        
        $url = url('/desain/images/user.png');
        if (file_exists(public_path('/uploads/students/') . $this->picture)) {
            $url = url('/uploads/students/' . $this->picture);
        }
        return $url;
    }

    public function upload($picture)
    {
        $fileName = rand(11111, 99999) . '.' . $picture->getClientOriginalExtension();
        $image_resize = Image::make($picture->getRealPath());              
        $image_resize->resize(300, 300);
        if ( $image_resize->save(public_path('/uploads/students/' .$fileName))) {
            $this->picture = $fileName;
        }
    }

}

