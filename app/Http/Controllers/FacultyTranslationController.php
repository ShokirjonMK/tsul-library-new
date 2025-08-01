<?php

namespace App\Http\Controllers;

use App\Models\FacultyTranslation;
use Illuminate\Http\Request;

/**
 * Class FacultyTranslationController
 * @package App\Http\Controllers
 */
class FacultyTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $facultyTranslations = FacultyTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('faculty-translation.index', compact('facultyTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $facultyTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultyTranslation = new FacultyTranslation();
        return view('faculty-translation.create', compact('facultyTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FacultyTranslation::rules());

        $facultyTranslation = FacultyTranslation::create(FacultyTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('faculty-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $facultyTranslation = FacultyTranslation::find($id);

        return view('faculty-translation.show', compact('facultyTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $facultyTranslation = FacultyTranslation::find($id);

        return view('faculty-translation.edit', compact('facultyTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FacultyTranslation $facultyTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, FacultyTranslation $facultyTranslation)
    {

        request()->validate(FacultyTranslation::rules());

        $facultyTranslation->update(FacultyTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('faculty-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $facultyTranslation = FacultyTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('faculty-translations.index', app()->getLocale());
    }
}
