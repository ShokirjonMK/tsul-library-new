<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

/**
 * Class ResourceController
 * @package App\Http\Controllers
 */
class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $resources = Resource::orderBy('id', 'desc')->paginate($perPage);

        return view('resource.index', compact('resources'))
            ->with('i', (request()->input('page', 1) - 1) * $resources->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = new Resource();
        return view('resource.create', compact('resource'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Resource::rules());

        $resource = Resource::create(Resource::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('resources.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $resource = Resource::find($id);

        return view('resource.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $resource = Resource::find($id);

        return view('resource.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Resource $resource)
    {

        request()->validate(Resource::rules());

        $resource->update(Resource::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('resources.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $resource = Resource::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('resources.index', app()->getLocale());
    }
}
