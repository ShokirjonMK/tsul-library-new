<?php

namespace App\Http\Controllers;

use App\Models\BasicTranslation;
use Illuminate\Http\Request;

/**
 * Class BasicTranslationController
 * @package App\Http\Controllers
 */
class BasicTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $basicTranslations = BasicTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('basic-translation.index', compact('basicTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $basicTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $basicTranslation = new BasicTranslation();
        return view('basic-translation.create', compact('basicTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BasicTranslation::rules());

        $basicTranslation = BasicTranslation::create(BasicTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('basic-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $basicTranslation = BasicTranslation::find($id);

        return view('basic-translation.show', compact('basicTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $basicTranslation = BasicTranslation::find($id);

        return view('basic-translation.edit', compact('basicTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BasicTranslation $basicTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BasicTranslation $basicTranslation)
    {

        request()->validate(BasicTranslation::rules());

        $basicTranslation->update(BasicTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('basic-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $basicTranslation = BasicTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('basic-translations.index', app()->getLocale());
    }
}
