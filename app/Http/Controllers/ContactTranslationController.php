<?php

namespace App\Http\Controllers;

use App\Models\ContactTranslation;
use Illuminate\Http\Request;

/**
 * Class ContactTranslationController
 * @package App\Http\Controllers
 */
class ContactTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $contactTranslations = ContactTranslation::orderBy('id', 'desc')->paginate($perPage);

        return view('contact-translation.index', compact('contactTranslations'))
            ->with('i', (request()->input('page', 1) - 1) * $contactTranslations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactTranslation = new ContactTranslation();
        return view('contact-translation.create', compact('contactTranslation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ContactTranslation::rules());

        $contactTranslation = ContactTranslation::create(ContactTranslation::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('contact-translations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $contactTranslation = ContactTranslation::find($id);

        return view('contact-translation.show', compact('contactTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $contactTranslation = ContactTranslation::find($id);

        return view('contact-translation.edit', compact('contactTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ContactTranslation $contactTranslation
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, ContactTranslation $contactTranslation)
    {

        request()->validate(ContactTranslation::rules());

        $contactTranslation->update(ContactTranslation::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('contact-translations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $contactTranslation = ContactTranslation::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('contact-translations.index', app()->getLocale());
    }
}
