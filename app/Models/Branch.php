<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Branch
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $logo
 * @property $image_path
 * @property $icon_path
 * @property $address
 * @property $address2
 * @property $phone
 * @property $organization_id
 * @property $phone2
 * @property $email
 * @property $email2
 * @property $fax
 * @property $fax2
 * @property $stir
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property BranchTranslation[] $branchTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Branch extends Model implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];
    
 

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','organization_id','isActive','logo','image_path','icon_path','address','address2','phone','phone2','email','email2','fax','fax2','stir','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branchTranslations()
    {
        return $this->hasMany('App\Models\BranchTranslation', 'branch_id', 'id');
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
        return $data;
    }
    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookInventar()
    {
        return $this->hasMany('App\Models\BookInventar', 'branch_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany('App\Models\Book', 'branch_id', 'id');
    }

}
