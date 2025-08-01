<?php

namespace App\Http\Controllers;

use App\Models\SubjectGroupTranslation;
use Illuminate\Http\Request;

/**
 * Class SubjectGroupTranslationController
 * @package App\Http\Controllers
 */
class SubjectGroupTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $subjectGroupTranslations = SubjectGroupTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('subject-group-translation.index', compact('subjectGroupTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $subjectGroupTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectGroupTranslation = new SubjectGroupTranslation();
        return view('subject-group-translation.create', compact('subjectGroupTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubjectGroupTranslation::rules());

        $subjectGroupTranslation = SubjectGroupTranslation::create(SubjectGroupTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('subject-group-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $subjectGroupTranslation = SubjectGroupTranslation::find($id);

        return view('subject-group-translation.show', compact('subjectGroupTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $subjectGroupTranslation = SubjectGroupTranslation::find($id);

        return view('subject-group-translation.edit', compact('subjectGroupTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubjectGroupTranslation $subjectGroupTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, SubjectGroupTranslation $subjectGroupTranslation)
    {

        request()->validate(SubjectGroupTranslation::rules());

        $subjectGroupTranslation->update(SubjectGroupTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('subject-group-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $subjectGroupTranslation = SubjectGroupTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('subject-group-translations.index', app()->getLocale());
    }
}
