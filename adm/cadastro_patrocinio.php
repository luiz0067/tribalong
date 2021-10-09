<?php
include('cabecalho.php');
$row=null;
$result=null;
if (($_GET["codigo"]!=null)){
	$sql	= "SELECT codigo,imagem,nome,link FROM patrocinio where (codigo=0".$_GET["codigo"].")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if (isset($row))
	$imagem_antiga=$row["imagem"];
}
?>
<div style="height:100px;display:block;">
<?php
if ($_POST) {
	$folder = "C:\\apache\\htdocs\\TribalONG\\upload\\imagens\\";
	if (
		(
			($_FILES["imagem"]["type"] == "image/gif")
			|| 
			($_FILES["imagem"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/pjpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/png")
			|| 
			($_FILES["imagem"]["type"] == "image/bmp")
		)
	)
	{
		if (($_FILES["imagem"]["size"] < 1024*1024)){
			if ($_FILES["imagem"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem"]["error"] . "<br />";
			}
			else
			{
				echo "Upload: " . $_FILES["imagem"]["name"] . "<br />";
				echo "Type: " . $_FILES["imagem"]["type"] . "<br />";
				echo "Size: " . ($_FILES["imagem"]["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES["imagem"]["tmp_name"] . "<br />";
				$imagem=$_FILES["imagem"]["name"];
				$extension=strtolower(end(explode(".", $imagem)));
				if (file_exists($folder . $imagem))
				{
					$imagem=time().".".$extension;
					move_uploaded_file(
						$_FILES["imagem"]["tmp_name"],
						$folder . $imagem
					);
				}
				else
				{
					move_uploaded_file(
						$_FILES["imagem"]["tmp_name"],
						$folder . $imagem
					);
					
				}
				echo "<a href=\"..\\upload\\imagens\\".$imagem."\">".$imagem."</a><br>";
					if ($_POST ['acao']=='alterar'){
						//delete_file($folder . $imagem_antiga);
						$sql = "update patrocinio set imagem='".$imagem."', nome='".$_POST["nome"]."',link='".$_POST["link"]."' where (codigo=".$_POST["codigo"].");";
						echo $sql;
						mysql_query($sql, $link);
					}
					else if( $_POST['acao']=='inserir'){
						$sql = "insert into patrocinio (imagem, nome, link) values ('".$imagem."','".$_POST["nome"]."','".$_POST["link"]."');";
						//echo $sql;
						mysql_query($sql, $link);
					}
			}
		}
		else
	{
		echo "Tamanho muito grande<br>";
	}
	}
	else
	{
		echo "Não é uma imagem<br>";
	}
	if ($_POST['acao']=='excluir'){
		//delete_file($folder . $imagem_antiga);
		$sql = 'delete FROM patrocinio where codigo='.$_POST["codigo"];
		//echo $sql;
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
			codigo:<input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"><br>
			imagem:<input name="imagem" type="file" ><br>
			link:<input name="link" type="text" value="<?php if ($result!=null) echo $row["link"]?>"><br>
			nome:<input name="nome" type="text" value="<?php if ($result!=null) echo $row["nome"]?>"><br>
			<input type="submit" name="acao" value="inserir">
			<input type="submit" name="acao" value="alterar">
			<input type="submit" name="acao" value="excluir">
			<input type="button" value="limpar" onclick="self.location.href='?codigo'">		
		</form>
			<table border="1">
			<tr>
				<td>codigo</td>
				<td>imagem</td>
				<td>nome</td>
				<td>link</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT codigo,imagem,nome,link FROM patrocinio;';
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
					<td>
						<a href="..\upload\imagens\<?php echo $row['imagem'];?>"><?php echo $row['imagem'];?><a/><br>
						<img width="50px" height="50PX" src="..\upload\imagens\<?php echo $row['imagem'];?>">
					</td>
					<td><?php echo $row['nome'];?>&nbsp </td>
					<td><a href="<?php echo $row['link'];?>"><?php echo $row['link'];?><a/></td>
				</tr>
			<?php
				}
				mysql_free_result($result);
			?>
			</table>
<?php
	include('rodape.php');
?>
