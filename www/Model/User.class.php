<?php

namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    protected $id = null;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $avatar;
    protected $status;
    protected $role = 'user';
    protected $token = null;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): object
    {
        $this->id = $id;
        parent::populate();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return mixed
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return mixed
     */
    public function getAvatar(): string
    {
        return "/assets/images/profiles/" . $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function getFormattedRole(): string
    {
        switch ($this->role) {
            case 'admin':
                return 'Administrateur';
                break;
            case 'user':
                return 'Utilisateur';
                break;
            default:
                return 'Utilisateur';
                break;
        }
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param null
     * Token char 32
     */
    public function generateToken(): void
    {
        $this->token = str_shuffle(md5(uniqid()));
    }

    public function getFormRegister(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "register",
                "submit" => "S'inscrire",
                "class" => "w-100",
                "model" => get_class($this)
            ],
            "inputs" => [
                "firstname" => [
                    "name" => "Prénom",
                    "type" => "text",
                    "placeholder" => "John",
                    "id" => "firstname",
                    "class" => "input w-100",
                    "min" => 2,
                    "max" => 50,
                    "required" => true,
                    "error" => "Votre prénom semble incorrect",
                ],
                "lastname" => [
                    "name" => "Nom de famille",
                    "type" => "text",
                    "placeholder" => "Doe",
                    "id" => "lastname",
                    "class" => "input w-100",
                    "min" => 2,
                    "max" => 100,
                    "required" => true,
                    "error" => "Votre nom de famille semble incorrect",
                ],
                "email" => [
                    "name" => "Adresse e-mail",
                    "type" => "email",
                    "placeholder" => "john@doe.com",
                    "id" => "email",
                    "class" => "input w-100",
                    "required" => true,
                    "error" => "L'adresse email est invalide",
                    "unicity" => true,
                    "errorUnicity" => "L'adresse e-mail a déjà été utilisée"
                ],
                "password" => [
                    "name" => "Mot de passe",
                    "type" => "password",
                    "id" => "password",
                    "class" => "input w-100",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire entre 8 et 16 et contenir des chiffres et des lettres",
                ],
            ]

        ];
    }

    public function getFormProfile(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Modifier",
                "class" => "w-100",
                "model" => get_class($this)
            ],
            "inputs" => [
                "firstname" => [
                    "name" => "Prénom",
                    "type" => "text",
                    "placeholder" => "John",
                    "id" => "firstname",
                    "class" => "input w-100",
                    "min" => 2,
                    "max" => 50,
                    "required" => true,
                    "error" => "Votre prénom semble incorrect",
                ],
                "lastname" => [
                    "name" => "Nom de famille",
                    "type" => "text",
                    "placeholder" => "Doe",
                    "id" => "lastname",
                    "class" => "input w-100",
                    "min" => 2,
                    "max" => 100,
                    "required" => true,
                    "error" => "Votre nom de famille semble incorrect",
                ],
                "email" => [
                    "name" => "Adresse e-mail",
                    "type" => "email",
                    "placeholder" => "john@doe.com",
                    "id" => "email",
                    "class" => "input w-100",
                    "required" => true,
                    "error" => "L'adresse email est invalide",
                    "unicity" => true,
                    "errorUnicity" => "L'adresse e-mail a déjà été utilisée"
                ],
                "password" => [
                    "name" => "Ancien mot de passe",
                    "type" => "password",
                    "id" => "old_password",
                    "class" => "input w-100",
                    "required" => false
                ],
                "password_new" => [
                    "name" => "Nouveau mot de passe",
                    "type" => "password",
                    "id" => "password",
                    "class" => "input w-100",
                    "required" => false,
                    "error" => "Votre mot de passe doit faire entre 8 et 16 et contenir des chiffres et des lettres",
                ],
                "id" => [
                    "name" => "id",
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "input w-100",
                    "required" => true,
                    "error" => "Votre id semble incorrect",
                ],
            ]
        ];
    }


    public function getFormLogin(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "login",
                "submit" => "Se connecter",
                "class" => "w-100",
                "model" => $this
            ],
            "inputs" => [
                "email" => [
                    "name" => "E-mail",
                    "type" => "email",
                    "placeholder" => "mail@exemple.com",
                    "id" => "email",
                    "class" => "input w-100",
                    "required" => true,
                ],
                "password" => [
                    "name" => "Mot de passe",
                    "type" => "password",
                    "id" => "password",
                    "class" => "input w-100",
                    "placeholder" => "",
                    "required" => true,
                ]
            ]

        ];
    }

    public function getFormReset(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "reset",
                "submit" => "Envoyer le lien",
                "class" => "w-100",
                "model" => $this
            ],
            "inputs" => [
                "email" => [
                    "name" => "E-mail",
                    "type" => "email",
                    "placeholder" => "mail@exemple.com",
                    "id" => "email",
                    "class" => "input w-100",
                    "required" => true,
                ]
            ]

        ];
    }

    public function getFormResetPassword($token = null): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Réinitialiser le mot de passe",
                "class" => "w-100",
                "model" => $this
            ],
            "inputs" => [
                "token" => [
                    "type" => "hidden",
                    "id" => "token",
                    "value" => $token,
                    "required" => true,
                ],
                "password" => [
                    "name" => "Mot de passe",
                    "type" => "password",
                    "id" => "password",
                    "class" => "input w-100",
                    "placeholder" => "Le mot de passe doit contenir au moins 8 caractères dont au moins une majuscule, une minuscule et un chiffre.",
                    "required" => true,
                ]
            ]

        ];
    }
}
