<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use App\Models\ScientificPublication;
use Illuminate\Http\Request;

/**
 * Class ResDissertationsController
 * @package App\Http\Controllers
 */
class ResDissertationsController extends Controller
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
        $keyword=trim($request->get('keyword'));
        $q = ScientificPublication::query();
        if($keyword != null){ 
            $q->whereHas('translations', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('title', 'like', '%'.$keyword.'%')->orWhere('keywords', 'like', '%'.$keyword.'%');
                }
            }); 
        }
        $scientificPublications = $q->with('translations')->where('key', '=', 'dissertation')->orderBy('id', 'desc')->paginate($perPage);

        return view('res-dissertation.index', compact('scientificPublications', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $scientificPublications->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scientificPublication = new ScientificPublication();
        $resourceFields = ResourceType::with('translations')->orderBy('id', 'desc')->field()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceLanguages = ResourceType::with('translations')->orderBy('id', 'desc')->language()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceTypes = ResourceType::with('translations')->where('code', '=', 'dissertation')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        return view('res-dissertation.create', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ScientificPublication::rules(),
        [
            'title_uz.required' =>  __('The :attribute field is required.'),
            'published_year.required' =>  __('The :attribute field is required.'),
        ],
        [
            'published_year' => __('Published Year'),
            'title_uz' => __('Title UZ'),
        ]);
        $scientificPublication = new ScientificPublication();

        $scientificPublications = ScientificPublication::create(ScientificPublication::GetData($request, $scientificPublication));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('res-dissertations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id);

        return view('res-dissertation.show', compact('scientificPublication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id);
        $resourceFields = ResourceType::with('translations')->orderBy('id', 'desc')->field()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceLanguages = ResourceType::with('translations')->orderBy('id', 'desc')->language()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceTypes = ResourceType::with('translations')->where('code', '=', 'dissertation')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        return view('res-dissertation.edit', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScientificPublication $scientificPublication
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ScientificPublication $resDissertation)
    {

        request()->validate(ScientificPublication::rules());
        $resDissertation->update(ScientificPublication::GetData($request, $resDissertation));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('res-dissertations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $scientificPublication = ScientificPublication::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('res-dissertations.index', app()->getLocale());
    }
}
