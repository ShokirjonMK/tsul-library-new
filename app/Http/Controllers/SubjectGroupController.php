<?php

namespace App\Http\Controllers;

use App\Models\SubjectGroup;
use Illuminate\Http\Request;

/**
 * Class SubjectGroupController
 * @package App\Http\Controllers
 */
class SubjectGroupController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $perPage = 20;
        $q = SubjectGroup::query();

        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }

        $subjectGroups = $q->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('subject-group.index', compact('subjectGroups', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $subjectGroups->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectGroup = new SubjectGroup();
        return view('subject-group.create', compact('subjectGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubjectGroup::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]);

//        request()->validate(SubjectGroup::rules());

        $subjectGroup = SubjectGroup::create(SubjectGroup::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('subject-groups.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $subjectGroup = SubjectGroup::find($id);

        return view('subject-group.show', compact('subjectGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $subjectGroup = SubjectGroup::find($id);

        return view('subject-group.edit', compact('subjectGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SubjectGroup $subjectGroup
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, SubjectGroup $subjectGroup)
    {
        request()->validate(SubjectGroup::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]);


        $subjectGroup->update(SubjectGroup::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('subject-groups.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
//        $subjectGroup = SubjectGroup::find($id)->delete();
        $subjectGroup = SubjectGroup::find($id);
        $subjectGroup->isActive = false;
        $subjectGroup->save();
        toast(__('Deleted successfully.'), 'info');
        return redirect()->route('subject-groups.index', app()->getLocale());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type = $request->input('type');

        // BooksType::find($id)->delete();
        $bookFileType = SubjectGroup::find($id);
        if ($type == 'DELETE') {
            SubjectGroup::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        } else {
            return view('subject-groups.index', compact('bookFileType'));
        }
    }
}
