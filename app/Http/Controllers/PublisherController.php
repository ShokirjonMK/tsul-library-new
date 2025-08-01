<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

/**
 * Class PublisherController
 * @package App\Http\Controllers
 */
class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $publishers = Publisher::with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('publisher.index', compact('publishers'))
            ->with('i', (request()->input('page', 1) - 1) * $publishers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisher = new Publisher();
        return view('publisher.create', compact('publisher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Publisher::rules());
        
        $publisher = Publisher::create(Publisher::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('publishers.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $publisher = Publisher::find($id);

        return view('publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $publisher = Publisher::find($id);

        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Publisher $publisher
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Publisher $publisher)
    {

        request()->validate(Publisher::rules());

        $publisher->update(Publisher::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('publishers.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // ->delete()
        $publisher = Publisher::find($id);

        $publisher->isActive=false;
        $publisher->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('publishers.index', app()->getLocale());
    }
}
