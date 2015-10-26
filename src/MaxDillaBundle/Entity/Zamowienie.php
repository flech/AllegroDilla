<?php

namespace MaxDillaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zamowienie
 */
class Zamowienie
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nazwaKliena;

    /**
     * @var float
     */
    private $wartosc;

    /**
     * @var float
     */
    private $zysk;

    /**
     * @var \DateTime
     */
    private $data;
   
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwaKliena
     *
     * @param string $nazwaKliena
     * @return Zamowienie
     */
    public function setNazwaKliena($nazwaKliena)
    {
        $this->nazwaKliena = $nazwaKliena;

        return $this;
    }

    /**
     * Get nazwaKliena
     *
     * @return string 
     */
    public function getNazwaKliena()
    {
        return $this->nazwaKliena;
    }

    /**
     * Set wartosc
     *
     * @param float $wartosc
     * @return Zamowienie
     */
    public function setWartosc($wartosc)
    {
        $this->wartosc = $wartosc;

        return $this;
    }

    /**
     * Get wartosc
     *
     * @return float 
     */
    public function getWartosc()
    {
        return $this->wartosc;
    }

    /**
     * Set zysk
     *
     * @param float $zysk
     * @return Zamowienie
     */
    public function setZysk($zysk)
    {
        $this->zysk = $zysk;

        return $this;
    }

    /**
     * Get zysk
     *
     * @return float 
     */
    public function getZysk()
    {
        return $this->zysk;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Zamowienie
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }
}
