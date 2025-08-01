<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Faculty;
use App\Models\Organization;
use App\Models\UserProfile;
use Illuminate\Http\Request;

/**
 * Class FacultyController
 * @package App\Http\Controllers
 */
class FacultyController extends Controller
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
        $q = Faculty::query();
        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->whereHas('translations', function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
        }
        if ($organization_id != null && $organization_id > 0) {
            $q->where('organization_id', '=', $organization_id);
        }
        if ($branch_id != null && $branch_id > 0) {
            $q->where('branch_id', '=', $branch_id);
        }
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $branchs = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $faculties = $q->with(['translations', 'organization', 'branch', 'organization.translations',  'branch.translations'])->withCount('profiles')->orderBy('id', 'desc')->paginate($perPage);
        $facultyIds = $faculties->pluck('id')->toArray();

        $totalUsers = UserProfile::whereNotNull('chair_id')
            ->whereHas('faculty', function ($query) use ($organization_id, $branch_id, $facultyIds, $keyword) {
                if (!empty($organization_id) && $organization_id > 0) {
                    $query->where('organization_id', '=', $organization_id);
                }
                if (!empty($branch_id) && $branch_id > 0) {
                    $query->where('branch_id', '=', $branch_id);
                }
                if (!empty($facultyIds) && count($facultyIds) > 0 && $keyword != null) {
                    $query->whereIn('id', $facultyIds); // Filter by chair IDs
                }
            })
            ->count();

        return view('faculty.index', compact('faculties', 'keyword', 'branchs', 'organizations', 'organization_id', 'branch_id', 'totalUsers'))
            ->with('i', (request()->input('page', 1) - 1) * $faculties->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = new Faculty();
        return view('faculty.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Faculty::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),
            'organization_id' => __('Organization'),
            'branch_id' => __('Branches'),
        ]);

        $faculty = Faculty::create(Faculty::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('faculties.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $faculty = Faculty::find($id);

        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $faculty = Faculty::find($id);

        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Faculty $faculty
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Faculty $faculty)
    {

        request()->validate(Faculty::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),
            'organization_id' => __('Organization'),
            'branch_id' => __('Branches'),
        ]);

        $faculty->update(Faculty::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('faculties.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $faculty = Faculty::find($id)->delete();
        $faculty = Faculty::find($id);
        $faculty->isActive=false;
        $faculty->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('faculties.index', app()->getLocale());
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
        $booksType= Faculty::find($id);
        if($type=='DELETE'){
            Faculty::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        }else{
            return view('book-types.show', compact('booksType'));
        }
    }
}
