<html>
<head>
</head>
<body>
<?php
require_once 'calendario.php';
//Tratamento do $_GET  
if(empty($_GET)){
	$mes = date('m');
	$ano = date('Y');
}else{
	if(is_null($_GET['mes'])){
		$mes = date('m');
	}else{
		$mes = $_GET['mes'];
	}
	
	if(is_null($_GET['ano'])){
		$ano = date('Y');
	}else{
		$ano = $_GET['ano'];
	}
}

//Criar objeto calendar
$calendar = new Calendario();

//Exibe o calendário
print $calendar->exibirCalendario($mes, $ano);
?>
</body>
</html>