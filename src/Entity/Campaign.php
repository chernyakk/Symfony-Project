<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 */
class Campaign
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $members_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembersId(): ?int
    {
        return $this->members_id;
    }

    public function setMembersId(int $members_id): self
    {
        $this->members_id = $members_id;

        return $this;
    }

    public function getMessageEnd(): ?string
    {
        return $this->message_end;
    }

    public function setMessageEnd(string $message_end): self
    {
        $this->message_end = $message_end;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
