<?php

namespace App\Http\Controllers;

use App\Models\BookInventar;
use Illuminate\Http\Request;

/**
 * Class BookInventarController
 * @package App\Http\Controllers
 */
class BookInventarController extends Controller
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
        $bookInventars = BookInventar::orderBy('id', 'desc')->paginate($perPage);

        return view('book-inventar.index', compact('bookInventars'))
            ->with('i', (request()->input('page', 1) - 1) * $bookInventars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookInventar = new BookInventar();
        return view('book-inventar.create', compact('bookInventar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookInventar::rules());

        $bookInventar = BookInventar::create(BookInventar::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-inventars.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookInventar = BookInventar::find($id);

        return view('book-inventar.show', compact('bookInventar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookInventar = BookInventar::find($id);

        return view('book-inventar.edit', compact('bookInventar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookInventar $bookInventar
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookInventar $bookInventar)
    {

        request()->validate(BookInventar::rules());

        $bookInventar->update(BookInventar::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-inventars.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookInventar = BookInventar::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-inventars.index', app()->getLocale());
    }
}
