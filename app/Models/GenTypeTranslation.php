<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GenTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $gen_type_id
 * @property $title
 * @property $slug
 * @property $content
 *
 * @property GenType $genType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GenTypeTranslation extends Model
{
  use Sluggable;
    static $rules = [
		'locale' => 'required',
		'gen_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','gen_type_id','title','slug','content'];
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
    public function genType()
    {
        return $this->hasOne('App\Models\GenType', 'id', 'gen_type_id');
    }
    


}
