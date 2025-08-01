<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class UserTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $user_type_id
 * @property $title
 * @property $slug
 *
 * @property UserType $userType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserTypeTranslation extends Model
{
  use Sluggable;
    static $rules = [
		'locale' => 'required',
		'user_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','user_type_id','title','slug'];
    public $timestamps = false;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userType()
    {
        return $this->hasOne('App\Models\UserType', 'id', 'user_type_id');
    }
    


}
