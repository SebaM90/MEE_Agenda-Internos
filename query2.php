<?php

// QUERY - Para obtener la cantidad de accesos ----------------
$valorHOST = getenv('REMOTE_HOST');
$FechaDeHoy = date("Y-m-d");
$query = "
            SELECT *
            FROM public.log_conexiones
            WHERE hostname = '$valorHOST' AND sistema = 'internos' AND current_date = '$FechaDeHoy'
            ORDER BY acceso_cantidad DESC
            LIMIT 1;
        ";

$res = pg_query($query) or die('Error: ' . pg_last_error());
$row = pg_fetch_assoc($res);
$valorCantidadAccesos = $row['acceso_cantidad'];

// QUERY - FIN -------------------------------------------------



// INSERT INTO ----------------------------------------------------------------------------------------------------------------
require '../FuncionesPHP/browser-detect.php';
require '../FuncionesPHP/os-detect.php';

// Preparar consulta para ejecución
$sql = '';
$sql = "
        INSERT INTO public.log_conexiones (hostname, ip, sistema, fecha_acceso, acceso_cantidad, cliente_so, cliente_plataforma)
        VALUES ( $1 , $2 , $3 , CURRENT_TIMESTAMP , $4 , $5 , $6 )
       ";

//      ON CONFLICT (hostname) DO UPDATE SET ip=$2, fecha_acceso=CURRENT_TIMESTAMP;



$consulta = pg_prepare($dbconn, "sql_insertar", $sql);

// hostname, ip, sistema, fecha_acceso, acceso_cantidad, cliente_so, cliente_plataforma

$valorHOST = getenv('REMOTE_HOST');     //  $1
$valorIP = getenv('REMOTE_ADDR');       //  $2
$valorSistema = "internos";             //  $3
$valorCantidadAccesos += 1;             //  $4
$valorOS = getPlatform();               //  $5
$valorPlatform = getBrowser();          //  $6

// Ejecutar la consula preparada
$result = pg_execute($dbconn, "sql_insertar", array( $valorHOST , $valorIP , $valorSistema , $valorCantidadAccesos , $valorOS , $valorPlatform ));

// ------------------------------------------------------------------------------------------------------------------------------

?>