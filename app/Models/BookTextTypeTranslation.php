<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookTextTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_text_type_id
 * @property $title
 * @property $slug
 *
 * @property BookTextType $bookTextType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookTextTypeTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'book_text_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_text_type_id','title','slug'];
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
    public function bookTextType()
    {
        return $this->hasOne('App\Models\BookTextType', 'id', 'book_text_type_id');
    }
    


}
