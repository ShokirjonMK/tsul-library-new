<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $education_type_id
 * @property $title
 * @property $slug
 *
 * @property EducationType $educationType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EducationTypeTranslation extends Model
{
    use Sluggable;

    static $rules = [
		'locale' => 'required',
		'education_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','education_type_id','title','slug'];

    public $timestamps = false;

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
    public function educationType()
    {
        return $this->hasOne('App\Models\EducationType', 'id', 'education_type_id');
    }



}
