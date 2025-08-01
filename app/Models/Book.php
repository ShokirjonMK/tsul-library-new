<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

/**
 * Class Book
 *
 * @property $id
 * @property $dc_title
 * @property $authors_mark
 * @property $slug
 * @property $dc_subjects
 * @property $dc_creators
 * @property $dc_authors
 * @property $dc_UDK
 * @property $uk
 * @property $dc_BBK
 * @property $dc_source
 * @property $dc_rights
 * @property $dc_relation
 * @property $dc_publisher
 * @property $dc_identifier
 * @property $dc_published_city
 * @property $ISBN
 * @property $dc_description
 * @property $dc_date
 * @property $dc_coverage
 * @property $dc_contributor
 * @property $image_path
 * @property $full_text_path
 * @property $file_format
 * @property $file_format_type
 * @property $file_size
 * @property $betlar_soni
 * @property $price
 * @property $status
 * @property $location_index
 * @property $published_year
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $books_type_id
 * @property $book_language_id
 * @property $book_text_id
 * @property $book_text_type_id
 * @property $book_access_type_id
 * @property $book_file_type_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property BooksType $booksType
 * @property BookAccessType $bookAccessType
 * @property BookFileType $bookFileType
 * @property BookLanguage $bookLanguage
 * @property BookText $bookText
 * @property BookTextType $bookTextType
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Book extends Model
{

    use Sluggable;
    static $rules = [
        'dc_title' => 'required',
        'betlar_soni' => 'required',
        'price' => 'required',
        'status' => 'required',
        'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['dc_title', 'authors_mark', 'slug', 'dc_subjects', 'dc_creators', 'dc_authors', 'dc_UDK', 'dc_BBK', 'dc_source', 'dc_rights', 'dc_relation', 'dc_publisher', 'dc_identifier', 'dc_published_city', 'ISBN', 'dc_description', 'dc_date', 'dc_coverage', 'dc_contributor', 'image_path', 'full_text_path', 'file_format', 'file_format_type', 'file_size', 'betlar_soni', 'price', 'status', 'published_year', 'extra1', 'extra2', 'extra3', 'extra4', 'books_type_id', 'book_language_id', 'book_text_id', 'book_text_type_id', 'book_access_type_id', 'book_file_type_id', 'created_by', 'updated_by', 'where_id', 'who_id', 'subject_id', 'uk', 'location_index', 'circulation', 'printing_plate'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'dc_title'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booksType()
    {
        return $this->hasOne('App\Models\BooksType', 'id', 'books_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookAccessType()
    {
        return $this->hasOne('App\Models\BookAccessType', 'id', 'book_access_type_id');
    }
    // public function bookAccessType()
    // {
    //  return $this->belongsTo(BookAccessType::class);
    // }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookFileType()
    {
        return $this->hasOne('App\Models\BookFileType', 'id', 'book_file_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function whos()
    {
        return $this->hasOne('App\Models\Who', 'id', 'who_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wheres()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookInventar()
    {
        return $this->hasMany('App\Models\BookInventar', 'book_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookLanguage()
    {
        return $this->hasOne('App\Models\BookLanguage', 'id', 'book_language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookText()
    {
        return $this->hasOne('App\Models\BookText', 'id', 'book_text_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookTextType()
    {
        return $this->hasOne('App\Models\BookTextType', 'id', 'book_text_type_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extraAuthorBooks()
    {
        return $this->hasMany('App\Models\ExtraAuthorBook', 'book_id', 'id');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeTotalAll()
    {
        $books = DB::select("SELECT COUNT( DISTINCT book_id) as total_all FROM `book_inventars` WHERE isActive=1");
        if (count($books) > 0) {
            return $books[0]->total_all;
        }
        return 0;
    }

    public static function scopeTotalAllPdf()
    {
        $model = self::where('full_text_path', '<>', "");
        return $model->count();
    }
    public static function scopeTotalAllDcSourcePdf()
    {
        $model = self::where('dc_source', '<>', "");

        return $model->count();
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

            $roles = Auth::user()->getRoleNames()->toArray();
            if (count($roles) > 0) {
                $user = Auth::user()->profile;
                if($user != null){
                    $model->organization_id = $user->organization_id;
                    $model->branch_id  = $user->branch_id;
                    $model->deportment_id  = $user->department_id;
                }
            }
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
    public static function GetCountBookByBookTypeByMonthAndId($id = null, $year, $month)
    {
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();

        $cards = DB::select("SELECT SUM(COUNT(DISTINCT id)) OVER() as nomda FROM `books` where status=1 and DATE(created_at) between '$startDate' and '$endDate' GROUP by id limit 1;");

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

        $cards = DB::select("SELECT SUM(COUNT(DISTINCT id)) OVER() as nusxa FROM `book_inventars` as bi where bi.isActive=1 and DATE(bi.created_at) between '$startDate' and '$endDate' GROUP by bi.id LIMIT 1");

        if (count($cards) > 0) {
            return $cards[0]->nusxa;
        }
        return 0;
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
        $data['circulation'] = $request->input('circulation');
        $data['printing_plate'] = $request->input('printing_plate');
        return $data;
    }
    public static function rules()
    {

        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }

    public static function GetBibliographicById($id)
    {
        $book = self::find($id);

        if ($book != null) {
            $bibliographicdata = '';
            $bibliographicdata.=$book->location_index.'&nbsp; '.$book->authors_mark.'&nbsp;';
            if ($book->dc_authors) {
                $all_authors = '';
                foreach (json_decode($book->dc_authors) as $key => $value) {
                    $all_authors .= $value . ' ';
                }
                $bibliographicdata .= '<b>' . $all_authors . '</b><br>';
            }
            if ($book->dc_title) {
                $bibliographicdata .= $book->dc_title . ' ';
            }

            if ($book->book_file_type_id) {
                $bibliographicdata .= '[' . $book->bookFileType->title . ']: ';
            }
            if ($book->dc_authors) {
                $all_authors = '';
                foreach (json_decode($book->dc_authors) as $key => $value) {
                    $all_authors .= $value . ' ';
                }
                $bibliographicdata .= ' / ' . $all_authors . '.';
            }
            if ($book->dc_published_city) {
                // $bibliographicdata.='<span class="dashes">-</span>'.strtoupper(substr($book->dc_published_city, 0, 1)).'.:';
                $bibliographicdata .= '<span class="dashes">-</span>' . $book->dc_published_city . '.:';
            }
            if ($book->dc_publisher) {
                $bibliographicdata .= ' ' . $book->dc_publisher . ', ' . $book->published_year ?? $book->published_year;
            }
            if ($book->betlar_soni) {
                $bibliographicdata .= '. <span class="dashes">-</span>' . $book->betlar_soni. ' b.';
            }
            if ($book->books_type_id) {
                $bibliographicdata .= '.<br> <b>' . $book->booksType->title . '</b>.';
            }

            if ($book->book_language_id) {
                $bibliographicdata .= '.<b>' . $book->bookLanguage->title . '</b>.';
            }

            return $bibliographicdata;
        }
        return null;
    }

    public static function GetCountBookByUserByMonth($user_id = null, $year, $month){

        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `books` as b where b.status=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `books` as b where b.status=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

    public static function GetBookTopTemplateById($id)
    {
        $book = self::with(['booksType', 'booksType.translations'])->find($id);
        if($book != null){
            $all_authors = '';
            if ($book->dc_authors) {
                foreach (json_decode($book->dc_authors) as $key => $value) {
                    $all_authors .= $value . ' ';
                }
            }
            $image='<img src="/book_no_photo.jpg" alt="image-description img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" width="120">';
            if ($book->image_path){
                $image='<img src="/storage/'.$book->image_path.'" alt="image-description img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" width="120">';
            }
            $link=url(app()->getLocale() . '/books/' . $book->id);

            return '<div class="product product__card border-right">
            <div class="media p-3 p-md-4d875">
                <a href="'.$link.'" class="d-block">
                    '.$image.'
                </a>
                <div class="media-body ml-4d875">
                    <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="'.$link.'">'.$book->booksType->title.'</a></div>
                    <h2 class="woocommerce-loop-product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="'.$link.'">'.$book->dc_title.'</a></h2>
                    <div class="font-size-2 mb-1 text-truncate"><a href="'.$link.'" class="text-gray-700">'.$all_authors.'</a></div>
                    <div class="price d-flex align-items-center font-weight-medium font-size-3">
                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span></span>
                    </div>
                </div>
            </div>
        </div>';
        }
    }

    public static function GetCountBookByUserByTwoMonth($user_id = null, $startDate, $endDate){

        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `books` as b where b.status=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `books` as b where b.status=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

}
