<?php

namespace App\Http\Controllers;

use App\Models\BookTakenWithoutPermission;
use Illuminate\Http\Request;

/**
 * Class BookTakenWithoutPermissionController
 * @package App\Http\Controllers
 */
class BookTakenWithoutPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookTakenWithoutPermissions = BookTakenWithoutPermission::orderBy('id', 'desc')->paginate($perPage);

        return view('book-taken-without-permission.index', compact('bookTakenWithoutPermissions'))
            ->with('i', (request()->input('page', 1) - 1) * $bookTakenWithoutPermissions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        $bookTakenWithoutPermission = new BookTakenWithoutPermission();
//        return view('book-taken-without-permission.create', compact('bookTakenWithoutPermission'));
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookTakenWithoutPermission::rules());

        $bookTakenWithoutPermission = BookTakenWithoutPermission::create(BookTakenWithoutPermission::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-taken-without-permissions.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookTakenWithoutPermission = BookTakenWithoutPermission::find($id);

        return view('book-taken-without-permission.show', compact('bookTakenWithoutPermission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookTakenWithoutPermission = BookTakenWithoutPermission::find($id);

        return view('book-taken-without-permission.edit', compact('bookTakenWithoutPermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookTakenWithoutPermission $bookTakenWithoutPermission
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookTakenWithoutPermission $bookTakenWithoutPermission)
    {

        request()->validate(BookTakenWithoutPermission::rules());

        $bookTakenWithoutPermission->update(BookTakenWithoutPermission::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-taken-without-permissions.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookTakenWithoutPermission = BookTakenWithoutPermission::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-taken-without-permissions.index', app()->getLocale());
    }
}
