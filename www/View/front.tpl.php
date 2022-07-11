<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo ?? "Template du front" ?></title>
    <meta name="Description" content="Ceci est la description de ma page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/styles.css">
</head>

<body>
    <?php include "front-menu.view.php"; ?>
    <div class="front">
        <?php include $this->view . ".view.php"; ?>
    </div>
</body>

</html>