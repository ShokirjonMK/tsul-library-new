<?php

namespace App\Http\Controllers;

use App\Models\OrganizationTranslation;
use Illuminate\Http\Request;

/**
 * Class OrganizationTranslationController
 * @package App\Http\Controllers
 */
class OrganizationTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $organizationTranslations = OrganizationTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('organization-translation.index', compact('organizationTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $organizationTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizationTranslation = new OrganizationTranslation();
        return view('organization-translation.create', compact('organizationTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(OrganizationTranslation::rules());

        $organizationTranslation = OrganizationTranslation::create(OrganizationTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('organization-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $organizationTranslation = OrganizationTranslation::find($id);

        return view('organization-translation.show', compact('organizationTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $organizationTranslation = OrganizationTranslation::find($id);

        return view('organization-translation.edit', compact('organizationTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrganizationTranslation $organizationTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, OrganizationTranslation $organizationTranslation)
    {

        request()->validate(OrganizationTranslation::rules());

        $organizationTranslation->update(OrganizationTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('organization-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $organizationTranslation = OrganizationTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('organization-translations.index', app()->getLocale());
    }
}
