<?php

namespace App\Controller;

use App\Entity\Page;
use App\Manager\ContentManager;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * @param Request $request
     * @param string  $slug
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function indexAction(Request $request, string $slug = '', ContentManager $contentManager): Response
    {
        /** @var PageRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Page::class);

        $page = $repo->getOneBySlug($slug);

        if (null === $page) {
            throw new NotFoundHttpException('');
        }

        if ($page->getRedirect() != null) {
            return $this->redirect($page->getRedirect(), 302);
        }

        $content = $contentManager->manageContent($page->getContent());

        return $this->render('@App/page/index.html.twig', [
            'page'    => $page,
            'content' => $content
        ]);
    }
}
