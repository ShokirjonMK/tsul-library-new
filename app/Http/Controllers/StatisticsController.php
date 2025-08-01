<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookText;
use App\Models\Debtor;
use App\Models\Subject;
use App\Models\User;
use App\Models\Where;
use App\Models\Who;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statdebtors($language, Request $request)
    {
        $from = (trim($request->get('from')))?trim($request->get('from')):date('Y-m-d');
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');
        $startDate = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $to);
        $statdebtors = Debtor::whereBetween(DB::raw('DATE(taken_time)'), [$startDate, $endDate])->get();
        
        $counts = $statdebtors->countBy(function ($item) {
            return $item['status'];
        });
        
        $statdebtor_by_readers = Debtor::with(['reader', 'reader.profile'])->whereBetween(DB::raw('DATE(taken_time)'), [$startDate, $endDate])->distinct()->paginate(20,['reader_id']);

        // $counts_by_readers = $statdebtor_by_readers->countBy(function ($item) {
        //     return $item['reader_id'];
        // });
        // dd($statdebtor_by_readers);
        return view('statistics.statdebtors', compact('statdebtors', 'from', 'to', 'counts', 'statdebtor_by_readers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeestat($language, Request $request)
    {
        $usersEmps = \DB::select("SELECT u.id, u.name, u.email, u.inventar_number FROM `model_has_roles` as mhr left JOIN users as u on u.id=mhr.model_id WHERE mhr.role_id in (1,2,3)");
                
        $months = BooksType::getMonths();

        $from = (trim($request->get('from')))?trim($request->get('from')):date('Y-m-d');
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');

        $startMonth = Carbon::createFromFormat('Y-m-d', $from);
        $endMonth = Carbon::createFromFormat('Y-m-d', $to);

        // $statdebtors = Debtor::whereBetween(DB::raw('DATE(taken_time)'), [$startDate, $endDate])->get();
        
        // $counts = $statdebtors->countBy(function ($item) {
        //     return $item['status'];
        // });
        

        // $counts_by_readers = $statdebtor_by_readers->countBy(function ($item) {
        //     return $item['reader_id'];
        // });
        // dd($statdebtor_by_readers);
        return view('statistics.employeestat', compact('from', 'startMonth', 'endMonth',  'to',  'usersEmps'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function debtorsshow($language, $reader_id, Request $request){

        $from = (trim($request->get('from')))?trim($request->get('from')):date('Y-m-d');
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');
        $statdebtor_by_readers = Debtor::with(['reader', 'reader.profile'])->where('reader_id', '=', $reader_id)->whereBetween(DB::raw('DATE(taken_time)'), [$from, $to])->paginate(10);
        $user = User::find($reader_id);
        

        return view('statistics.debtorsshow', compact('statdebtor_by_readers', 'from', 'to', 'user'));
    }

    public function statisticsByMonth($language, Request $request){

        $month = $request->get('month');
        
    //    $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
    //    $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
        // dd($from);
         //     $statbooks = Book::whereBetween('created_at', [$startDate, $endDate])->get();


        return view('statistics.statisticsByMonth', compact('month'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function statbooks($language, Request $request)
    // {
    //     // dd($request->get('from'));
    //     $from = (trim($request->get('from')))?trim($request->get('from')):date('Y-m');
    //     $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m');

    //     $startDate = Carbon::createFromFormat('Y-m', $from)->startOfMonth();
    //     $endDate = Carbon::createFromFormat('Y-m', $to)->endOfMonth();
        
    //     $statbooks = Book::whereBetween('created_at', [$startDate, $endDate])->get();

    //     dd($statbooks);
    //     $counts = $statbooks->countBy(function ($item) {
    //         return $item['books_type_id'];
    //     });
    //     // dd($counts);

    //     // dd($statbooks);
    //     $statdebtor_by_readers = Book::with(['bookInventar', 'BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->whereBetween('created_at', [$startDate, $endDate])->distinct()->paginate(20,['books_type_id']);
    //     // dd($statdebtor_by_readers);
    //     return view('statistics.books.statbooks', compact('statbooks', 'from', 'to', 'counts', 'statdebtor_by_readers'));
    // }
    public function statbooks($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $months = BooksType::getMonths();
        $booksTypes = BooksType::with('translations')->withCount(['books', 'journals'])->paginate(20);
 
        return view('statistics.books.statbooks', compact('booksTypes', 'year', 'months', 'years'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booksshow($language, $reader_id, Request $request){

        $from = (trim($request->get('from')))?trim($request->get('from')):date('Y-m-d');
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');
        $statdebtor_by_readers = Debtor::with(['reader', 'reader.profile'])->where('reader_id', '=', $reader_id)->whereBetween(DB::raw('DATE(taken_time)'), [$from, $to])->paginate(10);
        $user = User::find($reader_id);
        

        return view('statistics.booksshow', compact('statdebtor_by_readers', 'from', 'to', 'user'));
    }

    public function statbooktypes($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = BooksType::with('translations')->withCount(['books', 'journals'])->paginate(20);
        $months = BooksType::getMonths();
 
        return view('statistics.statbooktypes', compact('booksTypes', 'year', 'months', 'years'));
    }

    public function statbooktexts($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = BookText::with('translations')->withCount(['books', 'journals'])->paginate(20);
        $months = BooksType::getMonths();
 
        return view('statistics.statbooktexts', compact('booksTypes', 'year', 'months', 'years'));
    }
    public function statbooksubjects($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = Subject::with('translations')->withCount(['books'])->paginate(20);
        $months = BooksType::getMonths();
 
        return view('statistics.statbooksubjects', compact('booksTypes', 'year', 'months', 'years'));
    }
  
    public function statbookwhos($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = Who::with('translations')->withCount(['books'])->paginate(20);
        $months = BooksType::getMonths();
        
        return view('statistics.statbookwhos', compact('booksTypes', 'year', 'months', 'years'));
    }
  
    public function statbookwhere($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = Where::with('translations')->withCount(['books'])->paginate(20);
        $months = BooksType::getMonths();
        
        return view('statistics.statbookwhere', compact('booksTypes', 'year', 'months', 'years'));
    }
  
    public function statbooklangs($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $bookLanguages = BookLanguage::with('translations')->withCount(['books'])->paginate(20);
        $months = BooksType::getMonths();
        
        return view('statistics.statbooklangs', compact('bookLanguages', 'year', 'months', 'years'));
    }

    public function statdebtorsbooktypes($language, Request $request)
    {

        $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $years = range(2022, strftime("%Y", time())); 
        
        $booksTypes = BooksType::with('translations')->withCount(['books', 'journals'])->paginate(20);
        $months = BooksType::getMonths();
 
        return view('statistics.statdebtorsbooktypes', compact('booksTypes', 'year', 'months', 'years'));
    }

}