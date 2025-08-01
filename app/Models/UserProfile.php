<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UserProfile
 *
 * @property $id
 * @property $phone_number
 * @property $pnf_code
 * @property $passport_seria_number
 * @property $passport_copy
 * @property $image
 * @property $date_of_birth
 * @property $kursi
 * @property $gender_id
 * @property $user_type_id
 * @property $user_id
 * @property $faculty_id
 * @property $organization_id
 * @property $branch_id
 * @property $department_id
 * @property $faculty_id
 * @property $chair_id
 * @property $group_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 * @property $address
 *
 * @property Branch $branch
 * @property Department $department
 * @property ReferenceGender $referenceGender
 * @property User $user
 * @property User $user
 * @property User $user
 * @property UserType $userType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserProfile extends Model
{
    
    static $rules = [
		'phone_number' => 'required',
    ];

 
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['phone_number','pnf_code','passport_seria_number','passport_copy','image','date_of_birth','kursi','gender_id','user_type_id','user_id', 'organization_id', 'branch_id','department_id', 'faculty_id', 'chair_id', 'group_id', 'address',  'created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function faculty()
    {
        return $this->hasOne('App\Models\Faculty', 'id', 'faculty_id');
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chair()
    {
        return $this->hasOne('App\Models\Chair', 'id', 'chair_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function referenceGender()
    {
        return $this->hasOne('App\Models\ReferenceGender', 'id', 'gender_id');
    }
    
    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasOne
    //  */
    // public function user()
    // {
    //     return $this->hasOne('App\Models\User', 'id', 'user_id');
    // }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userType()
    {
        return $this->hasOne('App\Models\UserType', 'id', 'user_type_id');
    }
 
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

     
    /**
     * This is model Observer which helps to do the same actions automatically when you creating or updating models
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public static function GetCountUsersByUserByTwoMonth($user_id = null, $startDate, $endDate)
    {
        
        $cards = DB::select("SELECT SUM(COUNT(DISTINCT d.id)) OVER() as nomda FROM `user_profiles` as d where d.`created_by`=$user_id and DATE(d.created_at) between '$startDate' and '$endDate' GROUP by d.id limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

}
