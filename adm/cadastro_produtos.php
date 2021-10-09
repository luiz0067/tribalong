<?php
	
	include('cabecalho.php');
	$row=null;
	$result=null;
//	$sql    = "SELECT * FROM produtos WHERE);";
	if (($_GET["id_produto"]!=null)){
		$sql    = "SELECT * FROM produtos WHERE (id_produto=".$_GET["id_produto"].");";
		//echo $sql;
		//$sql    = "SELECT * FROM produtos where (id_produto=".$_GET["id_produto"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);	
	}
?>
<form method="post" >
	<table border="1">
		<tr>
			<td>id:<input type="text" name="id_produto" value="<?php if ($result!=null) echo $row["id_produto"]?>"></td>
		</tr>
		<tr>
			<td>nome:<input type="text" name="nome" value="<?php if ($result!=null)  echo $row["nome"]?>"></td>
		</tr>
        <tr>
		    <td>categoria:<select name="id_categoria" style="width:200px;">
				<?php
					$row_categoria=null;
					$result_categoria=null;					
					$sql_categoria="SELECT * FROM categorias order by nome asc";
					$result_categoria=mysql_query($sql_categoria, $link);
					while ($row_categoria = mysql_fetch_assoc($result_categoria)) {		
						if ($row["id_categoria"]==$row_categoria["id_categoria"]){
							$selected="SELECTED";
						}
						else
							$selected="";
				?>
					<option <?php echo $selected?> value="<?php if ($result_categoria!=null)  echo $row_categoria["id_categoria"]?>"><?php if ($result_categoria!=null)  echo $row_categoria["nome"]?></option>
				<?php
					}
					mysql_free_result($result_categoria);
				?>
			</select></td>
															
		</tr>
		<tr>
			<td>valor:<input type="text" name="valor" value="<?php if ($result!=null)   echo $row["valor"]?>"></td>  
		</tr>
		<tr>	
			<td>descricão:<textarea name="descricao" value="<?php if ($result!=null)  echo $row["descricao"]?>"></textarea>	</td>
        </tr>
		<tr>	
			<td>cliente:<input type="text" name="nome_cliente" value="<?php if ($result!=null)  echo $row["nome_cliente"]?>"></td>
		</tr>
        <tr>	
			<td>fone:<input type="text" name="telefone" value="<?php if ($result!=null)  echo $row["telefone"]?>"></td>
		</tr>
        <tr>	
			<td>email:<input type="text" name="email" value="<?php if ($result!=null)  echo $row["email"]?>"></td>
		</tr>
		<tr>
			<td >
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">	
				<input type="button"  value="limpar" onclick="self.location.href='?id='">
			</td>		
		</tr>	
		<?php
			
			if( $_POST['acao']=='excluir'){				
				$sql    = 'delete  FROM produtos where id_produto='.$_POST["id_produto"];
				//echo $sql;
				mysql_query($sql, $link);				
			}
			else if( $_POST['acao']=='alterar'){
				$sql    = "update produtos set nome='".$_POST["nome"]."',id_categoria=".$_POST["id_categoria"].",valor='".$_POST["valor"]."',descricao='".$_POST["descricao"]."',nome_cliente='".$_POST["nome_cliente"]."',telefone='".$_POST["telefone"]."',email='".$_POST["email"]."' where (id_produto=".$_POST["id_produto"].");";
				//echo $sql;
				mysql_query($sql, $link);							
			}
			else if( $_POST['acao']=='inserir'){
				$sql    = "insert into produtos (nome,id_categoria,valor,descricao,nome_cliente,telefone,email) values ('".$_POST["nome"]."',".$_POST["id_categoria"].",'".$_POST["valor"]."','".$_POST["descricao"]."','".$_POST["nome_cliente"]."','".$_POST["telefone"]."','".$_POST["email"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}			
		?>
        
		<table border="1">
		<tr>
			<td>id-produto</td>
			<td>nome</td>
			<td>categoria</td> 
            <td>valor</td>
            <td>descricão</td> 
            <td>cliente</td>    
			<td>fone</td>
			<td>email</td>
		</tr>
		<?php			
			/*if( $_POST['acao']=='buscar')*/
			if ($result!=null){
				mysql_free_result($result);
			}		
			$sql    = 'SELECT * FROM produtos order by nome asc;';
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)) {
		?> 
				<tr>
					<td><a href="?id_produto=<?php echo $row['id_produto'];?>"><?php echo $row['id_produto'];?></a></td>
					<td><?php echo $row['nome'];?>&nbsp </td>
					<td><?php echo $row['id_categoria'];?>&nbsp </td>
                    <td><?php echo $row['valor'];?>&nbsp </td>
                    <td><?php echo $row['descricao'];?>&nbsp </td>
                    <td><?php echo $row['nome_cliente'];?>&nbsp </td>
					<td><?php echo $row['telefone'];?>&nbsp </td>                
					<td><?php echo $row['email'];?>&nbsp </td>
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