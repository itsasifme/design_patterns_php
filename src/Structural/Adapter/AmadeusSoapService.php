<?php
namespace DesignPatterns\Structural\Adapter;

/**
 * Immutable legacy service returning raw XML data via SOAP.
 */
class AmadeusSoapService
{
    /**
     * Fetches raw XML payload from the legacy endpoint.
     *
     * @return string Raw SOAP XML string.
     */
    public function getLowFareSearchXml(): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                <OTA_AirLowFareSearchRS>
                    <PricedItineraries>
                        <FlightSegment DepartureDateTime="2026-07-15T14:30:00">
                            <MarketingAirline Code="LH"/>
                        </FlightSegment>
                        <AirItineraryPricingInfo>
                            <ItinTotalFare CurrencyCode="EUR">
                                <BaseFare Amount="350.00"/>
                                <Taxes Amount="75.50"/>
                            </ItinTotalFare>
                        </AirItineraryPricingInfo>
                    </PricedItineraries>
                </OTA_AirLowFareSearchRS>
            </soap:Body>
        </soap:Envelope>';
    }
}
