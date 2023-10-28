<?php
$arquivo_resultados = file_get_contents('resultados-megasena.txt');
$resultados =  explode("\n", $arquivo_resultados);
$total = count($resultados) - 1;

$maisSorteadas = array();
$dezenasPares = array();
$dezenasImpares = array();
$maisAtrasadas = array();

for ($x = 0; $x < $total; $x++) {
	$dezenas = explode('-', $resultados[$x]);
	
	foreach ($dezenas as $d) {
		$dezena = ($d < 10) ? '0'.$d : $d;
		
		if (($d % 2) == 0) {
			//pares
			$dezenasPares[$dezena] = isset($dezenasPares[$dezena]) ? $dezenasPares[$dezena] + 1 : 0;
		} else {
			//impares
			$dezenasImpares[$dezena] = isset($dezenasImpares[$dezena]) ? $dezenasImpares[$dezena] + 1 : 0;
		}
		//mais sorteadas
		$maisSorteadas[$dezena] = isset($maisSorteadas[$dezena]) ? $maisSorteadas[$dezena] + 1 : 0;

	}
}

for ($d = 1; $d <= 60; $d++) {
	$dezena = ($d < 10) ? '0'.$d : $d;
	$maisAtrasadas[$dezena] = 0;
}
//As mais atrasadas são as que não saíram nos últimos 20 concursos
for ($x = ($total - 20); $x < $total; $x++) {
	$dezenas = explode('-', $resultados[$x]);
	
	foreach ($dezenas as $d) {
		$dezena = ($d < 10) ? '0'.$d : $d;
		$maisAtrasadas[$dezena] = isset($maisAtrasadas[$dezena]) ? $maisAtrasadas[$dezena] + 1 : 0;
	}
}

//ordena por ordem de frequência
arsort($maisSorteadas);
arsort($dezenasPares);
arsort($dezenasImpares);
asort($maisAtrasadas);

//Obter apenas a chave que corresponde as dezenas
$maisSorteadas = array_keys($maisSorteadas);
$dezenasPares = array_keys($dezenasPares);
$dezenasImpares = array_keys($dezenasImpares);
$maisAtrasadas = array_keys($maisAtrasadas);

//cortar o array para obter apenas 16 dezenas
$maisSorteadas = array_slice($maisSorteadas, 0 ,16);
$dezenasPares = array_slice($dezenasPares, 0 ,16);
$dezenasImpares = array_slice($dezenasImpares, 0 ,16);
$maisAtrasadas = array_slice($maisAtrasadas, 0 ,16);

echo 'MAIS_SORTEADAS:'.implode('-', $maisSorteadas)."\r\n";
echo 'DEZENAS_PARES:'.implode('-', $dezenasPares)."\r\n";
echo 'DEZENAS_IMPARES:'.implode('-', $dezenasImpares)."\r\n";
echo 'MAIS_ATRASADAS:'.implode('-', $maisAtrasadas)."\r\n";

?>
