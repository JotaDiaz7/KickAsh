<?php
$name = '';

$subject = 'Bienvenid@ 🎉🎉';
$body = '<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="background-color: #f4f4f4; margin: 0; padding: 0;">
        <div style="width: 100%; max-width: 450px; margin: 0 auto; background-color: #f8f8f8;">
            <div id="header" style="height: 130px;background:#ffe15c;">
                <img id="logo" src="https://kickash.ovh/media/logo/mainLogo.svg" alt="KickAsh logo" title="KickAsh logo" style="width: 80%;height:100%;margin: 0 10%;">
            </div>
            <div id="content" style="padding: 50px 20px;">
                <h1 style="color:#595250;font-size: 1.5rem; margin-bottom: 30px; font-family: sans-serif;">Te damos la bienvenida.</h1>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Muchas gracias por registrarte. ¡Es genial tenerte con nosotros!</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">Tu correo de inicio de sesión es: ' . $email . '</p>
                <p style="color:#595250;font-size: 1.1rem; line-height: 2; font-family: sans-serif;">¡Ya puedes iniciar sesión y crear espacios sin humos! ¿Vamos a la web?</p>
                <a id="ancla" href="https://kickash.ovh" style="text-align: center; text-decoration: none; color: #dd9ba9; font-weight: bold; display: block; font-family: sans-serif; font-size: 1.2rem;">KickAsh.ovh</a>
                <div style="text-align:center; margin-top:20px;"><img src="https://kickash.ovh/media/logo/main.svg" style="width:250px;"/></div>
            </div>
            <div id="footer" style=" text-align: center; padding: 10px 0; font-size: 12px; font-weight: 600;">
                <p style="color:#595250;font-size: 1.1rem; font-family: sans-serif;">Síguenos en nuestras redes sociales</p>
                <table style="width:100%; padding: 0 95px;">
                    <tr>
                        <td style="text-align: center;">
                            <a href="https://www.facebook.com/profile.php?id=61562944147734&locale=es_ES">
                                <img width="40px" src="https://descalcitos.es/pictures/facebook.PNG">
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="https://www.instagram.com/descalcitos_calzado/">
                                <img width="40px" src="https://descalcitos.es/pictures/instagram.PNG">
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="#">
                                <img width="40px" src="https://descalcitos.es/pictures/tiktok.PNG">
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
require_once '../../config/PHPMailer/config.php';