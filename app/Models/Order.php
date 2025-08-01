<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Order
 *
 * @property $id
 * @property $order_date
 * @property $order_number
 * @property $type
 * @property $status
 * @property $reader_id
 * @property $created_at
 * @property $updated_at
 *
 * @property OrderDetail[] $orderDetails
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Order extends Model
{
    public static $DELETED = 0;
    public static $SENT = 1; 
    public static $ACCEPTED = 2;
    public static $READY = 3;
    public static $TAKEN_BY_READER = 4;
    public static $BOOK_NOT_AVIALABLE = 5;

    static $rules = [
		'order_date' => 'required',
		'order_number' => 'required',
		'status' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_date','order_number','type','status','reader_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }
    
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
    public function reader()
    {
        return $this->hasOne('App\Models\User', 'id', 'reader_id');
    }
     

    public static function GetOrderNumber()
    {
        return str_pad(self::get()->count() + 1, 4, '0', STR_PAD_LEFT);
    }

    public static function GetStatus($status)
    {
        if($status==self::$SENT){
            return "<span class='btn btn-sm btn-primary'>".__("SENT")."</span>"; 
        }elseif($status==self::$ACCEPTED){
            return "<span class='btn btn-sm btn-success'>".__("ACCEPTED")."</span>"; 
        }elseif($status==self::$READY){
            return "<span class='btn btn-sm btn-success'>".__("READY")."</span>"; 
        }elseif($status==self::$TAKEN_BY_READER){
            return "<span class='btn btn-sm btn-success'>".__("TAKEN_BY_READER")."</span>"; 
        }elseif($status==self::$DELETED){
            return __("DELETED");
        }
        return __("UNKNOWN");
    }

    public static function ChangeStatus($order_id, $status){
        $order = Order::find($order_id);
        $order->status=$status;
        if($order->orderDetails != null && $order->orderDetails->count()>0){
            foreach($order->orderDetails as $k=>$v){
                $detail=OrderDetail::find($v->id);
                $detail->status=$status;
                $detail->save();
            }
        }
        $order->save();
        return $order;
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::$SENT);
    }
}
