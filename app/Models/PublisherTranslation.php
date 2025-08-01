<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PublisherTranslation
 *
 * @property $id
 * @property $locale
 * @property $publisher_id
 * @property $title
 * @property $slug
 * @property $content
 *
 * @property Publisher $publisher
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PublisherTranslation extends Model
{
    use Sluggable;

    static $rules = [
		'locale' => 'required',
		'publisher_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];
 

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','publisher_id','title','slug','content'];
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
    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher', 'id', 'publisher_id');
    }
    


}
