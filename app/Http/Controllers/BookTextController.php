<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookText;
use App\Models\BookText;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookTextController
 * @package App\Http\Controllers
 */
class BookTextController extends Controller
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
        $q = BookText::query();
        $perPage = 20;
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        
        $bookTexts = $q->withCount(['books', 'journals'])->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('book-text.index', compact('bookTexts', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $bookTexts->perPage());
    }

    public function export($language, Request $request){
        $file_name = 'book-text_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportBookText($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookText = new BookText();
        return view('book-text.create', compact('bookText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookText::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookText = BookText::create(BookText::GetData($request));
        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-texts.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookText = BookText::find($id);

        return view('book-text.show', compact('bookText'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookText = BookText::find($id);

        return view('book-text.edit', compact('bookText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookText $bookText
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookText $bookText)
    {

        request()->validate(BookText::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookText->update(BookText::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-texts.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookText = BookText::find($id);
        
        $bookText->isActive=false;
        $bookText->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-texts.index', app()->getLocale());
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
        $bookLanguage= BookText::find($id);
        if($type=='DELETE'){
            BookText::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-texts.show', compact('bookLanguage'));
        }
    }
}
