<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class AuthorTranslation
 *
 * @property $id
 * @property $locale
 * @property $author_id
 * @property $title
 * @property $slug
 * @property $body
 *
 * @property Author $author
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AuthorTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'author_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','author_id','title','slug','body'];

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
    public function author()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
    


}
