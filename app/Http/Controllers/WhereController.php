<?php

namespace App\Http\Controllers;

use App\Exports\ExportWhere;
use App\Models\Where;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class WhereController
 * @package App\Http\Controllers
 */
class WhereController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager|Accountant']);

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
        $q = Where::query();

        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }


        $wheres = $q->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('where.index', compact('wheres', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $wheres->perPage());
    }

    public function export($language, Request $request)
    {
        $file_name = 'who_' . date('Y_m_d_H_i_s') . '.xlsx';
        $keyword = trim($request->get('keyword'));

        return Excel::download(new ExportWhere($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $where = new Where();
        return view('where.create', compact('where'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Where::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $where = Where::create(Where::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('wheres.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $where = Where::find($id);

        return view('where.show', compact('where'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $where = Where::find($id);

        return view('where.edit', compact('where'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Where $where
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Where $where)
    {

        request()->validate(Where::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $where->update(Where::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('wheres.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $where = Where::find($id)->delete();
        $where = Where::find($id);
        $where->isActive=false;
        $where->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('wheres.index', app()->getLocale());
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
        $bookFileType= Where::find($id);
        if($type=='DELETE'){
            Where::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-file-types.show', compact('bookFileType'));
        }
    }
}
