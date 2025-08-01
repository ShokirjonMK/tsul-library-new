<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class BookInformation
 *
 * @property $id
 * @property $isActive
 * @property $summarka_raqam
 * @property $arrived_year
 * @property $organization_id
 * @property $kutubxonada_bor
 * @property $elektronni_bor
 * @property $branch_id
 * @property $deportmetn_id
 * @property $book_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property Branch $branch
 * @property Department $department
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookInformation extends Model
{
     
    protected $table = 'book_informations';


    static $rules = [
		'kutubxonada_bor' => 'required',
		'elektronni_bor' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['isActive','organization_id','summarka_raqam','arrived_year','kutubxonada_bor','elektronni_bor','branch_id','deportmetn_id','book_id','created_by','updated_by'];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookInventar()
    {
        return $this->hasMany('App\Models\BookInventar', 'book_information_id', 'id');
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

    public static function GetCountBookInformationByUserByMonth($user_id = null, $year, $month){
         
        $from = $year . '-' . $month;
        $to = $year . '-' . $month;
        
        $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_informations` as b where b.isActive=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_informations` as b where b.isActive=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }
        
        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0; 
    }
    public static function GetCountBookInformationByUserByTwoMonth($user_id = null, $startDate, $endDate){
         
       
        if($user_id != null){
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_informations` as b where b.isActive=1 and b.`created_by`=$user_id and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }else{
            $cards = DB::select("SELECT SUM(COUNT(DISTINCT b.id)) OVER() as nomda FROM `book_informations` as b where b.isActive=1 and DATE(b.created_at) between '$startDate' and '$endDate' GROUP by b.id  limit 1;");
        }
        
        if (count($cards) > 0) {
            return $cards[0]->nomda;
        }
        return 0; 
    }

}
