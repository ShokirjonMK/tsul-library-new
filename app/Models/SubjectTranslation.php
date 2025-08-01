<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class SubjectTranslation
 *
 * @property $id
 * @property $locale
 * @property $subject_id
 * @property $title
 * @property $slug
 *
 * @property Subject $subject
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SubjectTranslation extends Model
{
  use Sluggable;
  static $rules = [
    'locale' => 'required',
    'subject_id' => 'required',
    'title' => 'required',
    'slug' => 'required',
  ];


  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['locale', 'subject_id', 'title', 'slug'];
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
  public function subject()
  {
    return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
  }
}
