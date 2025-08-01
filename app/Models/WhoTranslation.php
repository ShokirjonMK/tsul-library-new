<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class WhoTranslation
 *
 * @property $id
 * @property $locale
 * @property $who_id
 * @property $title
 * @property $slug
 *
 * @property Who $who
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WhoTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'who_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','who_id','title','slug'];
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
    public function who()
    {
        return $this->hasOne('App\Models\Who', 'id', 'who_id');
    }
    


}
