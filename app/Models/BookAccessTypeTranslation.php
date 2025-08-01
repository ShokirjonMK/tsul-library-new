<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookAccessTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_access_type_id
 * @property $title
 * @property $slug
 *
 * @property BookAccessType $bookAccessType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookAccessTypeTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'book_access_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_access_type_id','title','slug'];
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
    public function bookAccessType()
    {
        return $this->hasOne('App\Models\BookAccessType', 'id', 'book_access_type_id');
    }
    


}
