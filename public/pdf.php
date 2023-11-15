<?php  

namespace PDF;

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 0);      

use FPDF\FPDF;

require_once 'fpdf/fpdf.php';

class PDF extends FPDF {
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';
    protected $col = 0;
    protected $y0; 

    function pdf_header($title, $icon_position_x = 70) {
        $this->Image('storage/system/logo.png',$icon_position_x,6,17);
        $this->SetFont('courier','B',15);
        $this->Cell(15);
        $this->Cell(0,10,$title,0,0,'C'); 
        $this->SetCol(2);
        $this->SetCol(0);
    }

    function SetCol($col) {
        $this->col = $col;
        $x = 10+$col*65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    function WriteHTML($html) { 
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e) {
            if($i%2==0) { 
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            } else { 
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else { 
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v) {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    public function unset_data() {
        unset($_SESSION['book_name']);
        unset($_SESSION['book_email']);
        unset($_SESSION['book_phone']);
        unset($_SESSION['book_brand']);
        unset($_SESSION['book_model']); 
        unset($_SESSION['book_schedule_date']);
        unset($_SESSION['book_service_time']);
        unset($_SESSION['book_data']);
        unset($_SESSION['book_total_items']);
        unset($_SESSION['book_total']);
    }

    function OpenTag($tag, $attr) { 
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag) { 
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable) { 
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s) {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt) { 
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    function purchase($header, $data) { 
        $w = array(50,50,50); 
        $this->SetFont('courier','B',10);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],0,0,'C');
        $this->Ln();
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln();  
        $this->SetFont('courier','',8);
        foreach($data as $row) {
            $price = str_replace([',', '₱'], '', $row['price']);
            $this->Cell($w[0],6,$row['product'],0,0,'LR');
            $this->Cell($w[1],6,'1',0,0,'C');
            $this->Cell($w[2],6,'Php '.number_format((int)$price,2),0,0,'R'); 
            $this->Ln();
        } 
        $this->Cell(array_sum($w),0,'','T');
    }

    public function receipt() {  
        $header = array('Product', 'Quantity', 'Price'); 
        $this->SetFont('Arial','',14);
        $this->AddPage(); 
        $this->pdf_header('CJCE AUTOPARTS');
        $this->Ln(20);
        $this->SetLeftMargin((210 - 153) / 2);
        $this->SetRightMargin((210 - 153) / 2);
        $this->SetFont('courier','B',12);
        $this->Cell(50,7,'Customer',0,0,'C');
        $this->Cell(50,7,'Vehicle',0,0,'C');
        $this->Cell(50,7,'Schedule',0,0,'C');
        $this->Ln(); 
        $this->Cell(150,0,'','T'); 
        $this->Ln();
        $this->SetFont('courier','',8);
        $this->Cell(50,6,"Name: {$_SESSION['book_name']}",0,0,'LR');
        $this->Cell(50,6,"Brand: {$_SESSION['book_brand']}",0,0,'LR');
        $this->Cell(50,6,date('F, d, Y', strtotime($_SESSION['book_schedule_date'])),0,0,'C');
        $this->Ln(); 
        $this->Cell(50,6,"Email: {$_SESSION['book_email']}",0,0,'LR');
        $this->Cell(50,6,"Model {$_SESSION['book_model']}",0,0,'LR');
        $this->Cell(50,6,$_SESSION['book_service_time'],0,0,'C');
        $this->Ln();  
        $this->Cell(50,6,"Contact no.: {$_SESSION['book_phone']}",0,0,'LR');
        $this->Cell(50,6," ",0,0,'LR');
        $this->Cell(50,6,"",0,0,'LR');  
        $this->Ln(); 
        $this->Cell(150,0,'','T'); 
        $this->Ln(10);
        $total = str_replace([',', '₱'], '', $_SESSION['book_total']);
        $this->purchase($header,$_SESSION['book_data']);
        $this->Ln();  
        $this->SetFont('courier','B',10);
        $this->Cell(50,6,"TOTAL",0,0,'LR');
        $this->SetFont('courier','B',10);
        $this->Cell(50,6,$_SESSION['book_total_items'],0,0,'C');
        $this->Cell(50,6,"Php ". number_format((int)$total,2),0,0,'C');  
        $this->Output();
        $this->unset_data();
    }

    public function coe() {
        $datestarted = date('F d, Y', strtotime($_SESSION['datestarted']));
        $day = date('d');
        $month = date('F');
        $year = date('Y');
        $html = "
            <p>This is to certify that <b>{$_SESSION['name']}</b> was an employee of CJCE Autoparts from <b>$datestarted</b> up to <b>{$_SESSION['lastday']}</b> as <b>{$_SESSION['position']}</b>.</p>
            <br /><br />
            <p>This certification is being issued by Mr./Ms. <b>{$_SESSION['name']}</b> for whatever legal purpose it may serve.</p>
            <br /><br />
            <p>Given this <b>$day th</b> day of <b>$month</b>, <b>$year</b> at 5 General Avenue Corner Road 20, Bahay Toro, Proj 8, Quezon City, 1106 Metro Manila</p>
        "; 

        $this->AddPage();
        $this->pdf_header('CERTIFICATE OF EMPLOYMENT', 50); 
        $this->Ln(20);  
        $this->SetLeftMargin(35);
        $this->SetRightMargin(30);
        $this->SetFont('Arial','',10); 
        $this->WriteHTML($html);
        $this->Ln(20);  

        $this->SetX(140);
        $this->SetFont('courier','',12);
        $this->Cell(260,4,'___________________',0,1,'');

        $this->SetFont('Arial','',8); 
        $this->Cell(260,6,"Issuer signature over printed name",0,0,'C'); 
        $this->Output();
        $this->unset_data();
    }
}

$pdf = new PDF();

echo match($_GET['pdf']) {
    'generate_payment_slip' => $pdf->receipt()
};