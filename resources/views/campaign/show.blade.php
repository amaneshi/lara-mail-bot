@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('campaign.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Campaign: <b>{{$campaign->name}}</b></div>
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
                <th width="25%">Attribute</th>
                <th width="75%">Value</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{$campaign->name}}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{$campaign->description}}</td>
            </tr>
            <tr>
                <td>Template</td>
                <td>
                    {{ link_to_route('template.show', $campaign->template->name, [$campaign->template->id], null) }}
                </td>
            </tr>
            <tr>
                <td>Bunch</td>
                <td>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td>
                                {{ link_to_route('bunch.show', $campaign->bunch->name, [$campaign->bunch->id]) }}
                            </td>
                        </tr>
                        @foreach ($campaign->bunch->subscribers as $subscriber)
                            <tr>
                                <td>
                                    {!! $subscriber->first_name.' '.$subscriber->last_name.' <b> ( '.$subscriber->email.' ) </b>' !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        {{ link_to_route('campaign.preview', 'Preview and SEND', [$campaign->id], ['class' => 'btn btn-primary btn-md']) }}
    </div>
@endsection