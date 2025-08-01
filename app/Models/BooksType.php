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
 * Class BooksType
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
 * @property BooksTypeTranslation[] $booksTypeTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BooksType extends Model implements TranslatableContract
{

    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'isActive', 'image_path', 'icon_path', 'created_by', 'updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booksTypeTranslations()
    {
        return $this->hasMany('App\Models\BooksTypeTranslation', 'books_type_id', 'id');
    }

    public static function getMonths()
    {
        return [
            '01' => __("January"),
            '02' => __('February'),
            '03' => __('March'),
            '04' => __('April'),
            '05' => __('May'),
            '06' => __('June'),
            '07' => __('July'),
            '08' => __('August'),
            '09' => __('September'),
            '10' => __('October'),
            '11' => __('November'),
            '12' => __('December')
        ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'books_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function journals()
    {
        return $this->hasMany('App\Models\Journal', 'books_type_id', 'id');
    }

    public static function GetCountBookCountByBookTypeId($id = null)
    {
        $cards = DB::select("SELECT COUNT(*) as nusxa FROM `books_types` as bt left JOIN books as b on b.books_type_id =bt.id where b.status=1 and bt.id=$id GROUP by bt.id;");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
    }

    public static function GetCountBookCopiesByBookTypeId($id = null)
    {
        $cards = DB::select("SELECT COUNT(*) as nusxa FROM `books_types` as bt left JOIN books as b on b.books_type_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id GROUP by bt.id;");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
    }

    public static function GetCountBookByBookTypeId($id = null)
    {
        $cards = DB::select("SELECT SUM(COUNT(DISTINCT bil.book_id)) OVER() as nomda FROM `books_types` as bt left JOIN books as b on b.books_type_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id GROUP by bil.book_id limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }


    public static function GetCountBookByBookTypeByMonthAndId($id = null, $year, $month)
    {
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();

        $cards = DB::select("SELECT SUM(COUNT(DISTINCT bil.book_id)) OVER() as nomda FROM `books_types` as bt left JOIN books as b on b.books_type_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id and DATE(bil.created_at) between '$startDate' and '$endDate' GROUP by bil.book_id  limit 1;");

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

        $cards = DB::select("SELECT COUNT(*) as nusxa FROM `books_types` as bt left JOIN books as b on b.books_type_id =bt.id left join book_inventars as bil on bil.book_id=b.id where b.status=1 and bil.isActive=1 and bt.id=$id and DATE(bil.created_at) between '$startDate' and '$endDate' GROUP by bt.id;");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
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

    public static function GetData(Request $request, BooksType $booksType)
    {
 
        $data = [];
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }
        $booksType_coverage_image_name = '';
        if ($request->file('file')) {
            $booksType_coverage_image_name = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('booksTypes/photo', $booksType_coverage_image_name, 'public');
            $data['image_path'] = $booksType_coverage_image_name;
            if ($booksType != null && $booksType->image_path) {
                $path = public_path('storage/booksTypes/photo/' . $booksType->image_path);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        }
        $data['isActive'] = $request->input('isActive');
        $data['icon_path'] = $request->input('icon_path');

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
