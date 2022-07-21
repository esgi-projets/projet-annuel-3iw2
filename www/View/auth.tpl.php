<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= "Authentification | " . $settings->getSetting('title') ?? "Authentification" ?></title>
    <meta name="Description" content="<?= $settings->getSetting('description') ?? "Authentification" ?>">
    <link rel="stylesheet" href="/dist/styles.css">
</head>

<body onload="highlightButton()">
    <?php include $this->view . ".view.php"; ?>

</body>

</html>