<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titleSeo . ' | ' . $settings->getSetting('title') ?? 'Template du back' ?></title>
    <meta name="description" content="ceci est la description de ma page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/styles.css">
    <link rel="icon" type="image/x-icon" href="/assets/images/<?= $settings->getSetting('favicon') ?? 'favicon.png' ?>">
    <script src="https://cdn.tiny.cloud/1/pav5g98o090khpnxooh9msgp55nbp9tfvzyt79hblmwtq2io/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body onload="highlightButton()">

    <div class="row">
        <?php
        include 'back-menu.view.php';
        ?>
        <div class="col-9-xl col-12-lg col-12-md col-12-sm col-12-xs">
            <div class="row">
                <?php

                include 'back-menu-mobile.view.php';

                include $this->view . ".view.php";
                ?>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough forecolor backcolor removeformat | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %d/%m/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %d/%m/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h1 h2 h3 blockquote quickimage quicktable',
            contextmenu: 'link image table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });

        $(document).ready(function() {
            $('.file').on('change', function(evt) {
                const input = evt.currentTarget;
                var file = $(this).val();
                var filename = file.split('\\').pop();
                $(this).siblings('#text').text('Fichier chargé : ' + filename);
            });
        });
    </script>
</body>

</html>