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
                        <td align="center" style="font-size: 30px">
                            PAYMENT VERIFIED
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Hello!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            {{ $data['requirement'] }} of {{ $data['first_name'] }} {{ $data['last_name'] }} is now verified.
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