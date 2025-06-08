<?php
$name = '';

$subject = 'Recuperación de contraseña';
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
                <h1 style="color:#595250;font-size: 1.5rem; margin-bottom: 30px; font-family: sans-serif;">No te preocupes.</h1>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Hemos generado una nueva contraseña temporal para que puedas acceder a tu cuenta:</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;"><strong>' . $password . '</strong> </p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Por tu seguridad, te recomendamos cambiarla tan pronto como inicies sesión para mantener tu cuenta segura. Puedes hacerlo desde la sección de configuración en tu perfil.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Si no solicitaste este cambio, por favor contáctanos de inmediato.</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;"> Equipo de <img width="60px" src="https://kickash.ovh/media/logo/mainLogo.svg" alt="Kickash logo" title="Kickash logo"></p>
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
        </div>
    </body>
</html>';
// echo $body;
include_once '../../config/PHPMailer/config.php';