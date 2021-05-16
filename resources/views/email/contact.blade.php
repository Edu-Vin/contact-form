@extends('layouts.email.extend')
@section('content')
<div style="margin:0px auto;max-width:600px;background:white;">
            <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 40px 40px;">
              
                            <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                                <table role="presentation" cellpadding="0" cellspacing="0" style="width=100%; border=0;">
                                    <tbody>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;" align="left">
                                                <div style="cursor:auto;color:#222228;font-family:'Avenir Next', Avenir, sans-serif;font-size:16px;line-height:30px;text-align:left;">
                                                Hey {{getenv('ADMIN_NAME')}}!,
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;padding: 20px 0px 0px 0px;" align="left">
                                                <div style="cursor:auto;color:#222228;font-family:'Avenir Next', Avenir, sans-serif;font-size:16px;line-height:30px;text-align:left;">
                                                {{$name}} with email address {{$email}} tried to contact you. They dropped this message</div>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="word-wrap:break-word;font-size:0px;padding: 20px 0px 0px 0px;" align="left">
                                                <div style="cursor:auto;font-size:16px;line-height:30px;text-align:center;font-style:italic;">
                                                        {{$body}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection