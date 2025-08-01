<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class Debtor
 *
 * @property $id
 * @property $status
 * @property $taken_time
 * @property $return_time
 * @property $returned_time
 * @property $count_prolong
 * @property $how_many_days
 * @property $reader_id
 * @property $book_id
 * @property $book_information_id
 * @property $book_inventar_id
 * @property $branch_id
 * @property $department_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property BookInformation $bookInformation
 * @property BookInventar $bookInventar
 * @property Branch $branch
 * @property Department $department
 * @property User $user
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Debtor extends Model
{
    public static $DELETED = 0;
    public static $GIVEN = 1;
    public static $TAKEN = 2;
    
    static $rules = [
		'status' => 'required',
		'taken_time' => 'required',
		'count_prolong' => 'required',
		'how_many_days' => 'required',
    ];

 
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status','taken_time','return_time','returned_time','count_prolong','how_many_days','reader_id','book_id','book_information_id','book_inventar_id','branch_id','department_id','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookInformation()
    {
        return $this->hasOne('App\Models\BookInformation', 'id', 'book_information_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookInventar()
    {
        return $this->hasOne('App\Models\BookInventar', 'id', 'book_inventar_id');
    }
    
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
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reader()
    {
        return $this->hasOne('App\Models\User', 'id', 'reader_id');
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
    public static function GetStatus($status)
    {
        if($status==self::$GIVEN){
            return "<span class='btn btn-sm btn-primary'>".__("GIVEN")."</span>"; 
        }elseif($status==self::$TAKEN){
            return "<span class='btn btn-sm btn-success'>".__("TAKEN")."</span>"; 
        }elseif($status==self::$DELETED){
            return __("DELETED");
        }
        return __("UNKNOWN");
    }
    
    public static function GetStatusCount($reader_id, $from, $to, $status)
    {
        $statdebtor_by_reader = Debtor::with(['reader', 'reader.profile'])->where('reader_id', '=', $reader_id)->where('status', '=', $status)->whereBetween(DB::raw('DATE(taken_time)'), [$from, $to])->get();

        return $statdebtor_by_reader->count();
    }

    public static function GetStatusCountById($reader_id, $status)
    {
        $statdebtor_by_reader = Debtor::with(['reader', 'reader.profile'])->where('reader_id', '=', $reader_id)->where('status', '=', $status)->get();

        return $statdebtor_by_reader->count();
    }

    public static function GetCountBookByBookTypeByMonthAndIdAndStatus($id = null, $year, $month, $status)
    {
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();

        $cards = DB::select("SELECT SUM(COUNT(DISTINCT d.book_id)) OVER() as nomda FROM `debtors` as d left JOIN books as b on b.id =d.book_id left join books_types as bt on bt.id=b.books_type_id where b.status=1 and d.status=$status and bt.isActive=1 and bt.id=$id and d.taken_time between '$startDate' and '$endDate' GROUP by d.book_id limit 1;");

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

    public static function GetCountBookByUserByTwoMonth($user_id = null, $startDate, $endDate, $status)
    {
        // d.status=$status and
        if($status == self::$GIVEN){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT d.book_id)) OVER() as nomda FROM `debtors` as d where d.`created_by`=$user_id and d.taken_time between '$startDate' and '$endDate' GROUP by d.book_id limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT d.book_id)) OVER() as nomda FROM `debtors` as d where d.`created_by`=$user_id and DATE(d.updated_at) between '$startDate' and '$endDate' GROUP by d.book_id limit 1;");
        }

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

}
