<?php
$name = '';

$subject = 'Hasta la próxima, esperamos verte pronto.';
$body = '<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="background-color: #f4f4f4; margin: 0; padding: 0;">
        <div style="width: 100%; max-width: 450px; margin: 0 auto; background-color: #f8f8f8;">
            <div id="header" style="height: 130px;background:#ffe15c;">
                <img id="logo" src="https://kickash.ovh/media/logo/mainLogo.svg" alt="Kickash logo" title="Kickash logo" style="width: 80%;height:100%;margin: 0 10%;">
            </div>
            <div id="content" style="padding: 50px 20px;">
                <h1 style="color:#595250;font-size: 1.5rem; margin-bottom: 30px; font-family: sans-serif;">Sentimos mucho que te vayas...</h1>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Si en los próximos 30 días decides volver, puedes ponerte en contacto con nosotros a través de este email y reactivaremos tu cuenta.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Pasado esos días, tu cuenta y todos tus datos serán completamente eliminados de nuestro sistema.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Estaremos esperándote por si cambias de opinión.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Muchas gracias por habernos dado tu confianza y tiempo.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;"> Equipo de <img width="60px" src="https://kickash.ovh/media/logo/mainLogo.svg" alt="Kickash logo" title="Kickash logo"></p>
            </div>
        </div>
        <div id="footer" style=" text-align: center; padding: 10px 0; font-size: 12px; font-weight: 600;">
            <p style="color:#595250;font-size: 1.1rem; font-family: sans-serif;">Síguenos en nuestras redes sociales</p>
            <table style="width:100%; padding: 0 95px;">
                <tr>
                    <td style="text-align: center;">
                        <a href="https://www.facebook.com/profile.php?id=61562944147734&locale=es_ES">
                            <img width="40px" src="https://kickash.ovh/media/icons/facebook.PNG">
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a href="https://www.instagram.com/kickash/">
                            <img width="40px" src="https://kickash.ovh/media/icons/instagram.PNG" alt="Instagram logo" title="Instagram logo">
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a href="#">
                            <img width="40px" src="https://kickash.ovh/media/icons/tiktok.PNG">
                        </a>
                    </td>
                </tr>
            </table>
            <p style="font-size: 0.9rem; color: #666666; font-family: sans-serif;">&copy; 2024 KickAsh</p>
        </div>
    </body>
</html>';
// echo $body;
include_once '../../config/PHPMailer/config.php';