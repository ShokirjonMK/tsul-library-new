<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ChairTranslation
 *
 * @property $id
 * @property $locale
 * @property $chair_id
 * @property $title
 * @property $slug
 * @property $content
 *
 * @property Chair $chair
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ChairTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'chair_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','chair_id','title','slug','content'];
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
    public function chair()
    {
        return $this->hasOne('App\Models\Chair', 'id', 'chair_id');
    }
    


}
