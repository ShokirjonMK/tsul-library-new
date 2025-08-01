<?php

namespace App\Http\Controllers;

use App\Models\SubjectTranslation;
use Illuminate\Http\Request;

/**
 * Class SubjectTranslationController
 * @package App\Http\Controllers
 */
class SubjectTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $subjectTranslations = SubjectTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('subject-translation.index', compact('subjectTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $subjectTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectTranslation = new SubjectTranslation();
        return view('subject-translation.create', compact('subjectTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubjectTranslation::rules());

        $subjectTranslation = SubjectTranslation::create(SubjectTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('subject-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $subjectTranslation = SubjectTranslation::find($id);

        return view('subject-translation.show', compact('subjectTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $subjectTranslation = SubjectTranslation::find($id);

        return view('subject-translation.edit', compact('subjectTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubjectTranslation $subjectTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, SubjectTranslation $subjectTranslation)
    {

        request()->validate(SubjectTranslation::rules());

        $subjectTranslation->update(SubjectTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('subject-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $subjectTranslation = SubjectTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('subject-translations.index', app()->getLocale());
    }
}
