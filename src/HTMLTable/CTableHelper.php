<?php
namespace Anax\HTMLTable;

/**
* Simple class to create basic HTML tables with columns, rows and table headers.
* Some basic styling options are available if ctablehelper.css is included in your stylesheet.
* You can also add your own class name to handle the styling on your own.
*
* Available stylings:
*    'light'
*    'dark'
*    'oddeven'
*    'colorful'
*
*
* @package CTableHelper
*/

class CTableHelper {

    /**
    * Properties
    */

    private $cssClass;


    /**
    * Creates the table headers for each column (can be left as an empty array to exclude headers).
    *
    * @param array $header contains headers for columns in table
    *
    * @return string $html, html code used to create table headers
    */
    private function createHeaders($headers) {
        $html = '<tr class="ctable-headertag">';
        foreach ($headers as $index => $header) {
            $html .= '<th>' . $header . '</th>';
        }
        $html .= '</tr>';
        return $html;

    }

    /**
    * Creates the table cells and rows.
    *
    * @param array $data contains the data that goes into the cells.
    *
    * @return string $html, html code used to create table cells and rows.
    */
    private function createCells($data){
        $html = '';
        foreach ($data AS $index => $row) {
            $html .= '<tr class="ctable-rows">';
            foreach ($row as $rownr => $data) {
                $html .= '<td>' . $data . '</td>';
            }
            $html .= '</tr>';
        }
        return $html;
    }

    /**
    * Creates a HTML Table.
    *
    * @param array $headers contains the table headers. Use empty array (array() or []) for table without headers.
    * @param nested array $data contains the data that goes into the cells.
    * @param string $style to choose which style to be used (optional).
    *
    * Example call to function:
    * $myheaders = ['header 1', 'header 2'];
    * $mydata = [['row1', 'row1'], ['row2', 'row2']];
    * createTable($myheaders, $mydata);
    *
    * @return string $html, html code used to create table cells and rows.
    */
    public function createTable($headers, $data, $style = '') {

        //Check if header or data is not an array
        if(!is_array($headers) || !is_array($data)) {
            return "Failed to create HTMLTable, header and data must be arrays.";
        }

        //Check that the nr of headers (if more than zero) matches nr of data columns
        // and if there are no headings, check that all rows contain the same number of columns
        if (!empty($headers)) {
            $nrHeaders = count($headers);
            foreach ($data AS $key => $value) {
                $nrValue = count($value);
                if ($nrValue != $nrHeaders) {
                    return "Failed to create HTMLTable, not an equal nr of headers and columns.";
                }
            }
        } else {
            //Check if there are the same number of cells in each row
            $checkValue = 0;
            for ($i = 0; $i < count($data); $i++) {
                foreach ($data AS $key => $value) {
                    if ($i === 0) {
                        $checkValue = count($value);
                    } elseif ($checkValue != count($value)) {
                        return "Failed to create HTMLTable, not equal nr of cells in each row.";
                    }
                }
            }
        }

        //Checks if $style is a string, if not use default light as styling
        if(is_string($style)){
            $this->cssClass = $style;
        } else {
            $this->cssClass = 'light';
        }

        $tableHeader = $this->createHeaders($headers);
        $tableCells = $this->createCells($data);

        $html = <<< EOD
<table class="ctable-tabletag {$this->cssClass}">
{$tableHeader}
{$tableCells}
</table>
EOD;

        return $html;

    }
}
