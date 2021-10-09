<?php
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo,nome,imagem,link FROM patrocinio where (codigo=0".$_GET["codigo"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
		$codigo=$row["codigo"];
		$nome=$row["nome"];
		$imagem=$row["imagem"];
		$link_=$row["link"];
	}
	if ($_POST["acao"]!=null)
	{
		$codigo=$_POST["codigo"];
		$nome=$_POST["nome"];
		$imagem=$_POST["imagem"];
		$link_=$_POST["link"];
		if ($_POST['acao']=='excluir'){
			$sql = 'delete FROM patrocinio where codigo='.$_POST["codigo"];
			//echo $sql;
			mysql_query($sql, $link);
		}
		else if ($_POST ['acao']=='alterar'){
			$sql = "update patrocinio set nome='".$_POST["nome"]."', imagem='".$_POST["imagem"]."', link='".$_POST["link"]."' where (codigo=".$_POST["codigo"].");";
			echo $sql;
			mysql_query($sql, $link);
		}
		else if( $_POST['acao']=='inserir'){
			$sql = "insert into patrocinio (nome,imagem,link) values ('".$_POST["nome"]."','".$_POST["imagem"]."','".$_POST["link"]."');";
			//echo $sql;
			mysql_query($sql, $link);
		}
		else if( $_POST['acao']=='inserir'){
			$sql    = "insert into patrocinio (nome,imagem,link) values ('".$_POST["nome"]."','".$_POST["imagem"]."','".$_POST["link"]."');";
			//echo $sql;
			mysql_query($sql, $link);
		}			
	}

?>
<form method="post">
		<table border="1">
		<tr>
			<td>codigo:<input type="text" name="codigo" value="<?php if ($result!=null) echo $codigo;?>"></td>
		</tr>
		<tr>
			<td>nome:<input type="text" name="nome" value="<?php if ($result!=null) echo $nome;?>"></td>
		</tr>
		<tr>
			<td>imagem:<input type="text" name="imagem" value="<?php if ($result!=null) echo $imagem;?>"></td>
		</tr>
		<tr>
			<td>link:<input type="text" name="link" value="<?php if ($result!=null) echo $link_;?>"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">
				<input type="button" value="limpar" onclick="self.location.href='?codigo'">
			</td>
		</tr>
		
			<table border="1">
			<tr>
				<td>codigo</td>
				<td>nome</td>
				<td>imagem</td>
				<td>link</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT codigo,nome,imagem,link FROM patrocinio order by nome asc;';
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)){
			?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td><?php echo $row['nome'];?>&nbsp </td>                
					<td><?php echo $row['imagem'];?>&nbsp </td>
					<td><?php echo $row['link'];?>&nbsp </td>
				</tr>
			<?php
			
				}
				if ($result !=null)
					mysql_free_result($result);
			?>
			</table>
		</table>
</form>
<?php
	include('rodape.php');
?>