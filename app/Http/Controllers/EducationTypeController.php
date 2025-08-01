<?php

namespace App\Http\Controllers;

use App\Models\EducationType;
use Illuminate\Http\Request;

/**
 * Class EducationTypeController
 * @package App\Http\Controllers
 */
class EducationTypeController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {

        $perPage = 20;
//        $educationTypes = EducationType::orderBy('id', 'desc')->paginate($perPage);
        $q = EducationType::query();

        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }

        $educationTypes = $q->with('translations')->orderBy('id', 'desc')->paginate($perPage);


        return view('education-type.index', compact('educationTypes', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $educationTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educationType = new EducationType();
        return view('education-type.create', compact('educationType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(EducationType::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]);

        $educationType = EducationType::create(EducationType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('education-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $educationType = EducationType::find($id);

        return view('education-type.show', compact('educationType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $educationType = EducationType::find($id);

        return view('education-type.edit', compact('educationType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param EducationType $educationType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($language, Request $request, EducationType $educationType)
    {
        request()->validate(EducationType::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]);


        $educationType->update(EducationType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('education-types.index', app()->getLocale());
    }

    public function destroy($language, $id)
    {
        $educationType = EducationType::find($id);
        $educationType->isActive = false;
        $educationType->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('education-types.index', app()->getLocale());
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($language, $id, Request $request)
    {
        $type = $request->input('type');
        $bookFileType = EducationType::find($id);
        if ($type == 'DELETE') {
            EducationType::find($id)->delete();
            toast(__('Deleted successfully.'), 'info');
            return back();
        } else {
            return view('education-types.index', compact('bookFileType'));
        }
    }

}
