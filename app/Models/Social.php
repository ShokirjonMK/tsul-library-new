<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Class Social
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $link
 * @property $title
 * @property $fa_icon_class
 * @property $isMain
 * @property $order
 * @property $extra1
 * @property $extra2
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Social extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','isActive','link','title','fa_icon_class','isMain','order','extra1','extra2','created_by','updated_by'];


     
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
        return $query->active()->where('isMain', 1);
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
        $data['title'] = $request->input('title');
        $data['code'] = $request->input('code');
        $data['isActive'] = $request->input('isActive');
        $data['link'] = $request->input('link');
        $data['fa_icon_class'] = $request->input('fa_icon_class');
        $data['isMain'] = $request->input('isMain');
        $data['order'] = $request->input('order');
        
        return $data;
    }
    public static function rules()
    {
        $rules=[
            'title' =>'required',
            'link' =>'required',
        ];

        return $rules;
    }

    


}
