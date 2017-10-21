<?php
/*
 * Página mobile responsável por criar um calendário conforme os eventos
 * do curso nível informado visa GET.
 */
$cursonivel = $_GET['eventos'];
//cruso nível
switch ($cursonivel){
    case '6200000000001' : $eventos = 'graduacao'; break;
    case '6200000000002' : $eventos = 'lato'; break;
    case '6200000000008' : $eventos = 'stricto'; break;
}

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo  '<title>Calend&#225rio Escolar 2014</title>';
//meta para webview 
echo '<meta name="viewport" content="width=device-width, initial-scale=1"/>';

echo '<link rel="stylesheet" href="../js/fullcalendar/jquery.mobile-1.4.2.min.css"/>';
echo '<link rel="stylesheet" href="../js/fullcalendar/fullcalendar.css" />';
echo '<script src="../js/fullcalendar/jquery.min.js"></script>';
echo '<script src="../js/fullcalendar/jquery.mobile-1.4.2.min.js"></script>';
echo '<script src="../js/fullcalendar/fullcalendar.min.js" charset="UTF-8"></script>';
echo '<script src="../js/fullcalendar/eventos/'.$eventos.'.js" charset="UTF-8"></script> ';

echo '</head> ';
echo '<body> 
    <div data-role="page" id="index">
        
        <div data-role="content">       
            <div id="calendar" style="width:100%;"></div>
        </div><!-- /content -->
    
    </div><!-- /page -->
</body>';
echo '</body>';
echo '</html>';
?>