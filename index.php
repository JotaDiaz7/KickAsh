<?php ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('./structure/head.php') ?>
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/index.css">
    <script type="module" src="/js/index.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <main class="flex">
            <div class="logoWrap center column">
                <div class="imgWrap">
                    <img src="./media/logo/main.png" alt="Logo KiskAsh" title="Logo KiskAsh" />
                    <h1>kickash</h1>
                </div>
            </div>
            <div class="formWrap center column">
                <?php include_once('./templates/login.php') ?>
                <?php include_once('./templates/alert.php') ?>
            </div>
        </main>
        <?php include_once('./structure/footer.php') ?>
    </section>
</body>

</html>