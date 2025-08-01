<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
/**
 * Class ScientificPublication
 *
 * @property $id
 * @property $steps
 * @property $copies
 * @property $key
 * @property $code
 * @property $publication_year
 * @property $page_number
 * @property $permission
 * @property $barcode_key
 * @property $barcode
 * @property $inventar_number
 * @property $isActive
 * @property $image_path
 * @property $file_path
 * @property $journal_id
 * @property $magazine_issue_id
 * @property $res_lang_id
 * @property $res_type_id
 * @property $res_field_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Journal $journal
 * @property MagazineIssue $scientificPublication
 * @property ResourceType $resourceType
 * @property ResourceType $resourceType
 * @property ResourceType $resourceType
 * @property ScientificPublicationTranslation[] $scientificPublicationTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ScientificPublication extends Model  implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug', 'sub_title', 'country', 'inst_nome_address', 'authors', 'keywords', 'place_protection', 'content', 'description'];
    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['steps','copies','key','code','publication_year','page_number','permission','barcode_key','barcode','inventar_number','isActive','image_path','file_path','journal_id','magazine_issue_id','res_lang_id','res_type_id','res_field_id','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function journal()
    {
        return $this->hasOne('App\Models\Journal', 'id', 'journal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function scientificPublication()
    {
        return $this->hasOne('App\Models\MagazineIssue', 'id', 'magazine_issue_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resTypeLang()
    {
        return $this->hasOne('App\Models\ResourceType', 'id', 'res_lang_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resType()
    {
        return $this->hasOne('App\Models\ResourceType', 'id', 'res_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resField()
    {
        return $this->hasOne('App\Models\ResourceType', 'id', 'res_field_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scientificPublicationTranslations()
    {
        return $this->hasMany('App\Models\ScientificPublicationTranslation', 'scientific_publication_id', 'id');
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
    public static function GetData(Request $request,ScientificPublication $scientificPublication)
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
            $filePath = $request->file('file')->storeAs('scientificPublications/photo', $journal_coverage_image_name, 'public');
            $data['image_path'] = $journal_coverage_image_name;
            if($scientificPublication!=null && $scientificPublication->image_path){
                $path = public_path('storage/scientificPublications/photo/'.$scientificPublication->image_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
            }
        }
        $journal_coverage_file_path = '';
        if ($request->file('file_path')) {
            $journal_coverage_file_path = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file_path')->getClientOriginalExtension();
            $filePath = $request->file('file_path')->storeAs('scientificPublications/full-text/', $journal_coverage_file_path, 'public');
            $data['file_path'] = $journal_coverage_file_path;

            if($scientificPublication!=null && $scientificPublication->file_path){
                $path = public_path('storage/scientificPublications/full-text/'.$scientificPublication->file_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
            }
        }
        $data['isActive'] = $request->input('isActive');
        $data['key'] = $request->input('key');
        $data['code'] = $request->input('code');
        $data['res_lang_id'] = $request->input('res_lang_id');
        $data['res_type_id'] = $request->input('res_type_id');
        $data['res_field_id'] = $request->input('res_field_id');
        $data['publication_year'] = $request->input('publication_year');
        $data['page_number'] = $request->input('page_number');
        $data['barcode'] = $request->input('barcode');
        $data['inventar_number'] = $request->input('inventar_number');
        $data['journal_id'] = $request->input('journal_id');
        $data['magazine_issue_id'] = $request->input('magazine_issue_id');
        
        return $data;
    }
    public static function rules()
    {
        $rules = [
            'publication_year' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }


}
