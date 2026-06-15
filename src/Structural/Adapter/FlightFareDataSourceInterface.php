<?php
namespace DesignPatterns\Structural\Adapter;

/**
 * Interface for normalizing external airline fare payloads.
 */
interface FlightFareDataSourceInterface
{
    /**
     * Fetches raw fare data and returns a structured JSON string.
     *
     * @return string JSON schema: {airline_code: string, departure_time: string, base_fare: float, taxes: float, total_fare: float, currency: string}
     */
    public function fetchFareJson(): string;
}
