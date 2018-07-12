<?php

namespace App\Controller;

use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    /**
     * @Route(path="/image/{type}/{size}/{rf}/{item}", name="image", requirements={"rf": "fix|res"})
     * @param Request $request
     * @param string  $type
     * @param string  $size
     * @param string  $rf Property to define resize or fixed type of image
     * @param $item
     *
     * @return Response
     */
    public function indexAction(Request $request, string $type, string $size, string $rf, $item): Response
    {
        $projectDir = $this->getParameter('kernel.project_dir');

        if (!file_exists($projectDir . '/public/images/upload/' . $type . '/' . $item)) {
            return (new BinaryFileResponse($projectDir . '/public/images/upload/' . $type . '/default.jpg'));
        }

        $hash = md5($item);

        $hashDir = substr($hash, 1, 2) . '/' . substr($hash, 3, 4);

        $cacheDir = $this->getParameter('kernel.cache_dir') . '/thumbs/' . $hashDir;

        if (!preg_match("/[\d]+x[\d]+/", $size)) {
            throw new NotFoundHttpException('');
        }

        $types = ['settings', 'intro', 'experience', 'page', 'team'];

        if (!\in_array($type, $types, true)) {
            throw new NotFoundHttpException('');
        }

        if (!file_exists($cacheDir)) {
            mkdir($cacheDir, 0777, true);
            chmod($cacheDir, 0777);
        }

        $cacheKey = $type . '-' . $size . '-' . $item;

        $cacheImage = $cacheDir . '/' . md5($cacheKey) . '.jpg';

        $imageName = $projectDir . '/public/images/upload/' . $type . '/' . $item;

        if (!file_exists($cacheImage) || filectime($cacheImage) < filectime($imageName)) {
            $manager = new ImageManager(array('driver' => \extension_loaded('imagick') ? 'imagick' : 'gd'));
            $image   = $manager->make($imageName);

            [$width, $height] = explode('x', $size);

            switch($rf) {
                case 'fix':
                    $image->fit($width, $height, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                        }, 'center');
                    break;
                case 'res':
                    $image->resize($width, $height, function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    break;
            }

            $image->save($cacheImage);
        }

        $lastModifiedDate = new \DateTime('@' . filectime($cacheImage));

        if ($request->headers->has('If-Modified-Since')) {
            if (new \DateTime($request->headers->get('If-Modified-Since')) >= $lastModifiedDate) {
                return new Response('', Response::HTTP_NOT_MODIFIED);
            }
        }

        return (new BinaryFileResponse($cacheImage))->setLastModified($lastModifiedDate)->setAutoEtag();
    }
}
