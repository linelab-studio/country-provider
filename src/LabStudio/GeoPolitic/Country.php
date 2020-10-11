<?php


namespace LabStudio\GeoPolitic;


class Country
{
    /**
     * @var string
     */
    protected $name = 'Polska';
    /**
     * @var string
     */
    protected $alpha2 = 'PL';
    /**
     * @var string
     */
    protected $alpha3 = 'POL';
    /**
     * @var Currency[]
     */
    protected $currencies;
    /**
     * @var string
     */
    protected $locale = 'pl_PL';
    /**
     * @var string[]
     */
    protected $timezones = ['Europe/Warsaw'];

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * @return string
     */
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * @return Currency[]
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string[]
     */
    public function getTimezones()
    {
        return $this->timezones;
    }


}