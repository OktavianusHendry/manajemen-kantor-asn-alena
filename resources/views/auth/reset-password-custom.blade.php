<!-- resources/views/auth/reset-password-custom.blade.php -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
    </head>

    <body>
        <h1>Hello, {{ $user->name }}</h1>
        <p>You requested a password reset. Click the link below to reset your password:</p>

        <a href="{{ $url }}"
            style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">
            Reset Password
        </a>

        <p>If you did not request this password reset, please ignore this email.</p>

        <p>Thank you,<br>Your Application Team</p>
    </body>

</html>


<!--
* This email was built using Tabular.
* For more information, visit https://tabular.email
-->
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

    <head>
        <title></title>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!--[if !mso]>-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--<![endif]-->
        <meta name="x-apple-disable-message-reformatting" content="" />
        <meta content="target-densitydpi=device-dpi" name="viewport" />
        <meta content="true" name="HandheldFriendly" />
        <meta content="width=device-width" name="viewport" />
        <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
        <style type="text/css">
            table {
                border-collapse: separate;
                table-layout: fixed;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt
            }

            table td {
                border-collapse: collapse
            }

            .ExternalClass {
                width: 100%
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%
            }

            body,
            a,
            li,
            p,
            h1,
            h2,
            h3 {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            html {
                -webkit-text-size-adjust: none !important
            }

            body,
            #innerTable {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            #innerTable img+div {
                display: none;
                display: none !important
            }

            img {
                Margin: 0;
                padding: 0;
                -ms-interpolation-mode: bicubic
            }

            h1,
            h2,
            h3,
            p,
            a {
                line-height: inherit;
                overflow-wrap: normal;
                white-space: normal;
                word-break: break-word
            }

            a {
                text-decoration: none
            }

            h1,
            h2,
            h3,
            p {
                min-width: 100% !important;
                width: 100% !important;
                max-width: 100% !important;
                display: inline-block !important;
                border: 0;
                padding: 0;
                margin: 0
            }

            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important
            }

            u+#body a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            a[href^="mailto"],
            a[href^="tel"],
            a[href^="sms"] {
                color: inherit;
                text-decoration: none
            }
        </style>
        <style type="text/css">
            @media (min-width: 481px) {
                .hd {
                    display: none !important
                }
            }
        </style>
        <style type="text/css">
            @media (max-width: 480px) {
                .hm {
                    display: none !important
                }
            }
        </style>
        <style type="text/css">
            @media (max-width: 480px) {
                .t35 {
                    mso-line-height-alt: 0px !important;
                    line-height: 0 !important;
                    display: none !important
                }

                .t36 {
                    padding-left: 30px !important;
                    padding-bottom: 40px !important;
                    padding-right: 30px !important
                }

                .t38,
                .t97 {
                    width: 480px !important
                }

                .t19 {
                    width: 353px !important
                }

                .t7 {
                    padding-bottom: 20px !important
                }

                .t14,
                .t26,
                .t33,
                .t43,
                .t81,
                .t86,
                .t9,
                .t93 {
                    width: 420px !important
                }

                .t6 {
                    line-height: 28px !important;
                    font-size: 26px !important;
                    letter-spacing: -1.04px !important
                }

                .t95 {
                    padding: 40px 30px !important
                }

                .t79 {
                    padding-bottom: 36px !important
                }

                .t75 {
                    text-align: center !important
                }

                .t46,
                .t48,
                .t52,
                .t54,
                .t58,
                .t60,
                .t64,
                .t66,
                .t70,
                .t72 {
                    display: revert !important
                }

                .t50,
                .t56,
                .t62,
                .t68,
                .t74 {
                    vertical-align: top !important;
                    width: 44px !important
                }

                .t2 {
                    padding-bottom: 50px !important
                }

                .t4 {
                    width: 80px !important
                }

                .t24,
                .t31 {
                    padding-bottom: 34px !important
                }
            }
        </style>
        <!--[if !mso]>-->
        <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@500;700;800&amp;display=swap"
            rel="stylesheet" type="text/css" />
        <!--<![endif]-->
        <!--[if mso]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]-->
    </head>

    <body id="body" class="t101" style="min-width:100%;Margin:0px;padding:0px;background-color:#D1D1D1;">
        <div class="t100" style="background-color:#D1D1D1;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td class="t99"
                        style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#D1D1D1;"
                        valign="top" align="center">
                        <!--[if mso]>
