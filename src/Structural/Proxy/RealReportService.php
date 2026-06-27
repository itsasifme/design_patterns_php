<?php
namespace DesignPatterns\Structural\Proxy;

/**
 * The real, heavyweight report generator.
 */
class RealReportService implements ReportServiceInterface
{
    /**
     * Perform expensive operations to generate a report.
     *
     * @param int $reportId
     * @return string
     */
    public function generateReport(int $reportId): string
    {
        echo "Connecting to database..." . PHP_EOL;
        echo "Fetching report data..." . PHP_EOL;
        echo "Loading files from storage..." . PHP_EOL;
        echo "Rendering PDF..." . PHP_EOL;
        echo "Writing export log..." . PHP_EOL;

        return "report_{$reportId}.pdf";
    }
}
