<?php

namespace controllers;
class EquipmentController
{
    private $equipmentModel;
    /**
     * Constructeur de la classe.
     *
     * Ce constructeur injecte une dépendance au modèle d'équipement.
     *
     * @param object $equipmentModel Une instance du modèle d'équipement.
     */
    function __construct($equipmentModel){
        $this->equipmentModel = $equipmentModel;
    }
    /**
     * Affiche la vue de création d'un équipement.
     *
     * Cette fonction utilise le moteur de templates Twig pour
     * rendre le template 'create.html.twig' et l'afficher.
     *
     * @return void
     */
    function CallViewCreateEquipment():void{
        global $twig;
        echo $twig->render('create.html.twig',[]);
    }
    /**
     * Affiche la liste des équipements.
     *
     * Cette fonction récupère la liste des équipements à partir du modèle d'équipement,
     * puis utilise le moteur de templates Twig pour rendre le template
     * "index.html.twig" et l'afficher, en transmettant la liste des équipements
     * au template.
     *
     * @return void
     */
    function index():void{
        global $twig;
        $list= $this->equipmentModel->readEquipement();
        echo $twig->render("index.html.twig",['list'=>$list]);
    }
    /**
     * Redirige vers la page d'accueil.
     *
     * Cette fonction utilise la fonction `header()` de PHP pour rediriger
     * l'utilisateur vers l'index.
     *
     * @return void
     */
    function HeaderLocationIndex(){
        header("location:/public/");
    }
    /**
     * Crée un nouvel équipement.
     *
     * Cette fonction extrait les données du formulaire de création d'équipement
     * à partir de la variable superglobale `$_POST`, les transmet au modèle d'équipement
     * pour les enregistrer en base de données, puis redirige vers la page index.
     *
     * @return void
     */
    function createEquipement():void{
        extract($_POST);
        $this->equipmentModel->saveEquipement($_POST);
        $this->HeaderLocationIndex();
    }
    /**
     * Supprime un équipement.
     *
     * Cette fonction récupère l'identifiant de l'équipement à supprimer
     * à partir de la requête GET, appelle le modèle pour supprimer
     * l'équipement en base de données, puis redirige vers index.
     *
     * @return void
     */
    function removeEquipement():void{
        $id=$_GET["id"];
        $this->equipmentModel->deleteEquipement($id);
        $this->HeaderLocationIndex();
    }
    /**
     * Affiche la vue de mise à jour d'un équipement.
     *
     * Cette fonction récupère l'identifiant de l'équipement à mettre à jour
     * à partir de la requête GET, récupère les informations de l'équipement
     * correspondant à partir du modèle, puis utilise le moteur de templates Twig
     * pour rendre le template "edit.html.twig" et l'afficher, en transmettant
     * les données nécessaires au template.
     *
     * @return void
     */
    function CallViewUpdateEquipment():void{
        global $twig;
        $id=$_GET["id"];
        $Eqp= $this->equipmentModel->getEquipementById($id);
        echo $twig->render("edit.html.twig",['Eqp'=>$Eqp]);
    }
    /**
     * Met à jour les informations d'un équipement.
     *
     * Cette fonction extrait les données du formulaire de mise à jour
     * d'équipement à partir de la variable superglobale `$_POST`, les transmet
     * au modèle d'équipement pour mettre à jour l'enregistrement
     * en base de données, puis redirige vers la page index.
     *
     * @return void
     */
    function updateEquipementController():void{
        extract($_POST);
        $this->equipmentModel->updateEquipement($_POST);
        $this->HeaderLocationIndex();
    }
   /*public function  beforeDel($id){
     $animaux= $this->equipmentModel->checkBeforeDeleteEquipement($id);
    // var_dump($animaux);
     return $animaux;
    }*/
    /**
     * Affiche une alert avec le message souhaité
     * @param string $Message
     * @return void
     */
    public function alert($Message)
    {
        echo "<script>
                      alert('$Message');
                  </script>";
    }
}
