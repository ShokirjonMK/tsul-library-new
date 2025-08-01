<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookFileType;
use App\Models\BookFileType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookFileTypeController
 * @package App\Http\Controllers
 */
class BookFileTypeController extends Controller
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
        $q = BookFileType::query();
        $perPage = 20;
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        

        $bookFileTypes = $q->with('translations')->withCount('books')->orderBy('id', 'desc')->paginate($perPage);
         
        return view('book-file-type.index', compact('bookFileTypes', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $bookFileTypes->perPage());
    }

    public function export($language, Request $request){
        $file_name = 'book-file-type_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportBookFileType($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookFileType = new BookFileType();
        return view('book-file-type.create', compact('bookFileType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookFileType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),  
        ]);

        $bookFileType = BookFileType::create(BookFileType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-file-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookFileType = BookFileType::find($id);

        return view('book-file-type.show', compact('bookFileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookFileType = BookFileType::find($id);

        return view('book-file-type.edit', compact('bookFileType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookFileType $bookFileType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookFileType $bookFileType)
    {

        request()->validate(BookFileType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookFileType->update(BookFileType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-file-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookFileType = BookFileType::find($id);
        $bookFileType->isActive=false;
        $bookFileType->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-file-types.index', app()->getLocale());
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
        $bookFileType= BookFileType::find($id);
        if($type=='DELETE'){
            BookFileType::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-file-types.show', compact('bookFileType'));
        }
    }
}
