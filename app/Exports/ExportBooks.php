<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBooks implements FromCollection, WithMapping, WithHeadings
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
        return Book::all();
    }
    public function map($book): array
    {
        $auhtor="";
        if($book->dc_authors){
            foreach (json_decode($book->dc_authors) as $key => $value) {
                $auhtor .= $value.', ';
            }
        }
        return [
            $book->id,
            $book->dc_BBK,
            $book->dc_UDK,
            rtrim($auhtor, ', '),
            $book->dc_title,
            $book->books_type_id ? $book->booksType->title : '',
            $book->bookLanguage ? $book->bookLanguage->title : '',
            $book->published_year,
            $book->dc_publisher,
            $book->price,
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('Dc BBK'),
            __('Dc UDK'),
            __('Dc Authors'),
            __('Dc Title'),
            __('Books Type'),
            __('Book Language'),
            __('Published Year'),
            __('Dc Publisher'),
            __('Price')
        ];
    }
}
