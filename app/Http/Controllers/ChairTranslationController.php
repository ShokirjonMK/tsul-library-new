<?php

namespace App\Http\Controllers;

use App\Models\ChairTranslation;
use Illuminate\Http\Request;

/**
 * Class ChairTranslationController
 * @package App\Http\Controllers
 */
class ChairTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $chairTranslations = ChairTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('chair-translation.index', compact('chairTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $chairTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chairTranslation = new ChairTranslation();
        return view('chair-translation.create', compact('chairTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ChairTranslation::rules());

        $chairTranslation = ChairTranslation::create(ChairTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('chair-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $chairTranslation = ChairTranslation::find($id);

        return view('chair-translation.show', compact('chairTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $chairTranslation = ChairTranslation::find($id);

        return view('chair-translation.edit', compact('chairTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ChairTranslation $chairTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ChairTranslation $chairTranslation)
    {

        request()->validate(ChairTranslation::rules());

        $chairTranslation->update(ChairTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('chair-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $chairTranslation = ChairTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('chair-translations.index', app()->getLocale());
    }
}
