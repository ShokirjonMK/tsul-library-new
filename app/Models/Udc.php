<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Class Udc
 *
 * @property $id
 * @property $udc_number
 * @property $slug
 * @property $description
 * @property $number_of_codes
 * @property $notes
 * @property $parent_id
 * @property $udc_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Udc $udc
 * @property Udc[] $udcs
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Udc extends Model
{
    use Sluggable;
    


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['udc_number','slug','description','number_of_codes','notes','parent_id','udc_id','created_by','updated_by'];
/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'udc_number'
        ]
      ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function udc()
    {
        return $this->hasOne('App\Models\Udc', 'id', 'udc_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function udcs()
    {
        return $this->hasMany('App\Models\Udc', 'udc_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne('App\Models\Udc', 'id', 'parent_id');
    }

    public function subcategory(){
        return $this->hasMany('App\Models\Udc', 'parent_id');
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
         
        
        $data['udc_number'] = $request->input('udc_number');
        $data['description'] = $request->input('description');
        $data['number_of_codes'] = $request->input('number_of_codes');
        $data['notes'] = $request->input('notes');
        $data['notes'] = $request->input('notes');
        $data['parent_id'] = $request->input('parent_id');
        $data['udc_id'] = $request->input('udc_id');

        return $data;
    }
    public static function rules()
    {
        $rules = [
            'udc_number' => 'required',
            'description' => 'required',
        ];
        return $rules;
    }


}
