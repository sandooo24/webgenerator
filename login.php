<?php 
	$mens=" ";
	if (isset($_POST['boton-login'])) {
		$email=$_POST['ing_email'];
		$password=$_POST['ing_pass'];

		$conexion=mysqli_connect("localhost", "adm_webgenerator", "webgenerator2024", "webgenerator");
		$sql="SELECT * FROM `usuarios`";

		$resp=mysqli_query($conexion,$sql);
		
		if ($email=="admin@server.com" && $password="serveradmin") {
			session_start();
			$_SESSION['usuario']="admin";
			$_SESSION["timeout"] = time();
			header("Location:panel.php");
		}
		else if (mysqli_num_rows($resp)>0) {//Si la tabla 'usuarios' tiene filas 
			while ($fila = mysqli_fetch_array($resp, MYSQLI_ASSOC)) {
				if ($fila['email'] == $email && $fila['password'] == $password) {//si  el email y contraseña son validos
					session_start();
					$_SESSION['usuario']=$fila['idUsuario'];
					$_SESSION["timeout"] = time();
					header("Location:panel.php");
				}//si el email y contraseña son validos
				else{//si el email y contraseña son invalidos muestre un mensaje
					$mens="Usuario / Contraseña invalidos!!!!!";
				}//si el email y contraseña son invalidos muestre un mensaje
			}
		}//Si la tabla 'usuarios' tiene fila
	}
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Webgenerator Facundo Sandoval</title>
</head>
<body style="text-align: center;">
	<h2>Webgenerator Facundo Sandoval</h2>
	<form method="post" >
		<span style="color: red;"><?= $mens ?></span>
		<p>
		<input type="email" name="ing_email" placeholder="Ingrese email" required>
		<p>
		<input type="password" name="ing_pass" placeholder="ingrese contraseña" required>
		<p>
		<input type="submit" value="Ingresar" name="boton-login" >
		<h5><a href="register.php">Registrarse</a></h5>
	</form>
</body>
</html>