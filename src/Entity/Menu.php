<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Menu
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
     * @Assert\NotNull()
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "{{ limit }} number must be higher than zero",
     * )
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    private $rank;

    /**
     * @var string
     * @ORM\Column(name="link_target", type="string", nullable=true)
     */
    private $linkTarget;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parentMenu")
     * @ORM\OrderBy({"rank" = "ASC"})
     */
    private $childrenMenu;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="childrenMenu")
     * @ORM\JoinColumn(name="parent_menu_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parentMenu;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="menu")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    private $page;

    /**
     * @var string
     * @ORM\Column(name="link_type", type="string", nullable=true)
     */
    private $linkType;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childrenMenu = new ArrayCollection();
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
     * @return Menu
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
     * Set link
     *
     * @param string $link
     *
     * @return Menu
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Menu
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
     * Set rank
     *
     * @param integer $rank
     *
     * @return Menu
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
     * Add children_menu
     *
     * @param Menu $childrenMenu
     *
     * @return Menu
     */
    public function addChildrenMenu(Menu $childrenMenu)
    {
        $this->childrenMenu[] = $childrenMenu;

        return $this;
    }

    /**
     * Remove children_menu
     *
     * @param Menu $childrenMenu
     */
    public function removeChildrenMenu(Menu $childrenMenu)
    {
        $this->childrenMenu->removeElement($childrenMenu);
    }

    /**
     * Get children_menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildrenMenu()
    {
        return $this->childrenMenu;
    }

    /**
     * Get children_menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActiveChildrenMenu()
    {
        $childrenMenu = $this->childrenMenu;

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('active', true))
            ->orderBy(['rank' => Criteria::ASC]);

        return $childrenMenu->matching($criteria);
    }

    /**
     * Set parent_menu
     *
     * @param Menu $parentMenu
     *
     * @return Menu
     */
    public function setParentMenu(Menu $parentMenu = null)
    {
        $this->parentMenu = $parentMenu;

        return $this;
    }

    /**
     * Get parent_menu
     *
     * @return Menu
     */
    public function getParentMenu()
    {
        return $this->parentMenu;
    }

    /**
     * Set page
     *
     * @param Page $page
     *
     * @return Menu
     */
    public function setPage(Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set linkType
     *
     * @param string $linkType
     *
     * @return Menu
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return string
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Menu';
    }
}

