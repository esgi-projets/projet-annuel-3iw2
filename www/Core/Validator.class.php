<?php

namespace App\Core;

class Validator
{
    public static function run($config, $data): array
    {
        $result = [];
        $model = isset($config['config']['model']) ? new $config['config']['model'] : null;

        if (count($data) != count($config["inputs"])) {
            $result[] = "Formulaire modifié par l'utilisateur";
        }
        foreach ($config["inputs"] as $name => $input) {
            $data[$name] = Validator::sanitize($data[$name]);

            if (!isset($data[$name])) {
                $result[] = "Il manque des champs";
            }
            if (!empty($input["required"]) && empty($data[$name])) {
                $result[] = "Modification du formulaire détectée";
            }

            if (!empty($input["unicity"]) && !empty($data[$name])) {
                $find = $model->find($name, $_POST[$name], get_class($model));
                if (!empty($find) && $find->getId() != $data['id']) {
                    $result[] = $input["errorUnicity"];
                }
            }

            if ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                $result[] = "Le mot de passe doit contenir au moins 8 caractères dont au moins une majuscule, une minuscule et un chiffre";
            } else if ($input["type"] == "email"  && !self::checkEmail($data[$name])) {
                $result[] = "L'adresse e-mail semble incorrecte";
            }
        }
        return $result;
    }

    public static function checkPassword($pwd): bool
    {
        return strlen($pwd) >= 8
            && preg_match('/[A-Z]/', $pwd)
            && preg_match('/[a-z]/', $pwd)
            && preg_match('/[0-9]/', $pwd);
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function sanitizeArray($data)
    {
        $data = array_map(function ($item) {
            return Validator::sanitize($item);
        }, $data);
        return $data;
    }
}
