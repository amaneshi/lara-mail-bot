<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<table width="100%">
    <tr>
        <th width="10%"></th>
        <th width="80%" align="center">
            <div>
                <!-- Branding Image -->
                <a href="{{ url('/') }}" style="text-decoration: none; text-transform: uppercase">
                    <strong>{{ config('app.name', 'Laravel') }}</strong>
                </a>
            </div>
        </th>
        <th width="10%"></th>
    </tr>
    <tr>
        <td></td>
        <td>
            <div style="width: 100%; padding: 20px;border: black solid 2px;box-sizing: border-box">
                {!! $campaign->template->content !!}
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td align="center">
            <strong>© 2018 {{ config('app.name', 'Laravel') }}. All rights reserved.</strong>
        </td>
        <td></td>
    </tr>
</table>

@if(strpos($campaign->template->content, '{UNSUBSCRIBE}')=== false)
    <p style="text-align: center">{UNSUBSCRIBE}</p>
@endif

</body>
</html>
