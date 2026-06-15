<?php
namespace DesignPatterns\Structural\Adapter\ClassAdapter;

use DesignPatterns\Structural\Adapter\AmadeusSoapService;
use DesignPatterns\Structural\Adapter\FlightFareDataSourceInterface;
use SimpleXMLElement;

/**
 * GoF Class Adapter inheriting from AmadeusSoapService to implement FlightFareDataSourceInterface.
 */
class AmadeusFareAdapter extends AmadeusSoapService implements FlightFareDataSourceInterface
{
    /**
     * Unwraps the SOAP envelope and extracts the normalized JSON payload.
     *
     * @return string Validated JSON string.
     */
    public function fetchFareJson(): string
    {
        $xmlRaw = $this->getLowFareSearchXml();
        $xmlElement = simplexml_load_string($xmlRaw);

        if ($xmlElement === false) {
            return json_encode(['error' => 'Malformed XML payload']);
        }

        $xmlElement->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $bodyNodes = $xmlElement->xpath('//soap:Body/*');
        $bodyNode = $bodyNodes[0] ?? null;

        if ($bodyNode === null) {
            return json_encode(['error' => 'Invalid SOAP envelope structure']);
        }

        return $this->transformToTargetJson($bodyNode);
    }

    /**
     * Maps raw XML values into the target domain array layout.
     *
     * @param SimpleXMLElement $payload Inner payload extracted from the SOAP body.
     * @return string Standardized JSON string.
     */
    private function transformToTargetJson(SimpleXMLElement $payload): string
    {
        $airlineCode = (string) ($payload->xpath('//MarketingAirline/@Code')[0] ?? 'UNKNOWN');
        $departureTime = (string) ($payload->xpath('//FlightSegment/@DepartureDateTime')[0] ?? '');
        
        $baseFare = (float) ($payload->xpath('//BaseFare/@Amount')[0] ?? 0.0);
        $taxes = (float) ($payload->xpath('//Taxes/@Amount')[0] ?? 0.0);
        $currency = (string) ($payload->xpath('//ItinTotalFare/@CurrencyCode')[0] ?? 'USD');
        
        $totalFare = $baseFare + $taxes;

        $normalizedData = [
            'airline_code' => $airlineCode,
            'departure_time' => $departureTime,
            'base_fare' => $baseFare,
            'taxes' => $taxes,
            'total_fare' => $totalFare,
            'currency' => $currency,
        ];

        return json_encode($normalizedData, JSON_PRETTY_PRINT);
    }
}
