@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('home')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Unsubscribe: <b>'{{$sentMail->subscriber()->withTrashed()->first()->first_name." ".$sentMail->subscriber()->withTrashed()->first()->last_name.' <'.$sentMail->subscriber()->withTrashed()->first()->email.'>'}}'</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {!! Form::model($sentMail, ['route' => ['sentMail.unsubscribeAfter', 'mailId' => $sentMail->id], 'method' => 'POST']) !!}

        <div class="form-group">
            {!!Form::label('reason', 'Reason') !!}
            {!!Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => 'Please, specify your reason to unsubscribe...']) !!}

        </div>

        @include('layouts.errors')
        <div class="form-group">
            {!! Form::button('Unsubscribe', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection