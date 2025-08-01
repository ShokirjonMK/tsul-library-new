<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ExtraAuthorTranslation
 *
 * @property $id
 * @property $locale
 * @property $extra_author_id
 * @property $title
 * @property $slug
 * @property $content
 *
 * @property ExtraAuthor $extraAuthor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExtraAuthorTranslation extends Model
{
  use Sluggable;


    static $rules = [
		'locale' => 'required',
		'extra_author_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','extra_author_id','title','slug','content'];
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
    public function extraAuthor()
    {
        return $this->hasOne('App\Models\ExtraAuthor', 'id', 'extra_author_id');
    }
    


}
