<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRepository")
 */
class Staff
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StaffType", inversedBy="staff")
     */
    private $staffType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ActivityLog", mappedBy="staff")
     */
    private $activityLogs;

    public function __construct()
    {
        $this->activityLogs = new ArrayCollection();
    }

    public function getId()
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getStaffType(): ?StaffType
    {
        return $this->staffType;
    }

    public function setStaffType(?StaffType $staffType): self
    {
        $this->staffType = $staffType;

        return $this;
    }

    /**
     * @return Collection|ActivityLog[]
     */
    public function getActivityLogs(): Collection
    {
        return $this->activityLogs;
    }

    public function addActivityLog(ActivityLog $activityLog): self
    {
        if (!$this->activityLogs->contains($activityLog)) {
            $this->activityLogs[] = $activityLog;
            $activityLog->addStaff($this);
        }

        return $this;
    }

    public function removeActivityLog(ActivityLog $activityLog): self
    {
        if ($this->activityLogs->contains($activityLog)) {
            $this->activityLogs->removeElement($activityLog);
            $activityLog->removeStaff($this);
        }

        return $this;
    }
}
