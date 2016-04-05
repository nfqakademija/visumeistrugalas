<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Temperature
 *
 * @ORM\Table(name="temperatures")
 * @ORM\Entity
 **/

class Temperature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $date;

    /**
     * @var City
     *
     * @ManyToOne(targetEntity="City")
     * @JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var float
     *
     * @ORM\Column(name="temperature_high", type="float")
     */
    private $temperatureHigh;

    /**
     * @var float
     *
     * @ORM\Column(name="temperature_low", type="float")
     */
    private $temperatureLow;

    /**
     * @var Provider
     *
     * @ManyToOne(targetEntity="Provider")
     * @JoinColumn(name="provider_id", referencedColumnName="id")
     */
    private $provider;

    /**
     * @var integer
     *
     * @ORM\Column(name="humidity", type="integer")
     */
    private $humidity;

    /**
     * @var float
     *
     * @ORM\Column(name="pressure", type="float")
     */
    private $pressure;


    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date.
     *
     * @param DateTime $date
     * @return Temperature
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set city.
     *
     * @param City $city
     * @return Temperature
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set temperature.
     *
     * @param float $temperatureHigh
     * @return Temperature
     */
    public function setTemperatureHigh($temperatureHigh)
    {
        $this->temperatureHigh = $temperatureHigh;

        return $this;
    }

    /**
     * Get temperature high.
     *
     * @return float
     */
    public function getTemperatureHigh()
    {
        return $this->temperatureHigh;
    }

    /**
     * Set temperature.
     *
     * @param float $temperatureLow
     * @return Temperature
     */
    public function setTemperatureLow($temperatureLow)
    {
        $this->temperatureLow = $temperatureLow;

        return $this;
    }

    /**
     * Get temperature low.
     *
     * @return float
     */
    public function getTemperatureLow()
    {
        return $this->temperatureLow;
    }

    /**
     * Set provider.
     *
     * @param Provider $provider
     * @return temperature
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider.
     *
     * @return Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set humidity.
     *
     * @param integer $humidity
     * @return Temperature
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;

        return $this;
    }

    /**
     * Get humidity.
     *
     * @return integer
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Set pressure.
     *
     * @param float $pressure
     * @return Temperature
     */
    public function setPressure($pressure)
    {
        $this->pressure = $pressure;

        return $this;
    }

    /**
     * Get pressure.
     *
     * @return float
     */
    public function getPressure()
    {
        return $this->pressure;
    }
}