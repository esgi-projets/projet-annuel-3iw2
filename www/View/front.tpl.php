<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo ?? "Template du front" ?></title>
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" href="/dist/styles.css">
</head>

<body onload="highlightButton()">

    <?php include $this->view . ".view.php"; ?>

</body>

</html>