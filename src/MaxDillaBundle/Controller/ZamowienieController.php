<?php

namespace MaxDillaBundle\Controller;

use MaxDillaBundle\Entity\Produkt;
use MaxDillaBundle\Entity\Zamowienie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;

class ZamowienieController extends Controller {

    public function indexAction(Request $request) {

        # pobranie obiektu sesji
        $session = $request->getSession();
        // $session->invalidate();
        # wszystkie produkty w sesji
        $produktySesja = $session->get('produkty');

        # jeśli nie ma zmiennej, stwórz ją
        if (!isset($produktySesja)) {
            $session->set('produkty', array());
        }

        $dodano = $this->get('request')->request->get('dodano');

        if (!empty($dodano)) {

            $zamowienie = new Zamowienie;
            $nazwa = $this->get('request')->request->get('nazwaKlienta');
            $zamowienie->setNazwaKliena($this->get('request')->request->get('nazwaKlienta'));
            $zamowienie->setData(new \DateTime($this->get('request')->request->get('data')));
            $zamowienie->setWartosc('0');
            $zamowienie->setZysk('0');
            $zamowienie->setWartosc('0');

            $em = $this->getDoctrine()->getManager();
            $em->persist($zamowienie);
            $em->flush();

            $order = new Zamowienie();
            $order = $this->getDoctrine()
                            ->getRepository('MaxDillaBundle:Zamowienie')->findOneBy(
                    array('nazwaKliena' => $nazwa)
            );
            $orderId = $order->getId();
            $session = $request->getSession();
            $wKoszyku = $session->get('produkty');

            foreach ($wKoszyku as $item) {
                $item2 = new Produkt();
                $item2->setNazwa($item->getNazwa());
                $item2->setCenaNetto($item->getCenaNetto());
                $item2->setIlosc($item->getIlosc());
                $item2->setIdZam($orderId);
                $item2->setZysk($item->getZysk()*$item->getIlosc());
                $item2->setCenaSprzedazy($item->getCenaSprzedazy());
                $em = $this->getDoctrine()->getManager();
                $em->persist($item2);
                $em->flush();
            }
            
          
            $query = $em->createQuery(
                'SELECT SUM(p.zysk)
    FROM MaxDillaBundle:Produkt p
    WHERE p.idZam = :price'  
           )->setParameter('price', $orderId);

            $gain = $query->setMaxResults(1)->getOneOrNullResult();
    $gain[1];
    
    
        $query1 = $em->createQuery(
                'SELECT p
    FROM MaxDillaBundle:Produkt p
    WHERE p.idZam = :price'  
           )->setParameter('price', $orderId);

            $gainer = $query1->getResult();
 $warto = 0;
            foreach ($gainer as $item)
            {
               $wart = $item->getIlosc() * $item->getCenaSprzedazy();
               
               
               $warto = $warto + $wart;
               
            }
        
     
  
    
    $order->setWartosc($warto);
    $order->setZysk($gain[1]);
     $em->persist($order);
            $em->flush();
  
            $session->invalidate();
        }

        $dodan = $this->get('request')->request->get('dodan');

        # zmienna przesłana przez drugi formularz
        if (!empty($dodan)) {


//      if (!empty($this->get('request')->request->all())) {

            $id = $request->request->all();
//            $idi = $this->get('request')->request->get('produkt.id');
            $idii = array_pop($id);
            

            $produkt = $this->getDoctrine()->getRepository('MaxDillaBundle:Produkt')->find($idii);

            $ilosc = $request->request->get('ilosc');
            $produkt->setIlosc($ilosc);

            $produktySesja[] = $produkt;
            $session->set('produkty', $produktySesja);
        }

        $wKoszyku = $session->get('produkty');

        $produkty = $this->getDoctrine()
                            ->getRepository('MaxDillaBundle:Produkt')->findBy(
                array('idZam' => 0));

        return $this->render('MaxDillaBundle:Zamowienie:index.html.twig', array(
                    'produkty' => $produkty,
                    'wKoszyku' => $wKoszyku));
    }
    
    
    
    

    public function usunProduktAction(Request $request, $id) {
        $session = $request->getSession();
        $wKoszyku = $session->get('produkty');
        unset($wKoszyku[$id]);
        $wKoszyku = array_values($wKoszyku);

        $session->set('produkty', $wKoszyku);

        $produkty = $this->getDoctrine()
                        ->getRepository('MaxDillaBundle:Produkt')->findAll();

        return $this->redirectToRoute('zamowienie_dodaj');
    }

    public function zamowienieDetailAction($id) {

        $order = $this->getDoctrine()
                        ->getRepository('MaxDillaBundle:Zamowienie')->find($id);
        $em = $this->getDoctrine()->getManager();
        $orderId = $order->getId();

        $products = $this->getDoctrine()
                            ->getRepository('MaxDillaBundle:Produkt')->findBy(
                array('idZam' => $orderId));

        return $this->render('MaxDillaBundle:Zamowienie:detail.html.twig', array(
                    'order' => $order,
                    'produkty' => $products));
    }
    
    
       public function deleteZamowienieAction($id) {
        $Produkt = $this->getDoctrine()->getRepository('MaxDillaBundle:Zamowienie')
                ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($Produkt);
        $em->flush();
        return $this->redirectToRoute('max_dilla_homepage');
    }
    
   
    
    
    

}
