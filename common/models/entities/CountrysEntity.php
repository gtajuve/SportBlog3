<?php

class CountrysEntity extends Entity
{
    protected $id;
    protected $countryName;
    protected $cnt;

    /**
     * @return mixed
     */
    public function getCnt()
    {
        return $this->cnt;
    }

    /**
     * @param mixed $cnt
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }


}