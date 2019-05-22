<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','dob','phone', 'id_telegram'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function imageUrl()
    {
        
        $url = url('/desain/images/user.png');
        if (file_exists(public_path('/uploads/user/') . $this->picture)) {
            $url = url('/uploads/user/' . $this->picture);
        }
        return $url;
    }

    public function upload($picture)
    {
        $fileName = rand(11111, 99999) . '.' . $picture->getClientOriginalExtension();
        $image_resize = Image::make($picture->getRealPath());              
        $image_resize->resize(300, 300);
        if ( $image_resize->save(public_path('/uploads/user/' .$fileName))) {
            $this->picture = $fileName;
        }
    }

    /**
     * User otp relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function otp()
    {
        return $this->hasMany(Otp::class);
    }

    public function routeNotificationForTelegram()
    {
        return $this->id_telegram;
    }
}
