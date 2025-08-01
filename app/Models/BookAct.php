<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class BookAct
 *
 * @property $id
 * @property $where_id
 * @property $price
 * @property $summarka_raqam
 * @property $arrived_date
 * @property $arrived_year
 * @property $arrived_month
 * @property $arrived_day
 * @property $comment
 * @property $extra1
 * @property $full_text_path
 * @property $organization_id
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
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @property Where $where
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookAct extends Model
{
     


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['where_id','price','summarka_raqam','arrived_date','arrived_year','arrived_month','arrived_day','comment','extra1','full_text_path','organization_id','branch_id','deportmetn_id','book_id','created_by','updated_by'];


    
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
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wheres()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
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
}
