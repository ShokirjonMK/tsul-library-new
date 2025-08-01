<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookSubjectTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_subject_id
 * @property $title
 * @property $slug
 *
 * @property BookSubject $bookSubject
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookSubjectTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'book_subject_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_subject_id','title','slug'];

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
    public function bookSubject()
    {
        return $this->hasOne('App\Models\BookSubject', 'id', 'book_subject_id');
    }
    


}
