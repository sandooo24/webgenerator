<?php 
	$mens=" ";
	//INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES ('1', 'facu@gmail.com', '12345', '2024-05-26');
	if (isset($_POST['boton-regist'])) {//SI presiono el boton 'Registrarse'
		$email=$_POST['nuev_email'];
		$password=$_POST['nuev_pass'];
		$passwordConf=$_POST['conf_pass'];

		if ($password == $passwordConf) {//SI la confirmacion de contraseña es valida
			$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
			$sql="SELECT * FROM usuarios";

			$resp=mysqli_query($conexion,$sql);
			$tam=mysqli_num_rows($resp);
			$id=0;

			if ($tam>0) {//Si la tabla 'usuarios' tiene filas 
				while ($fila = mysqli_fetch_array($resp,MYSQLI_ASSOC)) {
					if ($fila['email'] == $email && $fila['password'] == $password) {//si esta logeado lo redireccione a panel.php
						session_start();
						$_SESSION['usuario']=$fila['idUsuario'];
						header("Location:panel.php");
					}//si esta logeado lo redireccione a panel.php
					else{
						$id=$fila['idUsuario'];
					}
				}
			}//Si la tabla 'usuarios' tiene filas 

			$sql="INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES ('".($id+1)."', '".$email."', '".$password."', '".date('Y-m-d')."');";
			$resp=mysqli_query($conexion,$sql);
			if ($resp) {
				header("Location:login.php");
			}else{
				echo "ERROR!!!!";
			}
			
		}//SI la confirmacion de contraseña es valida
		else{//SI la confirmacion de contraseña es invalida muestre un mensaje
			$mens = "Contraseña incorrecta!!!!";
		}//SI la confirmacion de contraseña es invalida muestre un mensaje
		
	}//SI presiono el boton 'Registrarse'
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
</head>
<body>
	<h2>Registrarte es simple</h2>
	<form method="post" >
		<input type="email" name="nuev_email" placeholder="Ingrese email" required>
		<p>
		<input type="password" name="nuev_pass" placeholder="ingrese contraseña" required>
		<p>
		<input type="password" name="conf_pass" placeholder="confirmar contraseña" required>
		<br>
		<span style="color:red"><?= $mens ?></span>
		<p>	
		<input type="submit" value="Registrase" name="boton-regist">
	</form>
</body>
</html>