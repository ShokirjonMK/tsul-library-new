<?php

namespace App\Http\Controllers;

use App\Exports\ExportWho;
use App\Models\Who;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class WhoController
 * @package App\Http\Controllers
 */
class WhoController extends Controller
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
        $q = Who::query();

        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }

        $whos = $q->with('translations')->withCount('books')->orderBy('id', 'desc')->paginate($perPage);

        return view('who.index', compact('whos', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $whos->perPage());
    }
    public function export($language, Request $request)
    {
        $file_name = 'who_' . date('Y_m_d_H_i_s') . '.xlsx';
        $keyword = trim($request->get('keyword'));

        return Excel::download(new ExportWho($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $who = new Who();
        return view('who.create', compact('who'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Who::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $who = Who::create(Who::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('whos.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $who = Who::find($id);

        return view('who.show', compact('who'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $who = Who::find($id);

        return view('who.edit', compact('who'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Who $who
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Who $who)
    {

        request()->validate(Who::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $who->update(Who::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('whos.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $who = Who::find($id)->delete();
        $who = Who::find($id);
        $who->isActive=false;
        $who->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('whos.index', app()->getLocale());
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
        $bookFileType= Who::find($id);
        if($type=='DELETE'){
            Who::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-file-types.show', compact('bookFileType'));
        }
    }
}
