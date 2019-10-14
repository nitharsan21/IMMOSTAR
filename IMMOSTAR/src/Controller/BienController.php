<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bien;
use App\Form\BienType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BienController extends AbstractController
{
    /**
     * @Route("/bien", name="bien")
     */
    public function index()
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }
    
        /**
     * @Route("/bienCreate", name="bienCreate")
     */
    public function bienCreate(Request $query)
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        
        $form->handleRequest($query);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bien);
            $entityManager->flush();
            return $this->redirect('bienAfficher');
                    
       
            
      
        }
        return $this->render('bien/CreateBien.html.twig',array('form'=>$form->createView(),));
    }
    
    /**
     * @Route("/bienAfficher", name="bienAfficher")
     */
    public function BienAfficher()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Biens = $entityManager->getRepository(Bien::class)->findall();
        
        return $this->render('bien/BienListe.html.twig', [
            'Biens' => $Biens,
        ]);
    }
    
    /**
      *@Route("/Bien/verif/supprimer/{id}",name="verif_del_art")
      */
   
    public function deleteVerif(Session $session, $id){
        $article = $this->getDoctrine()->getManager()->getRepository(Bien::class)->find($id);
        return $this->render('bien/delete.html.twig', array('bien'=>$article));
    }
   
    /**
      *@Route("/Bien/supprimer/{id}",name="del_art")
      */
    public function deleterBien(Session $session, $id){

        $article = $this->getDoctrine()->getManager()->getRepository(Bien::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('bienAfficher');
    }
    
    /**
      *
      *@Route("/Bien/update/{id}",name="upd_route")
      *
      */    
     public function updateBien(Request $request, Session $session, $id){
         
        $article = new Bien() ;
        $article = $this->getDoctrine()->getManager()->getRepository(Bien::class)->find($id);
       
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
       
        $form = $this->createForm(BienType::class, $article);
       
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('bienAfficher');
            }
        }
        return $this->render( 'bien/CreateBien.html.twig', array(
            'form' =>$form->createView(), 'article'=>$article));
    }
    
}
