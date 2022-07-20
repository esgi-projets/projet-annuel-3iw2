<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo . ' | ' . $settings->getSetting('title') ?? 'Template du front' ?></title>
    <meta name="Description" content="Ceci est la description de ma page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/styles.css">
    <link rel="icon" type="image/x-icon" href="/assets/images/<?= $settings->getSetting('favicon') ?? 'favicon.png' ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="row">
        <?php
        include "front-menu.view.php";
        include 'front-menu-mobile.view.php'; ?>
        <div class="front col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
            <?php include $this->view . ".view.php"; ?>
        </div>
    </div>

</body>

</html>