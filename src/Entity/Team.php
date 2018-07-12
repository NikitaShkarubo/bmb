<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 * @ORM\Table(name="team")
 *
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    public const THREE_IN_ROW = 3;
    public const TWO_IN_ROW = 2;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     * @ORM\Column(name="in_row", type="integer")
     */
    private $inRow;

    /**
     * @ORM\OneToMany(targetEntity="TeamMember", mappedBy="team", cascade="remove")
     * @ORM\OrderBy({"rank" = "ASC"})
     */
    private $member;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->page = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Gallery
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Gallery
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Gallery
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set InRow
     *
     * @param integer $inRow
     *
     * @return Team
     */
    public function setInRow($inRow)
    {
        $this->inRow = $inRow;

        return $this;
    }

    /**
     * Get inRow
     *
     * @return bool
     */
    public function getInRow()
    {
        return $this->inRow;
    }

    /**
     * Add member
     *
     * @param TeamMember $member
     *
     * @return Team
     */
    public function addMember(TeamMember $member)
    {
        $this->member[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param TeamMember $member
     */
    public function removeMember(TeamMember $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get member
     *
     * @return ArrayCollection|TeamMember[]
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->title;
    }
}
