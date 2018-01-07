<?php
require 'config.php';
require 'classes/medicos.class.php';
require 'classes/reservas.class.php';

$reservas = new Reservas($pdo);
$medicos = new Medicos($pdo);

if(!empty($_POST['medico'])) {
	$medico = addslashes($_POST['medico']);
	$data_inicio = explode('/', addslashes($_POST['data_inicio']));
	$data_fim = explode('/', addslashes($_POST['data_fim']));
	$paciente = addslashes($_POST['paciente']);

	$data_inicio = $data_inicio[2].'-'.$data_inicio[1].'-'.$data_inicio[0];
	$data_fim = $data_fim[2].'-'.$data_fim[1].'-'.$data_fim[0];

	if($reservas->verificarDisponibilidade($medico, $data_inicio, $data_fim)) {
		$reservas->reservar($medico, $data_inicio, $data_fim, $paciente);
		header("Location: index.php");
		exit;
	} else {
		echo "Este medico já está reservado neste período.";
	}


}




?>
<h1>Adicionar Reserva</h1>

<form method="POST">
	Carro:<br/>
	<select name="medico">
		<?php
		$lista = $medicos->getMedicos();

		foreach($lista as $medico):
			?>
			<option value="<?php echo $medico['id']; ?>"><?php echo $medico['nome']; ?></option>
			<?php
		endforeach;
		?>
	</select><br/><br/>

	Data de início:<br/>
	<input type="text" name="data_inicio" /><br/><br/>

	Data de fim:<br/>
	<input type="text" name="data_fim" /><br/><br/>

	Nome do paciente:<br/>
	<input type="text" name="paciente" /><br/><br/>

	<input type="submit" value="Reservar" />
</form>