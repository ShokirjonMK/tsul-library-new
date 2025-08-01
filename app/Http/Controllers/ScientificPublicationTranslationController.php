<?php

namespace App\Http\Controllers;

use App\Models\ScientificPublicationTranslation;
use Illuminate\Http\Request;

/**
 * Class ScientificPublicationTranslationController
 * @package App\Http\Controllers
 */
class ScientificPublicationTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $scientificPublicationTranslations = ScientificPublicationTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('scientific-publication-translation.index', compact('scientificPublicationTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $scientificPublicationTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scientificPublicationTranslation = new ScientificPublicationTranslation();
        return view('scientific-publication-translation.create', compact('scientificPublicationTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ScientificPublicationTranslation::rules());

        $scientificPublicationTranslation = ScientificPublicationTranslation::create(ScientificPublicationTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('scientific-publication-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $scientificPublicationTranslation = ScientificPublicationTranslation::find($id);

        return view('scientific-publication-translation.show', compact('scientificPublicationTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $scientificPublicationTranslation = ScientificPublicationTranslation::find($id);

        return view('scientific-publication-translation.edit', compact('scientificPublicationTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScientificPublicationTranslation $scientificPublicationTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ScientificPublicationTranslation $scientificPublicationTranslation)
    {

        request()->validate(ScientificPublicationTranslation::rules());

        $scientificPublicationTranslation->update(ScientificPublicationTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('scientific-publication-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $scientificPublicationTranslation = ScientificPublicationTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('scientific-publication-translations.index', app()->getLocale());
    }
}
