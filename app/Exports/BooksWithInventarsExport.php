<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BooksWithInventarsExport implements FromCollection, WithMapping, WithHeadings
{

    // use Exportable;

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
        $keyword = trim($this->request);
        $q = Book::query();
        // if($keyword != null){ 
        //     $q->whereHas('translations', function ($query) use ($keyword) {
        //         if($keyword) {
        //             $query->where('title', 'like', '%'.$keyword.'%');
        //         }
        //     }); 
        // }

        return  $q->paginate(50);
    }

    // public function view(): View
    // {

    //     // $keyword=trim($this->request);
    //     $q = Book::query();
    //     // if($keyword != null){ 
    //     //     $q->whereHas('translations', function ($query) use ($keyword) {
    //     //         if($keyword) {
    //     //             $query->where('title', 'like', '%'.$keyword.'%');
    //     //         }
    //     //     }); 
    //     // }

    //     $books=  $q->orderBy('created_at', 'DESC')->get();

    //     return view('exports.book-inventars', ['books'=>$books]);
    // }


    public function map($book): array
    {
        $createdAt = null;
        if ($book->created_at != null) {
            $createdAt = \Carbon\Carbon::parse($book->created_at)->format('Y-d-m');
        }
        return [
            $book->id . ')',
            html_entity_decode(strip_tags(Book::GetBibliographicById($book->id))), //
            $createdAt,
            \App\Models\BookInventar::GetInventarsByBookId($book->id),
            \App\Models\BookInventar::GetInventarsCountByBookId($book->id),
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
            __('Bibliographic record'),
            __('Created At'),
            __('Inventar Numbers'),
            __('Copies'),
            __('Price')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'F'  => ['font' => ['size' => 16]],
        ];
    }
}
