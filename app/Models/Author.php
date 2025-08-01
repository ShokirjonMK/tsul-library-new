<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Author
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $image_path
 * @property $icon_path
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property AuthorTranslation[] $authorTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Author extends Model implements TranslatableContract
{

    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];



    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'isActive', 'image_path', 'icon_path', 'created_by', 'updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authorTranslations()
    {
        return $this->hasMany('App\Models\AuthorTranslation', 'author_id', 'id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }
    /**
     * This is model Observer which helps to do the same actions automatically when you creating or updating models
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public static function GetData(Request $request)
    {
        $data = [];
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }
        $journal_coverage_image_name = '';
        if ($request->file('file')) {
            $journal_coverage_image_name = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('authors/photo', $journal_coverage_image_name, 'public');
            $data['image_path'] = $journal_coverage_image_name;
        }

        $data['isActive'] = $request->input('isActive');
        return $data;
    }
    public static function rules()
    {
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }
    public static function GetById($id)
    {
        $model = self::find($id);
        if ($model != null) {
            return $model;
        }
        return null;
    }
    public function change_str_with_alphabet($str)
    {
        $returnStr = str_replace('&#1202;', 'Ҳ', $str);
        $returnStr = str_replace('&#1203;', 'ҳ', $returnStr);
        $returnStr = str_replace('&#1178;', 'Қ', $returnStr);
        $returnStr = str_replace('&#1179;', 'қ', $returnStr);
        $returnStr = str_replace('&#1170;', 'Ғ', $returnStr);
        $returnStr = str_replace('&#1171;', 'ғ', $returnStr);
        $returnStr = str_replace('&#1171;', 'ғ', $returnStr);
        $returnStr = str_replace("\'", "'", $returnStr);
        return $returnStr;
    }

    public static function GetIdByJsonName($names)
    {

        $ids = [];
        if ($names != null && json_decode($names) != null && count(json_decode($names)) > 0) {
            foreach (json_decode($names) as $k => $v) {
                $model = self::active()->whereTranslation('title', self::change_str_with_alphabet($v))->first();
                if ($model != null) {
                    $ids[$k] = $model->id;
                } else {
                    foreach (json_decode($names) as $ks => $v) {
                        $author = Author::whereTranslation("title", self::change_str_with_alphabet($v))->first();

                        if ($author == null && $v != '') {
                            $authorData = null;
                            $count = 0;
                            foreach (config('app.locales') as $til_code => $locale) {
                                $authorData[$til_code] = [
                                    'title' => self::change_str_with_alphabet($v)
                                ];
                                $count += 1;
                            }
                            $modelAuthor = Author::create($authorData);
                            $ids[$k] = $modelAuthor->id;
                        }
                    }
                }
            }
        } else {
            if($names != null){
                $model = self::active()->whereTranslation('title', self::change_str_with_alphabet($names))->first();
            
                if ($model != null) {
                    $ids = $model->id;
                } else {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => self::change_str_with_alphabet($names)
                        ];
                        $count += 1;
                    }
                    $modelAuthor = Author::create($authorData);
                }
            }

        }
        return $ids;
    }

    public static function GetTitleById($id)
    {
        $model = self::find($id);
        if ($model != null) {
            return $model->title;
        }
        return null;
    }


    public static function GetStringNameByJsonName($names)
    {
        $ids = "";
        if ($names != null && json_decode($names) != null && count(json_decode($names)) > 0) {
            foreach (json_decode($names) as $k => $v) {
                $ids .= $v . ',';
            }
        }else{
            return $names;
        }
        return rtrim($ids, ',');
    }
}
