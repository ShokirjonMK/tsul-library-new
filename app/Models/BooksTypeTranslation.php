<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BooksTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $books_type_id
 * @property $title
 * @property $slug
 *
 * @property BooksType $booksType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BooksTypeTranslation extends Model
{
  use Sluggable;
  static $rules = [
    'locale' => 'required',
    'books_type_id' => 'required',
    'title' => 'required',
    'slug' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['locale', 'books_type_id', 'title', 'slug'];
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
  public function booksType()
  {
    return $this->hasOne('App\Models\BooksType', 'id', 'books_type_id');
  }
}
