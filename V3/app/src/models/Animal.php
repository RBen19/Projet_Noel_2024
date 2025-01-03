<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'animal')]
class Animal
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $idAnimal;
    #[ORM\Column(type: 'string')]
    private string $typeA;
    #[ORM\Column(type: 'string')]
    private string $sante;
    #[ORM\Column(type: 'float')]
    private int $age;
    #[ManyToOne(targetEntity: Equipements::class, inversedBy: 'Animals')]
    #[JoinColumn(name: 'equipements_id', referencedColumnName: 'idEqp')]
    private ?Equipements $equipements = null;
    public function getIdAnimal():int{
        return $this->idAnimal;
    }
    public function getTypeA():string{
        return $this->typeA;
    }
    public function getSante():string{
        return $this->sante;
    }
    public function getAge():float{
        return $this->age;
    }
    public function getEquipements():Equipements{
        return $this->equipements;
    }
    public function setTypeA(string $typeA):void{
        $this->typeA = $typeA;
    }
    public function setSante(string $sante):void{
        $this->sante = $sante;
    }
    public function setAge(float $age):void{
        $this->age = $age;
    }
    public function setEquipements(Equipements $equipements):void{
        $this->equipements = $equipements;
    }
    /**
     * Enregistre un nouvel animal dans la base de données en utilisant l'entityManager.
     *
     * @param array $data Un tableau associatif (tableau super global $_POST) contenant les données de l'animal :
     *     - 'typeA' : Le type d'animal.
     *     - 'sante' : L'état de santé de l'animal.
     *     - 'age' : L'âge de l'animal.
     *     - 'idEqp' : L'identifiant de l'équipement associé à l'animal.
     *
     * @return void
     */
    public function saveAnimal($data){
        global $entityManager;
        extract($data);
        $animal = new Animal();
        $animal->setTypeA($typeA);
        $animal->setSante($sante);
        $animal->setAge($age);
        $idEquipement = $idEqp;
        $equipement = $entityManager->find(Equipements::class, $idEquipement);
        $animal->setEquipements($equipement);
        $entityManager->persist($animal);
        $entityManager->flush();
    }
    /**
     * Récupère la liste de tous les animaux et retourne un tableau contenant les enregistrements.
     *
     * @return array Un tableau d'objets Animal.
     */
    public function readAnimal(){
        global $entityManager;
        return  $animal = $entityManager->getRepository(Animal::class)->findAll();
    }
    /**
     * Récupère un animal spécifique à partir de son identifiant.
     *
     * @param int $id L'identifiant de l'animal.
     *
     * @return Animal|null L'objet Animal correspondant à l'identifiant, ou NULL si l'animal n'est pas trouvé.
     */
    public function readOneAnimal($id){
        global $entityManager;
        return  $animal = $entityManager->find(Animal::class, $id);
    }
    /**
     * Supprime un animal de la base de données.
     *
     * @param int $id L'identifiant de l'animal à supprimer.
     *
     * @return void
     */
    public function deleteAnimal($id){
        global $entityManager;
        $animal = $entityManager->find(Animal::class, $id);
        $entityManager->remove($animal);
        $entityManager->flush();
    }
    /**
     * Met à jour les informations d'un animal existant en le recherchant grâce à son identifiant.
     *
     * @param array $data Un tableau associatif contenant les données de l'animal :
     *     - 'idA' : L'identifiant de l'animal.
     *     - 'typeA' : Le nouveau type d'animal.
     *     - 'sante' : Le nouvel état de santé de l'animal.
     *     - 'age' : Le nouvel âge de l'animal.
     *     - 'idEqp' : L'identifiant de l'équipement associé à l'animal.
     *
     * @return void
     */
    public function updateAnimal($data){
        global $entityManager;
        extract($data);
        $animal = $entityManager->find(Animal::class, $idA);
        $animal->setTypeA($typeA);
        $animal->setSante($sante);
        $animal->setAge($age);
        $idEquipement = $idEqp;
        $Equipement = $entityManager->find(Equipements::class, $idEquipement);
        $animal->setEquipements($Equipement);
        $entityManager->flush();
    }
    public function countEquipementsAnimal($id)
    {
        global $entityManager;
        $Animal = $entityManager->getRepository(Animal::class)->findBy(['equipements' => $id]);
        return count($Animal);

    }
}