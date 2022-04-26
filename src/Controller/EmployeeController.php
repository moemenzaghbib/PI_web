<?php

namespace App\Controller;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use App\Entity\Employee;
use App\Entity\Equipe;
use App\Entity\Service;
use App\Form\EmployeeEquipeType;
use App\Form\EmployeeType;
use App\Form\EmpRatingType;
use App\Repository\EquipeRepository;
use App\Form\EquipeServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;


/**
 * @Route("/employee")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/", name="app_employee_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/stat", name="tat")
     */
    public function indexTache_Emp(EmployeeRepository $repository): Response
    {
        $emps = $repository->findAll();



        $data = [['Employee id', 'rate']];
        foreach($emps as $emp)
        {
            $data[] = array($emp->getId(), $emp->getRating());
        }
        $bar = new ColumnChart();
        $bar->getData()->setArrayToDataTable(
            $data
        );

        $bar->getOptions()->getTitleTextStyle()->setColor('#07600');
        $bar->getOptions()->getTitleTextStyle()->setFontSize(50);
        return $this->render('employee/statistique.html.twig', array('barchart' => $bar,'nbs' => $emps));
    }
    /*$nbs = $repository->getART();

        $data = [['rate', 'Employee']];
        foreach($nbs as $nb)
        {
            $data[] = array($nb['Rating'], $nb['rec']);
        }
        $bar = new barchart();
        $bar->getData()->setArrayToDataTable(
            $data
        );

        $bar->getOptions()->getTitleTextStyle()->setColor('#07600');
        $bar->getOptions()->getTitleTextStyle()->setFontSize(50);
        return $this->render('employee/statistique.html.twig', array('barchart' => $bar,'nbs' => $nbs));*/
    /**
     * @Route("/EmpFRONT", name="JSONTEST")
     */
    public function AFFICHAGE_Par_JSON(EntityManagerInterface $entityManager, NormalizerInterface $normalizer)
    {
        $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();




        $JsonContent = $normalizer->normalize($employees, 'json',['group'=>'post:read']);
        return new Response(json_encode($JsonContent));

    }

    /**
     * @Route("/Updatepar_JSON", name="UJSON" , methods={"GET","POST"})
     */
    public function Update_Rating_Ajax(Request $request, EntityManagerInterface $entityManager)
    {
            $idd = $request->get('idd');
            $x = $request->get('x');
            $em = $this->getDoctrine()->getManager();
            $e1 = $em->getRepository(Employee::class)->find($idd);
            $e1->setRating($x);
            $em->flush();
            $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();
        $responseArray = [];
        $idx = 0;
        foreach ($employees as $Employee) {
            $temp = [
                'id' => $Employee->getId(),
                'nom' => $Employee->getNom(),
                'prenom' => $Employee->getPrenom(),
                'email' => $Employee->getEmail(),
                'cin' => $Employee->getCin(),
                'Rating' => $Employee->getRating(),
                'photo' => $Employee->getPhoto(),
                'EquipeId' => $Employee->getEquipeId(),
                'ServiceId' => $Employee->getServiceId(),
                'role' => $Employee->getRole(),
                'motDePasse' => $Employee->getMotDePasse(),
            ];
            $responseArray[$idx++] = $temp;
        }
        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/AffecterEquipe", name="app_emp_equipe", methods={"GET", "POST"})
     */
    public function AffecterServiceEquipe(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employees = $entityManager
            ->getRepository(Employee::class)
            ->findAll();
        $equipes = $entityManager
            ->getRepository(Equipe::class)
            ->findAll();


        return $this->render('equipe/AffecterEquipeEmployee.html.twig', [
            'employees' => $employees,
            'equipes' => $equipes,
        ]);
    }
        /**
         * @Route("/RateEmp", name="app_rate_emp", methods={"GET"})
         */
        public function RateEmp(EntityManagerInterface $entityManager): Response
    {   $employees = $entityManager
        ->getRepository(Employee::class)
        ->findAll();


        return $this->render('employee/RateEmp.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/RateEmployee/{id}", name="app_rate_Input_emp", methods={"GET", "POST"})
     */
    public function RateEmpID(Request $request,Employee $emp, EntityManagerInterface $entityManager): Response
    {   $employees = $entityManager
        ->getRepository(Employee::class)
        ->findAll();

        $form = $this->createForm(EmpRatingType::class, $emp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_emp_equipe', [], Response::HTTP_SEE_OTHER);
                    }

        return $this->render('employee\RateEmpInput.html.twig', [
            'employees' => $employees,
            'emp' => $emp,
            'form' => $form->createView(),
        ]);}

    /**
     * @Route("/AffecterEmpEquipe/{id}", name="app_emp_ID_equipe", methods={"GET", "POST"})
     */
    public function AffecterServiceEquipewithID(Request $request,Employee $emp, EntityManagerInterface $entityManager, EquipeRepository $Rep): Response
    {   $employees = $entityManager
        ->getRepository(Employee::class)
        ->findAll();
        $equipes = $entityManager
            ->getRepository(Equipe::class)
            ->findAll();
        $test = $emp->getEquipeId();


        $form = $this->createForm(EmployeeEquipeType::class, $emp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($test != 0){

                $equipe=$entityManager->getRepository(Equipe::class)->find($test);
                $value = $equipe->getNbreEmp();
                //dd($value);
                $value--;
                //dd($value);

                $Rep->updateEquipe($test,$value);
            }
                $entityManager->flush();
                $id = $emp->getEquipeId();
                $equipe=$entityManager->getRepository(Equipe::class)->find($id);
                $value = $equipe->getNbreEmp();
                $value ++;
                $Rep->updateEquipe($id,$value);

        return $this->redirectToRoute('app_emp_equipe', [], Response::HTTP_SEE_OTHER);
    }
    return $this->render('equipe/AffecterEmpEquipe.html.twig', [
        'employees' => $employees,
        'equipes' => $equipes,
        'emp' => $emp,
        'form' => $form->createView(),
    ]);
}




/**
 * @Route("/new", name="app_employee_new", methods={"GET", "POST"})
 */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employee);
            $entityManager->flush();


            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_employee_show", methods={"GET"})
     */
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_employee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_employee_delete", methods={"POST"})
     */
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }




}

