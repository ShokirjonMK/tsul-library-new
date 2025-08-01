<?php

namespace App\Exports;

use App\Models\BookLanguage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBookLanguage implements FromCollection, WithMapping, WithHeadings
{

    use Exportable;

    protected $keyword;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $keyword = trim($this->keyword);
        $q = BookLanguage::query();
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }
        return  $q->with('translations')->withCount(['books'])->get();
    }
    public function map($bookstype): array
    {
        return [
            $bookstype->id,
            $bookstype->title,
            $bookstype->books_count,
            \App\Models\BookLanguage::GetCountBookByBookTypeId($bookstype->id),
            \App\Models\BookLanguage::GetCountBookCopiesByBookTypeId($bookstype->id)
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('Title'),
            __('Bibliographic record'),
            __('Number of books'),
            __('Books in Copy')
        ];
    }
}
