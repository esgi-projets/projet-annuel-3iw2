<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Validator;
use App\Core\View;
use App\Model\Settings as SettingsModel;

class Settings
{
  public function form()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $settings = new SettingsModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $_POST['email_grant'] = NULL;
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
              $find = $settings->find('name', 'logo', SettingsModel::class);

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
              $find = $settings->find('name', 'favicon', SettingsModel::class);

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
              $find = $settings->find('name', 'background', SettingsModel::class);

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
          $view = new View("admin-shop", "back");
          $view->assign("titleSeo", "Gestion de la boutique");
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("title", "Modifier les paramètres 🔧");
          $view->assign("titleSeo", "Modifier les paramètres");
          $view->assign("errorMessage", "Les paramètres n'ont pu être enregistrés pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }


        foreach ($_POST as $key => $value) {
          $find = $settings->find('name', $key, SettingsModel::class);

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

        $view = new View("admin-shop", "back");
        $view->assign("titleSeo", "Gestion de la boutique");
        $view->assign("user", $user);
        $view->assign("success", true);
        $view->assign("settings", $settings);
        $view->assign("successMessage", "Les paramètres ont bien été enregistrés.");
        return;
      }
      $view = new View("admin-shop", "back");
      $view->assign("titleSeo", "Gestion de la boutique");
      $view->assign("user", $user);
      $view->assign("settings", $settings);
    } else {
      header("Location: /dashboard");
      exit;
    }
  }
}
