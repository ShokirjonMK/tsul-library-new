<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Http\Request;

/**
 * Class GenType
 *
 * @property $id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $code
 * @property $isActive
 * @property $logo
 * @property $image_path
 * @property $icon_path
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Branch $branch
 * @property Department $department
 * @property GenTypeTranslation[] $genTypeTranslations
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GenType extends Model implements TranslatableContract
{

    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['organization_id', 'branch_id', 'deportmetn_id', 'code', 'isActive', 'logo', 'image_path', 'icon_path', 'created_by', 'updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'deportmetn_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function genTypeTranslations()
    {
        return $this->hasMany('App\Models\GenTypeTranslation', 'gen_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
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

    public static function GetOrCreate($title)
    {

        if ($title > 0 || $title != "") {
                        $modelData = self::find($title);

            if ($modelData == null) {
                $model = self::whereTranslation('title',  $title)->first();
                if ($model == null) {
                    $data = null;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $data[$til_code] = [
                            'title' => $title
                        ];
                    }
                    $modelAuthor = self::create($data);
                    return $modelAuthor->id;
                }
                return $model->id;
            }
            return $modelData->id;
        }
        return null;
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
        $data['code'] = $request->input('code');

        $user = Auth::user()->profile;
        $data['organization_id'] = $user->organization_id;
        $data['branch_id']  = $user->branch_id;
        $data['deportmetn_id'] = $user->department_id;
        return $data;
    }
    public static function rules()
    {
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }
}
