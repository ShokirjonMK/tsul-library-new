<?php

namespace App\Http\Controllers;

use App\Models\PublisherTranslation;
use Illuminate\Http\Request;

/**
 * Class PublisherTranslationController
 * @package App\Http\Controllers
 */
class PublisherTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $publisherTranslations = PublisherTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('publisher-translation.index', compact('publisherTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $publisherTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisherTranslation = new PublisherTranslation();
        return view('publisher-translation.create', compact('publisherTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PublisherTranslation::rules());

        $publisherTranslation = PublisherTranslation::create(PublisherTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('publisher-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $publisherTranslation = PublisherTranslation::find($id);

        return view('publisher-translation.show', compact('publisherTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $publisherTranslation = PublisherTranslation::find($id);

        return view('publisher-translation.edit', compact('publisherTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PublisherTranslation $publisherTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, PublisherTranslation $publisherTranslation)
    {

        request()->validate(PublisherTranslation::rules());

        $publisherTranslation->update(PublisherTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('publisher-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $publisherTranslation = PublisherTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('publisher-translations.index', app()->getLocale());
    }
}
