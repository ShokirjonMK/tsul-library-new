<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Journal
 *
 * @property $id
 * @property $ISSN
 * @property $phone_number
 * @property $subjects
 * @property $fax
 * @property $email
 * @property $website
 * @property $editor_in_chiefs
 * @property $editorial_members
 * @property $code
 * @property $isActive
 * @property $image_path
 * @property $icon_path
 * @property $organization_id
 * @property $books_type_id
 * @property $book_text_id
 * @property $book_text_type_id
 * @property $book_access_type_id
 * @property $book_file_type_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property BooksType $booksType
 * @property BookAccessType $bookAccessType
 * @property BookFileType $bookFileType
 * @property BookText $bookText
 * @property BookTextType $bookTextType
 * @property JournalTranslation[] $journalTranslations
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Journal extends Model implements TranslatableContract
{
    
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug', 'body'];
    
    
   


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ISSN','phone_number','subjects','fax','email','website','editor_in_chiefs','editorial_members','code','isActive','image_path','icon_path','organization_id','books_type_id','book_text_id','book_text_type_id','book_access_type_id','book_file_type_id','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booksType()
    {
        return $this->hasOne('App\Models\BooksType', 'id', 'books_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookAccessType()
    {
        return $this->hasOne('App\Models\BookAccessType', 'id', 'book_access_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookFileType()
    {
        return $this->hasOne('App\Models\BookFileType', 'id', 'book_file_type_id');
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
    public function bookTextType()
    {
        return $this->hasOne('App\Models\BookTextType', 'id', 'book_text_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journalTranslations()
    {
        return $this->hasMany('App\Models\JournalTranslation', 'journal_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function magazineIssues()
    {
        return $this->hasMany('App\Models\MagazineIssue', 'journal_id', 'id');
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

    public static function GetData(Request $request, Journal $journal)
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
            $filePath = $request->file('file')->storeAs('journals/photo', $journal_coverage_image_name, 'public');
            $data['image_path'] = $journal_coverage_image_name;
            if($journal!=null && $journal->image_path){
                $path = public_path('storage/journals/photo/'.$journal->image_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
            }
        }
        $memberId=[];
        if($request->input('editorial_members')!=null&&count($request->input('editorial_members'))>0){
            foreach($request->input('editorial_members') as $k=>$v){
                $author=Author::find($v);
                if($author==null){ 
                    $authorData=null;
                    $count=0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count+=1;
                    }
                    $auth=Author::create($authorData);
                    $memberId[$k]="$auth->id";
                }else{
                    $memberId[$k]=$v;
                }
            }
        }
        $subjectId=[];
        if($request->input('subjects')!=null&&count($request->input('subjects'))>0){
            foreach($request->input('subjects') as $k=>$v){
                $book_subjects=BookSubject::find($v);
                if($book_subjects==null){
                    $subData=null;
                    $count=0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $subData[$til_code] = [
                            'title' => $v
                        ];
                        $count+=1;
                    }
                    $bookSubj = BookSubject::create($subData);
                    $subjectId[$k]=$bookSubj->id;
                }else{
                    $subjectId[$k]=$v;
                }
                
            }
        }


        $data['isActive'] = $request->input('isActive');
        $data['ISSN'] = $request->input('ISSN');
        $data['phone_number'] = $request->input('phone_number');       
        $data['subjects'] = json_encode($request->input('subjects')); //json decode 
        $data['fax'] = $request->input('fax');  
        $data['email'] = $request->input('email');  
        $data['website'] = $request->input('website');  
        $data['editor_in_chiefs'] = $request->input('editor_in_chiefs');  //json decode
        $data['editorial_members'] = json_encode($memberId);  //json decode
        $data['organization_id'] = $request->input('organization_id');  
        $data['books_type_id'] = $request->input('books_type_id');  
        $data['book_text_id'] = $request->input('book_text_id');  
        $data['book_text_type_id'] = $request->input('book_text_type_id');  
        $data['book_access_type_id'] = $request->input('book_access_type_id');


        return $data;
    }
    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
            'editor_in_chiefs' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }



}
