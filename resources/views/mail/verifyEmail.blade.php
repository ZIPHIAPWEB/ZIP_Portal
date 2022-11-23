<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="font-family: 'Source Sans Pro';">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="80%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="center">
                            <img src="{{ asset('logo2.png') }}" style="width: 120px; height: 120px;" alt="" srcset="">
                        </td>
                    </tr>
                </table>
                <table width="80%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding: 10px;">
                            Hello!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Thank you for registering with ZIP Travel Philippines!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            To complete your registration please click here:
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0;">
                            <a target="_blank" href="{{ $verification_link }}" style="padding: 12px; border: 1px solid none; border-radius: 20px; background-color: #002561; text-decoration: none; color: white;">Activate My Account</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            If you need technical assistance in using ZIP Travel Portal, please send us an email at support@ziptravel.com.ph 
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Regards,
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            ZIP Travel Philippines
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px">
                            Use this link if verification button is not working. {{ $verification_link }}
                        </td>
                    </tr>
                </table>
                <table width="80%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="center" style="padding: 20px;">
                            ZIP Travel Philippines @ {{ date('Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>