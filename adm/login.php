<?php
	include('conecta.php');
	$linha=null;
	$result=null;
	$sql	= "SELECT codigo,usuario,senha FROM usuario where (usuario='".$_POST["usuario"]."') and( senha='".$_POST["senha"]."')";
	$result=mysql_query($sql, $link);
	if (($result!=null)&&($_POST["usuario"]!=null)&&($_POST["senha"]!=null)){
		$linha = mysql_fetch_assoc($result);
		if (($_POST["usuario"]==$linha["usuario"])&&($_POST["senha"]==$linha["senha"])){
			
			session_start();
		
			$_SESSION["codigo"]		= $linha["codigo"];
			$_SESSION["usuario"]	= $linha["usuario"];
			$_SESSION['meu_tempo']     = time();
			header("location:principal.php");
			// echo "<script>location.href='principal.php';</script>";
			//echo "<a href='principal.php'>principal ".$_SESSION["usuario"]." </a>";
			//echo "<a href='verifica.php'>verifica.php ".$_SESSION["usuario"]." </a>";
		}
		else{
			?>
			<div style="color:#FF0000">Usuario ou senha inválido</div>
			<?php
		
			mysql_free_result($result);
		}
	}
	
?>
<html>
	<head>
	<script type="text/javascript">
	</script>
	<style type="text/css">
	</style>
	</head>
	<body>
		<form method="post">
			<input type="text" name="usuario"><br>
			<input type="password" name="senha"><br>
			<input type="submit" name="acao" value="ok"><br>
		</form>
	</body>
</html>