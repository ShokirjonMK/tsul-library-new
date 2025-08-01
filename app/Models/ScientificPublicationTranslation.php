<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScientificPublicationTranslation
 *
 * @property $id
 * @property $locale
 * @property $scientific_publication_id
 * @property $title
 * @property $slug
 * @property $sub_title
 * @property $country
 * @property $inst_nome_address
 * @property $authors
 * @property $keywords
 * @property $place_protection
 * @property $content
 * @property $description
 *
 * @property ScientificPublication $scientificPublication
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ScientificPublicationTranslation extends Model
{
  use Sluggable;
  static $rules = [
    'locale' => 'required',
    'scientific_publication_id' => 'required',
    'title' => 'required',
    'slug' => 'required',
  ];


  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['locale', 'scientific_publication_id', 'title', 'slug', 'sub_title', 'country', 'inst_nome_address', 'authors', 'keywords', 'place_protection', 'content', 'description'];
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
  public function scientificPublication()
  {
    return $this->hasOne('App\Models\ScientificPublication', 'id', 'scientific_publication_id');
  }
}
