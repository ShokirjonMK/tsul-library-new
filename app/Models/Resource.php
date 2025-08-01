<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Class Resource
 *
 * @property $id
 * @property $title
 * @property $authors
 * @property $type_id
 * @property $publisher_id
 * @property $published_year
 * @property $published_city
 * @property $copies
 * @property $price
 * @property $status
 * @property $consignment_note
 * @property $act_number
 * @property $ksu
 * @property $book_language_id
 * @property $book_text_id
 * @property $who_id
 * @property $where_id
 * @property $basic_id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $comment
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Basic $basic
 * @property Branch $branch
 * @property Department $department
 * @property GenType $genType
 * @property Organization $organization
 * @property Publisher $publisher
 * @property User $user
 * @property User $user
 * @property Who $who
 * @property Where $where_id
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Resource extends Model
{
    


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','authors','type_id','publisher_id','published_year','published_city','copies','price','status','consignment_note','act_number','ksu','who_id', 'where_id', 'basic_id','organization_id','branch_id','deportmetn_id','comment','extra1','extra2','extra3','extra4','created_by','updated_by', 'book_language_id', 'book_text_id', 'taken_into_account', 'res_type'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function basic()
    {
        return $this->hasOne('App\Models\Basic', 'id', 'basic_id');
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
    public function genType()
    {
        return $this->hasOne('App\Models\GenType', 'id', 'type_id');
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
    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher', 'id', 'publisher_id');
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
    public function who()
    {
        return $this->hasOne('App\Models\Who', 'id', 'who_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function where()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
    }
    
    public static function GetData(Request $request)
    {
        $data = [];
         
        $data['title'] = $request->input('title');
        $data['authors'] = $request->input('authors');
        $data['type_id'] = $request->input('type_id');
        $data['book_language_id'] = $request->input('book_language_id');
        $data['res_type'] = $request->input('res_type');
        $data['taken_into_account'] = $request->input('taken_into_account');
        $data['book_text_id'] = $request->input('book_text_id');
        $data['publisher_id'] = $request->input('publisher_id');
        $data['published_year'] = $request->input('published_year');
        $data['published_city'] = $request->input('published_city');
        $data['copies'] = $request->input('copies');
        $data['price'] = $request->input('price');
        $data['status'] = $request->input('status');
        $data['consignment_note'] = $request->input('consignment_note');
        $data['act_number'] = $request->input('act_number');
        $data['ksu'] = $request->input('ksu');
        $data['who_id'] = $request->input('who_id');
        $data['where_id'] = $request->input('where_id');
        $data['basic_id'] = $request->input('basic_id');
        $data['comment'] = $request->input('comment');
        $data['extra1'] = $request->input('extra1');
        $data['extra2'] = $request->input('extra2');
        $data['extra3'] = $request->input('extra3');
        $data['extra4'] = $request->input('extra4');
        
        $user = Auth::user()->profile;
        $data['organization_id'] = $user->organization_id;
        $data['branch_id']  = $user->branch_id;
        $data['deportmetn_id'] = $user->department_id;

        return $data;
    }
    public static function rules()
    {
        $rules = [
            'copies' => 'required',
            'price' => 'required',
            'status' => 'required',
        ];
       
        return $rules;
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
        return $query->where('status', 1);
    }


}
