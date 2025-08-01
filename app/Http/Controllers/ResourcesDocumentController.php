<?php

namespace App\Http\Controllers;

use App\Models\ResourcesDocument;
use Illuminate\Http\Request;

/**
 * Class ResourcesDocumentController
 * @package App\Http\Controllers
 */
class ResourcesDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $resourcesDocuments = ResourcesDocument::orderBy('id', 'desc')->paginate($perPage);

        return view('resources-document.index', compact('resourcesDocuments'))
            ->with('i', (request()->input('page', 1) - 1) * $resourcesDocuments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resourcesDocument = new ResourcesDocument();
        return view('resources-document.create', compact('resourcesDocument'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ResourcesDocument::rules());

        $resourcesDocument = ResourcesDocument::create(ResourcesDocument::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('resources-documents.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $resourcesDocument = ResourcesDocument::find($id);

        return view('resources-document.show', compact('resourcesDocument'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $resourcesDocument = ResourcesDocument::find($id);

        return view('resources-document.edit', compact('resourcesDocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ResourcesDocument $resourcesDocument
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ResourcesDocument $resourcesDocument)
    {

        request()->validate(ResourcesDocument::rules());

        $resourcesDocument->update(ResourcesDocument::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('resources-documents.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $resourcesDocument = ResourcesDocument::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('resources-documents.index', app()->getLocale());
    }
}
