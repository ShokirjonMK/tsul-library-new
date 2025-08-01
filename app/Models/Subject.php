<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class Subject
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
 * @property Book[] $books
 * @property SubjectTranslation[] $subjectTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subject extends Model  implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug', 'body'];
    
    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','isActive','image_path','icon_path','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'subject_id', 'id');
    }
    
    public static function GetCountBookCopiesByBookTypeId($id = null)
    {
        $cards = DB::select("SELECT COUNT(*) as nusxa FROM `subjects` as bt left JOIN books as b on b.subject_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id GROUP by bt.id;");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
    }

    public static function GetCountBookByBookTypeId($id = null)
    {
        $cards = DB::select("SELECT SUM(COUNT(DISTINCT bil.book_id)) OVER() as nomda FROM `subjects` as bt left JOIN books as b on b.subject_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id GROUP by bil.book_id limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjectTranslations()
    {
        return $this->hasMany('App\Models\SubjectTranslation', 'subject_id', 'id');
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

    public static function GetCountBookByBookTypeByMonthAndId($id = null, $year, $month)
    {
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
       
        $cards = DB::select("SELECT SUM(COUNT(DISTINCT bil.book_id)) OVER() as nomda FROM `subjects` as bt left JOIN books as b on b.subject_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id and DATE(bil.created_at) between '$startDate' and '$endDate' GROUP by bil.book_id  limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

    public static function GetCountBookCopiesByBookTypeByMonthAndId($id = null, $year, $month)
    {
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();

        $cards = DB::select("SELECT COUNT(*) as nusxa FROM `subjects` as bt left JOIN books as b on b.subject_id  = bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id and DATE(bil.created_at) between '$startDate' and '$endDate' GROUP by bt.id;");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
    }


}
