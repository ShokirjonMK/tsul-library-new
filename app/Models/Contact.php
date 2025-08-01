<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Contact
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $logo
 * @property $image_path
 * @property $email
 * @property $email2
 * @property $phone
 * @property $phone2
 * @property $phone3
 * @property $fax
 * @property $fax2
 * @property $fax3
 * @property $map
 * @property $icon_path
 * @property $bg_image
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property ContactTranslation[] $contactTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contact extends Model implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug', 'street_address'];
    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','isActive','logo','image_path','email','email2','phone','phone2','phone3','fax','fax2','fax3','map','icon_path','bg_image','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactTranslations()
    {
        return $this->hasMany('App\Models\ContactTranslation', 'contact_id', 'id');
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
    
    public function scopeMain($query)
    {
        return $query->active()->where('code', 'main');
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

    public static function GetData(Request $request, Contact $contact)
    {
        $data = []; 
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }  

        $data['code'] = $request->input('code');  
        $data['email'] = $request->input('email');  
        $data['phone'] = $request->input('phone');  
        $data['fax'] = $request->input('fax');
        $data['isActive'] = $request->input('isActive');
        $contact_coverage_image_name = '';
        if ($request->file('file')) {
            $contact_coverage_image_name = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('contacts/logo', $contact_coverage_image_name, 'public');
            $data['logo'] = $contact_coverage_image_name;
            if ($contact != null && $contact->logo) {
                $path = public_path('storage/contacts/logo/' . $contact->logo);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        }
        
        return $data;
    }
    public static function rules()
    {
        
        $rules = [
            'email' => 'required',
            'phone' => 'required', 
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
            $rules['street_address_' . $k] = 'required';
        }
        return $rules;
    }

}
