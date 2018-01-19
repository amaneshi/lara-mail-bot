<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use App\Models\Bunch;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    /**
     * SubscriberController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Subscriber::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function index(Bunch $bunch)
    {
        $subscribers = $bunch->subscribers()->owned()->orderBy('id', 'asc')->get();
        return view('subscriber.index', compact(['subscribers', 'bunch']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function create(Bunch $bunch)
    {
        return view('subscriber.create', compact('bunch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Bunch $bunch
     * @param  \App\Models\Subscriber $subscriber
     * @param  \App\Http\Requests\SubscriberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunch $bunch, Subscriber $subscriber, SubscriberRequest $request)
    {
        $subscriber->create(array_add($request->all(), 'bunch_id', $bunch->id));;
        return redirect()->route('subscriber.index', compact('bunch'))->with('message', 'Subscriber has been added');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return new Response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bunch $bunch
     * @param  \App\Models\Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch, Subscriber $subscriber)
    {
        return view('subscriber.edit', compact(['bunch', 'subscriber']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Bunch $bunch
     * @param  \App\Models\Subscriber $subscriber
     * @param   \App\Http\Requests\SubscriberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Bunch $bunch, Subscriber $subscriber, SubscriberRequest $request)
    {
        $subscriber->update(array_add($request->all(), 'bunch_id', $bunch->id));;
        return redirect()->route('subscriber.index', compact('bunch'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunch $bunch, Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('subscriber.index', compact('bunch'));
    }
}
