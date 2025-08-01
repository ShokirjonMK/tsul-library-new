<?php

namespace App\Http\Controllers;

use App\Models\EducationTypeTranslation;
use Illuminate\Http\Request;

/**
 * Class EducationTypeTranslationController
 * @package App\Http\Controllers
 */
class EducationTypeTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $educationTypeTranslations = EducationTypeTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('education-type-translation.index', compact('educationTypeTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $educationTypeTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educationTypeTranslation = new EducationTypeTranslation();
        return view('education-type-translation.create', compact('educationTypeTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(EducationTypeTranslation::rules());

        $educationTypeTranslation = EducationTypeTranslation::create(EducationTypeTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('education-type-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $educationTypeTranslation = EducationTypeTranslation::find($id);

        return view('education-type-translation.show', compact('educationTypeTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $educationTypeTranslation = EducationTypeTranslation::find($id);

        return view('education-type-translation.edit', compact('educationTypeTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EducationTypeTranslation $educationTypeTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, EducationTypeTranslation $educationTypeTranslation)
    {

        request()->validate(EducationTypeTranslation::rules());

        $educationTypeTranslation->update(EducationTypeTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('education-type-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $educationTypeTranslation = EducationTypeTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('education-type-translations.index', app()->getLocale());
    }
}
