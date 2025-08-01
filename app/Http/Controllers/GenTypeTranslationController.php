<?php

namespace App\Http\Controllers;

use App\Models\GenTypeTranslation;
use Illuminate\Http\Request;

/**
 * Class GenTypeTranslationController
 * @package App\Http\Controllers
 */
class GenTypeTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $genTypeTranslations = GenTypeTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('gen-type-translation.index', compact('genTypeTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $genTypeTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genTypeTranslation = new GenTypeTranslation();
        return view('gen-type-translation.create', compact('genTypeTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(GenTypeTranslation::rules());

        $genTypeTranslation = GenTypeTranslation::create(GenTypeTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('gen-type-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $genTypeTranslation = GenTypeTranslation::find($id);

        return view('gen-type-translation.show', compact('genTypeTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $genTypeTranslation = GenTypeTranslation::find($id);

        return view('gen-type-translation.edit', compact('genTypeTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  GenTypeTranslation $genTypeTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, GenTypeTranslation $genTypeTranslation)
    {

        request()->validate(GenTypeTranslation::rules());

        $genTypeTranslation->update(GenTypeTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('gen-type-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $genTypeTranslation = GenTypeTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('gen-type-translations.index', app()->getLocale());
    }
}
