<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class BookSubject
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
 * @property BookSubjectTranslation[] $bookSubjectTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookSubject extends Model implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','isActive','image_path','icon_path','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookSubjectTranslations()
    {
        return $this->hasMany('App\Models\BookSubjectTranslation', 'book_subject_id', 'id');
    }
    
    //  /**
    //  * @return \Illuminate\Database\Eloquent\Relations\hasMany
    //  */
    // public function books()
    // {
    //     return $this->hasMany('App\Models\Book', 'book_text_id', 'id');
    // }
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
        if($model!=null){
            return $model;
        }

        return null;

    }
    public static function GetTitleById($id)
    {
        $model = self::find($id);
        if($model!=null){
            return $model->title;
        }
        return null;
    }
    public static function GetIdByJsonName($names)
    {
        $ids=[];
        if($names != "null" && $names != null && count(json_decode($names))>0){
            foreach(json_decode($names) as $k=>$v){
                $model = self::active()->whereTranslation('title', $v)->first();
                if($model != null){
                    $ids[$k]=$model->id;
                }
            }
        }
        return $ids;
    }


}
