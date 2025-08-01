<?php

namespace App\Http\Controllers;

use App\Models\ScientificPublication;
use Illuminate\Http\Request;

/**
 * Class ScientificPublicationController
 * @package App\Http\Controllers
 */
class ScientificPublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $scientificPublications = ScientificPublication::orderBy('id', 'desc')->paginate($perPage);

        return view('scientific-publication.index', compact('scientificPublications'))
            ->with('i', (request()->input('page', 1) - 1) * $scientificPublications->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scientificPublication = new ScientificPublication();
        return view('scientific-publication.create', compact('scientificPublication'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ScientificPublication::rules());

        $scientificPublication = ScientificPublication::create(ScientificPublication::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('scientific-publications.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id);

        return view('scientific-publication.show', compact('scientificPublication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id);

        return view('scientific-publication.edit', compact('scientificPublication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScientificPublication $scientificPublication
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ScientificPublication $scientificPublication)
    {

        request()->validate(ScientificPublication::rules());

        $scientificPublication->update(ScientificPublication::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('scientific-publications.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('scientific-publications.index', app()->getLocale());
    }
}
