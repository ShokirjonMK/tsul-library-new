<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ReferenceGenderTranslation
 *
 * @property $id
 * @property $locale
 * @property $reference_gender_id
 * @property $title
 * @property $slug
 *
 * @property ReferenceGender $referenceGender
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ReferenceGenderTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'reference_gender_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','reference_gender_id','title','slug'];
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
    public function referenceGender()
    {
        return $this->hasOne('App\Models\ReferenceGender', 'id', 'reference_gender_id');
    }
    


}
