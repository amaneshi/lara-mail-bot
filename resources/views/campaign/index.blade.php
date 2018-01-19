@extends('layouts.panel')

@section('panel')
    <div class="panel-heading">
        <div class="centered-child"><b>Campaigns</b></div>
    </div>

    <div class="panel-body">
        @include('layouts.message')
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th width="15%">Name</th>
                <th width="20%">Description</th>
                <th width="15%">Template</th>
                <th width="15%">Bunch</th>
                <th width="5%">Recipients</th>
                <th width="30%">action</th>
            </tr>
            <tr>
                <td colspan="6" class="light-green-background no-padding" title="Create new campaign">
                    <div class="row centered-child">
                        <div class="col-md-12">
                            <a class="table-cell fa-green padding-sm"
                               href="{{ route('campaign.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @foreach ($campaigns as $model)
                <tr class="clickable_row"
                    onclick="window.location = '{{ route('campaign.show', $model->id) }}'">
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->description }}</td>
                    <td>{{ $model->template->name }}</td>
                    <td>{{ $model->bunch->name }}</td>
                    <td>{{ $model->bunch->subscribers->count() }}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('campaign.preview', 'Preview', [$model->id], ['class' => 'btn btn-warning btn-xs']) }}
                        |
                        {{ link_to_route('campaign.show', 'Info', [$model->id], ['class' => 'btn btn-info btn-xs']) }}
                        |
                        {{ link_to_route('campaign.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                        |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </tr>
            @endforeach
        </table>
        <div class="no-margin-r pull-right">

        </div>
    </div>
@endsection