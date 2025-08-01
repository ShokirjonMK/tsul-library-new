<?php

namespace App\Http\Controllers;

use App\Exports\ExportBookAccessType;
use App\Models\BookAccessType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookAccessTypeController
 * @package App\Http\Controllers
 */
class BookAccessTypeController extends Controller
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
        $q = BookAccessType::query();

        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }

        $bookAccessTypes = $q->with('translations')->withCount(['books', 'journals'])->orderBy('id', 'desc')->paginate($perPage);

        return view('book-access-type.index', compact('bookAccessTypes', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $bookAccessTypes->perPage());
    }
    public function export($language, Request $request)
    {
        $file_name = 'book-access-type_' . date('Y_m_d_H_i_s') . '.xlsx';
        $keyword = trim($request->get('keyword'));

        return Excel::download(new ExportBookAccessType($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookAccessType = new BookAccessType();
        return view('book-access-type.create', compact('bookAccessType'));
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
            BookAccessType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Key'),
            ]
        );

        $bookAccessType = BookAccessType::create(BookAccessType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-access-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);

        return view('book-access-type.show', compact('bookAccessType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);

        return view('book-access-type.edit', compact('bookAccessType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookAccessType $bookAccessType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookAccessType $bookAccessType)
    {

        request()->validate(
            BookAccessType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Key'),
            ]
        );

        $bookAccessType->update(BookAccessType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-access-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);
        $bookAccessType->isActive = false;
        $bookAccessType->Save();
        // ->delete()

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-access-types.index', app()->getLocale());
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
        $bookFileType= BookAccessType::find($id);
        if($type=='DELETE'){
            BookAccessType::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-file-types.show', compact('bookFileType'));
        }
    }
}
