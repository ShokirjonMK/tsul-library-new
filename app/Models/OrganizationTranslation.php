<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class OrganizationTranslation
 *
 * @property $id
 * @property $locale
 * @property $organization_id
 * @property $title
 * @property $slug
 * @property $content
 * @property $address
 * @property $address2
 *
 * @property Organization $organization
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrganizationTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'organization_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','organization_id','title','slug','content','address','address2'];
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
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }
    


}
