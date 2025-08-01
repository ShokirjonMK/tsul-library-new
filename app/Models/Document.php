<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class Document
 * 
 * @property $id
 * @property $title
 * @property $number
 * @property $deed_date
 * @property $arrived_date
 * @property $arrived_year
 * @property $arrived_month
 * @property $arrived_day
 * @property $file
 * @property $consignment_note
 * @property $act_number
 * @property $ksu
 * @property $where_id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $comment
 * @property $comment1
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Where $where_id
 * @property Branch $branch
 * @property Department $department
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Document extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','number', 'name', 'arrived_date','arrived_year','arrived_month','arrived_day','file','consignment_note','act_number','ksu','organization_id','branch_id','deportmetn_id','comment','comment1','extra1','extra2','extra3','extra4','created_by','updated_by', 'deed_date', 'where_id'];


    public static function GetData(Request $request)
    {
        $data = [];
         
        $data['title'] = $request->input('title');
        $data['number'] = $request->input('number');

        $data['arrived_date'] = $request->input('arrived_date');
         
       
        if($request->input('arrived_date') != null){
            $data['arrived_year'] = date('Y',strtotime($request->input('arrived_date')));
            $data['arrived_month'] = date('m',strtotime($request->input('arrived_date')));
            $data['arrived_day'] = date('d',strtotime($request->input('arrived_date')));
        }
       
        if ($request->file('file')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $up = $request->file('file')->storeAs('books/act', $filePath, 'public');
            $data['file'] = "books/act/" . $filePath;
        }

        $data['consignment_note'] = $request->input('consignment_note');
        $data['act_number'] = $request->input('act_number');
        $data['ksu'] = $request->input('ksu');

        $user = Auth::user()->profile;
        
        $data['organization_id'] = $user->organization_id;
        $data['branch_id']  = $user->branch_id;
        $data['deportmetn_id'] = $user->department_id;

        $data['where_id'] = $request->input('where_id');
        $data['comment1'] = $request->input('comment1');
        $data['comment'] = $request->input('comment');
        $data['extra1'] = $request->input('extra1');
        $data['extra2'] = $request->input('extra2');
        $data['extra3'] = $request->input('extra3');
        $data['extra4'] = $request->input('extra4');
        $data['deed_date'] = $request->input('deed_date');
        
        return $data;
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
    public function where()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resourcesDocuments()
    {
        return $this->hasMany('App\Models\ResourcesDocument', 'document_id', 'id');
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public static function rules()
    {
        $rules = [
            'title' => 'required',
            'number' => 'required',
        ];
        return $rules;
    }
    


}
