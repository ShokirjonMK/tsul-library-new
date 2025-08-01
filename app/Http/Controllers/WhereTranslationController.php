<?php

namespace App\Http\Controllers;

use App\Models\WhereTranslation;
use Illuminate\Http\Request;

/**
 * Class WhereTranslationController
 * @package App\Http\Controllers
 */
class WhereTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $whereTranslations = WhereTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('where-translation.index', compact('whereTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $whereTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $whereTranslation = new WhereTranslation();
        return view('where-translation.create', compact('whereTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(WhereTranslation::rules());

        $whereTranslation = WhereTranslation::create(WhereTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('where-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $whereTranslation = WhereTranslation::find($id);

        return view('where-translation.show', compact('whereTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $whereTranslation = WhereTranslation::find($id);

        return view('where-translation.edit', compact('whereTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  WhereTranslation $whereTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, WhereTranslation $whereTranslation)
    {

        request()->validate(WhereTranslation::rules());

        $whereTranslation->update(WhereTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('where-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $whereTranslation = WhereTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('where-translations.index', app()->getLocale());
    }
}
