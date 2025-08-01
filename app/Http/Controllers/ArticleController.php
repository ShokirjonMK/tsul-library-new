<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Journal;
use Illuminate\Http\Request;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
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
    public function index()
    {
        $perPage = 20;
        $articles = Article::orderBy('id', 'desc')->paginate($perPage);

        return view('article.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * $articles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();
        $journals  = Journal::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('article.create', compact('article', 'journals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            Article::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'journal_id.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'journal_id' => __('Journal'),
            ]
        );
        $article = Article::create(Article::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('articles.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $article = Article::find($id);

        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $article = Article::find($id);

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Article $article)
    {

        request()->validate(
            Article::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'journal_id.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'journal_id' => __('Journal'),
            ]
        );
        $article->update(Article::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('articles.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $article = Article::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('articles.index', app()->getLocale());
    }
}
