<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookLanguage;
use App\Models\BookLanguage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookLanguageController
 * @package App\Http\Controllers
 */
class BookLanguageController extends Controller
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
        $perPage = 20;
        $keyword=trim($request->get('keyword'));
        $q = BookLanguage::query();
        $perPage = 20;
        if($keyword != null){
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            });
        }

        $bookLanguages = $q->withCount('books')->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('book-language.index', compact('bookLanguages', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $bookLanguages->perPage());
    }


    public function export($language, Request $request){
        $file_name = 'book-language_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportBookLanguage($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookLanguage = new BookLanguage();
        return view('book-language.create', compact('bookLanguage'));
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
            BookLanguage::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Code'),
            ]
        );

        $bookLanguage = BookLanguage::create(BookLanguage::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-languages.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        return view('book-language.show', compact('bookLanguage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        return view('book-language.edit', compact('bookLanguage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookLanguage $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookLanguage $bookLanguage)
    {
        request()->validate(
            BookLanguage::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Code'),
            ]
        );

        $bookLanguage->update(BookLanguage::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-languages.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        $bookLanguage->isActive = false;
        $bookLanguage->Save();

        // ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-languages.index', app()->getLocale());
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
        $bookLanguage= BookLanguage::find($id);
        if($type=='DELETE'){
            BookLanguage::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        }else{
            return view('book-languages.show', compact('bookLanguage'));
        }
    }
}
