<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="homepage")
     * @return Response
     */
    public function indexAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository(Page::class)->getOneBySlug('homepage');

        return $this->render('@App/default/index.html.twig', [
                'page' => $page
            ]);
    }

    /**
     * @Route(path="our-team", name="our_team")
     */
    public function ourTeamAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository(Page::class)->getOneBySlug('our-team');

        $teams = $em->getRepository(Team::class)->getTeams();

        return $this->render('@App/default/our_team.html.twig', [
            'page'  => $page,
            'teams' => $teams
        ]);
    }

    /**
     * @Route(path="thank-you-contact", name="thank_you_contact")
     */
    public function thankYouContactAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository(Page::class)->getOneBySlug('thank-you-contact');

        return $this->render('@App/page/index.html.twig', [
            'page'  => $page
        ]);
    }
}
