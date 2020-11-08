<!DOCTYPE html>
<html>
<head>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title')</title>
  
</head>
<body>

    <div style="width:600px;margin:0 auto;padding:0;border:2px solid #f42a6c;padding:10px;">
    <table width="600" border="0" cellspacing="0">
        <tbody>
            {{-- <tr bgcolor="#f42a6c"> --}}
            <tr>
                <td align="center" valign="top" style="font-weight:bold;font-size:13px;padding:10px; border-bottom: 2px solid #f42a6c;">

                <img src="{{ asset('public/logo.png') }}" alt="Popping logo" border="0" height="75px" width="180px" />
                   
                </td>
            </tr>
            <tr><td colspan="2" valign="top">&nbsp;</td></tr>
            <tr>
                <td style="font-size:14px;padding-left:12px">
                         @yield('body')
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td style="font-weight:bold;font-size:12px;padding-left:12px"><p>Thanks & Regards,<br />{{env('APP_NAME')}}</p></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr bgcolor="#f42a6c">
                <td style="font-weight:bold;font-size:12px;padding-left:12px">    
                    <p style="background:#f42a6c;font-size:12px;text-align:center;padding:10px;border-top:1px solid #000;color:#FFFFFF;">Please do not reply to this email, as this is an unmonitored email address. You can contact to <span style="color: #FFFFFF;">{{env('SITE_EMAIL')}}</span> for any related query.<br />&copy; {{ env('APP_NAME') }} @php
                        echo date('Y');
                    @endphp</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
 

</body>
</html>