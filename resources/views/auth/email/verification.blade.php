<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>J-Hunting | Verify Your Email</title>
</head>

<body style="margin:0; padding:0; background: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" border="0"
                    style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #e3e3e3; padding: 40px;">
                    <tr>
                        <td align="center" style="font-family: Arial, sans-serif;">
                            <h2 style="margin-bottom: 10px; color: #2367d1;">Welcome to J-Hunting!</h2>
                            <p style="margin-bottom: 30px; color: #333;">Hello <span
                                    style="color:#2367d1;">{{ $account->email }}</span>,</p>
                            <p style="margin-bottom: 30px; color: #333;">
                                Click the button below to verify your email address:
                            </p>
                            <a href="{{ $verifyUrl }}"
                                style="display: inline-block; padding: 12px 32px; background: #2367d1; color: #fff; border-radius: 6px; text-decoration: none; font-weight: bold; margin-bottom: 30px;">
                                Verify Email
                            </a>
                            <p style="color: #888; font-size: 13px; margin-top: 24px;">
                                If you did not register to J-Hunting, you can ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top:24px;">
                            <span style="color:#bbb; font-size:12px;">&copy; {{ date('Y') }} J-Hunting</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
