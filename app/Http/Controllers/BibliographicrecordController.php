<?php

namespace App\Http\Controllers;

use App\Models\Bibliographicrecord;
use Illuminate\Http\Request;

/**
 * Class BibliographicrecordController
 * @package App\Http\Controllers
 */
class BibliographicrecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bibliographicrecords = Bibliographicrecord::orderBy('id', 'desc')->paginate($perPage);

        return view('bibliographicrecord.index', compact('bibliographicrecords'))
            ->with('i', (request()->input('page', 1) - 1) * $bibliographicrecords->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bibliographicrecord = new Bibliographicrecord();
        return view('bibliographicrecord.create', compact('bibliographicrecord'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Bibliographicrecord::rules());

        $bibliographicrecord = Bibliographicrecord::create(Bibliographicrecord::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('bibliographicrecords.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bibliographicrecord = Bibliographicrecord::find($id);

        return view('bibliographicrecord.show', compact('bibliographicrecord'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bibliographicrecord = Bibliographicrecord::find($id);

        return view('bibliographicrecord.edit', compact('bibliographicrecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bibliographicrecord $bibliographicrecord
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Bibliographicrecord $bibliographicrecord)
    {

        request()->validate(Bibliographicrecord::rules());

        $bibliographicrecord->update(Bibliographicrecord::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('bibliographicrecords.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bibliographicrecord = Bibliographicrecord::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('bibliographicrecords.index', app()->getLocale());
    }
}
