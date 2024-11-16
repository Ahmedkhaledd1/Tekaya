<?php
class View {
    protected $title = "Tekaya"; // Default title
    protected $styles = []; // Array to hold stylesheets

    // Set the title of the page
    public function setTitle($title) {
        $this->title = $title;
    }

    // Add stylesheets
    public function addStyle($style) {
        $this->styles[] = $style;
    }

    // Render the HTML header
    public function renderHeader() {
        $styles = '';
        foreach ($this->styles as $style) {
            $styles .= "<link rel='stylesheet' href='{$style}'>\n";
        }

        return "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>{$this->title}</title>
            {$styles}
        </head>
        <body>";
    }

    // Render the HTML footer
    public function renderFooter() {
        return "
        <footer>
            <p>&copy; " . date("Y") . " Your Company. All rights reserved.</p>
        </footer>
        </body>
        </html>";
    }
}
