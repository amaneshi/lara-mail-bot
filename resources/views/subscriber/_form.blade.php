<div class="form-group">
    {!!Form::label('first_name', 'First Name') !!}
    {!!Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
    {!!Form::label('last_name', 'Last Name') !!}
    {!!Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
    {!!Form::label('email', 'E-MAIL') !!}
    {!!Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}

    {!!Form::hidden('reason', 'reason-placeholder') !!}

</div>

@include('layouts.errors')