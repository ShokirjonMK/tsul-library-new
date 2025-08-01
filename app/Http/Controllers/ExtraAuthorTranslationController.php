<?php

namespace App\Http\Controllers;

use App\Models\ExtraAuthorTranslation;
use Illuminate\Http\Request;

/**
 * Class ExtraAuthorTranslationController
 * @package App\Http\Controllers
 */
class ExtraAuthorTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $extraAuthorTranslations = ExtraAuthorTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('extra-author-translation.index', compact('extraAuthorTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $extraAuthorTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extraAuthorTranslation = new ExtraAuthorTranslation();
        return view('extra-author-translation.create', compact('extraAuthorTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ExtraAuthorTranslation::rules());

        $extraAuthorTranslation = ExtraAuthorTranslation::create(ExtraAuthorTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('extra-author-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $extraAuthorTranslation = ExtraAuthorTranslation::find($id);

        return view('extra-author-translation.show', compact('extraAuthorTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $extraAuthorTranslation = ExtraAuthorTranslation::find($id);

        return view('extra-author-translation.edit', compact('extraAuthorTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ExtraAuthorTranslation $extraAuthorTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ExtraAuthorTranslation $extraAuthorTranslation)
    {

        request()->validate(ExtraAuthorTranslation::rules());

        $extraAuthorTranslation->update(ExtraAuthorTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('extra-author-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $extraAuthorTranslation = ExtraAuthorTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('extra-author-translations.index', app()->getLocale());
    }
}
