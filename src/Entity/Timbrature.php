<?php

namespace App\Entity;

use App\Repository\TimbratureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimbratureRepository::class)
 */
class Timbrature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codice;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dataora;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_dipendente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodice(): ?string
    {
        return $this->codice;
    }

    public function setCodice(string $codice): self
    {
        $this->codice = $codice;

        return $this;
    }

    public function getDataora()
    {
        return $this->dataora;
    }

    public function setDataora(string $dataora): self
    {
        $this->dataora = $dataora;

        return $this;
    }

    public function getIdDipendente(): ?int
    {
        return $this->id_dipendente;
    }

    public function setIdDipendente(int $id_dipendente): self
    {
        $this->id_dipendente = $id_dipendente;

        return $this;
    }
}
