<?php

namespace App\Jobs;

use App\Models\Bibliographicrecord;
use App\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Scriptotek\Marc\Collection;

class MarcImportProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $filePath;
    public $type_import;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $type_import)
    {
        $this->filePath = $filePath;
        $this->type_import = $type_import;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        if ($this->type_import == "from_armatplus") {
            
            $biblioRecords = Bibliographicrecord::where('id','<>',11537)->where('id','<>',12598)->where('id','<>',15976)->where('id','<>',16133)->where('id','<>',16134)->where('id','<>',17188)->get();
            // $biblioRecords = Bibliographicrecord::get();

            // $biblioRecords = Bibliographicrecord::orderBy('id', 'desc')->get();
            foreach ($biblioRecords as $biblioRecord) {

                // $res = getArrayFromArmatPlus($biblioRecord->record);
                $res = Import::GetArrayFromIsoArmatPP($biblioRecord->record);
                
                if ($res === false) {
                    $err = "INCORRECT_FORMAT";
                    break;
                } 
                $data = [];
    
                $data['price'] = 0;
                $data['status'] = 1;
                $data['published_year']=null;
                $data['title']=null;
                $data['published_city']=null;
                $data['publisher']=null;
        
         
        
                if (isset($res['20'])) {
                    if (isset($res['20']['c'])) {
                        $data['price'] = $res['20']['c'];
                    }
                    if (isset($res['20']['a'])) {
                        $data['ISBN'] = $res['20']['a'];
                    }
                }
        
                // if (isset($res['40'])) {
                //     if (isset($res['40']['b'])) {
                //         $data['price'] = $res['40']['b'];
                //     }
        
                // }
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
                $data['extra1']=json_encode($res);
                $data['extra4']=$biblioRecord->id;

                // $old_data = Import::where('title', '=', $data['title'])->where('published_year', '=', $data['published_year'])->where('published_city', '=', $data['published_city'])->where('publisher', '=', $data['publisher'])->first();
                $old_data = Import::where('extra4', '=', $biblioRecord->id)->first();

                
                if ($old_data == null) {
                    $data['status'] = 1;
                    $import = Import::create($data);
                }
                 else {
                    $old_data->update($data);
                }
    
    
            }
        }
        // $data=[];
      
        $collection = Collection::fromFile(public_path($this->filePath));
        
           
        if ($this->type_import == "armat_marc21") {
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
        
        
        // if ($this->type_import == "irbis_utf_8_marc21") {
        //     $data = [];
        //     $data['title']="";
        //     $data['published_year']="";
        //     $data['published_city']="";
        //     $data['publisher']="";
        //     // $fn_name  = $_REQUEST['file_name'];
        //     $from     = 0;
        //     // $format   = $_REQUEST['format'];
        //     // $db_url   = $_REQUEST['db_url'];

        //     $handle          = @fopen(public_path($this->filePath), "r");
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
        //         if (isset($res['702'])) {
        //             $data['authors'] = substr(Import::converting($res['702']['^'][0]), 1);
        //         }
                
        //         $import = Import::create($data);
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

        // if ($this->type_import == "irbis_windows_marc21") {
        //     foreach ($collection as $record) {
        //         print_r($record->getField('702'));
        //         if ($record->getField('100') != null) {
        //             echo $record->getField('100')->getSubfield('a')->getData();
        //         }

        //         if (isset($res['260'])) {
        //             if (isset($res['260']['A']))
        //                 $data['published_city'] = Import::converting($res['260']['A'][0]);
        //             if (isset($res['260']['B']))
        //                 $data['publisher'] = Import::converting($res['260']['B'][0]);
        //             if (isset($res['260']['C']))
        //                 $data['published_year'] = Import::converting($res['260']['C'][0]);
        //         }
        //         // dd($record->getField('100')->getSubfield('a')->getData());
        //         // dd($record->getField('245')->getSubfield('a')->getData());
        //     }
        // }

    }
}
