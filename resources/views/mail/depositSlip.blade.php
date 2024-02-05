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
                            Deposit Slip Details
                        </td>
                    </tr>
                </table>
                <table width="80%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding: 10px;">
                            Name: {{ $data['full_name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Name: {{ $data['program'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Bank Code: {{ $data['payment']->bank_code }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Reference No.: {{ $data['payment']->reference_no }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Date: {{ $data['payment']->date_deposit }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Bank Account No.: {{ $data['payment']->bank_account_no }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            Amount: {{ $data['payment']->amount }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0;">
                            <a target="_blank" href="{{ url(Storage::disk('uploaded_payment')->url($data['payment']->path)) }}" style="padding: 12px; border: 1px solid none; border-radius: 20px; background-color: #002561; text-decoration: none; color: white;">View Deposit Slip</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0;">
                            <a target="_blank" href="{{ route('verify.slip', $data['payment']->id) }}" style="padding: 12px; border: 1px solid none; border-radius: 20px; background-color: #002561; text-decoration: none; color: white;">Verify Deposit Slip</a>
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