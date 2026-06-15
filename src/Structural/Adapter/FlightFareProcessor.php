<?php
namespace DesignPatterns\Structural\Adapter;

use DesignPatterns\Structural\Adapter\FlightFareDataSourceInterface;

/**
 * Core business service consuming standardized flight fare data sources.
 */
class FlightFareProcessor
{
    /**
     * Processes and renders unified flight information.
     *
     * @param FlightFareDataSourceInterface $dataSource Any strategy satisfying the target interface.
     * @return void
     */
    public function displayFare(FlightFareDataSourceInterface $dataSource): void
    {
        $jsonData = $dataSource->fetchFareJson();

        echo "Rendering unified flight fare card:\n";
        echo $jsonData . PHP_EOL;
    }
}
