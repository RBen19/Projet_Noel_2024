<?php

namespace controllers;

class AnimalController
{
    private $EqpModel;
    private $AnimalModel;
    /**
     * Constructeur de la classe.
     *
     * @param object $EqpModel Le modèle d'équipement.
     * @param object $Animal Le modèle d'animal.
     */
    public function __construct($EqpModel, $AnimalModel){
        $this->EqpModel = $EqpModel;
        $this->AnimalModel = $AnimalModel;
    }
    /**
     * Redirige vers la page d'index des animaux.
     *
     * Cette fonction utilise la fonction `header()` de PHP pour rediriger
     * l'utilisateur vers l'index.
     */
    function HeaderLocationIndex(){
        header("location:/public/?action=indexAnimal");
    }
    /**
     * Affiche la vue de création d'un animal.
     *
     * Cette fonction utilise le moteur de template Twig pour
     * rendre le template "create.html.twig" et l'afficher.
     * Elle transmet également une liste d'équipements
     * au template pour les utiliser dans le formulaire de création.
     *
     * @return void
     */
    function CallViewCreateAnimal(){
        global  $twig2;
       $listEqp= $this->EqpModel->readEquipement();
       echo $twig2->render("create.html.twig", ["listEqp"=>$listEqp]);
    }
    /**
     * Crée un nouvel animal.
     *
     * Cette fonction extrait les données du formulaire de création d'animal
     * à partir de la variable superglobale `$_POST`, les transmet au modèle d'animal
     * pour les enregistrer en base de données, puis redirige vers la page
     * index.
     *
     * @return void
     */
    function createAnimal(){
        extract($_POST);
        $this->AnimalModel->saveAnimal($_POST);
        $this->HeaderLocationIndex();
    }
    /**
     * Affiche la liste des animaux.
     *
     * Cette fonction récupère la liste des animaux à partir du modèle d'animal,
     * puis utilise le moteur de template Twig pour rendre le template
     * "index.html.twig" et l'afficher, en transmettant la liste des animaux
     * au template.
     *
     * @return void
     */
    function indexAnimal(){
        global  $twig2;
        $listA = $this->AnimalModel->readAnimal();
        echo $twig2->render("index.html.twig", ["listA"=>$listA]);
    }
    /**
     * Supprime un animal.
     *
     * Cette fonction récupère l'identifiant de l'animal à supprimer
     * à partir de la requête GET, appelle le modèle pour supprimer
     * l'animal en base de données, puis redirige vers la page
     * index.
     *
     * @return void
     */
    function removeAnimal(){
       $id= $_GET["id"];
       $this->AnimalModel->deleteAnimal($id);
       $this->HeaderLocationIndex();

    }
    /**
     * Affiche la vue de mise à jour d'un animal.
     *
     * Cette fonction récupère l'identifiant de l'animal à mettre à jour
     * à partir de la requête GET, récupère les informations de l'animal
     * correspondant à partir du modèle, récupère également la liste
     * des équipements, puis utilise le moteur de template Twig pour
     * rendre le template "edit.html.twig" et l'afficher, en transmettant
     * les données nécessaires au template.
     *
     * @return void
     */
    function CallViewUpdateAnimal(){
        global  $twig2;
        $idA= $_GET["id"];
        $animal= $this->AnimalModel->readOneAnimal($idA);
        $listEqp= $this->EqpModel->readEquipement();
        echo $twig2->render("edit.html.twig", ["animal"=>$animal, "listEqp"=>$listEqp]);
    }
    /**
     * Met à jour les informations d'un animal.
     *
     * Cette fonction extrait les données du formulaire de mise à jour
     * d'animal à partir de la  variable superglobale `$_POST`, les transmet
     * au modèle d'animal pour mettre à jour l'enregistrement
     * en base de données, puis redirige vers la page index.
     *
     * @return void
     */
    function updateAnimalController(){
        extract($_POST);
        $this->AnimalModel->updateAnimal($_POST);
        $this->HeaderLocationIndex();
    }
    function countEqp($idEqp){
      return $count =$this->AnimalModel->countEquipementsAnimal($idEqp);
    }
}