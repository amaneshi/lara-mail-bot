@extends('layouts.panel')

@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('report.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">Report <b>'{{ $report->send_campaign_id }}'</b>
                (sentMails)
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['report.destroy', $report->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('report.update', 'Update', [$report->id], ['class' => 'btn btn-success btn-xs']) }}
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
                <th width="15%">First Name</th>
                <th width="15%">Last Name</th>
                <th width="15%">Email</th>
                <th width="10%">Opened</th>
                <th width="10%">Unsubscribed</th>
                <th width="35%">Reason</th>
            </tr>

            @foreach ($sentMails as $model)
                <tr class="clickable_row">
                    <td>{{ $model->subscriber()->withTrashed()->first()->first_name }}</td>
                    <td>{{ $model->subscriber()->withTrashed()->first()->last_name }}</td>
                    <td>{{ $model->subscriber()->withTrashed()->first()->email }}</td>
                    <td>{{ $model->mail_opened }}</td>
                    <td>{{ $model->mail_unsubscribed }}</td>
                    <td>{{ $model->mail_unsubscribe_reason }}</td>
                </tr>
            @endforeach
        </table>
        <div class="no-margin-r pull-right">

        </div>
    </div>
@endsection