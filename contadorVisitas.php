<?php 
        $fichero = "visitas.txt"; // fichero donde se guardaran las visitas

        $fptr = fopen($fichero,"r"); // abrir

        $num = fread($fptr,filesize($fichero)); // sumamos una visita
        $num++;
        
        // si el dia de HOY difiere del dia de modificacion
        // del archivo, entonces empezar restablecer a cero
        $diaARCH = date("j", filemtime($fichero));
        $diaHOY = date("j");
        if ($diaHOY<>$diaARCH) {
            $num = 0;
        }
        
        echo "<script>console.log('"."VISITAS: ".$num."')</script>";
    
        $fptr = fopen($fichero,"w+");
        fwrite($fptr,$num);

?>