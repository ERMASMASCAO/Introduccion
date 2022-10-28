<?php

namespace App\Entity;

use App\Repository\CiudadesRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**

 * @ORM\Entity(repositoryClass=CiudadesRepository::class)

 */
class Ciudades
{
    /**
    *    ORM\Id
    *    ORM\GeneratedValue
    *    RM\Column(type="integer")
    */

    private $id;

    /**
    * ORM\Column(type="string",length= 255)
    * @Assert\NotBlank
    * (message="El nombre es obligatorio")
    */

    private $nombre;

    /** 
    *  @abstractORM\Column(type="string", length=15)
    *  @Assert\NotBlank
    *  (message="Los habitantes no son correctos")
    */

    private $habitantes;

    /**
    *  @ORM\Column(type="string", lengrh=255)
    *  @Assert\NotBLank()
    *  @Assert\Alcalde
    *  (message="El alcalde {{ value }} no es válido")
    */

    private $alcalde;

    /**
     * @ORM\ManyToOne(targerEntity=Pais::class)
     */

    private $pais;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getNombre(): ?string
        {
            return $this->nombre;
        }

        public function setNombre(string $nombre): self
        {
            $this->nombre = $nombre;

            return $this;
        }

        public function getHabitantes(): ?int
        {
            return $this->habitantes;
        }

        public function setHabitantes(int $habitantes): self
        {
            $this->habitantes = $habitantes;

            return $this;
        }

        public function getAlcalde(): ?string
        {
            return $this->alcalde;
        }

        public function setAlcalde(string $alcalde): self
        {
            $this->alcalde = $alcalde;

            return $this;
        }

        public function getPais(): ?Pais
        {
            return $this->pais;
        }

        public function setPais(?Pais $pais): self
        {
            $this->pais = $pais;

            return $this;
        }
    }
