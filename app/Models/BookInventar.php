<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class BookInventar
 *
 * @property $id
 * @property $isActive
 * @property $comment
 * @property $inventar_number
 * @property $book_id
 * @property $book_information_id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property BookInformation $bookInformation
 * @property Branch $branch
 * @property Department $department
 * @property User $user
 * @property User $updatedBy
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookInventar extends Model
{
    public static $DELETED = 0;
    public static $ACTIVE = 1;
    public static $GIVEN = 2;

    // depozitoriyaga depozitariyga
    public static $WAREHOUSE = 3;

    public static $TYPE_UK = 0;
    public static $TYPE_SOVGA = 1;//sovg'a kitoblar
    public static $TYPE_INVENTAR = 2;//inventar kitoblar
    public static $TYPE_DROP = 3;//dropli kitoblar
    public static $TYPE_NUMLESS = 4;//raqamsiz kitoblar
    public static $TYPE_NUMLESS_SECOND = 5;//raqamsiz kitoblar

    static $rules = [
        'inventar_number' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['isActive', 'comment', 'inventar_number', 'book_id', 'book_information_id', 'organization_id', 'branch_id', 'deportmetn_id', 'created_by', 'updated_by', 'key', 'bar_code', 'inventar', 'rfid_tag_id'];


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
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
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
        return $this->hasOne('App\Models\Department', 'id', 'deportmetn_id');
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

    public function scopeBookActive($query)
    {
        return $query->whereNotNull('book_id');
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

    public static function changeStatus($id, $status = null)
    {

        $model = self::find($id);
        $model->isActive = $status;
        $model->save();

        return $model;
    }

    public static function generateInventars($book_id, $book_information_id, $branch_id, $deportmetn_id, $organization_id, $copies = 0)
    {

        $current_roles = Auth::user()->getRoleNames()->toArray();
        $current_user = Auth::user()->profile;

        if ($copies > 0) {

            DB::transaction(function () use ($copies, $book_id, $book_information_id, $organization_id, $branch_id, $deportmetn_id, $current_user) {

                // Jadvalni bloklab, eng katta bar_code ni olish
                $last = BookInventar::where('organization_id', $current_user->organization_id)
                    ->whereNotNull('book_id')
                    ->orderByRaw('bar_code * 1 desc')
                    ->lockForUpdate()
                    ->first();

                $lN = 0;
                if ($last != null) {
                    $lN = filter_var($last->bar_code, FILTER_SANITIZE_NUMBER_INT);
                }

                for ($i = 1; $i <= $copies; $i++) {
                    $lN += 1;
                    $generatedBarcode = self::generateNumber($lN);

                    $inventarData = [
                        'isActive' => true,
                        'book_id' => $book_id,
                        'book_information_id' => $book_information_id,
                        'organization_id' => $organization_id,
                        'branch_id' => $branch_id,
                        'deportmetn_id' => $deportmetn_id,
                        'key' => null,
                        'bar_code' => $generatedBarcode,
                        'inventar_number' => $lN,
                        'inventar' => $lN,
                    ];

                    BookInventar::create($inventarData);
                }
            });
        }
    }

    public static function generateNumber($digit=null){
        if($digit != null){
            return sprintf("%04d", $digit);
        }else{
            return $digit;
        }

    }
    public static function GetStatus($status)
    {

        if ($status == self::$GIVEN) {
            return "<span class='btn btn-sm btn-primary'>" . __("GIVEN") . "</span>";
        } elseif ($status == self::$ACTIVE) {
            return "<span class='btn btn-sm btn-success'>" . __("Active") . "</span>";
        } elseif ($status == self::$DELETED) {
            return '<span class="badge badge-danger">' . __("DELETED") . '</span>';
        } elseif ($status == self::$WAREHOUSE) {
            return '<span class="badge badge-danger">' . __("WAREHOUSED") . '</span>';
        }
        return __("UNKNOWN");
    }



    public static function GetInventarsByBookId($id)
    {
        $inventars = self::where('book_id', '=', $id)->get();

        if ($inventars != null) {
            $data="";
            foreach($inventars as $k=>$inventar){
                $data.=$inventar->bar_code.', ';
            }
            return rtrim($data, ', ');
        }
        return null;
    }
    public static function GetAvailablesByBookId($id)
    {
        $books = self::where('book_id', '=', $id)->where('isActive', self::$ACTIVE)->get();

        if ($books != null) {
            return $books->count();
        }
        return null;
    }
    public static function GetInventarsCountByBookId($id)
    {
        $inventars = self::where('book_id', '=', $id)->get();


        return $inventars->count();
    }

    public static function GetCountBookCopyByUserByMonth($user_id = null, $year, $month){

        $from = $year . '-' . $month;
        $to = $year . '-' . $month;

        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_inventars` as b where b.isActive=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_inventars` as b where b.isActive=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }

    public static function GetCountBookCopyByUserByTwoMonth($user_id = null, $startDate, $endDate){


        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_inventars` as b where b.isActive=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_inventars` as b where b.isActive=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }

        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0;
    }
}