<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
<v:fill color="#D1D1D1"/>
</v:background>
<![endif]-->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                            align="center" id="innerTable">
                            <tr>
                                <td>
                                    <div class="t35"
                                        style="mso-line-height-rule:exactly;mso-line-height-alt:45px;line-height:45px;font-size:1px;display:block;">
                                        &nbsp;&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table class="t39" role="presentation" cellpadding="0" cellspacing="0"
                                        style="Margin-left:auto;Margin-right:auto;">
                                        <tr>
                                            <!--[if mso]>
<td width="600" class="t38" style="background-color:#F8F8F8;width:600px;">
<![endif]-->
                                            <!--[if !mso]>-->
                                            <td class="t38" style="background-color:#F8F8F8;width:600px;">
                                                <!--<![endif]-->
                                                <table class="t37" role="presentation" cellpadding="0"
                                                    cellspacing="0" width="100%" style="width:100%;">
                                                    <tr>
                                                        <td class="t36" style="padding:0 50px 60px 50px;">
                                                            <table role="presentation" width="100%" cellpadding="0"
                                                                cellspacing="0" style="width:100% !important;">
                                                                <tr>
                                                                    <td>
                                                                        <div class="t1"
                                                                            style="mso-line-height-rule:exactly;mso-line-height-alt:45px;line-height:45px;font-size:1px;display:block;">
                                                                            &nbsp;&nbsp;</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">
                                                                        <table class="t5" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="130" class="t4" style="width:130px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t4" style="width:130px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t3"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t2"
                                                                                                style="padding:0 0 45px 0;">
                                                                                                <div
                                                                                                    style="font-size:0px;">
                                                                                                    <img class="t0"
                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                        width="130"
                                                                                                        height="60.59375"
                                                                                                        alt=""
                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/2e96bac8-2fd2-47fa-8359-47d82eeb642b.png" />
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t10" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t9" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t9"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t8"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t7"
                                                                                                style="padding:0 0 25px 0;">
                                                                                                <h1 class="t6"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:41px;font-weight:800;font-style:normal;font-size:39px;text-decoration:none;text-transform:none;letter-spacing:-1.56px;direction:ltr;color:#242C69;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">
                                                                                                    Halo,
                                                                                                    {{ $user->name }}!😊🙌
                                                                                                </h1>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t15" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t14" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t14"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t13"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t12"
                                                                                                style="padding:0 0 25px 0;">
                                                                                                <p class="t11"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">
                                                                                                    Kamu meminta
                                                                                                    pengaturan ulang
                                                                                                    kata sandi.
                                                                                                    <br />Klik tombol di
                                                                                                    bawah untuk menyetel
                                                                                                    ulang sandimu!~
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t20" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="250" class="t19" style="background-color:#FF8819;overflow:hidden;width:250px;border-radius:44px 44px 44px 44px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t24"
                                                                                    style="background-color:#FF8819;overflow:hidden;width:250px;border-radius:44px 44px 44px 44px;text-align:center;">
                                                                                    <a href="{{ $url }}"
                                                                                        style="display:inline-block;width:100%;text-decoration:none;background-color:#FF8819;color:#F8F8F8;padding:10px 0;border-radius:44px;line-height:44px;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;font-weight:800;font-size:12px;text-transform:uppercase;letter-spacing:2.4px;text-align:center;">
                                                                                        Reset Password
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="t23"
                                                                            style="mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;">
                                                                            &nbsp;&nbsp;</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t27" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t26" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t26"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t25"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t24">
                                                                                                <p class="t22"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;">
                                                                                                    <span
                                                                                                        class="t21"
                                                                                                        style="margin:0;Margin:0;mso-line-height-rule:exactly;">(
                                                                                                        Jika Anda tidak
                                                                                                        meminta
                                                                                                        pengaturan ulang
                                                                                                        kata sandi ini,
                                                                                                        abaikan email
                                                                                                        ini. )</span>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="t30"
                                                                            style="mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;">
                                                                            &nbsp;&nbsp;</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t34" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t33" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t33"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t32"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t31">
                                                                                                <p class="t29"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">
                                                                                                    <span
                                                                                                        class="t28"
                                                                                                        style="margin:0;Margin:0;mso-line-height-rule:exactly;">Best
                                                                                                        regards,&nbsp;
                                                                                                        &nbsp;<br />PT
                                                                                                        Anagata Sisedu
                                                                                                        Nusantara&nbsp;
                                                                                                        <br />Jakarta,
                                                                                                        Indonesia</span>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table class="t98" role="presentation" cellpadding="0" cellspacing="0"
                                        style="Margin-left:auto;Margin-right:auto;">
                                        <tr>
                                            <!--[if mso]>
