<?php

class ReportView extends View {

    public function __construct() {
        // Set the title
        $this->setTitle("Report Generation");
    }

    public function render($message = '') {
        $content = $this->renderHeader();
        $content .= "
        <form method='POST' action='/adminReport'>
            <h2>Report</h2>";
        if (!empty($message)) {
            $content .= "<p style='color: red;'>{$message}</p>";
        }
        $content .= "
            <input type='text' name='donorId' placeholder='Donor id' required>

            <select name='reportType' id='reportType' onchange='toggleFields()' required>
                <option value='XML'>XML</option>
                <option value='PDF'>PDF</option>
            </select>

            <button type='submit'>Generate</button>
        </form>
        
        <script>
            function toggleFields() {
                const reportType = document.getElementById('reportType').value;
            }
            window.onload = toggleFields;
        </script>";
        $content .= $this->renderFooter();
        return $content;
    }
}