<?php

namespace App\Http\Controllers;

use App\Models\ExtraAuthorBook;
use Illuminate\Http\Request;

/**
 * Class ExtraAuthorBookController
 * @package App\Http\Controllers
 */
class ExtraAuthorBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $extraAuthorBooks = ExtraAuthorBook::orderBy('id', 'desc')->paginate($perPage);

        return view('extra-author-book.index', compact('extraAuthorBooks'))
            ->with('i', (request()->input('page', 1) - 1) * $extraAuthorBooks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extraAuthorBook = new ExtraAuthorBook();
        return view('extra-author-book.create', compact('extraAuthorBook'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ExtraAuthorBook::rules());

        $extraAuthorBook = ExtraAuthorBook::create(ExtraAuthorBook::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('extra-author-books.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $extraAuthorBook = ExtraAuthorBook::find($id);

        return view('extra-author-book.show', compact('extraAuthorBook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $extraAuthorBook = ExtraAuthorBook::find($id);

        return view('extra-author-book.edit', compact('extraAuthorBook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ExtraAuthorBook $extraAuthorBook
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ExtraAuthorBook $extraAuthorBook)
    {

        request()->validate(ExtraAuthorBook::rules());

        $extraAuthorBook->update(ExtraAuthorBook::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('extra-author-books.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $extraAuthorBook = ExtraAuthorBook::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('extra-author-books.index', app()->getLocale());
    }
}
