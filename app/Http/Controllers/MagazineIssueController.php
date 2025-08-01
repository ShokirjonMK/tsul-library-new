<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\MagazineIssue;
use Illuminate\Http\Request;

/**
 * Class MagazineIssueController
 * @package App\Http\Controllers
 */
class MagazineIssueController extends Controller
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
        $keyword=trim($request->get('keyword'));

        $q = MagazineIssue::query();
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('published_year', 'like', "%$keyword%")
                        ->orWhere('fourth_number', 'LIKE', "%$keyword%")
                        ->orWhere('ISSN', 'LIKE', "%$keyword%")
                        ->orWhere('title', 'LIKE', "%$keyword%")
                        ->orWhere('body', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%");
                }
            }); 
        }
        
        $magazineIssues = $q->with('translations')->orderBy('id', 'desc')->paginate($perPage);


        return view('magazine-issue.index', compact('magazineIssues', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $magazineIssues->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $magazineIssue = new MagazineIssue();
        $journals = Journal::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('magazine-issue.create', compact('magazineIssue', 'journals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate(MagazineIssue::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'journal_id.required' =>  __('The :attribute field is required.'),
            'published_year.required' =>  __('The :attribute field is required.'),
            'fourth_number.required' =>  __('The :attribute field is required.'),
            'betlar_soni.required' =>  __('The :attribute field is required.'),
            'price.required' =>  __('The :attribute field is required.'),
        ],
        [
            'journal_id' => __('Journal'),
            'published_year' => __('Published Year'),
            'fourth_number' => __('Departments'),
            'betlar_soni' => __('Betlar soni'),
            'price' => __('Price'),
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),
        ]);
        $newMagazineIssue = new MagazineIssue();
         
        $magazineIssue = MagazineIssue::create(MagazineIssue::GetData($request, $newMagazineIssue));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('magazine-issues.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $magazineIssue = MagazineIssue::find($id);

        return view('magazine-issue.show', compact('magazineIssue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $magazineIssue = MagazineIssue::find($id);
        $journals = Journal::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('magazine-issue.edit', compact('magazineIssue','journals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MagazineIssue $magazineIssue
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, MagazineIssue $magazineIssue)
    {

        request()->validate(MagazineIssue::rules(),
        [
            'journal_id.required' =>  __('The :attribute field is required.'),
            'published_year.required' =>  __('The :attribute field is required.'),
            'fourth_number.required' =>  __('The :attribute field is required.'),
            'betlar_soni.required' =>  __('The :attribute field is required.'),
            'price.required' =>  __('The :attribute field is required.'),
        ],
        [
            'journal_id' => __('Journal'),
            'published_year' => __('Published Year'),
            'fourth_number' => __('Departments'),
            'betlar_soni' => __('Betlar soni'),
            'price' => __('Price'),
        ]);

        $magazineIssue->update(MagazineIssue::GetData($request, $magazineIssue));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('magazine-issues.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $magazineIssue = MagazineIssue::find($id)->delete();
        $magazineIssue = MagazineIssue::find($id);
        $magazineIssue->isActive=false;
        $magazineIssue->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('magazine-issues.index', app()->getLocale());
    }
}
