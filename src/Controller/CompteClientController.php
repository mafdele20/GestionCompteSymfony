<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Compte;
use App\Entity\Client;
use App\Entity\TypeClient;
use App\Entity\TypeCompte;
use App\Entity\Etat;


class CompteClientController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('login/index.html.twig');
    }

    /** 
     * @Route("addCompteClient", name="addCC")
     */
    public function add()
    {
        return $this->render('compte_client/add.html.twig');
    }
     /** 
     * @Route("saveCompteClient", name="saveCC")
     */
    public function save()
    {
        $db = $this->getDoctrine()->getManager();


        $typeCompteModel = $this->getDoctrine()->getRepository(TypeCompte::class);
        $etatModel = $this->getDoctrine()->getRepository(Etat::class);
        $typeClientModel = $this->getDoctrine()->getRepository(TypeClient::class);
        $ClientModel = $this->getDoctrine()->getRepository(Client::class);


        if(isset($_POST['valider']))
        {
            extract($_POST);

            $compte = new Compte();
            $compte->setNumero($numCompte);
            $compte->setCleRib("comp-".$numCompte);
            $compte->setDate( new \DateTime());
            $compte->setSolde($solde);
            $type = $typeCompteModel->findOneBy(['libelle' => $typeCompte]);
            $compte->setTypeCompte($type);
            $etat = $etatModel->find(2);
            $compte->addEtat($etat);
            $compte->setFrais($agio);
           
        
            if(isset($ancien)){
            
             $client = $ClientModel->find($idclient);
      
             $compte->setProprietaire($client);
             $ok =1;
      
               if ($client != null){
      
                  $db->persist($compte);
                  $db->flush();
      
               }else{
                  $ok = 0;
               }   
                  $data['ok'] = $ok;
                  return $this->render('compte_client/add.html.twig', $data);
         
            }
            if(isset($nouveau)){
               
                       $type =$typeClientModel->findOneBy(['libelle' => $typeClient]);
      
                       $client = new Client();
                       $client->setNom($nom);
                       $client->setPrenom($prenom);
                       $client->setAdresse($adresse);
                       $client->setEmail($email);
                       $client->setTelephone($tel);
                       $client->setSalaire($salaire);
                       $client->setNomEntreprise($nomentreprise);
                       $client->setTypeClient($type);
                     
                       $db->persist($client);
                       $db->flush();
                
                    $compte->setProprietaire($client);
                    $db->persist($compte);
                    $db->flush();

                     if($comp != null){
                        $ok = 1;
                      
                        $data['ok'] = $ok;
                        return $this->render('compte_client/add.html.twig', $data);
                     }else{
                       $ok = 0;
                       $data['ok'] = $ok;
                       return $this->render('compte_client/add.html.twig', $data);
                     }
      
            }
        
        }else{
            return $this->render('compte_client/add.html.twig');
        }
       return $this->render('compte_client/add.html.twig');
    }


      /** 
     * @Route("listeCompte", name="listeCC")
     */
    public function liste()
    {
        $CompteModel = $this->getDoctrine()->getRepository(Compte::class);
        $data['comptes'] = $CompteModel->findAll();
         
        return $this->render('compte_client/liste.html.twig',$data);
    }
}
