@extends('layouts.panel')

@section('panel')
    <div class="panel-heading">
        <div class="centered-child"><b>Bunches</b></div>
    </div>

    <div class="panel-body">
        @include('layouts.message')
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th width="15%">Name</th>
                <th width="40%">Description</th>
                <th width="15%">Emails</th>
                <th width="30%">action</th>
            </tr>
            <tr>
                <td colspan="5" class="light-green-background no-padding" title="Create new bunch">
                    <div class="row centered-child">
                        <div class="col-md-12">
                            <a class="table-cell fa-green padding-sm"
                               href="{{ route('bunch.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @foreach ($bunches as $model)
                <tr class="clickable_row"
                    onclick="window.location = '{{ route('subscriber.index', $model->id) }}'">
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->description }}</td>
                    <td>{{ $model->subscribers->count() }}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('subscriber.index', 'Subscribers', [$model->id], ['class' => 'btn btn-info btn-xs']) }}
                        |
                        {{ link_to_route('bunch.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
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