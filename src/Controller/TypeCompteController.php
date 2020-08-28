<?php

namespace App\Controller;

use App\Entity\TypeCompte;
use App\Form\TypeCompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeCompteController extends AbstractController
{
    /**
     * @Route("/type/compte", name="type_compte")
     */
    public function index()
    {

        
        return $this->render('type_compte/index.html.twig', [
            'controller_name' => 'TypeCompteController',
        ]);
    }

    /**
     * @Route("/type_compte/add", name="addtypecompte")
     */
    public function create(Request $request)
    {
        $tc = new TypeCompte();
        $form = $this->createForm(TypeCompteType::class, $tc);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tc = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($tc);
               $entityManager->flush();
    
            return $this->redirectToRoute('addtypecompte');
    }
    return $this->render('type_compte/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }
}
