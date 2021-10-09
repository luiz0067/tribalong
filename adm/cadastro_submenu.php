<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo, codigo_menu, nome, link FROM submenu where (codigo=0".$_GET["codigo"].")";
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
			<td>menu:<select name="codigo_menu" <?php if ($result!=null) echo $row["codigo_menu"]?>>
						<?php
						$sql_menu    = 'SELECT codigo, nome FROM menu order by nome asc;';
						$result_menu = mysql_query($sql_menu, $link);
						if (!$result_menu) {
							echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
							echo 'Erro MySQL: ' . mysql_error();
							exit;
						}
						while ($row_menu = mysql_fetch_assoc($result_menu)){
							$selected="";
							if ($result!=null){
								if($row["codigo_menu"]==$row_menu['codigo'])
									$selected="selected";
							}
							
						?>
							<option value="<?php echo $row_menu['codigo'];?>" <?php echo $selected?>>              
								<?php echo $row_menu['nome'];?>
							</option>
						<?php
							}
							mysql_free_result($result_menu);
						?>
					</select>
			</td>
		</tr>
		<tr>
			<td>nome:<input type="text" name="nome" value="<?php if ($result!=null) echo $row["nome"]?>"></td>
		</tr>
		<tr>
			<td>link:<input type="text" name="link" value="<?php if ($result!=null) echo $row["link"]?>"></td>
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
				$sql = 'delete FROM submenu where codigo='.$_POST["codigo"];
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if ($_POST ['acao']=='alterar'){
				$sql = "update submenu set codigo_menu=".$_POST["codigo_menu"].",nome='".$_POST["nome"]."',link='".$_POST["link"]."' where (codigo=".$_POST["codigo"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['acao']=='inserir'){
				$sql = "insert into submenu (codigo_menu, nome, link) values (".$_POST["codigo_menu"].",'".$_POST["nome"]."','".$_POST["link"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}
		?>
		<table border="1">
			<tr>
				<td>codigo</td>
				<td>menu</td>
				<td>nome</td>
				<td>link</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT submenu.codigo, menu.nome as menu, submenu.nome, submenu.link FROM submenu left join menu on(submenu.codigo_menu=menu.codigo) order by submenu.nome asc;';
			$result = mysql_query($sql, $link);
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>              
					<td><?php echo $row['menu'];?>&nbsp </td>
					<td><?php echo $row['nome'];?>&nbsp </td>
					<td><?php echo $row['link'];?>&nbsp </td>
				</tr>
			<?php
				}
				mysql_free_result($result);
			?>
			</table>
		</table>
</form>
<?php
	include('rodape.php');
?>
