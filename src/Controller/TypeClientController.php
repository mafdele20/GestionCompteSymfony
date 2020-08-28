<?php

namespace App\Controller;

use App\Entity\TypeClient;
use App\Form\TypeClientType;
use App\Form\TypeCompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeClientController extends AbstractController
{
    /**
     * @Route("/type/client", name="type_client")
     */
    public function index()
    {
        return $this->render('type_client/index.html.twig', [
            'controller_name' => 'TypeClientController',
        ]);
    }

      /**
     * @Route("/type_client/add", name="addtypeclient")
     */
    public function create(Request $request)
    {
        $tc = new TypeClient();
        $form = $this->createForm(TypeClientType::class, $tc);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tc = $form->getData();
    
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($tc);
               $entityManager->flush();
    
            return $this->redirectToRoute('addtypeclient');
    }
    return $this->render('type_compte/add.html.twig', [
        'form' => $form->createView(),
       ]);
    }
}
