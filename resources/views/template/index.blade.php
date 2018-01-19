@extends('layouts.panel')

@section('panel')
    <div class="panel-heading">
        <div class="centered-child"><b>Templates</b></div>
    </div>

    <div class="panel-body">
        @include('layouts.message')
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th width="25%">Name</th>
                <th width="55%">Content</th>
                <th width="20%">action</th>
            </tr>
            <tr>
                <td colspan="5" class="light-green-background no-padding" title="Create new template">
                    <div class="row centered-child">
                        <div class="col-md-12">
                            <a class="table-cell fa-green padding-sm"
                               href="{{ route('template.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @foreach ($templates as $model)
                <tr class="clickable_row"
                    onclick="window.location = '{{ route('template.show', $model->id) }}'">
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->content }}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['template.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('template.show', 'Info', [$model->id], ['class' => 'btn btn-info btn-xs']) }}
                        |
                        {{ link_to_route('template.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
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