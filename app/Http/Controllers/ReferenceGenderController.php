<?php

namespace App\Http\Controllers;

use App\Models\ReferenceGender;
use Illuminate\Http\Request;

/**
 * Class ReferenceGenderController
 * @package App\Http\Controllers
 */
class ReferenceGenderController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $referenceGenders = ReferenceGender::with('translations')->withCount('users')->orderBy('id', 'desc')->paginate($perPage);
 
        return view('reference-gender.index', compact('referenceGenders'))
            ->with('i', (request()->input('page', 1) - 1) * $referenceGenders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $referenceGender = new ReferenceGender();
        return view('reference-gender.create', compact('referenceGender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ReferenceGender::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $referenceGender = ReferenceGender::create(ReferenceGender::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('reference-genders.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $referenceGender = ReferenceGender::find($id);

        return view('reference-gender.show', compact('referenceGender'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $referenceGender = ReferenceGender::find($id);

        return view('reference-gender.edit', compact('referenceGender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ReferenceGender $referenceGender
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ReferenceGender $referenceGender)
    {

        request()->validate(ReferenceGender::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $referenceGender->update(ReferenceGender::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('reference-genders.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $referenceGender = ReferenceGender::find($id)->delete();
        $referenceGender = ReferenceGender::find($id);
        $referenceGender->isActive=false;
        $referenceGender->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('reference-genders.index', app()->getLocale());
    }
}
