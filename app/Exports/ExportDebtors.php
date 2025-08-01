<?php

namespace App\Exports;

use App\Models\Debtor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportDebtors implements  FromCollection, WithMapping, WithHeadings
{ 
    use Exportable;

    protected $keyword, $status, $barcode, $title;

    public function __construct($keyword, $status, $barcode, $title)
    {
        $this->keyword = $keyword;
        $this->status = $status;
        $this->barcode = $barcode;
        $this->title = $title;
    }
      
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $keyword=trim($this->keyword);
        $status=trim($this->status);
        $barcode=trim($this->barcode);
        $title=trim($this->title);

        $q = Debtor::query();

        if($status==null){
            $status=99;
        }
        
        if ($status == 99) {
            $q->orderBy('return_time', 'asc')->orderBy('status', 'ASC');
        }elseif($status == 98){
            $q-> whereNull('returned_time')->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'asc');
        } else {
            $q-> where('status', '=', $status)->orderBy('return_time', 'asc');
        } 

        if($keyword != null){ 
            $q->whereHas('reader', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                    $query->orWhere('email', 'like', '%'.$keyword.'%');
                    $query->orWhere('inventar_number', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        
        if ($barcode != null) {

            $q->whereHas('bookInventar', function ($query) use ($barcode) {
                if ($barcode) {
                    $query->where('bar_code', '=', $barcode);
                }
            });
        }

        if ($title != null) {

            $q->whereHas('book', function ($query) use ($title) {
                if ($title) {
                    $query->where('dc_title', 'LIKE', "%$title%")
                        ->orWhere('location_index', 'LIKE', "%$title%")
                        ->orWhere('dc_UDK', 'LIKE', "%$title%")
                        ->orWhere('dc_BBK', 'LIKE', "%$title%")
                        ->orWhere('ISBN', 'LIKE', "%$title%")
                        ->orWhere('extra1', 'LIKE', "%$title%")
                        ->orWhereHas('extraAuthorBooks', function ($query) use ($title) {
                            if ($title) {
                                $query->where('name', 'like', '%' . $title . '%');
                            }
                        });
                }
            });
        }

        $q->whereNotNull('reader_id');
        $debtors = $q->with(['reader', 'reader.profile'])->distinct()->get();
        
        return $debtors;
    }

    public function map($debtor): array
    {
      return[
             $debtor->id,
             $debtor->reader ? $debtor->reader->name : '',
             $debtor->reader->profile->faculty ? $debtor->reader->profile->faculty->title : '',
             $debtor->reader->profile->group ? $debtor->reader->profile->group->title : '',
             html_entity_decode(strip_tags(\App\Models\Book::GetBibliographicById($debtor->book_id))),
             $debtor->bookInventar->bar_code,
             html_entity_decode(strip_tags(Debtor::GetStatus($debtor->status))),
             $debtor->taken_time,
             $debtor->return_time,
             $debtor->returned_time,
             $debtor->how_many_days,
             $debtor->created_by ? $debtor->createdBy->name : '',
             $debtor->updated_by ? $debtor->updatedBy->name : '' ,
         ];
    }
   /** 
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            __('Code'),
            __('Reader'),
            __('Faculty'),
            __('Group'),
            __('Book'),
            __('Bar code'),
            __('Status'),
            __('Taken Time'),
            __('Return Time'),
            __('Returned Time'),
            __('How Many Days'),
            __('Given By'),
            __('Taken By'),

        ];
    } 
}
