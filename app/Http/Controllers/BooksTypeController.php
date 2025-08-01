<?php

namespace App\Http\Controllers;

use App\Exports\ExportBooksType;
use App\Models\BooksType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


/**
 * Class BooksTypeController
 * @package App\Http\Controllers
 */
class BooksTypeController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $keyword=trim($request->get('keyword'));
        $q = BooksType::query();
        $perPage = 20;
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        
        $booksTypes = $q->with('translations')->withCount(['books', 'journals'])->paginate($perPage);

        return view('book-types.index', compact('booksTypes', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $booksTypes->perPage());
    }

    public function export($language, Request $request){
        $file_name = 'books-type_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportBooksType($keyword), $file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booksType = new BooksType();
        return view('book-types.create', compact('booksType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate(
            BooksType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]
        );
        $booksTypeOld = new BooksType();
 
        $booksType = BooksType::create(BooksType::GetData($request, $booksTypeOld));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $booksType = BooksType::find($id);

        return view('book-types.show', compact('booksType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $booksType = BooksType::find($id);

        return view('book-types.edit', compact('booksType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BooksType $bookType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BooksType $bookType)
    {
        request()->validate(
            BooksType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]
        );
        $bookType->update(BooksType::GetData($request, $bookType));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id, Request $request)
    { 
        $booksType = BooksType::find($id);
        $booksType->isActive = false;
        $booksType->Save();
        

        // ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-types.index', app()->getLocale());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type=$request->input('type');

        // BooksType::find($id)->delete();
        $booksType= BooksType::find($id);
        if($type=='DELETE'){
            BooksType::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-types.show', compact('booksType'));
        }
    }
}
