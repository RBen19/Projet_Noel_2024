

<?php

    use controllers\AnimalController;
    use controllers\EquipmentController;

    require_once '../app/config/bootstrap.php';
    require_once '../app/src/controllers/EquipmentController.php';
    require_once '../app/src/controllers/AnimalController.php';
    require_once '../app/src/models/Equipements.php';
    require_once '../app/src/models/Animal.php';

    $loader = new \Twig\Loader\FilesystemLoader('../app/src/views/equipements');

    $loader2 = new \Twig\Loader\FilesystemLoader('../app/src/views/animals');

    $twig = new \Twig\Environment($loader);

    $twig2 = new \Twig\Environment($loader2);

    $EquipementModel = new Equipements();
    $EquipementController = new EquipmentController($EquipementModel);
    $AnimalModel = new Animal();
    $AnimalController = new AnimalController($EquipementModel, $AnimalModel);


    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if($_GET['action'] == 'addEqpView') {
            $EquipementController->CallViewCreateEquipment();
        }
        if($_GET['action'] == 'addEqp') {
            $EquipementController->createEquipement();
        }
        if($_GET['action'] == 'deleteEqp') {
            if( $AnimalController->countEqp($_GET['id'])==0){
                $EquipementController->removeEquipement();
            }else{

                echo "<script>
                      alert('cet Equipement est utilisé par des animaux impossible de le supprimer');
                  </script>";
            }
        }
        if ($_GET['action'] == 'indexEqp') {
            $EquipementController->index();
        }
        if($_GET['action'] == 'updateEqpView') {
            $EquipementController->CallViewUpdateEquipment();
        }
        if($_GET['action'] == 'UpdateEqp') {
            $EquipementController->updateEquipementController();
        }
        if($_GET['action'] == 'addAnimalView') {
            $AnimalController->CallViewCreateAnimal();
        }
        if ($_GET['action'] == 'addAnimal') {
            $AnimalController->createAnimal();
        }
        if ($_GET['action'] == 'indexAnimal') {
            $AnimalController->indexAnimal();
        }
        if ($_GET['action'] == 'deleteAnimal') {
            $AnimalController->removeAnimal();
        }
        if($_GET['action'] == 'updateAnimalView') {
            $AnimalController->CallViewUpdateAnimal();
        }
        if ($_GET['action'] == 'UpdateAnimal') {
            $AnimalController->updateAnimalController();
        }
    }else{
        $EquipementController->index();
       // $count = $AnimalController->countEqp(1);
       // print_r($count);
       // print_r($EquipementController->beforeDel(1));
        //echo"tab";
    }
