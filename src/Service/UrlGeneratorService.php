<?php


namespace App\Service;

use App\Entity\Links;
use App\Repository\LinksRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UrlGeneratorService extends AbstractController
{

    private $linksRepository;

    public function __construct(LinksRepository $linksRepository)
    {
        $this->linksRepository = $linksRepository;
    }


    public function getRandomUrl()
    {
        $linksRepository = $this->getDoctrine()->getRepository(Links::class);
        do {
            try {
                $bytes = random_bytes(5);
            } catch (Exception $e) {
                get('session')->setFlash('error', "Url generator failed. Try again!");
            }
            $random = bin2hex($bytes);

            if (strlen($random) > 5) {
                $url = substr($random, 0, 5);
            }
            $urlInDatabase = $linksRepository->findOneBy([
                'short_link' => $url,
            ]);
        } while ($urlInDatabase);
        return $url;
    }
}