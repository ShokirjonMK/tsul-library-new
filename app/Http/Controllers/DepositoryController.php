<?php

namespace App\Http\Controllers;

use App\Models\Depository;
use Illuminate\Http\Request;

/**
 * Class DepositoryController
 * @package App\Http\Controllers
 */
class DepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $depositories = Depository::with(['bookInformation', 'branch', 'department'])->orderBy('id', 'desc')->paginate($perPage);

        return view('depository.index', compact('depositories'))
            ->with('i', (request()->input('page', 1) - 1) * $depositories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depository = new Depository();
        return view('depository.create', compact('depository'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Depository::rules());

        $depository = Depository::create(Depository::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('depositories.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $depository = Depository::find($id);

        return view('depository.show', compact('depository'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $depository = Depository::find($id);

        return view('depository.edit', compact('depository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Depository $depository
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Depository $depository)
    {

        request()->validate(Depository::rules());

        $depository->update(Depository::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('depositories.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $depository = Depository::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('depositories.index', app()->getLocale());
    }
}
