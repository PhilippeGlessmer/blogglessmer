<?php

class Users
{

    // les constantes - variable
    public $idUser;
    public $mailUser;
    public $passwordUser;
    public $firstnameUser;
    public $lastnameUser;
    public $datebirthUser;
    public $rangUser;
    public $createUser;



    /**
     * Authors constructor.
     * @param $id
     */
    function __construct($id) {

        global $db;

        $id = str_secur($id);

        $reqUser = $db->fetch('SELECT * FROM users WHERE idUser = ?', [$id], false);
        $data = $reqUser;

        $this->idUser = $id;
        $this->mailUser = $data['mailUser'];
        $this->passwordUser = $data['passwordUser'];
        $this->firstnameUser = $data['firstnameUser'];
        $this->lastnameUser = $data['lastnameUser'];
        $this->datebirthUser = $data['datebirthUser'];
        $this->rangUser = $data['rangUser'];
        $this->createUser = $data['createUser'];

    }


    /**
     * Envoie de tous les auteurs / Users
     * @return array
     */
    static function getAllAuthors() {

        global $db;

        $reqAuthors = $db->fetch('SELECT * FROM users', [], true);
        return $reqAuthors;

    }

    /**
     * Login
     * @param $mailUser
     * @param $passwordUser
     * Nouvelle fonctionnalité password verify au lieu du md5
     */
    static function login($mailUser, $passwordUser){
        // Comparaison du pass envoyé via le formulaire avec la base
        global $db;
        if($mailUser){
            $reqUser = $db->fetch('SELECT * FROM users WHERE mailUser=?', [$mailUser], false);
            $data = $reqUser;
            $isPasswordCorrect = password_verify($passwordUser, $data['passwordUser']);
            if($isPasswordCorrect){
                $_SESSION['auth'] =$data;
                header('location: '.WEBSITE_URL);
            }
        }
    }

    /**
     * Vérifie si l'user exist par le mail
     * @param $mailUser
     * @return array|mixed
     */
    static function userverif($mailUser){

        global $db;
        $reqUser = $db->fetch('SELECT * FROM users WHERE mailUser = ?', [$mailUser], false);
        return $data;
    }

    /**
     * Enregistrement de l'utilisateur
     * @param $mailUser
     * @param $passwordUser
     * @param $firstnameUser
     * @param $lastnameUser
     * @param $datebirthUser
     */
    static function registerUser($mailUser, $passwordUser, $firstnameUser, $lastnameUser, $datebirthUser){
        global $db;
        if($mailUser) {
            // Hachage du mot de passe
            $pass_hache = password_hash($passwordUser, PASSWORD_DEFAULT);
            $verification = self::userverif($mailUser);
            if (!$verification) {
                $reqUser = $db->execute("INSERT INTO users SET mailUser = ?, passwordUser = ?, firstnameUser=?, lastnameUser=?, datebirthUser=?", [
                    $mailUser,
                    $pass_hache,
                    $firstnameUser,
                    $lastnameUser,
                    $datebirthUser
                ]);
                header('location: ' . WEBSITE_URL . '/users/login/');
            }
        }
    }

    /**
     * Verifie que l'on est bien un administrateur
     * @param $id
     */
    static function adminVerif($id)
    {
        $verif = new Users($id);
        if($verif->rangUser != 10)
            header('location: '.WEBSITE_URL);
    }
}