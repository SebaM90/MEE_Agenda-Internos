<?php
// detalles de la conexion
$conn_string = "host=localhost port=5432 dbname=telefonia user=postgres password=Nomemires++0";
// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string) or die('Error: ' . pg_last_error());;
// Revisamos el estado de la conexion en caso de errores. 
if(!$dbconn) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {
// echo "Conexión exitosa\n";
} 
?>