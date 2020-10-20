<?php


namespace LabStudio\GeoPolitic;


use LabStudio\GeoPolitic\Exception\CountryProviderException;
use Zend\Hydrator\Reflection;

class CountryProvider
{

    /**
     * @var array|null
     */
    protected static $inventory;
    protected static $getHelperLatin2ToLatin3 = [];
    protected static $getHelperNameToLatin3 = [];
    protected static $getHelperNumericToLatin3 = [];
    protected $instancesLatin3 = [];
    /**
     * @var ClassMethods
     */
    protected $hydrator;


    /**
     * @param $code
     * @return bool
     */
    public function has($code)
    {
        return (boolean) ($this->getLatin3By($code));
    }

    /**
     * @param $code
     * @return Country|null
     * @throws CountryProviderException
     */
    public function get($code)
    {
        if ($this->has($code)) {
            return $this->getInstanceByLatin3($this->getLatin3By($code));
        }
        throw new CountryProviderException(sprintf('Not found country by [%s]', $code));
    }


    /**
     * @param $latin3
     * @return Country|null
     */
    protected function getInstanceByLatin3($latin3)
    {

        if (!isset($this->instancesLatin3[$latin3])) {

            $this->instancesLatin3[$latin3] = null;
            $inventory = $this->getInventory();

            if (!empty($inventory[$latin3])) {

                $data = $inventory[$latin3];
                $country = $this->getHydrator()->hydrate($data, new Country);
                $this->instancesLatin3[$latin3] = $country;

            }
        }

        return $this->instancesLatin3[$latin3];


    }


    /**
     * @param $string
     * @return mixed|null
     */
    protected function getLatin3By($string) {

        $inventory = $this->getInventory();

        if(!empty($inventory[$string])) {
            return $string;
        } elseif ($string && !empty(self::$getHelperNameToLatin3[strtoupper($string)])) {
            return self::$getHelperNameToLatin3[strtoupper($string)];
        } elseif ($string && !empty(self::$getHelperLatin2ToLatin3[strtoupper($string)])) {
            return self::$getHelperLatin2ToLatin3[strtoupper($string)];
        } elseif ($string && !empty(self::$getHelperNumericToLatin3[$string])) {
            return self::$getHelperNumericToLatin3[$string];
        }
        return null;
    }


    /**
     * @return Reflection
     */
    protected function getHydrator()
    {
        if ($this->hydrator === null) {
            $this->hydrator = new Reflection();
        }
        return $this->hydrator;
    }


    /**
     * @return array|mixed
     */
    protected function getInventory()
    {
        if (self::$inventory === null) {

            $data = include __DIR__ . '/Data/countriesISO3166.config.php';
            self::$inventory = [];

            foreach ($data as $item) {

                if (!empty($item['alpha3'])) {
                    $alpha3 = $item['alpha3'];
                    $alpha2 = (!empty($item['alpha2'])) ? $item['alpha2'] : null;
                    $name = (!empty($item['name'])) ? $item['name'] : null;
                    $numeric = (!empty($item['numeric'])) ? $item['numeric'] : null;

                    self::$inventory[$alpha3] = $item;

                    if($alpha2) {
                        $name = strtoupper($alpha2);
                        self::$getHelperLatin2ToLatin3[$alpha2] = $alpha3;
                    }
                    if($name) {
                        $name = strtoupper($name);
                        self::$getHelperNameToLatin3[$name] = $alpha3;
                    }
                    if($numeric) {
                        self::$getHelperNameToLatin3[$numeric] = $alpha3;
                    }
                }
            }
        }
        return self::$inventory;
    }

}