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
                <table width="80%" cellpadding="0" cellspacing="0" border="0" style="padding-top: 20px;">
                    <tr>
                        <td align="center" style="font-size: 30px;">
                            APPLICATION STATUS
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Congratulations!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Your Application Status is now set to:
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 20px; padding-bottom: 20px; padding-left: 10px;">
                            <a href="" style="background-color: #002561; color: white; padding: 10px; border-radius: 10px; text-decoration: none;">FOR PDOS & CFO</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>ZIP Travel PDOS Schedule: {{ $data['pdos_schedule'] }} | {{ $data['pdos_time'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>CFO PDOS Schedule: {{ $data['cfo_schedule'] }} | {{ $data['cfo_time'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            You will receive an email from your program coordinator regarding specific details. Please be on time.
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            If you need technical assistance in using ZIP Portal, please send us an email at support@ziptravel.com.ph 
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
                            All Rights Reserved @ {{ date('Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>