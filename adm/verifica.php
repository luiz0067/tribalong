<?php
	$minutos=10;
	echo"<!--";
	session_start();
	echo"-->\n";
	echo "Bem vindo ".$_SESSION["usuario"];	
	include('conecta.php');
	$row=null;
	$result=null;
	$sql    = "SELECT * FROM usuario where (codigo=0".$_SESSION["codigo"].") ;";
	$result=mysql_query($sql, $link);
	if (
		($result!=null)
		&&
		($_SESSION["codigo"]!=null)
		&&
		((time()-$_SESSION['meu_tempo'])<($minutos*60))
		//((time()-$_SESSION['time'])<(10))
	)
	{
		$row = mysql_fetch_assoc($result);
		$_SESSION["codigo"]		= $row["codigo"];
		$_SESSION["usuario"]	= $row["usuario"];	
		$_SESSION['meu_tempo']		= time();
		mysql_free_result($result);
	}
	else{
		?>
		<script type="text/javascript">
			self.location.href="./logout.php"
			//alert("<?php echo ($_SESSION["codigo"]);?>")
		</script>
		<?php
	}
?>		