<?php 
require './_app/Config.inc.php';  ?>
<!DOCTYPE html>

<html>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $pg_name; ?></title>
        <meta name="description" content="<?= $pg_desc ?>">
        <meta http-equiv="content-language" content="pt" />
        <meta name="author" content="">
        <meta name="keywords" content="<?= $pg_keywords ?>">
        <meta property="og:title" content=" <?= $pg_name ?>" />
        <meta property="og:type" content="Internet" />
        <meta property="og:url" content="<?= HOME ?>" />
        <link rel="alternate" href="<?= HOME ?>" hreflang="pt-br" />
        <link rel="stylesheet" type="text/css" href="<?= REQUIRE_PATH ?>/css/carrousel.css">
        <link rel="stylesheet" type="text/css" href="<?= REQUIRE_PATH ?>/css/header.css">
        <link rel="stylesheet" type="text/css" href="<?= REQUIRE_PATH ?>/css/login.css">
        <link rel="stylesheet" type="text/css" href="<?= REQUIRE_PATH ?>/css/reset.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">


        <!-- Google analitcs -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-17457777-3"></script>
        <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                        dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', '<?= $pg_google_analitics; ?>');
        </script>


        <style>
                .ie-panel {
                        display: none;
                        background: #212121;
                        padding: 10px 0;
                        box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
                        clear: both;
                        text-align: center;
                        position: relative;
                        z-index: 1;
                }

                html.ie-10 .ie-panel,
                html.lt-ie-10 .ie-panel {
                        display: block;
                }
        </style>
</head>


<body>
        
        
        <?php
        $Url[1] = (empty($Url[1]) ? null : $Url[1]);
        if (file_exists(REQUIRE_PATH . '/' . $Url[0] . '.php')) :
                require REQUIRE_PATH . '/' . $Url[0] . '.php';
        elseif (file_exists(REQUIRE_PATH . '/' . $Url[0] . '/' . $Url[1] . '.php')) :
                require REQUIRE_PATH . '/' . $Url[0] . '/' . $Url[1] . '.php';
        else :
                require REQUIRE_PATH . '/404.php';
        endif;
        ?>
        <!-- Rodapé -->


</body>


</html>