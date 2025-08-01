<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookTextTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_text_id
 * @property $title
 * @property $slug
 *
 * @property BookText $bookText
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookTextTranslation extends Model
{
  use Sluggable;
    static $rules = [
		'locale' => 'required',
		'book_text_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_text_id','title','slug'];

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
    public function bookText()
    {
        return $this->hasOne('App\Models\BookText', 'id', 'book_text_id');
    }
    


}
