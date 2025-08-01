<?php

namespace App\Http\Controllers;

use App\Models\MagazineIssueTranslation;
use Illuminate\Http\Request;

/**
 * Class MagazineIssueTranslationController
 * @package App\Http\Controllers
 */
class MagazineIssueTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $magazineIssueTranslations = MagazineIssueTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('magazine-issue-translation.index', compact('magazineIssueTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $magazineIssueTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $magazineIssueTranslation = new MagazineIssueTranslation();
        return view('magazine-issue-translation.create', compact('magazineIssueTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(MagazineIssueTranslation::rules());

        $magazineIssueTranslation = MagazineIssueTranslation::create(MagazineIssueTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('magazine-issue-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $magazineIssueTranslation = MagazineIssueTranslation::find($id);

        return view('magazine-issue-translation.show', compact('magazineIssueTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $magazineIssueTranslation = MagazineIssueTranslation::find($id);

        return view('magazine-issue-translation.edit', compact('magazineIssueTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MagazineIssueTranslation $magazineIssueTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, MagazineIssueTranslation $magazineIssueTranslation)
    {

        request()->validate(MagazineIssueTranslation::rules());

        $magazineIssueTranslation->update(MagazineIssueTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('magazine-issue-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $magazineIssueTranslation = MagazineIssueTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('magazine-issue-translations.index', app()->getLocale());
    }
}
