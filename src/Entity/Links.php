<?php

namespace App\Entity;

use App\Repository\LinksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinksRepository::class)
 */
class Links
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $short_link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getShortLink(): ?string
    {
        return $this->short_link;
    }

    public function setShortLink(?string $short_link): self
    {
        $this->short_link = $short_link;

        return $this;
    }
}
