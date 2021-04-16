<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf_laporan extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
    

    //Page header
    public function Header() {
        // Logo
        $image_file = './assets/images/kucecwara.jpg';
        $this->Image($image_file, 25, 10, 15, '', 'JPG', '', 'T', false, 800, '', false, false, 0, false, false, false);
        // Set font
        
        // Title
        $this->Ln(3, true);
        $this->setCellMargins(13, 0, 0, 0);
        $this->SetFont('times', 'B', 11);
        $this->Cell(180, 8, 'PEMERINTAH KOTA MALANG ', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(180, 8, 'BADAN KESATUAN BANGSA DAN POLITIK KOTA MALANG ', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(180, 8, 'LAPORAN KADER PELOPOR EVALUASI MENTAL (KPRM) ', 0, 2, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetFont('times', '', 8);
        $this->Cell(0, 6, 'Jl. A. Yani No.98, Purwodadi Kec. Blimbing, Kota Malang,Jawa Timur 65125', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 6, 'Telp. (0341) 491180', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 5, 'Laman : bakesbangpol@malangkota.go.id', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Cell(0, 8, 'Laman : www.unej.ac.id', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        

    
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $date = date('d/m/Y');
        $this->Cell(0, 10, 'Laporan Kondisi WIlayah Kota Malang | '.$date, 0, 0, 'L');
        
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
        // $this->Cell(0, 10, 'Laporan Perpustakaan Universitas Negeri Jember Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */