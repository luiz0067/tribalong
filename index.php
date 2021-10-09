<?php
	include('./adm/conecta.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>TribalONG</title>
		<link rel="shortcut icon" href="/tribal.ico" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">			
			@import url("./css/estilo.css");
		</style>
		<script type="text/javascript">
			function trocardecor(elemento,cor){
				elemento.style.color=cor;
			}	
			function redimenciona(){
				var conteudo1 = document.getElementById("conteudo1").scrollHeight;
				var conteudo2 = document.getElementById("conteudo2").scrollHeight;
				var conteudo3 = document.getElementById("conteudo3").scrollHeight;
				var maior=0;
				if ((conteudo1>conteudo2)&&(conteudo1>conteudo3)){
					maior=conteudo1
				}
				else if ((conteudo2>conteudo1)&&(conteudo2>conteudo3)){
					maior=conteudo2
				}
				else if ((conteudo3>conteudo1)&&(conteudo3>conteudo2)){
					maior=conteudo3
				}
				document.getElementById("conteudo1").style.height=maior+"px";
				document.getElementById("conteudo2").style.height=maior+"px";
				document.getElementById("conteudo3").style.height=maior+"px";
			}
			function load(){
				redimenciona();
			}
		</script>
	</head>
	<body onload="load()">		
		<div id="tudo">
			<div id="topo" class="linha" onmousemove="document.getElementById('submenu_esporte').style.display='none'"> 
				<div class="centro" style="width:910px">
					<div id="logo"><img src="images/logo3.jpg" border="0" width="115px" height="121px"></div>
					<div style="float:left;">
						<div id="nomelogo">TribalONG</div>
						<div id="slogan">Livre e Solidária</div>					
					</div>
				</div>

			</div>
			<div id="linha_de_menu_2" class="linha"> 
				<div id="caixa_menu_2" class="centro">
					<a class="menu" href="?pagina=home"><div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')" onmousemove="document.getElementById('submenu_esporte').style.display='none'">Home</div></a>
					<a class="menu" href="?pagina=esporte">
						<div class="submenu2" id="submenu_esporte" onmouseover="this.style.display='block'" onmouseout="this.style.display='none'">
							<?php
							$sql    = "SELECT submenu.codigo,submenu.nome FROM submenu right join menu on(submenu.codigo_menu=menu.codigo) where(menu.nome='Esporte');";
							$result = mysql_query($sql, $link);
							while ($row = mysql_fetch_assoc($result)){
							?>
							<a href="?pagina=esporte&codigo=<?php echo $row["codigo"]?>"><div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')"><?php echo $row["nome"]?></div></a>
							<?php
							}
							?>
						</div>
						<div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')" onmousemove="document.getElementById('submenu_esporte').style.display='block'">Esportes</div>
					</a>
					<a class="menu" href="?pagina=eventos"><div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')" onmousemove="document.getElementById('submenu_esporte').style.display='none'">Eventos</div></a>
					<a class="menu" href="?pagina=projetos"><div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Projetos</div></a>
					<a class="menu" href="?pagina=blog"><div class="menu2" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Blog</div></a>
					<a class="menu" href="?pagina=??"><div class="menu2" style="width:136px" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')"></div></a>
					<div class="menu2"></div>					
				</div>
			</div>
			<div id="linha_de_menu_1" class="linha"> 
				<div id="caixa_menu_1" class="centro">
					<a class="menu" href="?pagina=registrar-se/login"><div class="menu1" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Registrar-se/login</div></a>
					<a class="menu" href="?pagina=quem_somos"><div class="menu1" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Quem somos</div></a>
					<a class="menu" href="?pagina=download"><div class="menu1" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Downloads</div></a>
					<a class="menu" href="?pagina=vídeos"><div class="menu1" style="width:154px" onmouseover="trocardecor(this,'red')" onmouseout="trocardecor(this,'black')">Vídeos</div></a>
				</div>
			</div>
			<div class="linha"> 
				<div class="centro" style="width:910px">
					<div id="conteudo1">
					<?php
						$row=null;
						$result=null;
						if ($_GET["pagina"]=="blog"){
							?>
							<iframe src="http://www.tribalong.blogspot.com/" width="100%" height="500px"  SCROLLING="yes">
							</iframe>
							<?php
						}
						else if($_GET["pagina"] =="esporte"){
							$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim FROM paginas where (nome='esporte') and (menu_codigo=".$_GET["codigo"].") and (data_fim is null) order by data_inicio desc";
								
							$result=mysql_query($sql, $link);
							if($result!=null){
								$row = mysql_fetch_assoc($result);
								$conteudo=$row["conteudo"];
							}
						}
						else if($_GET["pagina"]!="conteudo_lateral"){
							if ($_GET["pagina"]!="")
								$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim FROM paginas where (nome='".$_GET["pagina"]."') and (data_fim is null) order by data_inicio desc";
							else
								$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim FROM paginas where (nome='home') and (data_fim is null) order by data_inicio desc";
								
							$result=mysql_query($sql, $link);
							if($result!=null){
								$row = mysql_fetch_assoc($result);
								$conteudo=$row["conteudo"];
							}
						}
						echo $conteudo;
					?>
					</div>
					<div id="conteudo2">
					<?php
							$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim FROM paginas where (nome='conteudo_lateral') and (data_fim is null) order by data_inicio desc";
							//echo $sql;
							$result = mysql_query($sql, $link);
							if($result!=null){
								$row = mysql_fetch_assoc($result);
								$conteudo=$row["conteudo"];
								echo $conteudo;
							}
							
					?>
					</div>
					<div id="conteudo3">
						<?php
						$contador=0;
						$sql    = 'SELECT codigo,imagem,nome,link FROM patrocinio;';
						$result = mysql_query($sql, $link);
						while ($row = mysql_fetch_assoc($result)){
						$contador++;
						?>
							<div class="patrocinios">
								<a href="<?php echo $row['link'];?>">
									<img width="98px" height="55px" src="./upload/imagens/<?php echo $row['imagem'];?>" >	
								<a/>
							</div>
						<?php
						}
						mysql_free_result($result);
						if ($contador<7){
							$contador=(7 - $contador);
							for ($i=0;$i<$contador;$i++){
							?>
							<div class="patrocinios"></div>
							<?php
							}
						}
						?>
					
					</div>
						<div id="rodape">
						© 2000 - 2011 ONG Tribal - Livre e solidária. Todos os direitos reservados 
						</div>
				</div>
				
			</div>
			
		</div>
	</body>
</html>
<?php
	include('./adm/rodape.php');
?>