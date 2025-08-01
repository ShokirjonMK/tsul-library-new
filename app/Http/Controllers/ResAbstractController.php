<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use App\Models\ScientificPublication;
use Illuminate\Http\Request;

class ResAbstractController extends Controller
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
        $res_lang_id = trim($request->get('res_lang_id'));
        $res_type_id = trim($request->get('res_type_id'));
        $res_field_id = trim($request->get('res_field_id'));

        $q = ScientificPublication::query();


        $resourceFields = ResourceType::with('translations')->orderBy('id', 'desc')->field()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceLanguages = ResourceType::with('translations')->orderBy('id', 'desc')->language()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resourceTypes = ResourceType::with('translations')->where('code', '=', 'abstract')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $q->when($res_lang_id > 0, function ($query) use ($res_lang_id) {
            $query->where('res_lang_id', $res_lang_id);
        })
            ->when($res_type_id > 0, function ($query) use ($res_type_id) {
                $query->where('res_type_id', $res_type_id);
            })
            ->when($res_field_id > 0, function ($query) use ($res_field_id) {
                $query->where('res_field_id', $res_field_id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('scientificPublicationTranslations', function ($subQuery) use ($keyword) {
                    $subQuery->where(function ($q) use ($keyword) {
                        $q->where('title', 'like', '%' . $keyword . '%')
                            ->orWhere('authors', 'like', '%' . $keyword . '%')
                            ->orWhere('publication_year', '=', $keyword )
                            ->orWhere('barcode', '=', $keyword )
                            ->orWhere('inventar_number', '=', $keyword )
                            ->orWhere('keywords', 'like', '%' . $keyword . '%');
                    });
                });
            });

        $scientificPublications = $q->with(['translations', 'resTypeLang', 'resType', 'resType.translations', 'resField'])->where('key', '=', 'abstract')->orderBy('id', 'desc')->paginate($perPage);


        return view('res-abstract.index', compact('scientificPublications', 'keyword', 'resourceFields', 'resourceLanguages', 'resourceTypes', 'res_lang_id', 'res_type_id', 'res_field_id'))
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
        $resourceTypes = ResourceType::with('translations')->where('code', '=', 'abstract')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('res-abstract.create', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'title_uz' => 'required',
                'barcode' => 'required|unique:scientific_publications,barcode',
                'publication_year' => 'required'
            ],
            [
                'title_uz.required' => __('The :attribute field is required.'),
                'barcode.required' => __('The :attribute field is required.'),
                'barcode.unique' =>  __('The :attribute has already been taken.'),
                'published_year.required' => __('The :attribute field is required.'),
            ],
            [
                'published_year' => __('Published Year'),
                'title_uz' => __('Title UZ'),
            ]
        );

        $scientificPublication = new ScientificPublication();

        $scientificPublications = ScientificPublication::create(ScientificPublication::GetData($request, $scientificPublication));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('res-abstracts.index', app()->getLocale());
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

        return view('res-abstract.show', compact('scientificPublication'));
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
        $resourceTypes = ResourceType::with('translations')->where('code', '=', 'abstract')->orderBy('id', 'desc')->type()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('res-abstract.edit', compact('scientificPublication', 'resourceFields', 'resourceLanguages', 'resourceTypes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScientificPublication $scientificPublication
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ScientificPublication $resAbstract)
    {

//        request()->validate(ScientificPublication::rules());
        $this->validate(
            $request,
            [
                'title_uz' => 'required',
                'barcode' => 'required|unique:scientific_publications,barcode,' . $resAbstract->id,
                'publication_year' => 'required'
            ],
            [
                'title_uz.required' => __('The :attribute field is required.'),
                'barcode.required' => __('The :attribute field is required.'),
                'barcode.unique' => __('The :attribute has already been taken.'),
                'publication_year.required' => __('The :attribute field is required.'),
            ],
            [
                'publication_year' => __('Published Year'),
                'title_uz' => __('Title UZ'),
                'barcode' => __('Barcode'),
            ]
        );
        $resAbstract->update(ScientificPublication::GetData($request, $resAbstract));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('res-abstracts.index', app()->getLocale());
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

        return redirect()->route('res-abstracts.index', app()->getLocale());
    }
}
