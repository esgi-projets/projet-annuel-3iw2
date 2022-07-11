<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo ?? "Template page auth" ?></title>
    <meta name="Description" content="Ceci est la description de ma page">
    <link rel="stylesheet" href="/dist/styles.css">
</head>

<body onload="highlightButton()">
    <?php include $this->view . ".view.php"; ?>

</body>

</html>