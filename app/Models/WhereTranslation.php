<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class WhereTranslation
 *
 * @property $id
 * @property $locale
 * @property $where_id
 * @property $title
 * @property $slug
 *
 * @property Where $where
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WhereTranslation extends Model
{
  use Sluggable;
    static $rules = [
		'locale' => 'required',
		'where_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','where_id','title','slug'];
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
    public function where()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
    }
    


}
