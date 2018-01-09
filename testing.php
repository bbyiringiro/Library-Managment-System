<?php
    require_once("dompdf/dompdf_config.inc.php");
$html = <<<EOD
    
<p>ndigande</p>

EOD;

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("watchlista.pdf");?>