<?php
echo "<table id=idTabla class=tabla>";
echo "<thead>";
echo "      <tr>";
echo "          <th>INT</th>
                <th>EDIFICIO</th>
                <th>SECRETARíA</th>
                <th>OFICINA</th>
                <th>APELLIDO</th>
                <th>NOMBRE</th>
                <th title='Piso'>P</th>
                <th title='Última vez que se actualizó la información'>Revisión</th>
                <th title='Última estado del interno'>Conexión</th>";
echo "      </tr>";
echo "</thead>";

echo "<tbody>";
$query = "select * from \"ListarTodos\";";
$res = pg_query($query) or die('Error: ' . pg_last_error());
$contador = 0;
	while ($row = pg_fetch_assoc($res)) {

    $datetime1 = date_create();
    $datetime2 = date_create($row['FILA_MOD']);
    $interval = date_diff($datetime2, $datetime1);
    $dias = $interval->format('%a');
    $dias = (int)($dias);

    //( $dias <= 7 ) ? $reciente="NuevoInterno" : $reciente="";
    ( $dias <= 7 ) ? $reciente="NuevoInterno animated infinite slow pulse" : $reciente="";

    $aux = "<a href='#' onclick='sugerencia(".$row['ID']. ',' .$row['INTERNO']. ")'><img src='icon-modif_blue.png' title='Click para solicitar cualquier rectificación y/o supresión de información.'></a>";

    echo '<tr id='.++$contador.' class="'.$reciente.'">';
	echo '<td class="cINT '.$reciente.'">'. trim($aux) . $row['INTERNO'].'</td>';
	echo '<td class="'.$reciente.'">'.$row['EDIFICIO'].'</td>';
	echo '<td class="'.$reciente.'">'.$row['SECRETARÍA'].'</td>';
	echo '<td class="rowOFI '.$reciente.'">'.$row['OFICINA'].'</td>';
	echo '<td class="'.$reciente.'">'.$row['APELLIDO'].'</td>';
	echo '<td class="'.$reciente.'">'.$row['NOMBRE'].'</td>';
    echo '<td class="'.$reciente.'">'.$row['PISO'].'</td>';
       

    if ($dias > 360) {
        $result = "Hace más de 1 año";
    } elseif ($dias > 60) {
        $result = "Hace ".round( $dias/30 , 0)." meses";
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
    
    if ($row['FILA_MOD'] == '') $result = "";
    
    echo "<td class='".$reciente."' title='".$row['FILA_MOD']."'>" . trim($result) . "</td>";

    $ip = $row['IP'];
    $datetime2 = $datetime2->format('c');
    echo '<td name="nEstado" title="'.$ip.'"" data-id='.$row['ID'].' data-fecha="'.$datetime2.'""></td>';

    echo "</tr>";
};
echo "</tbody>";
echo "</table>";
?>