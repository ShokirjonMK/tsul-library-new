<?php

namespace App\Exports;

use App\Models\BookAct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBookAct implements FromCollection, WithMapping, WithHeadings
{

    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
 
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $q = BookAct::query();
        $where_id= trim($this->request->get('where-id'));
        $summarka= trim($this->request->get('summarka'));
        // $arrived_date= trim($this->request->get('arrived_date'));
        $arrived_year= trim($this->request->get('arrived-year'));

        if($where_id != null){ 
            $q->where('where_id', '=', $where_id);
        }
        if($summarka != null){ 
            $q->where('summarka_raqam', '=', $summarka);
        }
        // if($arrived_date != null){ 
        //     $q->where('arrived_date', '=', $arrived_date);
        // }
        if($arrived_year != null){ 
            $q->where('arrived_year', '=', $arrived_year);
        }        
        return  $q->with(['wheres', 'wheres.translations'])->orderBy('id', 'desc')->get();
    }
    public function map($bookstype): array
    {
        return [
            $bookstype->id,
            $bookstype->wheres->title,
            $bookstype->arrived_year,
            $bookstype->summarka_raqam,
            $bookstype->price,
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('Where'),
            __('Arrived Year'),
            __('Summarka Raqam'),
            __('Price')
        ];
    }
    
}
