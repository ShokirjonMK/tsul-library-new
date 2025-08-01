<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookLanguageTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_language_id
 * @property $title
 * @property $slug
 *
 * @property BookLanguage $bookLanguage
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookLanguageTranslation extends Model
{
  use Sluggable;
    static $rules = [
		'locale' => 'required',
		'book_language_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_language_id','title','slug'];
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
    public function bookLanguage()
    {
        return $this->hasOne('App\Models\BookLanguage', 'id', 'book_language_id');
    }
    


}
