<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class MagazineIssue
 *
 * @property $id
 * @property $published_year
 * @property $fourth_number
 * @property $subjects
 * @property $isActive
 * @property $image_path
 * @property $ISSN
 * @property $full_text_path
 * @property $file_format
 * @property $file_format_type
 * @property $file_size
 * @property $betlar_soni
 * @property $price
 * @property $journal_id
 * @property $editor_in_chiefs
 * @property $editorial_members
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Journal $journal
 * @property MagazineIssueTranslation[] $magazineIssueTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MagazineIssue extends Model implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];
    

     

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['published_year','fourth_number','subjects','isActive','image_path','ISSN','full_text_path','file_format','file_format_type','file_size','betlar_soni','price','journal_id','editor_in_chiefs','editorial_members','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function journal()
    {
        return $this->hasOne('App\Models\Journal', 'id', 'journal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function magazineIssueTranslations()
    {
        return $this->hasMany('App\Models\MagazineIssueTranslation', 'magazine_issue_id', 'id');
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

    public static function GetData(Request $request, MagazineIssue $magazineIssue)
    {
        $data = [];
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }
        $journal_coverage_image_name = '';
        if ($request->file('file')) {
            $journal_coverage_image_name = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('magazineIssues/photo', $journal_coverage_image_name, 'public');
            $data['image_path'] = $journal_coverage_image_name;
            if($magazineIssue!=null && $magazineIssue->image_path){
                $path = public_path('storage/magazineIssues/photo/'.$magazineIssue->image_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
            }
        }
        $journal_coverage_full_text_path = '';
        if ($request->file('full_text_path')) {
            $journal_coverage_full_text_path = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('full_text_path')->getClientOriginalExtension();
            $filePath = $request->file('full_text_path')->storeAs('magazineIssues/full-text/', $journal_coverage_full_text_path, 'public');
            $data['full_text_path'] = $journal_coverage_full_text_path;

            if($magazineIssue!=null && $magazineIssue->full_text_path){
                $path = public_path('storage/magazineIssues/full-text/'.$magazineIssue->full_text_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
            }
        }
         $data['journal_id'] = $request->input('journal_id');
        $data['published_year'] = $request->input('published_year');
        $data['fourth_number'] = $request->input('fourth_number');
        $data['betlar_soni'] = $request->input('betlar_soni');
        $data['price'] = trim($request->input('price'));
        $data['isActive'] = $request->input('isActive');
        return $data;
    }
    public static function rules()
    {
        $rules = [
            'journal_id' => 'required',
            'published_year' => 'required',
            'fourth_number' => 'required',
            'betlar_soni' => 'required',
            'price' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        
        return $rules;
    }
    public static function GetById($id)
    {
        $model = self::find($id);
        if($model!=null){
            return $model;
        }

        return null;

    }


}
