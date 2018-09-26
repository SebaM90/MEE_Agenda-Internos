<?php

// Preparar consulta para ejecución
$sql = '';
$sql = 'INSERT INTO public.clientes (hostname, ip, fecha_ultima) ';
$sql = $sql . 'VALUES ($1,$2,CURRENT_TIMESTAMP) ';
$sql = $sql . 'ON CONFLICT (hostname) DO UPDATE SET ip=$2, fecha_ultima=CURRENT_TIMESTAMP';

echo 'Consulta: ' . $consulta . '<br>';
$consulta = pg_prepare($dbconn, "sql_insertar", $sql);

// Obtener IP y HOSTNAME, y en caso de no ser una PC obtener tipo de dispositivo movil
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");

if ($iphone) ($dispositivo='iPhone');
if ($android) ($dispositivo='Android');
if ($palmpre) ($dispositivo='webOS');
if ($berry) ($dispositivo='BlackBerry');
if ($ipod) ($dispositivo='iPod');
if ($ipad) ($dispositivo='iPad');

$valorIP = getenv('REMOTE_ADDR');
$valorHOST = getenv('REMOTE_HOST');

if (strlen($valorHOST)==0) ($valorHOST=$dispositivo.'-'.$valorIP);

// Ejecutar la consula preparada
$result = pg_execute($dbconn, "sql_insertar", array( $valorHOST , $valorIP ));

echo $result . '<br>';

echo '--------------------' . '<br>';
?>