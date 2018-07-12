<?php

namespace App\Twig;

use App\Entity\Experience;
use App\Entity\Menu;
use App\Entity\Settings;
use App\Entity\Testimonials;
use Doctrine\ORM\EntityManagerInterface;

class Extension extends \Twig_Extension
{
    private $em;

    /**
     * Extension constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions(): array
    {
        return array(
            new \Twig_Function('getExperienceComponent', [$this, 'getExperienceComponent']),
            new \Twig_Function('getMenu', [$this, 'getMenu']),
            new \Twig_Function('getSettings', [$this, 'getSettings']),
            new \Twig_Function('getTestimonialsComponent', [$this, 'getTestimonialsComponent']),
        );
    }

    /**
     * @return null|Settings
     */
    public function getSettings(): ?Settings
    {
        return $this->em->getRepository(Settings::class)->find(1);
    }

    /**
     * @return Menu[]
     */
    public function getMenu(): array
    {
        return $this->em->getRepository(Menu::class)->getMenu();
    }

    /**
     * @return null|array
     */
    public function getExperienceComponent(): ?array
    {
        return $this->em->getRepository(Experience::class)->getExperience();
    }

    /**
     * @return null|array
     */
    public function getTestimonialsComponent(): ?array
    {
        return $this->em->getRepository(Testimonials::class)->getTestimonials();
    }
}
