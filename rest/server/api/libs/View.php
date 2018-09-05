<?php

include_once('fpdf.php');

class View 
{
    public function __construct($code, $data, $printType) {
        switch ($printType) {
            case null:
            case 'json':
                $this->printJson($code, $data);
                break;
            case 'pdf':
                $this->printPdf($code, $data);
                break;
            case 'xml':
                $this->printXml($code, $data);
                break;
            default:
                $this->printJson('404', array("message" => "Not found"));
                break;
        }
    }
    public function printJson($code, $data)
    {
        http_response_code($code);
        echo json_encode($data);
    }

    public function printPdf($code, $data)
    {
        //$name = 'file.pdf';
        //file_get_contents is standard function
        //$content = file_get_contents($name);
        /*
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=data.pdf');
        header("Content-Description: PHP Generated Data");
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.count($data));
        header('Accept-Ranges: bytes');
        header('Expires: 0');
        header('Cache-Control: public, must-revalidate, max-age=0');
        echo "test";*/
        
        $pdf=new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
        
    }

    public function printXml()
    {
        # code...
    }
}
