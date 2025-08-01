<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Support\Facades\DB;

/**
 * Class Chair
 *
 * @property $id
 * @property $organization_id
 * @property $branch_id
 * @property $faculty_id
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
 * @property ChairTranslation[] $chairTranslations
 * @property Faculty $faculty
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chair extends Model implements TranslatableContract
{

    use Translatable;

    // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['organization_id', 'branch_id', 'faculty_id', 'code', 'isActive', 'logo', 'image_path', 'icon_path', 'created_by', 'updated_by'];


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
    public function chairTranslations()
    {
        return $this->hasMany('App\Models\ChairTranslation', 'chair_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function faculty()
    {
        return $this->hasOne('App\Models\Faculty', 'id', 'faculty_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany('App\Models\UserProfile', 'chair_id', 'id');
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
        $data['branch_id'] = $request->input('branch_id');
        $data['faculty_id'] = $request->input('faculty_id');
        $data['isActive'] = $request->input('isActive');
        $data['code'] = $request->input('code');
        return $data;
    }

    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
            'branch_id' => 'required',
            'faculty_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }

    public static function createOrUpdateByHemisCode($data, $department)
    {

        $checkExist = self::where('code', $data['code'])->first();

        $faculty = Faculty::createOrUpdateByHemisCode($department);
        $faculty_id = null;
        if ($faculty != null && $faculty) {
            $faculty_id = $faculty->id;
        }

        if ($checkExist != null) {
            $newData = [
                'code' => $data['code'],
                'faculty_id' => $faculty_id,
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
                'faculty_id' => $faculty_id,
                'branch_id' => 1,
                'code' => $data['code'],
                'uz' => [
                    "title" => $data['name'],
                    "locale" => "uz",
                    "slug" => null
                ],
            ];
            $model = Chair::create($newData);
            return $model;
        }
    }

    public static function GetCountUsersByChairId($id = null)
    {
        $cards = DB::select("SELECT SUM(COUNT(DISTINCT bil.book_id)) OVER() as nomda FROM `book_texts` as bt left JOIN books as b on b.book_text_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id GROUP by bil.book_id limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

}
