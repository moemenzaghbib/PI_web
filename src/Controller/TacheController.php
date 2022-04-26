<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Tache;
use App\Form\TacheEmp;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MessageBird\Objects\Message;
use MessageBird\Objects\PartnerAccount\AccessKey;
use MessageBird\Client;


/**
 * @Route("/tache")
 */
class TacheController extends AbstractController
{
    /**
     * @Route("/", name="app_tache_index", methods={"GET"})
     */
    public function index1(EntityManagerInterface $entityManager): Response
    {
        $taches = $entityManager
            ->getRepository(Tache::class)
            ->findAll();

        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
        ]);
    }
    /**
 * @Route("/testtesttest", name="app1", methods={"GET"})
 */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $taches = $entityManager
            ->getRepository(Tache::class)
            ->findAll();

        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
        ]);
    }

    /**
     * @Route("/AffecterTache", name="Affecter_tache_app", methods={"GET"})
     */
    public function AffecterTacheIndex(EntityManagerInterface $entityManager): Response
    {
        $taches = $entityManager
            ->getRepository(Tache::class)
            ->findAll();
        $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();

        return $this->render('tache/AffecterTache.html.twig', [
            'taches' => $taches,'employees' => $employees
        ]);
    }

    /**
     * @Route("/AffecterTache/{idTache}", name="Affecter_tache_emp_app", methods={"GET", "POST"})
     */
    public function AffecterTacheEmp(Request $request, EntityManagerInterface $entityManager, Tache $tache): Response
    {
        $taches = $entityManager
            ->getRepository(Tache::class)
            ->findAll();
        $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();

        $form = $this->createForm(TacheEmp::class, $tache);
        $tache1 = $form->getData('numTache');

        $form->handleRequest($request);


        if ($form->isSubmitted() ) {
            $entityManager->flush();

            $client = new \MessageBird\Client('wNwC2RPJIv6iEnoWSrwnMr1xC');
            $message = new \MessageBird\Objects\Message();;

            $message->originator='E-Citoyen';
            $message->recipients=['+21629972529'];
            $message->body ='Une nouvelle taches vous a été affecté ';
            $client->messages->create($message);

            return $this->redirectToRoute('Affecter_tache_app', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('tache/AffecterTacheInput.html.twig', ['tache'=>$tache,
            'taches' => $taches,'employees' => $employees,'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="app_tache_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app1', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTache}", name="app_tache_show", methods={"GET"})
     */
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    /**
     * @Route("/{idTache}/edit", name="app_tache_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app1', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTache}", name="app_tache_delete", methods={"POST"})
     */
    public function delete(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getIdTache(), $request->request->get('_token'))) {
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app1', [], Response::HTTP_SEE_OTHER);
    }
}