<td width="600" class="t97" style="background-color:#242C69;width:600px;">
<![endif]-->
                                            <!--[if !mso]>-->
                                            <td class="t97" style="background-color:#242C69;width:600px;">
                                                <!--<![endif]-->
                                                <table class="t96" role="presentation" cellpadding="0"
                                                    cellspacing="0" width="100%" style="width:100%;">
                                                    <tr>
                                                        <td class="t95" style="padding:48px 50px 48px 50px;">
                                                            <table role="presentation" width="100%" cellpadding="0"
                                                                cellspacing="0" style="width:100% !important;">
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t44" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t43" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t43"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t42"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t41">
                                                                                                <p class="t40"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:800;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;letter-spacing:-0.9px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;">
                                                                                                    Kunjungi kami!</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t82" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t81" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t81"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t80"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t79"
                                                                                                style="padding:10px 0 44px 0;">
                                                                                                <div class="t78"
                                                                                                    style="width:100%;text-align:center;">
                                                                                                    <div class="t77"
                                                                                                        style="display:inline-block;">
                                                                                                        <table
                                                                                                            class="t76"
                                                                                                            role="presentation"
                                                                                                            cellpadding="0"
                                                                                                            cellspacing="0"
                                                                                                            align="center"
                                                                                                            valign="top">
                                                                                                            <tr
                                                                                                                class="t75">
                                                                                                                <td>
                                                                                                                </td>
                                                                                                                <td class="t50"
                                                                                                                    width="44"
                                                                                                                    valign="top">
                                                                                                                    <table
                                                                                                                        role="presentation"
                                                                                                                        width="100%"
                                                                                                                        cellpadding="0"
                                                                                                                        cellspacing="0"
                                                                                                                        class="t49"
                                                                                                                        style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <td class="t46"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                            <td
                                                                                                                                class="t47">
                                                                                                                                <a href="https://x.com/anagata_sisedu?s=11&t=WlmkR3Yewxc-ghdJo8bO9g"
                                                                                                                                    style="font-size:0px;"
                                                                                                                                    target="_blank"><img
                                                                                                                                        class="t45"
                                                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt=""
                                                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/024bea1d-ddb3-4f2b-8412-08a933b316e4.png" /></a>
                                                                                                                            </td>
                                                                                                                            <td class="t48"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <td class="t56"
                                                                                                                    width="44"
                                                                                                                    valign="top">
                                                                                                                    <table
                                                                                                                        role="presentation"
                                                                                                                        width="100%"
                                                                                                                        cellpadding="0"
                                                                                                                        cellspacing="0"
                                                                                                                        class="t55"
                                                                                                                        style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <td class="t52"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                            <td
                                                                                                                                class="t53">
                                                                                                                                <a href="https://www.facebook.com/AnagataSiseduNusantara?mibextid=LQQJ4d"
                                                                                                                                    style="font-size:0px;"
                                                                                                                                    target="_blank"><img
                                                                                                                                        class="t51"
                                                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt=""
                                                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/ceae95b1-ac8f-4520-8eed-eb5876e1ca14.png" /></a>
                                                                                                                            </td>
                                                                                                                            <td class="t54"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <td class="t62"
                                                                                                                    width="44"
                                                                                                                    valign="top">
                                                                                                                    <table
                                                                                                                        role="presentation"
                                                                                                                        width="100%"
                                                                                                                        cellpadding="0"
                                                                                                                        cellspacing="0"
                                                                                                                        class="t61"
                                                                                                                        style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <td class="t58"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                            <td
                                                                                                                                class="t59">
                                                                                                                                <a href="https://www.youtube.com/@anagatasisedunusantara8739"
                                                                                                                                    style="font-size:0px;"
                                                                                                                                    target="_blank"><img
                                                                                                                                        class="t57"
                                                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt=""
                                                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/d5cd5d1c-4c93-4d8f-9ddf-aa59887ccbc3.png" /></a>
                                                                                                                            </td>
                                                                                                                            <td class="t60"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <td class="t68"
                                                                                                                    width="44"
                                                                                                                    valign="top">
                                                                                                                    <table
                                                                                                                        role="presentation"
                                                                                                                        width="100%"
                                                                                                                        cellpadding="0"
                                                                                                                        cellspacing="0"
                                                                                                                        class="t67"
                                                                                                                        style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <td class="t64"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                            <td
                                                                                                                                class="t65">
                                                                                                                                <a href="https://www.linkedin.com/company/asn.id/"
                                                                                                                                    style="font-size:0px;"
                                                                                                                                    target="_blank"><img
                                                                                                                                        class="t63"
                                                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt=""
                                                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/5a924be4-4652-424b-90ba-71b52c8113a8.png" /></a>
                                                                                                                            </td>
                                                                                                                            <td class="t66"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <td class="t74"
                                                                                                                    width="44"
                                                                                                                    valign="top">
                                                                                                                    <table
                                                                                                                        role="presentation"
                                                                                                                        width="100%"
                                                                                                                        cellpadding="0"
                                                                                                                        cellspacing="0"
                                                                                                                        class="t73"
                                                                                                                        style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <td class="t70"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                            <td
                                                                                                                                class="t71">
                                                                                                                                <a href="https://www.instagram.com/asn.corp/"
                                                                                                                                    style="font-size:0px;"
                                                                                                                                    target="_blank"><img
                                                                                                                                        class="t69"
                                                                                                                                        style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt=""
                                                                                                                                        src="https://1e78fa8a-adf0-463b-9f0d-3fb066e190f2.b-cdn.net/e/2a73a699-984b-4440-93b6-cbae7c7519f3/1aef2d41-5493-483e-9c33-abbb83c0dca6.png" /></a>
                                                                                                                            </td>
                                                                                                                            <td class="t72"
                                                                                                                                style="width:10px;"
                                                                                                                                width="10">
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t87" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t86" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t86"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t85"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t84">
                                                                                                <p class="t83"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:12px;text-decoration:none;text-transform:none;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">
                                                                                                    PT Anagata Sisedu
                                                                                                    Nusantara
                                                                                                    <br />Revenue Tower,
                                                                                                    Lt. 15, District 8,
                                                                                                    SCBD, Jakarta
                                                                                                    Selatan,&nbsp;
                                                                                                    <br />DKI Jakarta,
                                                                                                    12190, Indonesia
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="t88"
                                                                            style="mso-line-height-rule:exactly;mso-line-height-alt:18px;line-height:18px;font-size:1px;display:block;">
                                                                            &nbsp;&nbsp;</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="t94" role="presentation"
                                                                            cellpadding="0" cellspacing="0"
                                                                            style="Margin-left:auto;Margin-right:auto;">
                                                                            <tr>
                                                                                <!--[if mso]>
<td width="500" class="t93" style="width:500px;">
<![endif]-->
                                                                                <!--[if !mso]>-->
                                                                                <td class="t93"
                                                                                    style="width:500px;">
                                                                                    <!--<![endif]-->
                                                                                    <table class="t92"
                                                                                        role="presentation"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        style="width:100%;">
                                                                                        <tr>
                                                                                            <td class="t91">
                                                                                                <p class="t90"
                                                                                                    style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:12px;text-decoration:none;text-transform:none;direction:ltr;color:#A1A1A1;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">
                                                                                                    <a class="t89"
                                                                                                        href="https://tabular.email"
                                                                                                        style="margin:0;Margin:0;font-weight:700;font-style:normal;text-decoration:none;direction:ltr;color:#A1A1A1;mso-line-height-rule:exactly;"
                                                                                                        target="_blank">Aplikasi
                                                                                                        Manajemen Kantor
                                                                                                        - by Alena
                                                                                                        Alfiana</a>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="gmail-fix" style="display: none; white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    </body>

</html>
