<?php

// Abstract Class: UserReportTemplate
abstract class AbstractUserReportTemplate
{
    // Template Method
    public function processReport($donorId)
    {
        $this->generateReport(donorId:$donorId);
        $this->saveReport();
    }

    // Abstract method to be implemented by subclasses
    abstract protected function generateReport($donorId): string;

    // Concrete methods shared by all subclasses
    protected function saveReport(): void
    {
        echo "Report saved.\n";
    }

    protected function removeReport(): void
    {
        echo "Report removed from temporary storage.\n";
    }
}