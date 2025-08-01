<?php

namespace App\Exports;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSubjectsMonthly implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }
    /**
     * Get the data for export
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Subject::withCount(['books' => function ($query) {
                $query->whereYear('created_at', $this->year);
            }])
            ->get();
//        return Subject::withCount(['books'])->get();
    }
    /**
     * Map the data into the Excel format
     * @param $subject
     * @return array
     */
    public function map($subject): array
    {
        $monthlyCounts = $this->getMonthlyBookCounts($subject->id);
        return array_merge([
            $subject->id,
            $subject->title,
        ], $monthlyCounts);

//        $months = range(1, 12); // Months from 1 (Jan) to 12 (Dec)
//        $monthlyCounts = [];
//
//        foreach ($months as $month) {
//            // Count books added in a specific month of the given year
//            $count = $subject->books()
//                ->whereYear('created_at', $this->year)
//                ->whereMonth('created_at', $month)
//                ->count();
//
//            $monthlyCounts[] = $count." | ". Subject::GetCountBookCopiesByBookTypeIdMonthNumber( $subject->id, $month);
//        }
//        return array_merge([
//            $subject->id,
//            $subject->title,
//            $subject->books_count, // Total books
//            \App\Models\Subject::GetCountBookCopiesByBookTypeId($subject->id)
//        ], $monthlyCounts);
    }
    /**
     * Get monthly book counts in one optimized query
     */
    private function getMonthlyBookCounts($subjectId)
    {
        $months = range(1, 12);
        $monthlyCounts = array_fill(0, 12, '0 | 0');

        $results = DB::table('books as b')
            ->select(
                'b.subject_id',
                DB::raw('MONTH(bil.created_at) as month'),
                DB::raw('(SELECT COUNT(*) FROM books WHERE subject_id = b.subject_id AND status = 1) as book_count'),
                DB::raw('COUNT(bil.id) as copy_count')
            )
            ->leftJoin('book_inventars as bil', 'bil.book_id', '=', 'b.id')
            ->where('b.subject_id', $subjectId)
            ->where('b.status', 1)
            ->whereYear('bil.created_at', $this->year)
            ->groupBy('b.subject_id', DB::raw('MONTH(bil.created_at)'))  // ✅ Added subject_id to GROUP BY
            ->get();


        foreach ($results as $row) {
            $monthlyCounts[$row->month - 1] = "{$row->book_count} | {$row->copy_count}";
        }

        return $monthlyCounts;
    }
    /**
     * Get total book copies for a subject
     */
    private function getTotalBookCopies($subjectId)
    {
        return DB::table('book_inventars as bil')
            ->join('books as b', 'bil.book_id', '=', 'b.id')
            ->where('b.subject_id', $subjectId)
            ->where('b.status', 1)
            ->where('bil.isActive', 1)
            ->count();
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return array_merge([
            'No',
            __("Title")
        ], [
            'Yanvar', 'Fevral', 'Mart', 'April', 'May', 'Iyun',
            'Iyul', 'Avgust', 'Sentabr', 'Oktabr', 'Noyabr', 'Dekabr'
        ]);
    }
}
