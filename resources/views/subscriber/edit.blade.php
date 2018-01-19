@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('subscriber.index', $bunch->id)}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Edit subscriber: <b>'{{$subscriber->first_name." ".$subscriber->last_name}}'</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['subscriber.destroy', $bunch->id, $subscriber->id], 'method' => 'DELETE'])}}
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {!! Form::model($subscriber, ['route' => ['subscriber.update', $bunch->id, $subscriber->id], 'method' => 'PUT']) !!}

        @include('subscriber._form')

        <div class="form-group">
            {!! Form::button('Edit', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection