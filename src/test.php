<?php

namespace App;

use App\Entity\Equipe;

class test
{/*
    /*
}
**
* @Route("/recherche_par_nom_taha", name="recherche_par_nom_taha",options={"expose"=true})

public function rechercheequipetestTAHA(Request $request): JsonResponse
{
    $repository = $this->getDoctrine()->getRepository(Equipe::class);
    $EquipeNumber=$request->get('searchValue');
    $Equipes = $repository->findTeamwithNumber($EquipeNumber);
    $responseArray = [];
    $idx = 0;
    foreach ($Equipes as $Equipe) {
        $temp = [
            'numEquipe' => $Equipe->getNumEquipe(),
            'nbreEmp' => $Equipe->getnbreEmp(),
            'service' => $Equipe->getservice(),
        ];

        $responseArray[$idx++] = $temp;
        return new JsonResponse($responseArray);
    }
}

    /**
     * @Route("/r/search_back", name="search_back",methods={"GET"})


    public function search_back(Request $request,NormalizerInterface $Normalizer,ReclamationBackRepository $reclamationBackRepository ): Response
    {

        $requestString=$request->get('searchValue');
        $requestString3=$request->get('orderid');
        $Reclamation = $reclamationBackRepository->findevent($requestString,$requestString3);
        $jsonContent = $Normalizer->normalize($Reclamation, 'json',['groups'=>'posts:read']);
        //  dump($jsoncontentc);
        $jsonc=json_encode($jsonContent);
        //   dump($jsonc);
        if(  $jsonc == "[]" ) { return new Response(null); }
        else{ return new Response($jsonc);
        }
    }

    public function findevent($valueemail,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Reclamation r   where r.nom like :nom order by r.numero DESC '
            );
            $query->setParameter('nom', $valueemail . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Reclamation r   where r.nom like :nom  order by r.numero ASC '
            );
            $query->setParameter('nom', $valueemail . '%');
        }
        return $query->getResult();
*/
}



