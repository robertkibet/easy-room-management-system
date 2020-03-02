<?php
/*
* Author: onlinecode.org
* start Pdf.php file
* Location: ./application/libraries/Pdf.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }


    public function Footer() {
        // Position at 25 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'B', 5);

        $this->Cell(0, 0, 'infoingolan@gmail.com,  www.golanaccomodations.co.ke', 0, 0, 'C');
        $this->Ln();
        $this->Cell(0,0,'0722247909, 0720864899 | P.O Box 4162 - 30100, Eldoret, KE.', 0, false, 'C', 0, '', 0, false, 'T', 'M');

        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}