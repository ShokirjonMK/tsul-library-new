<?php

namespace App\Http\Controllers;

use App\Models\ArticleTranslation;
use Illuminate\Http\Request;

/**
 * Class ArticleTranslationController
 * @package App\Http\Controllers
 */
class ArticleTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $articleTranslations = ArticleTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('article-translation.index', compact('articleTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $articleTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleTranslation = new ArticleTranslation();
        return view('article-translation.create', compact('articleTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ArticleTranslation::rules());

        $articleTranslation = ArticleTranslation::create(ArticleTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('article-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $articleTranslation = ArticleTranslation::find($id);

        return view('article-translation.show', compact('articleTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $articleTranslation = ArticleTranslation::find($id);

        return view('article-translation.edit', compact('articleTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ArticleTranslation $articleTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ArticleTranslation $articleTranslation)
    {

        request()->validate(ArticleTranslation::rules());

        $articleTranslation->update(ArticleTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('article-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $articleTranslation = ArticleTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('article-translations.index', app()->getLocale());
    }
}
