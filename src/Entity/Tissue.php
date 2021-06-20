<?php

namespace App\Entity;

use App\Repository\TissueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TissueRepository::class)
 */
class Tissue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sampleName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wellNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $xMosaic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yMosaic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $objectNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cellClass;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $centroidX;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $centroidY;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $centroidZ;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $volume;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $compactness;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $elongation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSampleName(): ?string
    {
        return $this->sampleName;
    }

    public function setSampleName(?string $sampleName): self
    {
        $this->sampleName = $sampleName;

        return $this;
    }

    public function getWellNumber(): ?int
    {
        return $this->wellNumber;
    }

    public function setWellNumber(?int $wellNumber): self
    {
        $this->wellNumber = $wellNumber;

        return $this;
    }

    public function getXMosaic(): ?int
    {
        return $this->xMosaic;
    }

    public function setXMosaic(?int $xMosaic): self
    {
        $this->xMosaic = $xMosaic;

        return $this;
    }

    public function getYMosaic(): ?int
    {
        return $this->yMosaic;
    }

    public function setYMosaic(?int $yMosaic): self
    {
        $this->yMosaic = $yMosaic;

        return $this;
    }

    public function getObjectNumber(): ?int
    {
        return $this->objectNumber;
    }

    public function setObjectNumber(?int $objectNumber): self
    {
        $this->objectNumber = $objectNumber;

        return $this;
    }

    public function getCellClass(): ?string
    {
        return $this->cellClass;
    }

    public function setCellClass(?string $cellClass): self
    {
        $this->cellClass = $cellClass;

        return $this;
    }

    public function getCentroidX(): ?float
    {
        return $this->centroidX;
    }

    public function setCentroidX(?float $centroidX): self
    {
        $this->centroidX = $centroidX;

        return $this;
    }

    public function getCentroidY(): ?float
    {
        return $this->centroidY;
    }

    public function setCentroidY(?float $centroidY): self
    {
        $this->centroidY = $centroidY;

        return $this;
    }

    public function getCentroidZ(): ?float
    {
        return $this->centroidZ;
    }

    public function setCentroidZ(?float $centroidZ): self
    {
        $this->centroidZ = $centroidZ;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(?float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getCompactness(): ?float
    {
        return $this->compactness;
    }

    public function setCompactness(?float $compactness): self
    {
        $this->compactness = $compactness;

        return $this;
    }

    public function getElongation(): ?float
    {
        return $this->elongation;
    }

    public function setElongation(?float $elongation): self
    {
        $this->elongation = $elongation;

        return $this;
    }
}
