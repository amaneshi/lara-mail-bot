<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use Illuminate\Http\Response;

class TemplateController extends Controller
{
    /**
     * TemplateController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Template::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function index(Template $template)
    {
        $templates = $template->owned()->orderBy('id', 'asc')->get();
        return view('template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Template  $template
     * @param  \App\Http\Requests\TemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Template $template, TemplateRequest $request)
    {
        $template->create($request->all());
        return redirect()->route('template.index')->with('message', 'Template has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('template.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('template.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Template  $template
     * @param  \App\Http\Requests\TemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Template $template, TemplateRequest $request)
    {
        $template->update($request->all());
        return redirect()->route('template.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('template.index');
    }
}
