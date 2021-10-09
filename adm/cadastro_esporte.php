<?php	
	include('cabecalho.php');
	$codigo_usuario=$_SESSION["codigo"];
	$row=null;
	$result=null;
	$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim,menu_codigo FROM paginas where (nome='esporte') and (data_fim is null) order by data_inicio desc";
	$result=mysql_query($sql, $link);
	if($result!=null){
		$row = mysql_fetch_assoc($result);
		$conteudo=$row["conteudo"];
		$codigo=$row["codigo"];
		$data_inicio=$row["data_inicio"];
		$menu_codigo=$_POST["menu_codigo"];
		if ($_POST['acao']=='atualizar pagina'){
			$conteudo=($_POST["conteudo"]);
			$conteudo=str_replace("\\\"", "\"", $conteudo);
			$data_hora=Date("Y-m-d H:i:s");    
			$sql = "insert into paginas (nome,conteudo,data_inicio,menu_codigo) values ('esporte','".$conteudo."','".$data_hora."',".$menu_codigo.");";
			mysql_query($sql, $link);
			$sql = "update paginas set data_fim='".$data_hora."',menu_codigo=".$menu_codigo." where (codigo=0".$codigo.");";
			mysql_query($sql, $link);			
		}
	}
?>

	<title>editor de texto</title>
	
	<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
	<script src="./ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="./ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body{
			margin-top:0px;
			margin-left:0px;
			margin-right:0px;
			margin-button:0px;
		}
	</style>
	<?php
	
		
	?>
	<?php echo $data_inicio;?>
	<form action="?pagina=home" method="post">
		<label for="editor1">Editor da pagina esporte</label><br>
		menu:<select name="menu_codigo" <?php if ($result!=null) echo $row["menu_codigo"]?>>
			<?php
			$sql_menu    = "SELECT submenu.codigo,submenu.nome FROM submenu right join menu on(submenu.codigo_menu=menu.codigo) where(menu.nome='Esporte');";
			$result_menu = mysql_query($sql_menu, $link);
			if (!$result_menu) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row_menu = mysql_fetch_assoc($result_menu)){
				$selected="";
				if ($result!=null){
					if($row["menu_codigo"]==$row_menu['codigo'])
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
		</select><br>
		<textarea class="ckeditor" style="width:100%;" name="conteudo" rows="10"><?php echo ($conteudo);?></textarea><br>
		<input type="submit" name="acao" value="atualizar pagina" />		
	</form>	
	
<?php
		$_SESSION["codigo"]=$codigo_usuario;
	$row=null;
	$result=null;
	$sql    = "SELECT * FROM usuario where (codigo=0".$_SESSION["codigo"].") ;";
	$result=mysql_query($sql, $link);
	if (
		($result!=null)
		&&
		($_SESSION["codigo"]!=null)
	)
	{
		$row = mysql_fetch_assoc($result);
		$_SESSION["codigo"]		= $row["codigo"];
		$_SESSION["usuario"]	= $row["usuario"];	
		$_SESSION['meu_tempo']		= time();
		mysql_free_result($result);
	}
	include('rodape.php');
?>
