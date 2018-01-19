<div class="form-group">
    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'bunch']) !!}
    {!!Form::label('description', 'Description') !!}
    {!!Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Bunch description']) !!}
</div>

@include('layouts.errors')
