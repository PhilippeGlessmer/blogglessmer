<?php

class Categories
{
    public $id;
    public $name;
    /**
     * Categories constructor.
     * @param $id
     */
    function __construct($id) {
        global $db;
        $id = str_secur($id);
        $reqCategory = $db->fetch('SELECT * FROM articles__categories WHERE idCategorie = ?', [$id], false);
        $data = $reqCategory;
        $this->idCategorie = $data['idCategorie'];
        $this->nameCategorie = $data['nameCategorie'];
    }
    /**
     * Envoie de toutes les catégories
     * @return array
     */
    static function getAllCategories() {
        global $db;
        $reqCategories = $db->fetch('SELECT * FROM articles__categories', [], true);
        return $reqCategories;
    }

    /**
     * Ajouter une Catégorie
     * @param $newCategory
     */
    static function addCategorie($newCategory) {
        global $db;
        if($newCategory) {
            $reqCategorie = $db->execute("INSERT INTO articles__categories SET nameCategorie = ?", [
                $newCategory
            ]);
            header('location: ' . WEBSITE_URL . '/articles/addarticle/');
        }

    }
}