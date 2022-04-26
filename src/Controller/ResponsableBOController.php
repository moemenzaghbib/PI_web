<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResponsableBOController extends AbstractController
{
    /**
     * @Route("/RespUI", name="RespUI")
     */
    public function index(): Response
    {
        return $this->render('responsable_bo/index.html.twig');
    }
    /**
     * @Route("/homeBACK", name="HOMEBACK")
     */
    public function index1(): Response
    {
        return $this->render('responsable_bo/index.html.twig');
    }
}
