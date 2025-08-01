<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookTextType;
use App\Models\BookTextType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookTextTypeController
 * @package App\Http\Controllers
 */
class BookTextTypeController extends Controller
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
        $q = BookTextType::query();
        $perPage = 20;
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        
        $bookTextTypes = $q->withCount(['books', 'journals'])->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('book-text-type.index', compact('bookTextTypes', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $bookTextTypes->perPage());
    }
    public function export($language, Request $request){
        $file_name = 'book-text-type_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportBookTextType($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookTextType = new BookTextType();
        return view('book-text-type.create', compact('bookTextType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookTextType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookTextType = BookTextType::create(BookTextType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-text-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookTextType = BookTextType::find($id);

        return view('book-text-type.show', compact('bookTextType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookTextType = BookTextType::find($id);
        
        return view('book-text-type.edit', compact('bookTextType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookTextType $bookTextType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookTextType $bookTextType)
    {

        request()->validate(BookTextType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookTextType->update(BookTextType::GetData($request));

        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-text-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookTextType = BookTextType::find($id);
        $bookTextType->isActive=false;
        $bookTextType->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');
        
        return redirect()->route('book-text-types.index', app()->getLocale());
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
        $bookLanguage= BookTextType::find($id);
        if($type=='DELETE'){
            BookTextType::find($id)->delete();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-text-types.show', compact('bookLanguage'));
        }
    }
}
