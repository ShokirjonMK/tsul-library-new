<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class DepartmentTranslation
 *
 * @property $id
 * @property $locale
 * @property $department_id
 * @property $title
 * @property $slug
 *
 * @property Department $department
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DepartmentTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'department_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','department_id','title','slug'];
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
    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
    


}
