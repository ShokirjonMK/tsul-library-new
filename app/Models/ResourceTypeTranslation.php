<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ResourceTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $resource_type_id
 * @property $title
 * @property $slug
 *
 * @property ResourceType $resourceType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ResourceTypeTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'resource_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','resource_type_id','title','slug'];
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
    public function resourceType()
    {
        return $this->hasOne('App\Models\ResourceType', 'id', 'resource_type_id');
    }
    


}
