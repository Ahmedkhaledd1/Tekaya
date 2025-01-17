<?php
class PDFReport extends AbstractUserReportTemplate
{
    protected function generateReport(): void
    {
        echo "Generating PDF report...\n";
    }
}