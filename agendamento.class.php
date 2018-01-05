<?php 

class Agendamento {

	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function getAgendamento() {
		$array = array();

		$sql = "SELECT * FROM agendamento";
		$sql = $this->pdo->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}




		return $array;
	}
}

 ?>