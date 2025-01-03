<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity]
#[ORM\Table(name: 'equipements')]
class Equipements
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $idEqp;
    #[ORM\Column(type: 'string')]
    private string $nom;
    #[ORM\Column(type: 'string')]
    private string $etat;
    #[ORM\Column(type: 'string')]
    private string $disponibilite;
    #[OneToMany(targetEntity: Animal::class, mappedBy: 'Equipements')]
    private Collection $Animals;
    public function getId(): int{
        return $this->idEqp;
    }
    public function getNom(): string{
        return $this->nom;
    }
    public function getEtat(): string{
        return $this->etat;
    }
    public function getDisponibilite(): string{
        return $this->disponibilite;
    }
    public function getAnimals(): Collection
    {
        return $this->Animals;
    }
    public function setNom(string $nom): void{
        $this->nom = $nom;
    }
    public function setEtat(string $etat): void{
        $this->etat = $etat;
    }
    public function setDisponibilite(string $disponibilite): void{
        $this->disponibilite = $disponibilite;
    }
    public function __construct() {
        $this->Animals = new ArrayCollection();
    }
    /**
     * Enregistre un nouvel équipement en base de données.
     *
     * Cette fonction prend un tableau associatif contenant les informations de l'équipement
     * et l'enregistre dans la base de données à l'aide de Doctrine ORM.
     *
     * @param array $data Un tableau associatif contenant les informations de l'équipement :
     *     — Nom (string) : Le nom de l'équipement.
     *     — Etat (string) : L'état de l'équipement (par exemple, "neuf", "usagé").
     *     — Disponibilite string : Indique si l'équipement est disponible.
     *
     */
    function saveEquipement($data)
    {
        global $entityManager;
        extract($data);
        $Equipement = new Equipements();
        $Equipement->setNom($nom);
        $Equipement->setEtat($etat);
        $Equipement->setDisponibilite($disponibilite);
        $entityManager->persist($Equipement);
        $entityManager->flush();

    }
    /**
     * Récupère tous les équipements enregistrés.
     *
     * Cette fonction utilise le Repository Doctrine pour récupérer tous les
     * objets `Equipements` enregistrés en base de données.
     *
     * @return Equipements[] Un tableau d'objets `Equipements`.
     */
    function readEquipement()
    {
        global $entityManager;
        $EqpRepository = $entityManager->getRepository(Equipements::class);
        $eqps= $EqpRepository->findAll();
        return $eqps;
    }
    /**
     * Récupère un équipement spécifique par son identifiant.
     *
     * Cette fonction utilise le Repository Doctrine pour rechercher et récupérer
     * un objet `Equipements` en base de données à partir de son identifiant.
     *
     * @param int $idEqp L'identifiant de l'équipement à récupérer.
     * @return Equipements|null L'objet `Equipements` correspondant à l'identifiant
     *                         fourni, ou null si aucun équipement n'est trouvé.
     */
    function getEquipementById(int $idEqp){
        global $entityManager;
        $Eqp= $entityManager->getRepository(Equipements::class)->find($idEqp);
        return $Eqp;
    }
    /**
     * Supprime un équipement en fonction de son identifiant.
     *
     * Cette fonction utilise le Repository Doctrine pour trouver l'équipement
     * correspondant à l'identifiant fourni et le supprimer de la base de données.
     *
     * @param int $id L'identifiant de l'équipement à supprimer.
     */
    function deleteEquipement($id){
        global $entityManager;
        $Eqp = $entityManager->getRepository(Equipements::class)->find($id);
        $entityManager->remove($Eqp);
        $entityManager->flush();
    }
    /**
     * Met à jour les informations d'un équipement existant.
     *
     * Cette fonction prend un tableau associatif contenant les nouvelles
     * informations de l'équipement et met à jour l'enregistrement correspondant
     * en base de données.
     *
     * @param array $data Un tableau associatif contenant les nouvelles informations :
     *     — Id (int) : L'identifiant de l'équipement à mettre à jour.
     *     — Nom (string) : Le nouveau nom de l'équipement.
     *     — Etat (string) : Le nouvel état de l'équipement.
     *     — Disponibilite (string) : La nouvelle disponibilité de l'équipement.
     *
     */
    function UpdateEquipement($data){
        global $entityManager;
        extract($data);
        $Eqp = $entityManager->getRepository(Equipements::class)->find($id);
        $Eqp->setNom($nom);
        $Eqp->setEtat($etat);
        $Eqp->setDisponibilite($disponibilite);
        $entityManager->flush();

    }

     /*function checkBeforeDeleteEquipement($id){
        global $entityManager;
        $Eqp = $entityManager->getRepository(Equipements::class)->find($id);
        $TabAnimaux = $Eqp->getAnimals()->toArray();
        print_r($TabAnimaux);
        //$nbr= count($TabAnimaux);
       // print_r($nbr);
        return count($Eqp->getAnimals());
    }*/
}