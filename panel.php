<?php 
	session_start();
	$inactividad = 600;
    
    //echo time()."<br>";
    //echo $_SESSION['timeout']."<p>";
    if(isset($_SESSION["timeout"])){// Comprobar si $_SESSION["timeout"] está establecida
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        //echo $sessionTTL;
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location:logout.php");
        }
    }

	if ($_SESSION['usuario'] == '' || $_SESSION['usuario'] == null ) {//si la variable sesion esta vacia lo redirecciona 'login.ph'
		header("Location:login.php");
	}//si la variable sesion esta vacia lo redirecciona 'login.ph'
	
	//INSERT INTO `webs` (`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES ('1', '1', '1leer', '2024-05-27');
	$mens=" ";
	$color=" ";
	$id=0;
	$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
	if (isset($_POST['boton-panel'])) {//Si presiona el boton 'Crear Web'
		$dominio=$_SESSION['usuario'].$_POST['ing_dom'];
		$sql="SELECT * FROM webs WHERE dominio = '$dominio' ";//SQL pregunta por si el dominio se repite
		$resp=mysqli_query($conexion,$sql);

		$tam= mysqli_num_rows($resp);//tamaño de filas
		
		if ($tam>0) {//Si el tamaño de filas es mayor a 0 significa que el dominio existe
			$mens="El dominio '$dominio' ya existe.";	
			$color="red";
		}//Si el tamaño de filas es mayor a 0 significa que el dominio existe
		else{//Si el tamaño de filas es 0 significa que el dominio no existe
			$sql="SELECT * FROM webs";
			$resp=mysqli_query($conexion,$sql);
			while ($fila=mysqli_fetch_array($resp,MYSQLI_ASSOC)) {
				$id=$fila['idWeb'];
			}

			$sql="INSERT INTO webs (idWeb, idUsuario, dominio, fechaCreacion) VALUES('".($id+1)."', '".$_SESSION['usuario']."', '".$dominio."', '".date('Y-m-d')."');";
			$resp=mysqli_query($conexion,$sql);
			shell_exec("./wix.sh $dominio 'Web $dominio'");
			shell_exec("zip -r ".$dominio.".zip ".$dominio."/");
			$mens="Se agrego el dominio '$dominio'";
			$color="green";
		}//Si el tamaño de filas es 0 significa que el dominio no existe
		//echo $dominio;
	}//Si presiona el boton 'Crear Web'

	if (isset($_GET['boton-eliminar'])) {//Si presiona el link 'Eliminar Web'
		$sql="DELETE FROM `webs` WHERE `webs`.`idWeb` = ".$_GET['idWeb']."";
		//echo $sql;
		$resp=mysqli_query($conexion,$sql);
		shell_exec("rm -r ".$_GET['dom']);
		shell_exec("rm ".$_GET['dom'].".zip");
		if ($resp) {
			header("Location:panel.php");
		}
	}'Eliminar Web'
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Webgenerator Facundo Sandoval</title>
</head>
<body>
	<h2>Bienvenido a tu panel</h2>
	<h5><a href="logout.php">Cerrar Sesion de <?= $_SESSION['usuario'] ?></a></h5>
	<?php 
		if ($_SESSION['usuario']=="admin") {//SI el Logeado es el 'admin'
			$resp=mysqli_query($conexion,"SELECT * FROM webs");
			?>
			<table border="1" style="border-collapse: collapse;">
				<tr>
					<th>IdWeb</th>
					<th>IdUsuario</th>
					<th>Dominio</th>
					<th>FechaCreaciòn</th>
				</tr>
			<?php
			while ($fila= mysqli_fetch_array($resp,MYSQLI_ASSOC)) {
				?>
				<tr>
					<td><?= $fila['idWeb'] ?></td>
					<td><?= $fila['idUsuario'] ?></td>
					<td><?= $fila['dominio'] ?></td>
					<td><?= $fila['fechaCreacion'] ?></td>
				</tr>
				<?php
			}
			echo "</table>";
		}//SI el Logeado es el 'admin'
		else{//SI el Logeado es un 'usuario'

			 ?>
			<form method="post">
				<label>Generar Web de <input type="text" name="ing_dom" required></label>
				<span style="color: <?= $color ?>;"><?= $mens ?></span>
				<p>
				<input type="submit" name="boton-panel" value="Crear Web">
			</form>
			<h3>Webs</h3>
			<ul>
			<?php 
				$sql="SELECT * FROM webs WHERE idUsuario = ".$_SESSION['usuario']."";
			 	$resp=mysqli_query($conexion,$sql);
			 	$tam=mysqli_num_rows($resp);
			 	if ($tam>0) {//Si la tabla tiene filas
			 		while ($fila = mysqli_fetch_array($resp,MYSQLI_ASSOC)) {//mientras
			 			?>
			 				<li><a href="<?= $fila['dominio'] ?>/"><?= $fila['dominio'] ?></a> <a href="<?= $fila['dominio'] ?>.zip" download="<?= $fila['dominio'] ?>.zip">Descargar Web</a> <a href="panel.php?boton-eliminar=1&idWeb=<?= $fila['idWeb'] ?>&dom=<?= $fila['dominio'] ?>">Eliminar Web</a></li>
			 			<?php
			 		}//mientras
			 	}//Si la tabla tiene filas
			 	else{
			 		echo "No hay webs agregadas.";
			 	}
	 	}//SI el Logeado es un 'usuario'
	 ?>
	</ul>
</body>
</html>
