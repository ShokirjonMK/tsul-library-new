<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookAct;
use App\Models\BookAct;
use App\Models\Where;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookActController
 * @package App\Http\Controllers
 */
class BookActController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $perPage = 20;
        $q = BookAct::query();
        $where_id= trim($request->get('where_id'));
        $summarka= trim($request->get('summarka'));
        $arrived_date= trim($request->get('arrived_date'));
        $arrived_year= trim($request->get('arrived_year'));

        if($where_id != null){ 
            $q->where('where_id', '=', $where_id);
        }
        if($summarka != null){ 
            $q->where('summarka_raqam', '=', $summarka);
        }
        if($arrived_date != null){ 
            $q->where('arrived_date', '=', $arrived_date);
        }
        if($arrived_year != null){ 
            $q->where('arrived_year', '=', $arrived_year);
        }        
        $bookActs = $q->with(['wheres', 'wheres.translations'])->orderBy('id', 'desc')->paginate($perPage);
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('book-act.index', compact('bookActs','where_id', 'summarka', 'arrived_date', 'arrived_year', 'wheres'))
            ->with('i', (request()->input('page', 1) - 1) * $bookActs->perPage());
    }
    
    public function export($language, Request $request){
        $file_name = 'book-acts_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new ExportBookAct($request), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookAct = new BookAct();
        return view('book-act.create', compact('bookAct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookAct::rules());

        $bookAct = BookAct::create(BookAct::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-acts.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookAct = BookAct::find($id);

        return view('book-act.show', compact('bookAct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookAct = BookAct::find($id);

        return view('book-act.edit', compact('bookAct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookAct $bookAct
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookAct $bookAct)
    {

        request()->validate(BookAct::rules());

        $bookAct->update(BookAct::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-acts.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        if (Auth::user()->hasRole('SuperAdmin')){
            $bookAct = BookAct::find($id);
            $bookAct->delete();
            toast(__('Successfully deleted'), 'info');
        }else{
            toast(__('You do not have the super admin role and you cannot delete it!'), 'warning');
        }


        
        return redirect()->route('book-acts.index', app()->getLocale());
    }
}
