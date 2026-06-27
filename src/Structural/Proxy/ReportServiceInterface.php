<?php
namespace DesignPatterns\Structural\Proxy;

/**
 * Interface for report generation services.
 */
interface ReportServiceInterface
{
    /**
     * Generate a report and return its filename or an error string.
     *
     * @param int $reportId
     * @return string
     */
    public function generateReport(int $reportId): string;
}
