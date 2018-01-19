<?php

namespace App\Http\Controllers;

use App\Models\Bunch;
use App\Http\Requests\BunchRequest;

class BunchController extends Controller
{
    /**
     * BunchController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Bunch::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function index(Bunch $bunch)
    {
        $bunches = $bunch->owned()->orderBy('id', 'asc')->get();
        return view('bunch.index', compact('bunches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bunch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Bunch $bunch
     * @param  \App\Http\Requests\BunchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunch $bunch, BunchRequest $request)
    {
        $bunch->create($request->all());
        return redirect()->route('bunch.index')->with('message', 'Bunch has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function show(Bunch $bunch)
    {
        return view('subscriber.index', compact('bunch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch)
    {
        return view('bunch.edit', compact('bunch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Bunch $bunch
     * @param  \App\Http\Requests\BunchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Bunch $bunch, BunchRequest $request)
    {
        $bunch->update($request->all());
        return redirect()->route('bunch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunch $bunch)
    {
        $bunch->delete();

        return redirect()->route('bunch.index');
    }
}
