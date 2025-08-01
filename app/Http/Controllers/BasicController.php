<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Http\Request;

/**
 * Class BasicController
 * @package App\Http\Controllers
 */
class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $basics = Basic::with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('basic.index', compact('basics'))
            ->with('i', (request()->input('page', 1) - 1) * $basics->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $basic = new Basic();
        return view('basic.create', compact('basic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Basic::rules());

        $basic = Basic::create(Basic::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('basics.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $basic = Basic::find($id);

        return view('basic.show', compact('basic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $basic = Basic::find($id);

        return view('basic.edit', compact('basic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Basic $basic
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Basic $basic)
    {

        request()->validate(Basic::rules());

        $basic->update(Basic::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('basics.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // ->delete()
        $basic = Basic::find($id);
        $basic->isActive=false;
        $basic->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('basics.index', app()->getLocale());
    }
}
