<?php

namespace App\Http\Controllers;

use App\Exports\ExportSubjects;
use App\Models\EducationType;
use App\Models\Subject;
use App\Models\SubjectGroup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class SubjectController
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
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
        $q = Subject::query();

        $keyword=trim($request->get('keyword'));
        $subject_group_id = trim($request->get('subject_group_id'));
        $education_type_id = trim($request->get('education_type_id'));

        if($keyword != null){
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            });
        }
        if ($subject_group_id != null && $subject_group_id > 0) {
            $q->where('subject_group_id', '=', $subject_group_id);
        }

        if ($education_type_id != null && $education_type_id > 0) {
            $q->where('education_type_id', '=', $education_type_id);
        }

        $subjectGroups = SubjectGroup::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $educationTypes = EducationType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');


        $subjects = $q->with('translations', 'subjectGroup', 'subjectGroup.translations', 'educationType', 'educationType.translations')->withCount('books')->orderBy('id', 'desc')->paginate($perPage);

        return view('subject.index', compact('subjects', 'keyword', 'subjectGroups', 'educationTypes', 'subject_group_id', 'education_type_id'))
            ->with('i', (request()->input('page', 1) - 1) * $subjects->perPage());
    }

    public function export($language, Request $request){
        $file_name = 'subjects_'.date('Y_m_d_H_i_s').'.xlsx';
        $keyword=trim($request->get('keyword'));

        return Excel::download(new ExportSubjects($keyword), $file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        return view('subject.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate(Subject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),
        ]);

        $subject = Subject::create(Subject::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('subjects.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $subject = Subject::withCount('books')->find($id);

        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $subject = Subject::find($id);

        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Subject $subject)
    {

        request()->validate(Subject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),
        ]);

        $subject->update(Subject::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('subjects.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $subject = Subject::find($id)->delete();

        $subject = Subject::find($id);
        $subject->isActive=false;
        $subject->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('subjects.index', app()->getLocale());
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type=$request->input('type');

        // BooksType::find($id)->delete();
        $bookFileType= Subject::find($id);
        if($type=='DELETE'){
            Subject::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        }else{
            return view('subjects.index', compact('bookFileType'));
        }
    }

}
