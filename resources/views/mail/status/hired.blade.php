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
                            <a href="" style="background-color: #002561; color: white; padding: 10px; border-radius: 10px; text-decoration: none;">HIRED</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Host Company: {{ $data['host_company'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Position: {{ $data['position'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Location: {{ $data['location'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Housing: {{ $data['housing_details'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Stipend: {{ $data['stipend'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;">
                            <b>Visa Sponsor: {{ $data['visa_sponsor'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Please log in to www.ziptravel.com.ph and upload your necessary documents.
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            If you need to contact us, please send us an email at support@ziptravel.com.ph 
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