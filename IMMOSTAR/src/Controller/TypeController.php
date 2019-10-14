<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Type;
use App\Form\TypeType;


class TypeController extends AbstractController
{
    /**
     * @Route("/login", name="accuiel")
     */
    public function index()
    {
        return $this->render('main/accueil.html.twig');
    }
    
    /**
     * @Route("/typeAfficher", name="typeAfficher")
     */
    public function typeAfficher()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Types = $entityManager->getRepository(Type::class)->findall();
        
        return $this->render('type/TypeList.html.twig', [
            'Types' => $Types,
        ]);
    }
    
    /**
     * @Route("/typeCreate", name="typeCreate")
     */
    public function typeCréer(Request $query)
    {
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        
        $form->handleRequest($query);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
            return $this->redirect('typeAfficher');
                    
       
            
      
        }
        return $this->render('type/CreateType.html.twig',array('form'=>$form->createView(),));
    }
    
    
    /**
      *
      *@Route("/type/update/{id}",name="upd_routeType")
      *
      */    
     public function updateType(Request $request, Session $session, $id){
         
        $article = new Type() ;
        $article = $this->getDoctrine()->getManager()->getRepository(Type::class)->find($id);
       
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
       
        $form = $this->createForm(TypeType::class, $article);
       
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('typeAfficher');
            }
        }
        return $this->render( 'type/CreateType.html.twig', array(
            'form' =>$form->createView(), 'article'=>$article));
    }
    
    /**
      *@Route("/type/delete/{id}",name="del_type")
      */
    public function deleter(Session $session, $id){

        $article = $this->getDoctrine()->getManager()->getRepository(Bien::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('bienAfficher');
    }
    
    
    
}
