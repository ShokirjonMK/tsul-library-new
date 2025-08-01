<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Organization;
use App\Models\UserProfile;
use Illuminate\Http\Request;

/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class GroupController extends Controller
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
        $q = Group::query();

        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $faculty_id = trim($request->get('faculty_id'));
        $chair_id = trim($request->get('chair_id'));
        $keyword = trim($request->get('keyword'));
        if ($keyword != null) {
            $q->where('title', 'like', '%' . $keyword . '%');
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
        if ($chair_id != null && $chair_id > 0) {
            $q->where('chair_id', '=', $chair_id);
        }
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $branchs = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $faculties = Faculty::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $chairs = Chair::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $groups = $q->with(['organization', 'branch', 'faculty', 'chair', 'organization.translations',  'branch.translations', 'faculty.translations', 'chair.translations'])->withCount('profiles')->orderBy('id', 'desc')->paginate($perPage);
        $groupIds = $groups->pluck('id')->toArray();

        $totalUsers = UserProfile::whereNotNull('group_id')
            ->whereHas('group', function ($query) use ($organization_id, $branch_id, $faculty_id, $chair_id, $groupIds, $keyword) {
                if (!empty($organization_id) && $organization_id > 0) {
                    $query->where('organization_id', '=', $organization_id);
                }
                if (!empty($branch_id) && $branch_id > 0) {
                    $query->where('branch_id', '=', $branch_id);
                }
                if (!empty($faculty_id) && $faculty_id > 0) {
                    $query->where('faculty_id', '=', $faculty_id);
                }
                if (!empty($chair_id) && $chair_id > 0) {
                    $query->where('chair_id', '=', $chair_id);
                }
                if (!empty($groupIds) && count($groupIds) > 0 && $keyword != null) {
                    $query->whereIn('id', $groupIds); // Filter by chair IDs
                }
            })
            ->count();
        return view('group.index', compact('groups', 'keyword', 'branchs', 'organizations', 'organization_id', 'branch_id', 'faculties', 'faculty_id', 'chairs', 'chair_id', 'totalUsers'))
            ->with('i', (request()->input('page', 1) - 1) * $groups->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group();
        return view('group.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Group::rules());

        $group = Group::create(Group::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('groups.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $group = Group::find($id);

        return view('group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $group = Group::find($id);

        return view('group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Group $group)
    {

        request()->validate(Group::rules());

        $group->update(Group::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('groups.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $group = Group::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('groups.index', app()->getLocale());
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
        $booksType= Group::find($id);
        if($type=='DELETE'){
            Group::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        }else{
            return view('book-types.show', compact('booksType'));
        }
    }
}
