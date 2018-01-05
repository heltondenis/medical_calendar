<?php 
require 'config.php';
require 'agendamento.class.php';
require 'medicos.class.php';

// Recebe as classes por variável e seta a conexão via parâmetro //
$agendamento = new Agendamento($pdo);
$medicos = new Medicos($pdo);
?>

<h1>Agendamentos</h1>

<?php 

$lista = $agendamento->getAgendamento();

foreach ($lista as $item) {
	$data1 = date('d/m/Y', strtotime($item['data_inicio']));
	$data2 = date('d/m/Y', strtotime($item['data_fim']));
	echo $item['medico'].' Reservou o atendimento '.$item['id_medico'].' entre '.$data1.' e '.$data2.'';
}
 ?>