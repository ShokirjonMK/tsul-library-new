<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ArticleTranslation
 *
 * @property $id
 * @property $locale
 * @property $article_id
 * @property $title
 * @property $slug
 * @property $sub_title
 * @property $description
 * @property $inst_name_address
 * @property $key_word
 * @property $content
 *
 * @property Article $article
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ArticleTranslation extends Model
{
  use Sluggable;

  static $rules = [
    'locale' => 'required',
    'article_id' => 'required',
    'title' => 'required',
    'slug' => 'required',
  ];


  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['locale', 'article_id', 'title', 'slug', 'sub_title', 'description', 'inst_name_address', 'key_word', 'content'];

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
  public function article()
  {
    return $this->hasOne('App\Models\Article', 'id', 'article_id');
  }
}
