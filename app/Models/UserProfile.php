<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function getProfilePhotoAttribute($profile_photo)
    {
        return ($profile_photo != null ) ? url('uploads/users/'.$profile_photo) : url('common_img/defoult_profile_image.png');
    }

    public function setDobAttribute($dob)
    {
    	$dob = str_replace('/', '-', $dob);
        $this->attributes['dob'] = date('Y-m-d', strtotime($dob));
    }

    public function getDobAttribute($dob)
    {
        if(!empty($dob)){
        return date('d-m-Y', strtotime($dob));
        }
    }
}
