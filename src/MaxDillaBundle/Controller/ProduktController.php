<?php

namespace MaxDillaBundle\Controller;

use MaxDillaBundle\Entity\Produkt;
use MaxDillaBundle\Entity\Zamowienie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduktController extends Controller {

    public function indexAction(Request $request) {
        $produkty = $this->getDoctrine()
                            ->getRepository('MaxDillaBundle:Produkt')->findBy(
                array('idZam' => 0));


        $product = new Produkt();

        $form = $this->createFormBuilder($product)
                ->add('nazwa', 'text')
                ->add('cenaNetto', 'number')
                ->add('cenaSprzedazy', 'number')
                ->add('save', 'submit', array('label' => 'Dodaj produkt'))
                ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $product = $form->getData();
                $product->setIdZam(0);
                $product->setIlosc(0);
                $product->setZysk(((($product->getCenaSprzedazy()/1.23) - $product->getCenaNetto())-$product->getCenaSprzedazy()*0.07)*1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                return $this->redirectToRoute('produkt');
            }
        }


        return $this->render('MaxDillaBundle:Default:produkt.html.twig', array(
                    'form' => $form->createView(),
                    'produkty' => $produkty));
    }

    public function deleteProduktAction($id) {
        $Produkt = $this->getDoctrine()->getRepository('MaxDillaBundle:Produkt')
                ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($Produkt);
        $em->flush();
        return $this->redirectToRoute('produkt');
    }
    
    

    public function editProduktAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $Produkt = $this->getDoctrine()->getRepository('MaxDillaBundle:Produkt')
                ->find($id);

        if (!$Produkt) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $id
            );
        }
        
          $form = $this->createFormBuilder($Produkt)
          ->add('nazwa', 'text')
          ->add('cenaNetto', 'number')
          ->add('cenaSprzedazy', 'number')
          ->add('save', 'submit', array('label' => 'Edytuj produkt'))
          ->getForm();  
       
      $form->handleRequest($request);
      
      if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $product = $form->getData();
                $product->setIdZam(0);
                $product->setIlosc(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                return $this->redirectToRoute('produkt');
            }
        }

        //$Produkt->setName('New product name!');
        //  $em->flush();
        return $this->render('MaxDillaBundle:Default:produkt_edit.html.twig', array(
                    'form' => $form->createView()));
}}
