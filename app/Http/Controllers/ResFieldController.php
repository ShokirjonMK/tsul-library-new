<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use Illuminate\Http\Request;

/**
 * Class ResLangController
 * @package App\Http\Controllers
 */
class ResFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $resourceTypes = ResourceType::with('translations')->orderBy('id', 'desc')->field()->paginate($perPage);

        return view('res-field.index', compact('resourceTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $resourceTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resourceType = new ResourceType();
        return view('res-field.create', compact('resourceType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ResourceType::rules());
        
        $resourceType = ResourceType::create(ResourceType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('res-field.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $resourceType = ResourceType::find($id);

        return view('res-field.show', compact('resourceType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $resourceType = ResourceType::find($id);

        return view('res-field.edit', compact('resourceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ResourceType $resourceType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ResourceType $resField)
    {

        request()->validate(ResourceType::rules());
        
        $resField->update(ResourceType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('res-field.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $resourceType = ResourceType::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('res-field.index', app()->getLocale());
    }
}
