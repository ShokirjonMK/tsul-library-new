<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class BookFileTypeTranslation
 *
 * @property $id
 * @property $locale
 * @property $book_file_type_id
 * @property $title
 * @property $slug
 *
 * @property BookFileType $bookFileType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookFileTypeTranslation extends Model
{
    use Sluggable;
    static $rules = [
		'locale' => 'required',
		'book_file_type_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','book_file_type_id','title','slug'];

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
    public function bookFileType()
    {
        return $this->hasOne('App\Models\BookFileType', 'id', 'book_file_type_id');
    }
    


}
