@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('campaign.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Campaign PREVIEW: <b>{{$campaign->name}}</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $campaign->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('campaign.edit', 'edit', [$campaign->id], ['class' => 'btn btn-primary btn-xs']) }}
                    |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-responsive">
            <tr>
                <td width="25%">Subject</td>
                <td width="75%">{{$campaign->name}}</td>
            </tr>
            <tr>
                <td>To</td>
                <td>
                    <b>
                        {{ $campaign->bunch->subscribers->take(200)->implode('email', ', ') }}
                        {{ $campaign->bunch->subscribers->count() > 200 ? ' ... ' : ' ' }} <br/>
                        ( {{ $campaign->bunch->subscribers->count() }} Total )
                    </b>
                </td>
            </tr>
            <tr>
                <td>From</td>
                <td>
                    {{ Auth::user()->name }} <b>{{ '<'.Auth::user()->email.'>' }}</b>
                </td>
            </tr>
            <tr>
                <td>ReplyTo</td>
                <td>
                    {{ Auth::user()->name }} <b>{{ '<'.Auth::user()->email.'>' }}</b>
                </td>
            </tr>
            <tr>
                <td>Message</td>
                <td>
                    <iframe width="100%" height="300" srcdoc="{{ $message }}">
                        Your browser doesn't support iFrames
                    </iframe>
                </td>
            </tr>
        </table>
        {{Form::open(['class' => 'confirm-send inline-form-buttons', 'route' => ['campaign.send', $campaign->id], 'method' => 'SEND'])}}
        {{Form::button('SEND THIS CAMPAIGN', ['class' => 'btn btn-success btn-md', 'type' => 'submit'])}}
        {{Form::close()}}
    </div>
@endsection