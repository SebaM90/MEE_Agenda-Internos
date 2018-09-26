<?php
echo "<table id=idTabla class=tabla>";
echo "<tr>";
echo "<th>INT</th><th>EDIFICIO</th><th>SECRETARíA</th><th>OFICINA</th><th>APELLIDO</th><th>NOMBRE</th><th>PISO</th><th>Revisión</th>";
echo "</tr>";

$query = "select * from \"ListarTodos\";";
$res = pg_query($query) or die('Error: ' . pg_last_error());
$contador = 0;
	while ($row = pg_fetch_assoc($res)) {
	echo '<tr id='.++$contador.'>';
	echo '<td class="cINT">'.$row['INTERNO'].'</td>';
	echo '<td>'.$row['EDIFICIO'].'</td>';
	echo '<td>'.$row['SECRETARÍA'].'</td>';
	echo '<td class=rowOFI>'.$row['OFICINA'].'</td>';
	echo '<td>'.$row['APELLIDO'].'</td>';
	echo '<td>'.$row['NOMBRE'].'</td>';
	echo '<td>'.$row['PISO'].'</td>';
        
$datetime1 = date_create();
$datetime2 = date_create($row['FILA_MOD']);
$interval = date_diff($datetime2, $datetime1);
$dias = $interval->format('%a');
$dias = (int)($dias);

if ($dias > 360) {
    $result = "Hace más de 1 año";
} elseif ($dias > 60) {
    $result = "Hace ".($dias/30)." meses";
} elseif ($dias == 30) {
    $result = "Hace 1 mes";
} elseif ($dias > 7) {
    $result = "Hace ".($dias)." días";
} elseif ($dias == 7) {
    $result = "Hace 1 semana";
} elseif ($dias == 2) {
    $result = "Anteayer";
} elseif ($dias == 1) {
    $result = "Ayer";
} elseif ($dias > 0) {
    $result = "Hace ".$dias." días";
} else {
    $result = "Hoy";
}
    
    if ($row['FILA_MOD'] == '') {
        $result = "";
    }
    echo '<td>'.$result.'</td>';
	echo'</tr>';
	}
echo "</table>";
?>