<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class FacultyTranslation
 *
 * @property $id
 * @property $locale
 * @property $faculty_id
 * @property $title
 * @property $slug
 * @property $content
 * @property $address
 * @property $address2
 *
 * @property Faculty $faculty
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FacultyTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'faculty_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','faculty_id','title','slug','content','address','address2'];
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
    public function faculty()
    {
        return $this->hasOne('App\Models\Faculty', 'id', 'faculty_id');
    }
    


}
