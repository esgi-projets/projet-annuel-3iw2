<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Migration;
use App\Core\Validator;
use App\Core\View;
use App\Model\Settings;

class Installer
{
  public function isInstalled()
  {
    if (empty($_ENV['DB_DRIVER']) && empty($_ENV['DB_HOST']) && empty($_ENV['DB_PORT']) && empty($_ENV['DB_NAME']) && empty($_ENV['DB_USER']) && empty($_ENV['DB_PWD'])) {
      return false;
    }

    $settings = new Settings();

    if ($settings->getSetting("installed") != "true") {
      return false;
    }


    return true;
  }

  public function checkIfInstalled()
  {
    if (empty($_ENV['DB_DRIVER']) && empty($_ENV['DB_HOST']) && empty($_ENV['DB_PORT']) && empty($_ENV['DB_NAME']) && empty($_ENV['DB_USER']) && empty($_ENV['DB_PWD'])) {
      $this->step1();
      return;
    }

    $settings = new Settings();

    if ($settings->getSetting("installed") == "true") {
      header("Location: /");
      exit;
    }

    $this->step2();
  }

  public function step1()
  {
    if (!empty($_POST)) {
      $results = [];
      if (empty($_POST['dbengine']) || empty($_POST['dbhost']) || empty($_POST['dbport']) || empty($_POST['dbname']) || empty($_POST['dbuser']) || empty($_POST['dbpass'])) {
        $results[] = "Tous les champs sont obligatoires";
      }

      try {
        $this->pdo = new \PDO($_POST['dbengine'] . ":host=" . $_POST['dbhost'] . ";port=" . $_POST['dbport'] . ";dbname=" . $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        fopen(".env", "w");

        file_put_contents(".env", "DB_DRIVER=" . $_POST['dbengine'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_HOST=" . $_POST['dbhost'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_PORT=" . $_POST['dbport'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_NAME=" . $_POST['dbname'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_USER=" . $_POST['dbuser'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_PWD=" . $_POST['dbpass'] . "\n", FILE_APPEND);
        file_put_contents(".env", "DB_PREFIX=" . $_POST['dbprefix'] . "\n", FILE_APPEND);

        $_ENV['DB_DRIVER'] = $_POST['dbengine'];
        $_ENV['DB_HOST'] = $_POST['dbhost'];
        $_ENV['DB_PORT'] = $_POST['dbport'];
        $_ENV['DB_NAME'] = $_POST['dbname'];
        $_ENV['DB_USER'] = $_POST['dbuser'];
        $_ENV['DB_PWD'] = $_POST['dbpass'];
        $_ENV['DB_PREFIX'] = $_POST['dbprefix'];

        $migrations = new Migration();
        $migrations->downMigrations(false);
        $migrations->applyMigrations(false);

        $view = new View("step2", "installer");
        $view->assign("titleSeo", "Installation - Etape 2");
      } catch (\Exception $e) {
        $results[] = "Une erreur est survenue lors de la connexion à la base de données : " . $e->getMessage();
      }

      if ($results) {
        $view = new View("step1", "installer");
        $view->assign("titleSeo", "Installation - Etape 1");
        $view->assign("error", true);
        $view->assign("errorMessage", "Lors de la validation des données, des erreurs ont été détectées :");
        $view->assign("listErrors", $results);
      }
      return;
    }

    $view = new View("step1", "installer");
    $view->assign("titleSeo", "Installation - Etape 1");
  }

  public function step2()
  {
    if (!empty($_POST)) {
      $settings = new Settings();
      if (isset($_POST['allow_reviews']) && $_POST['allow_reviews'] === "on") {
        $_POST['allow_reviews'] = 1;
      } else {
        $_POST['allow_reviews'] = 'NULL';
      }

      if (isset($_POST['visibility_search_engine']) && $_POST['visibility_search_engine'] === "on") {
        $_POST['visibility_search_engine'] = 1;
      } else {
        $_POST['visibility_search_engine'] = 'NULL';
      }

      $result = Validator::run($settings->getFormSettings(), $_POST);

      if ($_FILES['logo']['error'] !== 4) {
        $uploaddir = './View/assets/images/';
        $uploadname = 'logo.' . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $uploadname;

        if ($_FILES['logo']['size'] < 2000 * 1024) {
          if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
            $find = $settings->find('name', 'logo', Settings::class);

            if ($find) {
              $find->setValue($uploadname);
              $find->save();
            } else {
              $settings->setSetting('logo', $uploadname);
              $settings->save();
            }
          } else {
            $result[] = "L'upload de l'image a échoué";
          }
        } else {
          $result[] = "L'image est trop volumineuse (2Mo maximum)";
        }
      }

      if ($_FILES['favicon']['error'] !== 4) {
        $uploaddir = './View/assets/images/';
        $uploadname = 'favicon.' . pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $uploadname;

        if ($_FILES['favicon']['size'] < 2000 * 1024) {
          if (move_uploaded_file($_FILES['favicon']['tmp_name'], $uploadfile)) {
            $find = $settings->find('name', 'favicon', Settings::class);

            if ($find) {
              $find->setValue($uploadname);
              $find->save();
            } else {
              $settings->setSetting('favicon', $uploadname);
              $settings->save();
            }
          } else {
            $result[] = "L'upload de l'image a échoué";
          }
        } else {
          $result[] = "L'image est trop volumineuse (2Mo maximum)";
        }
      }

      if ($_FILES['background']['error'] !== 4) {
        $uploaddir = './View/assets/images/';
        $uploadname = 'background.' . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $uploadname;

        if ($_FILES['background']['size'] < 2000 * 1024) {
          if (move_uploaded_file($_FILES['background']['tmp_name'], $uploadfile)) {
            $find = $settings->find('name', 'background', Settings::class);

            if ($find) {
              $find->setValue($uploadname);
              $find->save();
            } else {
              $settings->setSetting('background', $uploadname);
              $settings->save();
            }
          } else {
            $result[] = "L'upload de l'image a échoué";
          }
        } else {
          $result[] = "L'image est trop volumineuse (2Mo maximum)";
        }
      }

      if ($result) {
        $view = new View("step2", "installer");
        $view->assign("titleSeo", "Installation - Etape 2");
        $view->assign("error", true);
        $view->assign("errorMessage", "Les paramètres n'ont pu être enregistrés pour les raisons suivantes :");
        $view->assign("listErrors", $result);
        return;
      }

      foreach ($_POST as $key => $value) {
        $find = $settings->find('name', $key, Settings::class);

        if ($find) {
          if ($key === "stripe_private_key") {
            if ($value !== "********************") {
              $find->setValue($value);
              $find->save();
            }
          } else {
            $find->setValue($value);
            $find->save();
          }
        } else {
          $settings->setSetting($key, $value);
          $settings->save();
        }
      }

      $settings->setSetting('installed', "true");
      $settings->save();

      $this->step3();
      return;
    }

    $view = new View("step2", "installer");
    $view->assign("titleSeo", "Installation - Etape 2");
  }

  public function step3()
  {
    $view = new View("step3", "installer");
    $view->assign("titleSeo", "Installation - Finalisation");
  }
}
