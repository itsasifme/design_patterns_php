<?php
namespace DesignPatterns\Structural\Proxy;

/**
 * Proxy that adds permission checks and caching to a ReportService.
 */
class CachedReportProxy implements ReportServiceInterface
{
    /** @var array<int,string> */
    private array $cache = [];

    /**
    * @param int                      $userId
    * @param ReportServiceInterface   $reportService
    */
    public function __construct(private int $userId, private ReportServiceInterface $reportService)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function generateReport(int $reportId): string
    {
        if (!$this->isUserAllowed($reportId)) {
            return 'Access denied.';
        }

        if (isset($this->cache[$reportId])) {
            echo "Returning cached report..." . PHP_EOL;

            return $this->cache[$reportId];
        }

        $report = $this->reportService->generateReport($reportId);

        $this->cache[$reportId] = $report;

        return $report;
    }

    /**
     * Check whether the user is allowed to access the given report.
     */
    private function isUserAllowed(int $reportId): bool
    {
        $allowedReports = $this->fetchAllowedReportsForUser();

        return in_array($reportId, $allowedReports, true);
    }

    /**
     * Simulate permission lookup for the current user.
     *
     * @return int[]
     */
    private function fetchAllowedReportsForUser(): array
    {
        echo "Proxy fetching user permissions..." . PHP_EOL;

        if ($this->userId === 10) {
            return [501, 502];
        }

        if ($this->userId === 20) {
            return [503];
        }

        return [];
    }
}
