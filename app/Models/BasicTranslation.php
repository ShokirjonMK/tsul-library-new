<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BasicTranslation
 *
 * @property $id
 * @property $locale
 * @property $basic_id
 * @property $title
 * @property $slug
 * @property $content
 *
 * @property Basic $basic
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BasicTranslation extends Model
{
    use Sluggable;

    static $rules = [
		'locale' => 'required',
		'basic_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','basic_id','title','slug','content'];


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
    public function basic()
    {
        return $this->hasOne('App\Models\Basic', 'id', 'basic_id');
    }
    


}
