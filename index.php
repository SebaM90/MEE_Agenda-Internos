<?php require 'conexion.php';?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="900"> <!-- REFRESCAR CADA 15 MINUTOS -->
		<title>M.E.E. Internos</title>
		<link rel="icon" type="image/png" href="favicon.ico"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
		<link id="idCSS" rel="stylesheet" type="text/css" href="CSS/estilo1.css">	
    </head>

	<body id=idBody onbeforeprint="cambiarCSS('estilo2.css')" onafterprint="cambiarCSS('estilo1.css')" onunload="cerrarDB()">

        <h1 id=h1 class="animated fadeInDown delay-1s slow">Municipalidad de Esteban Echeverría</h1>
        <h2 id=h2 class="animated fadeInUp delay-2s slow">Telefonía Interna</h2>
		
		<section>
			<form id=form class="animated fadeIn delay-1s slow" action="" method="">
				<input onkeyup="miFuncion()" id="txtBuscar" value="<?php echo $_GET['b'];?>" type="search" placeholder="Buscar..." autocomplete="off" autofocus>
			</form>
		</section>
        <div id=div class="animated fadeIn fast">

            <?php include 'contadorVisitas.php';?>
            <?php include_once 'query1.php';?>
            
            <div id=div2>
            <?php include 'query2.php';?>
            </div>
            
        </div>
        <p><button onclick="cambiarCSS('estilo2.css')">VERSIÓN PARA IMPRIMIR</button></p>
	</body>


		<script language="javascript" type="text/javascript">
            
            /*
            var repetir = setInterval(function(){
                                                cuerpo = document.getElementById('div2');
                                                cuerpo.innerHTML = "<?php include 'query2.php';?>";
												console.log("prueba"); 
											  }, 1000);
            */
			
            document.addEventListener('DOMContentLoaded', function() {            
                var estilo = "<?php echo $_GET['css'];?>";
                cambiarCSS(estilo);
                
				miFuncion();
            }, false);
                
			function miFuncion() {
    			var buscado = document.getElementById("txtBuscar").value;
    			var cantFilas = document.getElementById("idTabla").rows.length;
    			var cantCols = 8;
    			//Recorrido de todas las filas
    			for (var i = 1; i < cantFilas; i++) {
    				var fila = document.getElementById(i);
    					var celda = "";
    					for (var j = 0; j < cantCols; j++) {
    						celda += fila.cells[j].innerText;
    					}
                    if (celda.toUpperCase().search(buscado.toUpperCase()) > -1) {
                        fila.className = "rowMostrar";
                    } else {
                        fila.className = "rowOcultar";
                    }                                                                   

    			}
            pintarCebra();
			}
            
            function cambiarCSS(nuevoCSS) {
                window.scroll({top: 0, left: 0, behavior: 'smooth'});
                if (nuevoCSS.length == 0) {
                    nuevoCSS = 'estilo1.css';
                }
                document.getElementById("idCSS").href = "CSS/" + nuevoCSS;
            }
            
            function pintarCebra() {
                var allRows = document.getElementsByTagName("tr");
                var flag = false;
                for (var i = 0; i < allRows.length; i++) {
                    if (allRows[i].className == 'rowMostrar') {
                        if (flag) {
                            allRows[i].classList.add("row-cebra");
                        }
                    flag = !flag;
                    }
                } 
            }

            function cerrarDB() {
                event.preventDefault();
                document.write('<?php pg_close($dbconn);?>');
            }
		</script>			

</html>