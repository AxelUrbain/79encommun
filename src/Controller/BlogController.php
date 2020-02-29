<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page}", name="blog", defaults={"page": "1"},
     * methods={"GET"})
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($page, EntityManagerInterface $em)
    {
        $currentPath = 'blog';

        $nbPerPage = $this->getParameter('nbPerPage');
        $articlesPaginator = $em->getRepository('App:Article')->myFindAllWithPaging($page, $nbPerPage);

        $nbTotalPages = intval(ceil(count($articlesPaginator) / $nbPerPage ));

        return $this->render('blog/index.html.twig', [
            'articles' => $articlesPaginator,
            'nbPerPage' => $nbTotalPages,
            'page' => $page,
            'currentPath' => $currentPath
        ]);
    }
}
