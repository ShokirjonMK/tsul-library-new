<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * Class BranchController
 * @package App\Http\Controllers
 */
class BranchController extends Controller
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

        $q = Branch::query();
        $keyword=trim($request->get('keyword'));
        $status=trim($request->get('status'));

        $organization_id=trim($request->get('organization_id'));
        if ($organization_id != null && $organization_id>0)
        {
            $show_accardion=true;
            $q->where('organization_id', '=', $organization_id);
        }
        if($keyword != null){ 
            // $q->whereTranslationLike('title', 'LIKE', "%$keyword%");
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        
        if ($status != null)
        {
            $q->where('isActive', '=', $status);
        }else{
            $status=1;
        }

        $perPage = 20;
        $branches = $q->with(['translations', 'organization', 'organization.translations', 'book', 'bookInventar'])->withCount('book')->withCount('bookInventar')->orderBy('id', 'desc')->paginate($perPage);
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('branch.index', compact('branches', 'organizations', 'organization_id', 'status', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $branches->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = new Branch();
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('branch.create', compact('branch', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Branch::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'organization_id' => __('Organization'), 
        ]);

        $branch = Branch::create(Branch::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('branches.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $branch = Branch::find($id);

        return view('branch.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $branch = Branch::find($id);
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('branch.edit', compact('branch', 'organizations'));
    }
    public function findCityWithStateID($language, $id)
    {
         
        // $branches = Branch::where('organization_id', $id)->get();
        $branches = Branch::where('organization_id', $id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return response()->json($branches);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Branch $branch)
    {

        request()->validate(Branch::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $branch->update(Branch::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('branches.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $branch = Branch::find($id)->delete();
        $branch = Branch::find($id);
        $branch->isActive=false;
        $branch->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('branches.index', app()->getLocale());
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
        $booksType= Branch::find($id);
        if($type=='DELETE'){
            Branch::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('book-types.show', compact('booksType'));
        }
    }
}
