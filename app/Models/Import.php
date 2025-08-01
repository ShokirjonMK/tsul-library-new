<?php

namespace App\Models;

use App\Jobs\MarcImportProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Scriptotek\Marc\Collection;
use Scriptotek\Marc\Marc21;
use Scriptotek\Marc\Record;

/**
 * Class Import
 *
 * @property $id
 * @property $title
 * @property $authors
 * @property $UDK
 * @property $BBK
 * @property $publisher
 * @property $published_city
 * @property $published_year
 * @property $ISBN
 * @property $uk
 * @property $description
 * @property $published_date
 * @property $authors_mark
 * @property $from_what_system
 * @property $betlar_soni
 * @property $price
 * @property $status
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Import extends Model
{


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'authors', 'UDK', 'BBK', 'publisher', 'published_city', 'published_year', 'ISBN', 'description', 'published_date', 'authors_mark', 'from_what_system', 'betlar_soni', 'price', 'status', 'extra1', 'extra2', 'extra3', 'extra4', 'created_by', 'updated_by', 'full_text_path', 'file_format', 'file_format_type', 'file_size', 'uk', 'book_lang', 'books_type', 'books_text_type'];


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
    public function change_str_with_alphabet($str)
    {
        $returnStr = str_replace('&#1202;', 'Ҳ', $str);
        $returnStr = str_replace('&#1203;', 'ҳ', $returnStr);
        $returnStr = str_replace('&#1178;', 'Қ', $returnStr);
        $returnStr = str_replace('&#1179;', 'қ', $returnStr);
        $returnStr = str_replace('&#1170;', 'Ғ', $returnStr);
        $returnStr = str_replace('&#1171;', 'ғ', $returnStr);
        $returnStr = str_replace('&#1171;', 'ғ', $returnStr);
        $returnStr = str_replace("\'", "'", $returnStr);
        return $returnStr;
    }
    public static function converting($string)
    {

        $charset = mb_detect_encoding($string);
        // dd($charset);
        if ($charset == 'ASCII') {
            // return $string;
            return self::change_str_with_alphabet(mb_convert_encoding($string, "ASCII", "windows-1251"));
        } else {
            return self::change_str_with_alphabet(mb_convert_encoding($string, "utf-8", "windows-1251"));
        }
        // return $string;

    }

    public static function get100A_1_($rec)
    {
        $content = explode('', strstr($rec, '100^a'));
        $new = '';
        if ($content != null) {
            $c = explode('^', $content[0]);
            // dd($rec->type);
            $newArr = explode(' ', $c[2]);
            $new = ' / ' . $newArr[1] . ' ' . $newArr[2] . ' ' . $newArr[0];
        }
        return $new;
    }

    public static function importData($res, $type)
    {
        $data = [];

        $data['price'] = 0;
        $data['status'] = 1;
        $data['published_year'] = null;
        $data['title'] = null;
        $data['published_city'] = null;
        $data['publisher'] = null;



        if (isset($res['20'])) {
            if (isset($res['20']['c'])) {
                $data['price'] = $res['20']['c'];
            }
            if (isset($res['20']['a'])) {
                $data['ISBN'] = $res['20']['a'];
            }
        }

        if (isset($res['40'])) {
            if (isset($res['40']['b'])) {
                $data['price'] = $res['40']['b'];
            }
        }
        // if (isset($res['675']) && isset($res['675']['3'])) {
        //     $UDK = substr(Import::converting($res['675'][3][0]), 1);
        //     $data['UDK'] = $UDK;
        // }

        if (isset($res['90'])) {
            if (isset($res['90']['x'])) {
                $data['authors_mark'] = $res['90']['x'];
            }
            if (isset($res['90']['a'])) {
                $data['location_index'] = $res['90']['a'];
            }
        }
        $all_authors = null;
        if (isset($res['100'])) {
            if (isset($res['100']['a'])) {
                $all_authors .= $res['100']['a'];
            }
        }
        if (isset($res['245'])) {
            if (isset($res['245']['a'])) {
                $data['title'] = $res['245']['a'];
            }
        }
        if (isset($res['260'])) {
            if (isset($res['260']['a'])) {
                $data['published_city'] = $res['260']['a'];
            }
            if (isset($res['260']['b'])) {
                $data['publisher'] = $res['260']['b'];
            }
            if (isset($res['260']['c'])) {
                $data['published_year'] = $res['260']['c'];
            }
        }

        if (isset($res['520'])) {
            if (isset($res['520']['a'])) {
                $data['description'] = trim($res['520']['a']);
            }
        }

        if (isset($res['700'])) {
            if (isset($res['700']['a'])) {
                $all_authors .=  trim($res['700']['a']);
            }
        }

        $data['authors'] = json_encode(explode(';', $all_authors));
        $data['extra1'] = json_encode($res);

        $old_data = Import::where('title', '=', $data['title'])->where('published_year', '=', $data['published_year'])->where('published_city', '=', $data['published_city'])->where('publisher', '=', $data['publisher'])->first();


        if ($old_data == null) {
            $data['status'] = 1;
            $import = Import::create($data);
        } else {
            $old_data->update($data);
        }
    }
    public static function GetArrayFromStr($str)
    {
        $_IO_CH30 = chr(30);
        $_IO_CH29 = chr(29);
        $_IO_CH31 = chr(31);

        $prms = [];
        $str = substr($str, 0, -1);
        $rows = explode($_IO_CH29, $str);
        $n = count($rows);
      
        if ($n < 2){
            return false;
        }
        for ($i = 1; $i < $n; $i++) {
            $subs = explode($_IO_CH31, trim($rows[$i]));
            for ($j = 1; $j < count($subs); $j++) {
                $arrOne = explode($_IO_CH30, $subs[$j]);
                $cc = count($arrOne);
                if ($cc > 1) {
                    for ($k = 0; $k < $cc; $k++) {
                        if ($arrOne[$k] ) {
                            $strLines = explode("^", $arrOne[$k]);
                            for ($m = 0; $m < count($strLines); $m++) {
                                if ($m > 0 ) { 
                                    if (strlen($strLines[$m]) == 1 && array_key_exists($m + 1, $strLines)) {
                                        $prms[$strLines[0]][$strLines[$m]] = $strLines[$m + 1];
                                    }
                                }
                            }
                        }
                    }
                }                     
            }
        } 
        return $prms;
    }

    public static function GetArrayFromIsoArmatPP($str)
    {
        $_IO_CH30 = chr(30);
        $_IO_CH29 = chr(29);
        $_IO_CH31 = chr(31);
        $str  = substr($str, 19); //
        if ($str{strlen($str) - 1} != $_IO_CH30){
            $prms = [];
            $str = substr($str, 0, -1);
            $rows = explode($_IO_CH29, $str);
            $n = count($rows);
            if ($n < 2){
                return false;
            }

            for ($i = 1; $i < $n; $i++) {
                $first = explode($_IO_CH30, trim($rows[$i]));
                $subs = explode($_IO_CH31, $first[0]);
            
                for ($j = 1; $j < count($subs); $j++) {
                    $arrOne = explode($_IO_CH30, $subs[$j]);
                    // dd($arrOne);
                    $cc = count($arrOne);
                    if ($cc > 0) {
                        for ($k = 0; $k < $cc; $k++) {
                            if ($arrOne[$k] ) {
                                $strLines = explode("^", $arrOne[$k]);
                                for ($m = 1; $m < count($strLines); $m++) {
                                    if ($m > 0 ) { 
                                        if (strlen($strLines[$m]) == 1 && array_key_exists($m + 1, $strLines)) {
                                            $prms[$strLines[0]][$strLines[$m]] = $strLines[$m + 1];
                                        }
                                    } 
                                }
                            }
                        }
                    }                     
                }

              
            } 
            return $prms;
        }else{
            return self::GetArrayFromStr($str);
        }

    }
    public static function GetData(Request $request)
    {
        $data = [];
        // agar armat++dan bazaga olingan bo'lgan taqdirda
        // MarcImportProcess::dispatch("str", "from_armatplus");
 
        $type_import = $request->input('type_import');
        $booksType_coverage_image_name = "myimported" . '.' . $request->file('file')->getClientOriginalExtension();
        $filePath = '/storage/' . $request->file('file')->storeAs('books/imported', $booksType_coverage_image_name, 'public');
        
         $collection = Collection::fromFile(public_path($filePath));
        // armatdan import qilish queuesiz
        if ($type_import == "armat_marc21") {
            foreach ($collection as $k => $record) {
                $data = [];

                if ($record->getField('020') != null) {
                    if ($record->getField('020')->getSubfield('a')) {
                        $data['ISBN'] = Import::converting($record->getField('020')->getSubfield('a')->getData());
                    }
                    if ($record->getField('020')->getSubfield('c')) {
                        $data['price'] = Import::converting($record->getField('020')->getSubfield('c')->getData());
                    } else {
                        $data['price'] = 0;
                    }
                }
                if ($record->getField('041') != null) {
                    if ($record->getField('041')->getSubfield('a')) {
                        $data['book_lang'] = Import::converting($record->getField('041')->getSubfield('a')->getData());
                    }
                }

                if ($record->getField('090') != null) {
                    if ($record->getField('090')->getSubfield('x'))
                        $data['authors_mark'] = Import::converting($record->getField('090')->getSubfield('x')->getData());
                }
                $all_authors = null;
                if ($record->getField('100') != null) {
                    if ($record->getField('100')->getSubfield('a')) {
                        $all_authors .= Import::converting($record->getField('100')->getSubfield('a')->getData());
                    }
                }
                $data['title'] = null;

                if ($record->getField('245') != null) {
                    if ($record->getField('245')->getSubfield('a')) {
                        $data['title'] = Import::converting($record->getField('245')->getSubfield('a')->getData());
                    }
                    if ($record->getField('245')->getSubfield('b')) {
                        $data['books_type'] = Import::converting($record->getField('245')->getSubfield('b')->getData());
                    }
                    if ($record->getField('245')->getSubfield('h')) {
                        $data['books_text_type'] = Import::converting($record->getField('245')->getSubfield('h')->getData());
                    }
                }
                $data['published_city'] = null;
                $data['publisher']=null;
                $data['published_year'] = null;
                if ($record->getField('260') != null) {
                    if ($record->getField('260')->getSubfield('a'))
                        $data['published_city'] = Import::converting($record->getField('260')->getSubfield('a')->getData());
                    if ($record->getField('260')->getSubfield('b'))
                        $data['publisher'] = Import::converting($record->getField('260')->getSubfield('b')->getData());
                    if ($record->getField('260')->getSubfield('c'))
                        $data['published_year'] = Import::converting($record->getField('260')->getSubfield('c')->getData());
                }
                if ($record->getField('300') != null) {
                    if ($record->getField('300')->getSubfield('a')) {
                        $data['betlar_soni'] = Import::converting($record->getField('300')->getSubfield('a')->getData());
                    } else {
                        $data['betlar_soni'] = 0;
                    }
                }
                if ($record->getField('500') != null) {
                    if ($record->getField('500')->getSubfield('a')) {
                        $data['copies'] = Import::converting($record->getField('500')->getSubfield('a')->getData());
                    } else {
                        $data['copies'] = 0;
                    }
                }
                if ($record->getField('520') != null) {
                    if ($record->getField('520')->getSubfield('a')) {
                        $data['description'] = Import::converting($record->getField('520')->getSubfield('a')->getData());
                    }
                }
                if ($record->getField('653') != null) {
                    if ($record->getField('653')->getSubfield('a')) {
                        $data['ochqich_sozlar'] = Import::converting($record->getField('653')->getSubfield('a')->getData());
                    }
                }

                if ($record->getField('700') != null) {
                    if ($record->getField('700')->getSubfield('a')) {

                        $data['author_all'] = Import::converting($record->getField('700')->getSubfield('a')->getData());
                        if ($all_authors != null) {
                            $all_authors .= ';' . Import::converting($record->getField('700')->getSubfield('a')->getData());
                        } else {
                            $all_authors .=  Import::converting($record->getField('700')->getSubfield('a')->getData());
                        }
                    }
                }

                if ($record->getField('900') != null) {
                    if ($record->getField('900')->getSubfield('a')) {
                        $string = Import::converting($record->getField('900')->getSubfield('a')->getData());

                        $str_arr = explode(";", $string);
                        $data['full_text_path'] = 'books/fulltext/' . $str_arr[0] . '_' . $str_arr[1];
                        $data['file_format'] = $str_arr[3];
                        $data['file_format_type'] = $str_arr[3];
                        $data['file_size'] = $str_arr[2];
                    }
                }
                $data['authors'] = json_encode(explode(';', $all_authors));

                $old_data = Import::where('title', '=', $data['title'])->where('published_year', '=', $data['published_year'])->where('published_city', '=', $data['published_city'])->where('publisher', '=', $data['publisher'])->first();

                if ($old_data == null) {
                    $data['status'] = 1;
                    $import = Import::create($data);
                } else {
                    $old_data->update($data);
                }
            }
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        // $record = Record::fromString("");
        // dd($record); 
        // $record = Record::fromFile(public_path($filePath));

        // if ($record->type == Marc21::BIBLIOGRAPHIC) {
        //     foreach ($record->query('020{$2=\noubomn}') as $field) {
        //         echo $field->getSubfield('a')->getData();
        //     }
        //     dd($record->query('020{$2=\noubomn}'));
        //     dd($record->query('020$a'));
        //     dd($record->type);

        // }
        // $collection = Collection::fromFile(public_path($filePath));
        // foreach ($collection as $k=> $record) { 
        //     echo Import::get100A_1_($record).'<br>';
        //     dd($record); 


        // }
        // dd($filePath);
        // dd($collection);
        // MarcImportProcess::dispatch($filePath, $type_import);

        // unlink($filePath);


        // $collection = Collection::fromFile(public_path($filePath));
        // foreach ($collection as $k=> $record) { 

        //     dd($record);
        // }
        // dd($type_import);
        // if ($type_import == "irbis_utf_8_marc21") {
        //     $data = [];
        //     $data['title'] = "";
        //     $data['published_year'] = "";
        //     $data['published_city'] = "";
        //     $data['publisher'] = "";
        //     // $fn_name  = $_REQUEST['file_name'];
        //     $from     = 0;
        //     // $format   = $_REQUEST['format'];
        //     // $db_url   = $_REQUEST['db_url'];

        //     $handle          = @fopen(public_path($filePath), "r");
        //     $ind             = 0;
        //     $err             = "";

        //     // global $__vw_p, $__io_r;

        //     // $html = implode('', file('vw/uni2us.io.php'));
        //     // $html = str_replace("<?php", "", $html);
        //     // error_reporting(E_ERROR);

        //     while (!feof($handle)) {
        //         $rec      = fgets($handle, 6);
        //         $rec_len  = intval($rec);

        //         if (!($rec_len > 0))
        //             continue;
        //         $rec_full = @fgets($handle, $rec_len - 4);
        //         $ind++;
        //         if ($ind < $from)
        //             continue;

        //         if ($ind > ($from + 100))
        //             break;

        //         // $res = getArrayFromIso($rec_full);
        //         $res = getArrayFromIso($rec_full);



        //         if ($res === false) {
        //             $err = "INCORRECT_FORMAT";
        //             break;
        //         }

        //         $__vw_p = $res;
        //         $__io_r = array(); // set 
        //         // $book = new Book('', $__io_r);
        //         // $book->add('', true);
        //         // Loading copies

        //         $data['price'] = 0;
        //         $data['status'] = 1;
        //         if (isset($res['010']) && isset($res['010']['^'])) {
        //             $price = substr(Import::converting($res['010']['^'][0]), 1);
        //             $data['price'] = $price;
        //         }


        //         if (isset($res['200']) && isset($res['200']['^'])) {
        //             $title = substr(Import::converting($res['200']['^'][0]), 1);
        //             $title = explode("^F", $title);

        //             $data['title'] = $title[0];
        //         }
        //         if (isset($res['210']) && isset($res['210']['^'])) {
        //             $publisher = Import::converting($res['210']['^'][0]);
        //             $publisher = explode("^", $publisher);
        //             if (array_key_exists(2, $publisher))
        //                 $data['published_city'] = $publisher[2];
        //             if (array_key_exists(1, $publisher))
        //                 $data['publisher'] = ltrim($publisher[1], "C");
        //             if (array_key_exists(0, $publisher))
        //                 $data['published_year'] = substr($publisher[0], 1);
        //         }
        //         if (isset($res['675']) && isset($res['675']['3'])) {
        //             $UDK = substr(Import::converting($res['675'][3][0]), 1);
        //             $data['UDK'] = $UDK;
        //         }
        //         if (isset($res['702'])) {
        //             $data['authors'] = substr(Import::converting($res['702']['^'][0]), 1);
        //             $data['authors'] = json_encode(explode(';', $data['authors']));
        //         }

        //         $data['extra1'] = json_encode(mb_convert_encoding($res, 'UTF-8', 'UTF-8'));

        //         $old_data = Import::where('title', '=', $data['title'])->where('published_year', '=', $data['published_year'])->where('published_city', '=', $data['published_city'])->where('publisher', '=', $data['publisher'])->first();
        //         // dd($res);
        //         if ($old_data == null) {
        //             $data['status'] = 1;
        //             $import = Import::create($data);
        //         } else {
        //             $old_data->update($data);
        //         }

        //         // $import = Import::create($data);
        //     }

        //     fclose($handle);

        //     // echo "<pre>";
        //     // foreach ($collection as $record) {
        //     //     print_r($record);
        //     //     if($record->getField('100')!=null){
        //     //         echo $record->getField('100')->getSubfield('a')->getData()."<br>";
        //     //     }
        //     //     // dd($record->getField('100')->getSubfield('a')->getData());
        //     //     // dd($record->getField('245')->getSubfield('a')->getData());
        //     // }


        // }

        // if ($type_import == "irbis_windows_marc21") {
        //     foreach ($collection as $record) {
        //         print_r($record->getField('702'));
        //         if ($record->getField('100') != null) {
        //             echo $record->getField('100')->getSubfield('a')->getData();
        //         }

        //         if (isset($res['260'])) {
        //             if (isset($res['260']['A']))
        //                 $data['published_city'] = self::converting($res['260']['A'][0]);
        //             if (isset($res['260']['B']))
        //                 $data['publisher'] = self::converting($res['260']['B'][0]);
        //             if (isset($res['260']['C']))
        //                 $data['published_year'] = self::converting($res['260']['C'][0]);
        //         }
        //         // dd($record->getField('100')->getSubfield('a')->getData());
        //         // dd($record->getField('245')->getSubfield('a')->getData());
        //     }
        // }

        

        return $data;
    }

    public static function rules()
    {
        $rules = [
            'file' => 'required',
        ];

        return $rules;
    }
}
