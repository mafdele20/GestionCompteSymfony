<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Form\EtatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtatController extends AbstractController
{
    /**
     * @Route("/etat", name="etat")
     */
    public function index()
    {
        return $this->render('etat/index.html.twig', [
            'controller_name' => 'EtatController',
        ]);
    }

      /**
     * @Route("/etatcompte/add", name="addetat")
     */
    public function create(Request $request)
    {
        $etat= new Etat();
        $form = $this->createForm(EtatType::class, $etat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etat = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($etat);
               $entityManager->flush();
    
            return $this->redirectToRoute('addetat');
    }
    return $this->render('etat/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }
}
