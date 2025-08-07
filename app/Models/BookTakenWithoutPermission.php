<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookTakenWithoutPermission
 *
 * @property $id
 * @property $status
 * @property $bar_code
 * @property $rfid_tag_id
 * @property $comment
 * @property $book_id
 * @property $book_information_id
 * @property $book_inventar_id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property BookInformation $bookInformation
 * @property BookInventar $bookInventar
 * @property Branch $branch
 * @property Department $department
 * @property Organization $organization
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookTakenWithoutPermission extends Model
{
    
    static $rules = [
		'status' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status','bar_code','rfid_tag_id','comment','book_id','book_information_id','book_inventar_id','organization_id','branch_id','deportmetn_id'];


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
        return $this->hasOne('App\Models\Department', 'id', 'deportmetn_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }
    


}
