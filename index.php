<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="21600"> <!-- REFRESCAR CADA 6 HORAS -->
		<title>M.E.E. Internos</title>
		<link rel="icon" type="image/png" href="favicon.ico"/>
        <link rel="stylesheet" href="CSS/animate.min.css">
		<link rel="stylesheet" type="text/css" href="CSS/sweetalert2.min.css">
        <link id="idCSS" rel="stylesheet" type="text/css" href="CSS/estilo1.css?v=10">
    </head>

	<body id='idBody' onbeforeprint="cambiarCSS('estilo2.css');" onafterprint="cambiarCSS('estilo1.css');" onunload="cerrarDB()">
	
        <h1 id='h1' class="animated fadeInDown delay-1s slow"><img class='animated rotateInUpLeft delay-2s slow' src='MUNI_LOGO.png'> Telefonía Interna</h1>
        
        <code id='idFixes'>Última Versión: 24/ENE/2020</code>

		<section>
			<form id='form' class="animated fadeIn delay-1s slow" action="" method="">
                <input id="txtBuscar" onkeyup="miFuncion()" value="<?php echo $_GET['b'];?>" type="search" placeholder="Buscar..." autocomplete="off" autofocus>
				<button id='idImprimir' class='animated bounceInRight delay-2s slow' type='button' onclick="cambiarCSS('estilo2.css')" title='Imprimir'>⎙️</button>
                <!-- <button id='idImprimir' class='animated bounceInRight delay-2s slow' type='button' onclick="cambiarCSS('estilo2.css')" title='Imprimir'>⎙</button> -->
            </form>          
        </section>
        
        <div id='div' class="animated fadeIn slower">

            <?php require('conexion.php');?>
            <?php include('contadorVisitas.php');?>
            <?php include_once('query1.php');?>
            <?php include('query2.php');?>
            
            <!-- <button id='boton'>X</button> -->
        </div>

	</body>

    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/sweetalert2.all.min.js"></script>
    <script src="JS/moment-with-locales.min.js"></script>
    <script src="reportes.js?v=11"></script>
    <script src="index.js?v=16"></script>

    <script type="text/javascript">
    </script>
    
</html>