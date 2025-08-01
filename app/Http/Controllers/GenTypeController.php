<?php

namespace App\Http\Controllers;

use App\Models\GenType;
use Illuminate\Http\Request;

/**
 * Class GenTypeController
 * @package App\Http\Controllers
 */
class GenTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $genTypes = GenType::with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('gen-type.index', compact('genTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $genTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genType = new GenType();
        return view('gen-type.create', compact('genType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(GenType::rules());

        $genType = GenType::create(GenType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('gen-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $genType = GenType::find($id);

        return view('gen-type.show', compact('genType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $genType = GenType::find($id);

        return view('gen-type.edit', compact('genType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  GenType $genType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, GenType $genType)
    {

        request()->validate(GenType::rules());

        $genType->update(GenType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('gen-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // ->delete()
        $genType = GenType::find($id);
        $genType->isActive=false;
        $genType->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('gen-types.index', app()->getLocale());
    }
}
