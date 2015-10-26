<?php

namespace MaxDillaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produkt
 */
class Produkt {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nazwa;

    /**
     * @var float
     */
    private $cenaNetto;

    /**
     * @var string
     */
    private $idZam;
    private $ilosc;
    private $cenaSprzedazy;
    private $zysk;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    function getZysk() {
        return $this->zysk;
    }

    function setZysk($zysk) {
        $this->zysk = $zysk;
    }

        /**
     * Set nazwa
     *
     * @param string $nazwa
     * @return Produkt
     */
    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa() {
        return $this->nazwa;
    }

    /**
     * Set cenaNetto
     *
     * @param float $cenaNetto
     * @return Produkt
     */
    public function setCenaNetto($cenaNetto) {
        $this->cenaNetto = $cenaNetto;

        return $this;
    }

    /**
     * Get cenaNetto
     *
     * @return float 
     */
    public function getCenaNetto() {
        return $this->cenaNetto;
    }

    /**
     * Set idZam
     *
     * @param string $idZam
     * @return Produkt
     */
    public function setIdZam($idZam) {
        $this->idZam = $idZam;

        return $this;
    }

    /**
     * Get idZam
     *
     * @return string 
     */
    public function getIdZam() {
        return $this->idZam;
    }

    function getIlosc() {
        return $this->ilosc;
    }

    function setIlosc($ilosc) {
        $this->ilosc = $ilosc;
    }
    function getCenaSprzedazy() {
        return $this->cenaSprzedazy;
    }

    function setCenaSprzedazy($cenaSprzedazy) {
        $this->cenaSprzedazy = $cenaSprzedazy;
    }


}
