<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Faculty;
use App\Models\Organization;
use App\Models\UserProfile;
use Illuminate\Http\Request;

/**
 * Class ChairController
 * @package App\Http\Controllers
 */
class ChairController extends Controller
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
    public function index($language, Request $request)
    {
        $perPage = 20;
        $q = Chair::query();
        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $faculty_id = trim($request->get('faculty_id'));

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

        if ($faculty_id != null && $faculty_id > 0) {
            $q->where('faculty_id', '=', $faculty_id);
        }
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $branchs = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $faculties = Faculty::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $chairs = $q->with(['translations', 'organization', 'branch', 'faculty', 'organization.translations', 'branch.translations', 'faculty.translations'])->withCount('profiles')->orderBy('id', 'desc')->paginate($perPage);
        $chairIds = $chairs->pluck('id')->toArray();

        $totalUsers = UserProfile::whereNotNull('chair_id')
            ->whereHas('chair', function ($query) use ($organization_id, $branch_id, $faculty_id, $chairIds, $keyword) {
                if (!empty($organization_id) && $organization_id > 0) {
                    $query->where('organization_id', '=', $organization_id);
                }
                if (!empty($branch_id) && $branch_id > 0) {
                    $query->where('branch_id', '=', $branch_id);
                }
                if (!empty($faculty_id) && $faculty_id > 0) {
                    $query->where('faculty_id', '=', $faculty_id);
                }
                if (!empty($chairIds) && count($chairIds) > 0 && $keyword != null) {
                    $query->whereIn('id', $chairIds); // Filter by chair IDs
                }
            })
            ->count();
        return view('chair.index', compact('chairs', 'keyword', 'branchs', 'organizations', 'faculties', 'organization_id', 'branch_id', 'faculty_id', 'totalUsers'))
            ->with('i', (request()->input('page', 1) - 1) * $chairs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chair = new Chair();
        return view('chair.create', compact('chair'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Chair::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
                'organization_id.required' => __('The :attribute field is required.'),
                'branch_id.required' => __('The :attribute field is required.'),
                'faculty_id.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'faculty_id' => __('Faculties'),
            ]);

        $chair = Chair::create(Chair::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('chairs.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $chair = Chair::find($id);

        return view('chair.show', compact('chair'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $chair = Chair::find($id);

        return view('chair.edit', compact('chair'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Chair $chair
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Chair $chair)
    {

        request()->validate(Chair::rules(),
            [
                'title_en.required' => __('The :attribute field is required.'),
                'title_uz.required' => __('The :attribute field is required.'),
                'organization_id.required' => __('The :attribute field is required.'),
                'branch_id.required' => __('The :attribute field is required.'),
                'faculty_id.required' => __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'faculty_id' => __('Faculties'),
            ]);

        $chair->update(Chair::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('chairs.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $chair = Chair::find($id)->delete();
        $chair = Chair::find($id);
        $chair->isActive = false;
        $chair->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('chairs.index', app()->getLocale());
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
        $booksType = Chair::find($id);
        if ($type == 'DELETE') {
            Chair::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        } else {
            return view('book-types.show', compact('booksType'));
        }
    }
}
