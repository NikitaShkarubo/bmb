<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Settings
 * @ORM\Table(name="settings")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Settings
{
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
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="skype", type="string", length=255, nullable=true)
     */
    private $skype;

    /**
     * @var string
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     * @ORM\Column(name="toll_fax", type="string", length=255, nullable=true)
     */
    private $tollFax;

    /**
     * @var string
     * @Assert\Email(
     *     message = "'{{ value }}' не корректный email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=512, nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="header_text", type="text", nullable=true)
     */
    private $headerText;

    /**
     * @var string
     * @ORM\Column(name="footer_text", type="text", nullable=true)
     */
    private $footerText;

    /**
     * @var string
     * @Assert\Email(
     *     message = "'{{ value }}' не корректный email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="contact_email_send_to", type="string", length=255)
     */
    private $contactEmailSendTo;

    /**
     * @var string
     * @Assert\Email(
     *     message = "'{{ value }}' не корректный email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="contact_email_send_from", type="string", length=255)
     */
    private $contactEmailSendFrom;

    /**
     * @var string
     * @ORM\Column(name="contact_email_subject", type="string", length=255, nullable=true)
     */
    private $contactEmailSubject;

    /**
     * @var string
     * @ORM\Column(name="contact_success_redirect", type="string", length=255, nullable=true)
     */
    private $contactSuccessRedirect;

    /**
     * @var string
     * @ORM\Column(name="about_title", type="string", length=255, nullable=true)
     */
    private $aboutTitle;

    /**
     * @var string
     * @ORM\Column(name="about_text", type="text", nullable=true)
     */
    private $aboutText;

    /**
     * @var string
     * @ORM\Column(name="about_image", type="string", length=255, nullable=true)
     */
    private $aboutImage;

    /**
     * @var string
     * @ORM\Column(name="intro_image", type="string", length=255, nullable=true)
     */
    private $introImage;

    /**
     * @var string
     * @ORM\Column(name="intro_link", type="string", length=255, nullable=true)
     */
    private $introLink;

    /**
     * @var string
     * @ORM\Column(name="intro_title", type="string", length=255, nullable=true)
     */
    private $introTitle;

    /**
     * @var string
     * @ORM\Column(name="intro_text", type="text", nullable=true)
     */
    private $introText;

    /**
     * @var string
     * @ORM\Column(name="commitment_title", type="string", length=255, nullable=true)
     */
    private $commitmentTitle;

    /**
     * @var string
     * @ORM\Column(name="commitment_text", type="text", nullable=true)
     */
    private $commitmentText;

    /**
     * @var string
     * @ORM\Column(name="map_latitude", type="string", length=255)
     */
    private $mapLatitude;

    /**
     * @var string
     * @ORM\Column(name="map_longitude", type="string", length=255)
     */
    private $mapLongitude;

    /**
     * @var string
     * @ORM\Column(name="map_link", type="string", length=255, nullable=true)
     */
    private $mapLink;

    /**
     * @var string
     * @ORM\Column(name="code_block", type="text", nullable=true)
     */
    private $codeBlock;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="intro_image", fileNameProperty="introImage")
     *
     * @var File
     */
    private $image;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="settings_image", fileNameProperty="aboutImage")
     *
     * @var File
     */
    private $imageFile;

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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param string $skype
     */
    public function setSkype(string $skype)
    {
        $this->skype = $skype;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getTollFax()
    {
        return $this->tollFax;
    }

    /**
     * @param string $tollFax
     */
    public function setTollFax(string $tollFax)
    {
        $this->tollFax = $tollFax;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getContactEmailSendTo()
    {
        return $this->contactEmailSendTo;
    }

    /**
     * @param string $contactEmailSendTo
     */
    public function setContactEmailSendTo(string $contactEmailSendTo)
    {
        $this->contactEmailSendTo = $contactEmailSendTo;
    }

    /**
     * @return string
     */
    public function getContactEmailSendFrom()
    {
        return $this->contactEmailSendFrom;
    }

    /**
     * @param string $contactEmailSendFrom
     */
    public function setContactEmailSendFrom(string $contactEmailSendFrom)
    {
        $this->contactEmailSendFrom = $contactEmailSendFrom;
    }

    /**
     * @return string
     */
    public function getContactEmailSubject()
    {
        return $this->contactEmailSubject;
    }

    /**
     * @param string $contactEmailSubject
     */
    public function setContactEmailSubject(string $contactEmailSubject)
    {
        $this->contactEmailSubject = $contactEmailSubject;
    }

    /**
     * @return string
     */
    public function getContactSuccessRedirect()
    {
        return $this->contactSuccessRedirect;
    }

    /**
     * @param string $contactSuccessRedirect
     */
    public function setContactSuccessRedirect(string $contactSuccessRedirect)
    {
        $this->contactSuccessRedirect = $contactSuccessRedirect;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getFooterText()
    {
        return $this->footerText;
    }

    /**
     * @param string $footerText
     */
    public function setFooterText(string $footerText)
    {
        $this->footerText = $footerText;
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        return $this->headerText;
    }

    /**
     * @param string $headerText
     */
    public function setHeaderText(string $headerText)
    {
        $this->headerText = $headerText;
    }

    /**
     * @return string
     */
    public function getAboutTitle()
    {
        return $this->aboutTitle;
    }

    /**
     * @param string $aboutTitle
     */
    public function setAboutTitle(string $aboutTitle)
    {
        $this->aboutTitle = $aboutTitle;
    }

    /**
     * @return string
     */
    public function getAboutText()
    {
        return $this->aboutText;
    }

    /**
     * @param string $aboutText
     */
    public function setAboutText(string $aboutText)
    {
        $this->aboutText = $aboutText;
    }

    /**
     * @param string $aboutImage
     *
     * @return $this
     */
    public function setAboutImage($aboutImage)
    {
        $this->aboutImage = $aboutImage;

        return $this;
    }

    /**
     * Get aboutImage
     *
     * @return string
     */
    public function getAboutImage()
    {
        return $this->aboutImage;
    }

    /**
     * @param string $introImage
     *
     * @return $this
     */
    public function setIntroImage($introImage)
    {
        $this->introImage = $introImage;

        return $this;
    }

    /**
     * Get Image
     *
     * @return string
     */
    public function getIntroImage()
    {
        return $this->introImage;
    }

    /**
     * @return string
     */
    public function getIntroLink()
    {
        return $this->introLink;
    }

    /**
     * @param string $introLink
     */
    public function setIntroLink(string $introLink)
    {
        $this->introLink = $introLink;
    }

    /**
     * @return string
     */
    public function getIntroTitle()
    {
        return $this->introTitle;
    }

    /**
     * @param string $introTitle
     */
    public function setIntroTitle(string $introTitle)
    {
        $this->introTitle = $introTitle;
    }

    /**
     * @return string
     */
    public function getIntroText()
    {
        return $this->introText;
    }

    /**
     * @param string $introText
     */
    public function setIntroText(string $introText)
    {
        $this->introText = $introText;
    }

    /**
     * @return string
     */
    public function getCommitmentTitle()
    {
        return $this->commitmentTitle;
    }

    /**
     * @param string $commitmentTitle
     */
    public function setCommitmentTitle(string $commitmentTitle)
    {
        $this->commitmentTitle = $commitmentTitle;
    }

    /**
     * @return string
     */
    public function getCommitmentText()
    {
        return $this->commitmentText;
    }

    /**
     * @param string $commitmentText
     */
    public function setCommitmentText(string $commitmentText)
    {
        $this->commitmentText = $commitmentText;
    }

    /**
     * @return string
     */
    public function getMapLatitude()
    {
        return $this->mapLatitude;
    }

    /**
     * @param string $mapLatitude
     */
    public function setMapLatitude(string $mapLatitude)
    {
        $this->mapLatitude = $mapLatitude;
    }

    /**
     * @return string
     */
    public function getMapLongitude()
    {
        return $this->mapLongitude;
    }

    /**
     * @param string $mapLongitude
     */
    public function setMapLongitude(string $mapLongitude)
    {
        $this->mapLongitude = $mapLongitude;
    }

    /**
     * @return string
     */
    public function getMapLink()
    {
        return $this->mapLink;
    }

    /**
     * @param string $mapLink
     */
    public function setMapLink($mapLink)
    {
        $this->mapLink = $mapLink;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return Settings
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $aboutImage
     *
     * @return Settings
     */
    public function setImageFile(File $aboutImage = null)
    {
        $this->imageFile = $aboutImage;
        $this->setUpdatedAt(new \DateTime());

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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     *
     * @return Settings
     */
    public function setImage(File $image = null)
    {
        $this->image = $image;
        $this->setUpdatedAt(new \DateTime());

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Settings';
    }
}
