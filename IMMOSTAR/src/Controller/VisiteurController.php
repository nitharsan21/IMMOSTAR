<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Visiteur;
use App\Form\VisiteurType;
use Symfony\Component\HttpFoundation\Session\Session;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/visiteur", name="visiteur")
     */
    public function index()
    {
        return $this->render('visiteur/index.html.twig', [
            'controller_name' => 'VisiteurController',
        ]);
    }
    
    
    
        /**
     * @Route("/VisiteurCreate", name="VisiteurCreate")
     */
    public function VisiteurCreate(Request $query)
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(VisiteurType::class, $visiteur);
        
        $form->handleRequest($query);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiteur);
            $entityManager->flush();
            return $this->redirect('VisiteurAfficher');
                    
       
            
      
        }
        return $this->render('visiteur/CreateVisiteur.html.twig',array('form'=>$form->createView(),));
    }
    
    /**
     * @Route("/VisiteurAfficher", name="VisiteurAfficher")
     */
    public function VisiteurAfficher()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Visiteurs = $entityManager->getRepository(Visiteur::class)->findall();
        
        return $this->render('visiteur/ListeVisiteur.html.twig', [
            'Visiteurs' => $Visiteurs,
        ]);
    }
    
    
    /**
      *
      *@Route("/Visiteur/update/{id}",name="upd_routeVisiteur")
      *
      */    
     public function updateVisiteur(Request $request, Session $session, $id){
         
        $article = new Visiteur() ;
        $article = $this->getDoctrine()->getManager()->getRepository(Visiteur::class)->find($id);
       
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
       
        $form = $this->createForm(VisiteurType::class, $article);
       
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('VisiteurAfficher');
            }
        }
        return $this->render( 'visiteur/CreateVisiteur.html.twig', array(
            'form' =>$form->createView(), 'article'=>$article));
    }
}
