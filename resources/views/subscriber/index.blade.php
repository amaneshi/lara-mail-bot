@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('bunch.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Bunch <b>'{{ $bunch->name }}'</b> (subscribers)</div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $bunch->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('bunch.edit', 'Edit', [$bunch->id], ['class' => 'btn btn-success btn-xs']) }}
                    |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        @include('layouts.message')
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th width="25%">First Name</th>
                <th width="25%">Last Name</th>
                <th width="30%">Email</th>
                <th width="20%">Action</th>
            </tr>
            <tr>
                <td colspan="5" class="light-green-background no-padding" title="Create new bunch">
                    <div class="row centered-child">
                        <div class="col-md-12">
                            <a class="table-cell fa-green padding-sm"
                               href="{{ route('subscriber.create', $bunch->id ) }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @foreach ($bunch->subscribers as $model)
                <tr class="clickable_row">
                    <td>{{ $model->first_name }}</td>
                    <td>{{ $model->last_name }}</td>
                    <td>{{ $model->email }}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['subscriber.destroy', $bunch->id, $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('subscriber.edit', 'Edit', [$bunch->id, $model->id], ['class' => 'btn btn-success btn-xs']) }}
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