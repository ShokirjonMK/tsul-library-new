<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectGroupTranslation
 *
 * @property $id
 * @property $locale
 * @property $subject_group_id
 * @property $title
 * @property $slug
 *
 * @property SubjectGroup $subjectGroup
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SubjectGroupTranslation extends Model
{
    use Sluggable;

    static $rules = [
		'locale' => 'required',
		'subject_group_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','subject_group_id','title','slug'];
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
    public function subjectGroup()
    {
        return $this->hasOne('App\Models\SubjectGroup', 'id', 'subject_group_id');
    }



}
