<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= "Authentification | " . $settings->getSetting('title') ?? "Authentification" ?></title>
    <meta name="Description" content="<?= $settings->getSetting('description') ?? "Authentification" ?>">
    <link rel="stylesheet" href="/dist/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/images/<?= $settings->getSetting('favicon') ?? 'favicon.png' ?>">
</head>

<body onload="highlightButton()">
    <?php include $this->view . ".view.php"; ?>

</body>

</html>