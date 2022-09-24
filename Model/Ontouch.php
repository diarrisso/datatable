<?php

class Ontouch

{
    private $kundennummer;
    private $name;
    private $urlSc;
    private $rufnummerSc;
    private $urlCc;
    private $rufnummerCc;
    private $auftragsart;

    /**
     * @return mixed
     */
    public function getKundennummer()
    {
        return $this->kundennummer;
    }

    /**
     * @param mixed $kundennummer
     */
    public function setKundennummer($kundennummer)
    {
        $this->kundennummer = $kundennummer;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUrlSc()
    {
        return $this->urlSc;
    }

    /**
     * @param mixed $urlSc
     */
    public function setUrlSc($urlSc)
    {
        $this->urlSc = $urlSc;
    }

    /**
     * @return mixed
     */
    public function getRufnummerSc()
    {
        return $this->rufnummerSc;
    }

    /**
     * @param mixed $rufnummerSc
     */
    public function setRufnummerSc($rufnummerSc)
    {
        $this->rufnummerSc = $rufnummerSc;
    }

    /**
     * @return mixed
     */
    public function getUrlCc()
    {
        return $this->urlCc;
    }

    /**
     * @param mixed $urlCc
     */
    public function setUrlCc($urlCc)
    {
        $this->urlCc = $urlCc;
    }

    /**
     * @return mixed
     */
    public function getRufnummerCc()
    {
        return $this->rufnummerCc;
    }

    /**
     * @param mixed $rufnummerCc
     */
    public function setRufnummerCc($rufnummerCc)
    {
        $this->rufnummerCc = $rufnummerCc;
    }

    /**
     * @return mixed
     */
    public function getAuftragsart()
    {
        return $this->auftragsart;
    }

    /**
     * @param mixed $auftragsart
     */
    public function setAuftragsart($auftragsart)
    {
        $this->auftragsart = $auftragsart;
    }


}