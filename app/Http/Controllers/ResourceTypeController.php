<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use Illuminate\Http\Request;

/**
 * Class ResourceTypeController
 * @package App\Http\Controllers
 */
class ResourceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $resourceTypes = ResourceType::with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('resource-type.index', compact('resourceTypes'))
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
        return view('resource-type.create', compact('resourceType'));
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

        return redirect()->route('resource-types.index', app()->getLocale());
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

        return view('resource-type.show', compact('resourceType'));
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

        return view('resource-type.edit', compact('resourceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ResourceType $resourceType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ResourceType $resourceType)
    {

        request()->validate(ResourceType::rules());

        $resourceType->update(ResourceType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('resource-types.index', app()->getLocale());
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

        return redirect()->route('resource-types.index', app()->getLocale());
    }
}
