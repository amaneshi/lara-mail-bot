@extends('layouts.panel')

@section('panel')
    <div class="panel-heading">
        <div class="centered-child"><b>Reports</b></div>
    </div>

    <div class="panel-body">
        @include('layouts.message')
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th width="15%">Send Campaign ID</th>
                <th width="5%">Mail All</th>
                <th width="5%">Mail Sent</th>
                <th width="5%">Mail Queued</th>
                <th width="5%">Mail Accepted</th>
                <th width="5%">Mail Rejected</th>
                <th width="5%">Mail Delivered</th>
                <th width="5%">Mail Failed</th>
                <th width="5%">Mail Opened</th>
                <th width="5%">Mail Unsubscribed</th>
                <th width="5%">Action</th>
            </tr>

            @foreach ($reports as $model)
                <tr class="clickable_row"
                    onclick="window.location = '{{ route('sentMail.index', $model->id) }}'">
                    <td>{!!  $model->send_campaign_id !!}</td>
                    <td>{!! $model->asPercent($model->mail_all) !!}</td>
                    <td>{!! $model->asPercent($model->mail_sent) !!}</td>
                    <td>{!! $model->asPercent($model->mail_queued) !!}</td>
                    <td>{!! $model->asPercent($model->mail_accepted) !!}</td>
                    <td>{!! $model->asPercent($model->mail_rejected) !!}</td>
                    <td>{!! $model->asPercent($model->mail_delivered) !!}</td>
                    <td>{!! $model->asPercent($model->mail_failed) !!}</td>
                    <td>{!! $model->asPercent($model->mail_opened) !!}</td>
                    <td>{!! $model->asPercent($model->mail_unsubscribed) !!}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['report.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('sentMail.index', 'Sent Mails', [$model->id], ['class' => 'btn btn-info btn-xs']) }}
                        {{ link_to_route('report.show', 'Update', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="no-margin-r pull-right">

        </div>
    </div>
@endsection