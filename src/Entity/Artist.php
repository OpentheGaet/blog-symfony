<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album", mappedBy="artists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    public function __construct()
    {
        $this->album = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbum(): Collection
    {
        return $this->album;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->album->contains($album)) {
            $this->album[] = $album;
            $album->setArtists($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->album->contains($album)) {
            $this->album->removeElement($album);
            // set the owning side to null (unless already changed)
            if ($album->getArtists() === $this) {
                $album->setArtists(null);
            }
        }

        return $this;
    }

}
