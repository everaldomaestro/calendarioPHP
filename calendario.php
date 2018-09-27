<?php 
class Calendario{
	function exibirCalendario($m, $y){			
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
				
		$mesAtual = $m;	//Mês
		$anoAtual = $y; //Ano
		
		//Pega o último dia do mês
		$ultimoDia = date("t", mktime(0,0,0,$mesAtual,'01',$anoAtual));

		//Variáveis para pegar em qual dia da semana o mês inicia
		$dataInicial = strtotime($anoAtual.'-'.$mesAtual.'-01');			
		$data = new DateTime(date('Y-m-d', $dataInicial));
		$diaSemanaInicia = (int) $data->format('w');
		
		//Variaveis para link do próximo mês
		$proximoMes = date("m", strtotime("+1 months",$dataInicial));
		$proximoAno = date("Y", strtotime("+1 months",$dataInicial));
		
		//Variaveis para link do mês anterior
		$mesAnterior = date("m", strtotime("-1 months",$dataInicial));
		$anoAnterior = date("Y", strtotime("-1 months",$dataInicial));
		
		//Variáveis para cabeçalho da tabela
		$mes = (int) $mesAtual;
		$ano = (int) $anoAtual;
		
		//Inicio da montagem da tabela
		$cal = "<table border='0' cellpadding='1' cellspacing='1' align=left>";
		$cal .= "<tr>
					<td colspan='5' width='40' height='40'>$mesExtenso[$mes] de $ano</td>
					<td align='center'><a href='http://localhost/novam3/index.php?mes=$mesAnterior&ano=$anoAnterior'><</a></td>
					<td align='center'><a href='http://localhost/novam3/index.php?mes=$proximoMes&ano=$proximoAno'>></a></td>
				</tr><tr>";
		
		for($i = 0; $i < 7; $i++){
			$dia = substr($diasExtenso[$i],0,3);
			$cal .= "<td align='center' width='40' height='40'>$dia</td>";
		}
			
		$cal .= "</tr><tr>";
			
		$j = 0;//auxiliar para contador de dias da tabela
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
		
		//Fim da montagem da tabela
		$cal .= "</tr></table>";
			
		return $cal;
	}
}
?>