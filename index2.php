<html>
<head>
</head>
<body>
<?php

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

$calendar = new Calendario;
print $calendar->exibirCalendario($mes, $ano);

class Calendario{
	function exibirCalendario($month, $year){
		$m = $month;
		$y = $year;
			
		$mesExtenso = 
			array(
				1=> "Janeiro",
				2=> "Fevereiro",
				3=> "Março",
				4=> "Abril",
				5=> "Maio",
				6=> "Junho",
				7=> "Julho",
				8=> "Agosto",
				9=> "Setembro",
				10=> "Outubro",
				11=> "Novembro",
				12=> "Dezembro"
			);
				
		$diasExtenso = 
			array(
				0=> "Domingo",
				1=> "Segunda",
				2=> "Terça",
				3=> "Quarta",
				4=> "Quinta",
				5=> "Sexta",
				6=> "Sabado"
			);
									
		$mesAtual = $m;
		$anoAtual = $y;
		$ultimoDia = date("t", mktime(0,0,0,$mesAtual,'01',$anoAtual));

		$dataInicial = strtotime($anoAtual.'-'.$mesAtual.'-01');			
		$data = new DateTime(date('Y-m-d', $dataInicial));
		$diaSemanaInicia = (int) $data->format('w');
			
		$proximoMes = date("m", strtotime("+1 months",$dataInicial));
		$proximoAno = date("Y", strtotime("+1 months",$dataInicial));
			
		$mesAnterior = date("m", strtotime("-1 months",$dataInicial));
		$anoAnterior = date("Y", strtotime("-1 months",$dataInicial));
			
		$mes = (int) $mesAtual;
		$ano = (int) $anoAtual;
			
		$cal = "<table border='0' cellpadding='1' cellspacing='1' align=left>";
		$cal .= "<tr>
					<td colspan='5' width='40' height='40'>$mesExtenso[$mes] de $ano</td>
					<td align='center'><a href='http://localhost/novam3/index2.php?mes=$mesAnterior&ano=$anoAnterior'><</a></td>
					<td align='center'><a href='http://localhost/novam3/index2.php?mes=$proximoMes&ano=$proximoAno'>></a></td>
				</tr><tr>";
		
		for($i = 0; $i < 7; $i++){
			$dia = substr($diasExtenso[$i],0,3);
			$cal .= "<td align='center' width='40' height='40'>$dia</td>";
		}
			
		$cal .= "</tr><tr>";
			
		$j = 0;//Contador de dias da tabela
		$diaVazio = true;//auxiliar para preencher a tabela
			
		for($i = 1; $i <= $ultimoDia; $i++){
			while($diaVazio){					
				if($j == $diaSemanaInicia){
					$diaVazio = false;
				}else{
					$cal .= "<td height='40'></td>";
					$j++;
				}
			}
				
			$cal .= "<td align='center' height='40'>$i</td>";
				
			//Quebra a linha da tabela, iniciando nova semana
			if($j == 6 || $j == 13 || $j == 20 || $j == 27 || $j == 34){
				$cal .= "</tr><tr>";
			}
				
			$j++;
				
			if($i == $ultimoDia && $j >= 36){
				while($j <= 41){
					$cal .= "<td></td>";
					$j++;
				}
			}
				
			if($i == $ultimoDia && $j >= 28){
				while($j <= 34){
					$cal .= "<td></td>";
					$j++;
				}
			}
		}
			
		$cal .= "</tr></table>";
			
		return $cal;
	}
}
?>
</body>
</html>