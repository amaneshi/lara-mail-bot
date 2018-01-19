<div class="form-group">
    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'campaign']) !!}
</div>

<div class="form-group">
    {!! Form::label('template_id', 'Template') !!}
    {!! Form::select(
    'template_id',
    \App\Models\Template::getSelectList(),
    isset($campaign) ? $campaign->template_id : null,
    ['class' => 'form-control',
    'placeholder' => 'Pick a Template...']
    ) !!}
</div>

<div class="form-group">
    {!! Form::label('bunch_id', 'Bunch') !!}
    {!! Form::select(
    'bunch_id',
    \App\Models\Bunch::getSelectList(),
    isset($campaign) ? $campaign->bunch_id : null,
    ['class' => 'form-control',
    'placeholder' => 'Pick a Bunch...']
    ) !!}
</div>

<div class="form-group">
    {!!Form::label('description', 'Description') !!}
    {!!Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Campaign description']) !!}
</div>

@include('layouts.errors')
