<?php

namespace App\Controller;

use App\Entity\Employeur;
use App\Form\EmployeurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeurController extends AbstractController
{
    /**
     * @Route("/employeur", name="employeur")
     */
    public function index(Request $request)
    {
        $em = new Employeur();

        $form = $this->createForm(EmployeurType::class, $em);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $em = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($em);
               $entityManager->flush();
    
            return $this->redirectToRoute('employeur');
        }

        return $this->render('employeur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
  

}
