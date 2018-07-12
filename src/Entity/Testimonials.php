<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Testimonials
 * @ORM\Table(name="testimonials")
 * @ORM\Entity(repositoryClass="App\Repository\TestimonialsRepository")
 */
class Testimonials
{
    public const TARGET_BLANK = '_blank';
    public const TARGET_TOP = '_top';

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="link", type="string", length=255,nullable=true)
     */
    private $link;

    /**
     * @var string
     * @ORM\Column(name="link_target", type="string", nullable=true)
     */
    private $linkTarget;

    /**
     * @var string
     * @ORM\Column(name="comment", type="string", length=1500, nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var int
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "{{ limit }} цифра должна быть выше нуля",
     * )
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Experience
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set linkTarget
     *
     * @param string $linkTarget
     *
     * @return Menu
     */
    public function setLinkTarget($linkTarget)
    {
        $this->linkTarget = $linkTarget;

        return $this;
    }

    /**
     * Get linkTarget
     *
     * @return string
     */
    public function getLinkTarget()
    {
        return $this->linkTarget;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Contact
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     *
     * @return Contact
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Experience
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Experience
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
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }
}