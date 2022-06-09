<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageStoreRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Language::all();
        return view('admin.languages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageStoreRequest $request)
    {
        $lang = new Language();
        $lang->language_code = $request->language_code;
        if(!is_null($request->icon)){
            $image = FileUploadHelper::upload([$request->icon], ["jpg", "jpeg", "png"], "languages");
            $lang->icon = count($image) ? $image[0]['image'] : '';
        }
        $lang->save();

        session()->flash('create-message', 'Resource has been created successfully.');

        return redirect(route('admin.languages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $data = $language;
        return view('admin.languages.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageStoreRequest $request, Language $language)
    {
        $language->language_code = $request->language_code;

        if(!is_null($request->icon)){
            $image = FileUploadHelper::upload([$request->icon], ["jpg", "jpeg", "png"], "languages");
            $language->icon = count($image) ? $image[0]['image'] : '';
        }
        $language->save();

        session()->flash('update-message', 'Resource has been updated successfully.');
        return redirect(route('admin.languages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        try {
            $language->delete();
            session()->flash('delete-message', 'Resource has been deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('delete-message', 'Resource cannot be deleted. It may be deleted or has some data tied to this language');
        }

        return redirect(route('admin.languages.index'));
    }
}
