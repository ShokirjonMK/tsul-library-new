<?php

namespace App\Http\Controllers;

use App\Models\BookInformation;
use Illuminate\Http\Request;

/**
 * Class BookInformationController
 * @package App\Http\Controllers
 */
class BookInformationController extends Controller
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
        $bookInformations = BookInformation::orderBy('id', 'desc')->paginate($perPage);

        return view('book-information.index', compact('bookInformations'))
            ->with('i', (request()->input('page', 1) - 1) * $bookInformations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookInformation = new BookInformation();
        return view('book-information.create', compact('bookInformation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookInformation::rules());

        $bookInformation = BookInformation::create(BookInformation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-informations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookInformation = BookInformation::find($id);

        return view('book-information.show', compact('bookInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookInformation = BookInformation::find($id);

        return view('book-information.edit', compact('bookInformation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookInformation $bookInformation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookInformation $bookInformation)
    {

        request()->validate(BookInformation::rules());

        $bookInformation->update(BookInformation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-informations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookInformation = BookInformation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-informations.index', app()->getLocale());
    }
}
