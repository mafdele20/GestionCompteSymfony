<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\EntrepriseType;
use App\Form\NonSalarieType;
use App\Form\SalarieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index()
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }


     /**
     * @Route("/salarie", name="salarie")
     */
    public function Salarie(Request $request)
    {
        $c= new Client();
        $form = $this->createForm(SalarieType::class, $c);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $c = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($c);
               $entityManager->flush();
    
            return $this->redirectToRoute('salarie');
    }
    return $this->render('client/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }

    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function entreprise(Request $request)
    {
        $c= new Client();
        $form = $this->createForm(EntrepriseType::class, $c);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $c = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($c);
               $entityManager->flush();
    
            return $this->redirectToRoute('entreprise');
    }
    return $this->render('client/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }

      /**
     * @Route("/nonsalarie", name="nonsalarie")
     */
    public function nonsalarie(Request $request)
    {
        $c= new Client();
        $form = $this->createForm(NonSalarieType::class, $c);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $c = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($c);
               $entityManager->flush();
    
            return $this->redirectToRoute('nonsalarie');
    }
    return $this->render('client/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }
}
