<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>J-Hunting | Restriction Notification</title>
</head>

<body style="margin:0; padding:0; background: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" border="0"
                    style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #e3e3e3; padding: 40px;">
                    <tr>
                        <td align="center" style="font-family: Arial, sans-serif;">
                            <h2 style="margin-bottom: 10px; color: #c41212; font-size: 24px; font-weight: 600;">
                                {{ $title }}</h2>
                            <p style="margin-bottom: 30px; color: #333; font-size: 16px; font-weight: 500;">
                                {{ $content }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top:24px;">
                            <span style="color:#747474; font-size:12px;">If you have any questions, feel free to reply
                                to
                                this email.<br>
                                &copy; {{ date('Y') }} J-Hunting. All rights reserved.</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
