<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use App\Models\ScientificPublication;
use Illuminate\Http\Request;

/**
 * Class JournalArticlesController
 * @package App\Http\Controllers
 */
class JournalArticlesController extends Controller
{
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
                    $query->where('title', 'like', "%$keyword%")
                    ->orWhere('keywords', 'LIKE', "%$keyword%")
                        ->orWhere('place_protection', 'LIKE', "%$keyword%")
                        ->orWhere('content', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%");
                }
            }); 
        }
        $scientificPublications = $q->with(['resTypeLang', 'resField', 'translations'])->where('key', '=', 'journal-article')->with('translations')->orderBy('id', 'desc')->paginate($perPage);

        return view('journal-articles.index', compact('scientificPublications', 'keyword'))
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
        $resourceTypes = ResourceType::with('translations')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        return view('journal-articles.create', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'publication_year' => 'required',
            'journal_id' => 'required',
            'magazine_issue_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
           

        request()->validate($rules,
        [
            'title_uz.required' =>  __('The :attribute field is required.'),
            'publication_year.required' =>  __('The :attribute field is required.'),
            'journal_id.required' =>  __('The :attribute field is required.'),
            'magazine_issue_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'publication_year' => __('Published Year'),
            'title_uz' => __('Title UZ'),
            'journal_id' => __('Journals'),
            'magazine_issue_id' => __('Magazine Issue'),
        ]);
        $scientificPublication = new ScientificPublication(); 
        $scientificPublications = ScientificPublication::create(ScientificPublication::GetData($request, $scientificPublication));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('journal-articles.index', app()->getLocale());
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

        return view('journal-articles.show', compact('scientificPublication'));
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
        $resourceTypes = ResourceType::with('translations')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('journal-articles.edit', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScientificPublication $journalArticles
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ScientificPublication $journalArticle)
    {

        $rules = [
            'publication_year' => 'required',
            'journal_id' => 'required',
            'magazine_issue_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }

        request()->validate($rules,
        [
            'title_uz.required' =>  __('The :attribute field is required.'),
            'publication_year.required' =>  __('The :attribute field is required.'),
            'journal_id.required' =>  __('The :attribute field is required.'),
            'magazine_issue_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'publication_year' => __('Published Year'),
            'title_uz' => __('Title UZ'),
            'journal_id' => __('Journals'),
            'magazine_issue_id' => __('Magazine Issue'),
        ]);
        $journalArticle->update(ScientificPublication::GetData($request, $journalArticle));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('journal-articles.index', app()->getLocale());
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

        return redirect()->route('journal-articles.index', app()->getLocale());
    }
}
