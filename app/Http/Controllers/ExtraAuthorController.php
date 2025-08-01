<?php

namespace App\Http\Controllers;

use App\Models\ExtraAuthor;
use Illuminate\Http\Request;

/**
 * Class ExtraAuthorController
 * @package App\Http\Controllers
 */
class ExtraAuthorController extends Controller
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
    public function index()
    {
        $perPage = 20;
        $extraAuthors = ExtraAuthor::orderBy('id', 'desc')->paginate($perPage);

        return view('extra-author.index', compact('extraAuthors'))
            ->with('i', (request()->input('page', 1) - 1) * $extraAuthors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extraAuthor = new ExtraAuthor();

        return view('extra-author.create', compact('extraAuthor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ExtraAuthor::rules());

        $extraAuthor = ExtraAuthor::create(ExtraAuthor::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('extra-authors.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $extraAuthor = ExtraAuthor::find($id);

        return view('extra-author.show', compact('extraAuthor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $extraAuthor = ExtraAuthor::find($id);
        
        return view('extra-author.edit', compact('extraAuthor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ExtraAuthor $extraAuthor
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ExtraAuthor $extraAuthor)
    {

        request()->validate(ExtraAuthor::rules());

        $extraAuthor->update(ExtraAuthor::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('extra-authors.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $extraAuthor = ExtraAuthor::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('extra-authors.index', app()->getLocale());
    }
}
