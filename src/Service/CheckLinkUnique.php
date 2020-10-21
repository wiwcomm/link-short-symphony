<?php


namespace App\Service;
use Exception;
use App\Repository\LinksRepository;


class CheckLinkUnique
{

    private $linksRepository;

    public function __construct(LinksRepository $linksRepository)
    {
        $this->linksRepository = $linksRepository;
    }


    public function checkLink($link)
    {

        try {
            $urlInDatabase = $this->linksRepository->findOneBy([
                'link' => $link,
            ]);
        } catch (Exception $e) {
            get('session')->setFlash('error', "Url generator failed. Try again!");
        }
        if ($urlInDatabase) {
            return $urlInDatabase -> getShortLink();
        }
        else {
            return null;
        }
    }
}