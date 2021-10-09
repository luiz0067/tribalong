<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo,titulo,video FROM video where (codigo=0".$_GET["codigo"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
	}
?>
<form method="post">
		<table border="1">
		<tr>
			<td>codigo:<input type="text" name="codigo" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
		</tr>
		<tr>
			<td>titulo:<input type="text" name="titulo" value="<?php if ($result!=null) echo $row["titulo"]?>"></td>
		</tr>
		<tr>
			<td>video:<input type="text" name="video" value="<?php if ($result!=null) echo $row["titulo"]?>"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">
				<input type="button" value="limpar" onclick="self.location.href='?codigo'">
			</td>
		</tr>
		<?php
			
			if ($_POST['acao']=='excluir'){
				$sql = 'delete FROM video where codigo='.$_POST["codigo"];
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if ($_POST ['acao']=='alterar'){
				$sql = "update video set titulo='".$_POST[""]."', video='".$_POST["video"]."' where (codigo=".$_POST["codigo"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['acao']=='inserir'){
				$sql = "insert into video (titulo, video) values ('".$_POST["titulo"]."','".$_POST["video"]."');";
				echo $sql;
				mysql_query($sql, $link);
			}
				else if( $_POST['acao']=='inserir'){
				$sql    = "insert into video (titulo,video) values ('".$_POST["titulo"]."','".$_POST["video"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}			
		?>
		<table border="1">
			<tr>
				<td>codigo</td>
				<td>titulo</td>
				<td>vídeo</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT codigo,titulo,video FROM video order by titulo asc;';
			$result = mysql_query($sql, $link);
			if ($result!=null){
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td><?php echo $row['titulo'];?>&nbsp </td>                
					<td><?php echo $row['video'];?>&nbsp </td>
				</tr>
			<?php
				}
				
				mysql_free_result($result);
				}
			?>
			</table>
		</table>
</form>
<?php
	include('rodape.php');
?>

