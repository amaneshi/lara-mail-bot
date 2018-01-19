<div class="form-group">
    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Template name']) !!}
    {!!Form::label('content', 'Content') !!}
    {!!Form::textarea('content', null, ['class' => 'form-control text-editor', 'placeholder' => 'Template content']) !!}
</div>

@include('layouts.errors')
