<?php

namespace App\Controller;
use App\Form\TacheEtatType;
use App\Form\TacheType;
use App\Repository\TacheRepository;

use App\Entity\Employee;
use App\Entity\Tache;
use App\Repository\EmployeeRepository;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf ;
use Dompdf\Options;

class HOMEController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_h_o_m_e")
     */
    public function index(EntityManagerInterface $entityManager, Employee $employee, EquipeRepository $equipeRepository,EmployeeRepository $employeeRepository): Response
    {   $Taches = $employee->getTaches();
        $TachesEMP = $Taches->toArray();

        $EquipeID = $employee->getEquipeId();

        $equipe1 = $equipeRepository->find($EquipeID);
        $employees = $employeeRepository->getEmployeebyEquipeID($EquipeID);
        //lezem lehne nparcouri

        return $this->render('home/test2frontBase.html.twig', [ 'taches' => $TachesEMP,'employee' => $employee,'equipe' => $equipe1,'employees' => $employees,
        ]);


    }




    /**
     * @Route("imp/{id}", name="impr")
     */

    public function imprimer(EntityManagerInterface $entityManager,Employee $employee, TacheRepository $tacheRepository): Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $Taches = $employee->getTaches();



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('home/imprimerTACHES.html.twig', [
            'Taches' => $Taches,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  Taches.pdf", [
            "Attachment" => true

        ]);
        return 0;
    }


    /**
     * @Route("EmpTaches/{idTache}/edit", name="EmpTaches", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TacheEtatType::class, $tache);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_h_o_m_e', ['id' => $tache->getEmployee()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/editEtatTache.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }


}
