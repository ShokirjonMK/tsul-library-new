<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

/**
 * Class SocialController
 * @package App\Http\Controllers
 */
class SocialController extends Controller
{
            /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $socials = Social::orderBy('id', 'desc')->paginate($perPage);

        return view('social.index', compact('socials'))
            ->with('i', (request()->input('page', 1) - 1) * $socials->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $social = new Social();
        return view('social.create', compact('social'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Social::rules());

        $social = Social::create(Social::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('socials.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $social = Social::find($id);

        return view('social.show', compact('social'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $social = Social::find($id);

        return view('social.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Social $social
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Social $social)
    {

        request()->validate(Social::rules());

        $social->update(Social::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('socials.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $social = Social::find($id)->delete();
        $social = Social::find($id);
        $social->isActive=false;
        $social->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('socials.index', app()->getLocale());
    }
}
