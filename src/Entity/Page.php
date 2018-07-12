<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Page
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\EntityListeners({"App\EventListener\PageListener"})
 *
 * @Vich\Uploadable
 */
class Page
{
    public const TYPE_COMMON = 1;
    public const TYPE_SYSTEM = 2;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(name="html_title", type="string", length=255, nullable=true)
     */
    private $htmlTitle;

    /**
     * @var string
     * @ORM\Column(name="meta_keywords", type="string", length=255, nullable=true)
     */
    private $metaKeywords;

    /**
     * @var string
     * @ORM\Column(name="meta_description", type="string", length=1000, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     * @Assert\NotNull()
     * @ORM\Column(name="page_title", type="string", length=255)
     */
    private $pageTitle;

    /**
     * @var string
     * @ORM\Column(name="image_header_title", type="string", length=255, nullable=true)
     */
    private $imageHeaderTitle;

    /**
     * @var string
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var bool
     * @ORM\Column(name="contact_form_active", type="boolean", nullable=true)
     */
    private $contactFormActive;

    /**
     * @var bool
     * @ORM\Column(name="testimonials_active", type="boolean", nullable=true)
     */
    private $testimonialsActive;

    /**
     * @var bool
     * @ORM\Column(name="image_header_active", type="boolean", nullable=true)
     */
    private $imageHeaderActive;

    /**
     * @var string
     * @ORM\Column(name="redirect", type="string", length=255, nullable=true)
     */
    private $redirect;

    /**
     * @var string
     * @ORM\Column(name="code_block", type="text", nullable=true)
     */
    private $codeBlock;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="page_image", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="page")
     */
    private $menu;

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
     * Set slug
     *
     * @param string|null $slug
     *
     * @return Page
     */
    public function setSlug(?string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set htmlTitle
     *
     * @param string $htmlTitle
     *
     * @return Page
     */
    public function setHtmlTitle($htmlTitle)
    {
        $this->htmlTitle = $htmlTitle;

        return $this;
    }

    /**
     * Get htmlTitle
     *
     * @return string
     */
    public function getHtmlTitle()
    {
        return $this->htmlTitle;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return Page
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Page
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     *
     * @return Page
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set imageHeaderTitle
     *
     * @param string $imageHeaderTitle
     *
     * @return Page
     */
    public function setImageHeaderTitle($imageHeaderTitle)
    {
        $this->imageHeaderTitle = $imageHeaderTitle;

        return $this;
    }

    /**
     * Get imageHeaderTitle
     *
     * @return string
     */
    public function getImageHeaderTitle()
    {
        return $this->imageHeaderTitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Page
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Page
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Page
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
     * Set contactFormActive
     *
     * @param boolean $contactFormActive
     *
     * @return Page
     */
    public function setContactFormActive($contactFormActive)
    {
        $this->contactFormActive = $contactFormActive;

        return $this;
    }

    /**
     * Get contactFormActive
     *
     * @return bool
     */
    public function getContactFormActive()
    {
        return $this->contactFormActive;
    }

    /**
     * Set testimonialsActive
     *
     * @param boolean $testimonialsActive
     *
     * @return Page
     */
    public function setTestimonialsActive($testimonialsActive)
    {
        $this->testimonialsActive = $testimonialsActive;

        return $this;
    }

    /**
     * Get testimonialsActive
     *
     * @return bool
     */
    public function getTestimonialsActive()
    {
        return $this->testimonialsActive;
    }

    /**
     * Set imageHeaderActive
     *
     * @param boolean $imageHeaderActive
     *
     * @return Page
     */
    public function setImageHeaderActive($imageHeaderActive)
    {
        $this->imageHeaderActive = $imageHeaderActive;

        return $this;
    }

    /**
     * Get imageHeaderActive
     *
     * @return bool
     */
    public function getImageHeaderActive()
    {
        return $this->imageHeaderActive;
    }

    /**
     * Set redirect
     *
     * @param string $redirect
     *
     * @return Page
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect
     *
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @return string
     */
    public function getCodeBlock()
    {
        return $this->codeBlock;
    }

    /**
     * @param string $codeBlock
     */
    public function setCodeBlock($codeBlock)
    {
        $this->codeBlock = $codeBlock;
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
     * @return Page
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     *
     * @return Page
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    /**
     * Add menu
     *
     * @param Menu $menu
     *
     * @return Page
     */
    public function addMenu(Menu $menu)
    {
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param Menu $menu
     */
    public function removeMenu(Menu $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return ArrayCollection|Menu[]
     */
    public function getMenu()
    {
        return $this->menu;
    }
    

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->pageTitle;
    }
}
