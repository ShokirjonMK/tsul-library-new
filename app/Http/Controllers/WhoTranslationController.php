<?php

namespace App\Http\Controllers;

use App\Models\WhoTranslation;
use Illuminate\Http\Request;

/**
 * Class WhoTranslationController
 * @package App\Http\Controllers
 */
class WhoTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $whoTranslations = WhoTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('who-translation.index', compact('whoTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $whoTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $whoTranslation = new WhoTranslation();
        return view('who-translation.create', compact('whoTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(WhoTranslation::rules());

        $whoTranslation = WhoTranslation::create(WhoTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('who-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $whoTranslation = WhoTranslation::find($id);

        return view('who-translation.show', compact('whoTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $whoTranslation = WhoTranslation::find($id);

        return view('who-translation.edit', compact('whoTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  WhoTranslation $whoTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, WhoTranslation $whoTranslation)
    {

        request()->validate(WhoTranslation::rules());

        $whoTranslation->update(WhoTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('who-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $whoTranslation = WhoTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('who-translations.index', app()->getLocale());
    }
}
