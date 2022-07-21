<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title><?= $titleSeo ?? "Installeur" ?></title>
  <meta name="Description" content="Ceci est la description de ma page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/dist/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="bg-white">
  <header>
    <div class="row">
      <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-8 row">
        <div>
          <h1 class="" style="font-size: 48px;">Bienvenue</h1>
          <div class="bg-primary h-10 w-75 ml-28"></div> <!-- line under welcome -->
        </div>
        <div class="row hidden-under-md ml-auto mr-3">
          <a href="https://github.com/esgi-projets/projet-annuel-3iw2" class="button button-link button-icon mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            Consulter la documentation</a>
        </div>
      </div>
    </div>

    <style type="text/css">
      .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #A7F3D0;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
      }

      .checkmark {
        width: 128px;
        height: 128px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #065F46;
        stroke-miterlimit: 10;
        margin: 1% auto;
        box-shadow: inset 0px 0px 0px #A7F3D0;
        animation: fill 0.4s ease-in-out 0.4s forwards,
          scale 0.3s ease-in-out 0.9s both;
      }

      .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
      }

      @keyframes stroke {
        100% {
          stroke-dashoffset: 0;
        }
      }

      @keyframes scale {

        0%,
        100% {
          transform: none;
        }

        50% {
          transform: scale3d(1.1, 1.1, 1);
        }
      }

      @keyframes fill {
        100% {
          box-shadow: inset 0px 0px 0px 80px #A7F3D0;
        }
      }
    </style>
  </header>

  <div class="row">
    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-12">
      <?php include $this->view . ".view.php"; ?>
    </div>
  </div>

  <script>
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