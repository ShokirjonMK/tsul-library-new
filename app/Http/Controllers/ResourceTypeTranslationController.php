<?php

namespace App\Http\Controllers;

use App\Models\ResourceTypeTranslation;
use Illuminate\Http\Request;

/**
 * Class ResourceTypeTranslationController
 * @package App\Http\Controllers
 */
class ResourceTypeTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $resourceTypeTranslations = ResourceTypeTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('resource-type-translation.index', compact('resourceTypeTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $resourceTypeTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resourceTypeTranslation = new ResourceTypeTranslation();
        return view('resource-type-translation.create', compact('resourceTypeTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ResourceTypeTranslation::rules());

        $resourceTypeTranslation = ResourceTypeTranslation::create(ResourceTypeTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('resource-type-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $resourceTypeTranslation = ResourceTypeTranslation::find($id);

        return view('resource-type-translation.show', compact('resourceTypeTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $resourceTypeTranslation = ResourceTypeTranslation::find($id);

        return view('resource-type-translation.edit', compact('resourceTypeTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ResourceTypeTranslation $resourceTypeTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ResourceTypeTranslation $resourceTypeTranslation)
    {

        request()->validate(ResourceTypeTranslation::rules());

        $resourceTypeTranslation->update(ResourceTypeTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('resource-type-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $resourceTypeTranslation = ResourceTypeTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('resource-type-translations.index', app()->getLocale());
    }
}
