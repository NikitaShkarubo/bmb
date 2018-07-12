<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

class ContentManager
{
    /** @var EntityManager */
    private $em;

    /** @var \Twig_Environment */
    private $twig;

    /** @var array  */
    private $widgets = [
        '[[about us]]',
        '[[commitment]]',
        '[[contact form]]',
        '[[intro]]',
        '[[our experience block]]',
        '[[testimonials]]'
    ];

    /**
     * ContentManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param \Twig_Environment $twig
     */
    public function __construct(EntityManagerInterface $em, \Twig_Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    /**
     * @param string $content
     * @return string
     */
    public function manageContent($content): string
    {
        foreach ($this->widgets as $widget) {
            if (strpos($content, $widget) !== false) {
                $content = str_replace($widget, $this->getWidgetByName($widget), $content);
            }
        }

        return $content;
    }
    /**
     * @param string $widgetName
     * @return string
     */
    private function getWidgetByName($widgetName)
    {
        switch ($widgetName) {
            case "[[about us]]":
                return $this->twig->render("@App/_partials/about.html.twig", []);
            case "[[contact form]]":
                return $this->twig->render("@App/_partials/contact_form_content.html.twig", []);
            case "[[commitment]]":
                return $this->twig->render("@App/_partials/commitment.html.twig", []);
            case "[[intro]]":
                return $this->twig->render("@App/_partials/intro.html.twig", []);
            case "[[our experience block]]":
                return $this->twig->render("@App/_partials/experience.html.twig", []);
            case "[[testimonials]]":
                return $this->twig->render("@App/_partials/testimonials.html.twig", []);
        }
    }
}
