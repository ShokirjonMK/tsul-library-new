<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Faculty
 *
 * @property $id
 * @property $organization_id
 * @property $branch_id
 * @property $code
 * @property $isActive
 * @property $logo
 * @property $image_path
 * @property $icon_path
 * @property $phone
 * @property $phone2
 * @property $email
 * @property $email2
 * @property $fax
 * @property $fax2
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Branch $branch
 * @property FacultyTranslation[] $facultyTranslations
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Faculty extends Model implements TranslatableContract
{

    use Translatable;

    // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['organization_id', 'branch_id', 'code', 'isActive', 'logo', 'image_path', 'icon_path', 'phone', 'phone2', 'email', 'email2', 'fax', 'fax2', 'created_by', 'updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facultyTranslations()
    {
        return $this->hasMany('App\Models\FacultyTranslation', 'faculty_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany('App\Models\UserProfile', 'faculty_id', 'id');
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
            if (Auth::user()) {
                $user = Auth::user()->profile;
                if ($user != null) {
                    $model->organization_id = $user->organization_id;
                    $model->branch_id = $user->branch_id;
                }
            }else{
                $model->organization_id = 1;
                $model->branch_id = 1;
            }
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
        $data['organization_id'] = $request->input('organization_id');
        $data['isActive'] = $request->input('isActive');
        $data['branch_id'] = $request->input('branch_id');
        $data['code'] = $request->input('code');

        return $data;
    }

    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
            'branch_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }

    public static function getFacultyByCode($code)
    {
        $checkExist = self::where('code', $code)->first();

        if ($checkExist != null) {
            return $checkExist;
        } else {
            return null;
        }
    }

    public static function createOrUpdateByHemisCode($data)
    {
        $checkExist = self::where('code', $data['code'])->first();
        if ($checkExist != null) {
            $newData = [
                'code' => $data['code'],
                'uz' => [
                    "title" => $data['name'],
                    "locale" => "uz",
                    "slug" => null
                ],
            ];
            $checkExist->update($newData);
            return $checkExist;
        } else {
            $newData = [
                'organization_id' => 1,
                'isActive' => true,
                'branch_id' => 1,
                'code' => $data['code'],
                'uz' => [
                    "title" => $data['name'],
                    "locale" => "uz",
                    "slug" => null
                ],
            ];

            $model = Faculty::create($newData);
            return $model;
        }

    }

}
