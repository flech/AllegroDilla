<?php

namespace MaxDillaBundle\Controller;

use MaxDillaBundle\Entity\Produkt;
use MaxDillaBundle\Entity\Zamowienie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $zamowienia = $this->getDoctrine()
                        ->getRepository('MaxDillaBundle:Zamowienie')->findAll();

        $hajsik = 0;
        foreach ($zamowienia as $item) {

            $hajs = $item->getZysk();
            $hajsik = $hajsik + $hajs;
        }
        $wart1 = 0;
         foreach ($zamowienia as $item) {

            $wart = $item->getWartosc();
            $wart1 = $wart1 + $wart;
        }
        
        $filter = $this->get('request')->request->get('filtr');
        if (!empty($filter)) {
            $data1 = $this->get('request')->request->get('data1');
            $data2 = $this->get('request')->request->get('data2');
  
            
            $tab= array();
                 foreach ($zamowienia as &$item)
            {
           $dateObj = $item->getData();
           $dateFin = $dateObj->format('Y-m-d');


           if ($dateFin >= $data1 && $dateFin <= $data2){
               $tab[] = $item;
           }

            }
            $hajsik = 0;
             foreach ($tab as $item) {

            $hajs = $item->getZysk();
            $hajsik = $hajsik + $hajs;
        }
        
                $wart1 = 0;
         foreach ($tab as $item) {

            $wart = $item->getWartosc();
            $wart1 = $wart1 + $wart;
        }

            $zamowienia = $tab;
           
                      
        }
        
        
            return $this->render('MaxDillaBundle:Default:index.html.twig', array(
                        'zamowienia' => $zamowienia,
                        'szmal' => $hajsik,
                        'wart' => $wart1
            ));
        
    }

//     public function zamowienieAction($id)
//    {
//
//        $produkty = array();
//        
//        return $this->render('MaxDillaBundle:Default:zamowienie.html.twig',
//                array(
//                     'produkty' => $produkty
//                ));
//    }
}
