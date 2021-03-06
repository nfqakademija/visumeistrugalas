<?php
/**
 * Created by PhpStorm.
 * User: Renatas Narmontas
 * Date: 02/05/16
 * Time: 17:46
 */

namespace AppBundle\DatabaseManager;

use AppBundle\Entity\Forecast;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ForecastDeviationCalculator
 * @package AppBundle\DatabaseManager
 */
class ForecastDeviationCalculator
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

    /**
     * CalculateForecastDeviations constructor.
     * @param ManagerRegistry $managerRegistry
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct(ManagerRegistry $managerRegistry, string $startDate, string $endDate)
    {
        $this->managerRegistry = $managerRegistry;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Update Forecast $temperatureHighDeviation and $temperatureLowDeviation properties
     */
    public function updateForecastTemperatureDeviationsOthers()
    {
        $entityManager = $this->managerRegistry->getManager();

        /** @var array $tempDevHigh */
        $tempDevHigh = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdAndTemperatureDevHigh($this->startDate, $this->endDate);

        /** @var array $tempDevLow */
        $tempDevLow = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdAndTemperatureDevLow($this->startDate, $this->endDate);

        $humidityAndPressureDevs = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdHumidityAndPressureDeviations($this->startDate, $this->endDate);

        $this->assignAndFlushTemperatureHighDeviation($tempDevHigh);
        $this->assignAndFlushTemperatureLowDeviation($tempDevLow);
        $this->assignAndFlushHummidityAndPressure($humidityAndPressureDevs);
    }

    /**
     * Update Forecast $temperatureHighDeviation and $temperatureLowDeviation properties
     */
    public function updateForecastTemperatureDeviationsOur()
    {
        $entityManager = $this->managerRegistry->getManager();

        /** @var array $tempDevHigh */
        $tempDevHigh = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdAndTemperatureDevHighOur($this->startDate, $this->endDate);

        /** @var array $tempDevLow */
        $tempDevLow = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdAndTemperatureDevLowOur($this->startDate, $this->endDate);

        $humidityAndPressureDevs = $entityManager->getRepository('AppBundle:Forecast')
            ->getForecastIdHumidityAndPressureDeviationsOur($this->startDate, $this->endDate);

        $this->assignAndFlushTemperatureHighDeviation($tempDevHigh);
        $this->assignAndFlushTemperatureLowDeviation($tempDevLow);
        $this->assignAndFlushHummidityAndPressure($humidityAndPressureDevs);
    }

    /**
     * @param array $tempDevHigh
     */
    private function assignAndFlushTemperatureHighDeviation(array $tempDevHigh)
    {
        $entityManager = $this->managerRegistry->getManager();

        // Get Forecast entity and fill temperatureHighDeviation property
        foreach ($tempDevHigh as $item) {
            /** @var Forecast $forecast */
            $forecast = $entityManager->getRepository('AppBundle:Forecast')->findOneById($item['id']);
            $forecast->setTemperatureHighDeviation($item['temp_deviation_high']);
        }

        $entityManager->flush();
    }

    /**
     * @param array $tempDevLow
     */
    private function assignAndFlushTemperatureLowDeviation(array $tempDevLow)
    {
        $entityManager = $this->managerRegistry->getManager();

        // Get Forecast entity and fill temperatureLowDeviation property
        foreach ($tempDevLow as $item) {
            /** @var Forecast $forecast */
            $forecast = $entityManager->getRepository('AppBundle:Forecast')->findOneById($item['id']);
            $forecast->setTemperatureLowDeviation($item['temp_deviation_low']);
        }

        $entityManager->flush();
    }

    /**
     * @param array $humidityAndPressureDevs
     */
    private function assignAndFlushHummidityAndPressure(array $humidityAndPressureDevs)
    {
        $entityManager = $this->managerRegistry->getManager();

        // Get Forecast entity and fill humidityDeviation and pressureDeviation properties
        foreach ($humidityAndPressureDevs as $item) {
            /** @var Forecast $forecast */
            $forecast = $entityManager->getRepository('AppBundle:Forecast')->findOneById($item['id']);
            $forecast->setHumidityDeviation($item['humidity_deviation']);
            $forecast->setPressureDeviation($item['pressure_deviation']);
        }

        $entityManager->flush();
    }
}
