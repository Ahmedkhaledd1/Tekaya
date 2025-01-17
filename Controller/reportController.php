<?php
require_once "View/reportView.php";
require_once "Model/XMLReport.php";

class ReportController
{
    private $filePath = null;
    public function showReportGeneration() {
        $view = new ReportView();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->filePath == null) {
            $donorId = $_POST['donorId'];
            $reportType = $_POST['reportType'];

            $xmlReport = new XMLReport();
            if ($reportType == "XML"){
                $this->filePath = $xmlReport->processReport((int)$donorId);
            }
            // header("Location: /profile");
            // exit();
            echo $view->render();
        }
        elseif ($this->filePath != null) {
            echo $this->filePath;
        }
        else {
            echo $view->render();
        }
    }
}