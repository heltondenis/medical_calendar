<?php
class Reservas {

	private $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function getReservas($data_inicio, $data_fim) {
		$array = array();

		$sql = "SELECT * FROM reservas WHERE ( NOT ( data_inicio > :data_fim OR data_fim < :data_inicio ) )";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":data_inicio", $data_inicio);
		$sql->bindValue(":data_fim", $data_fim);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function verificarDisponibilidade($medico, $data_inicio, $data_fim) {

		$sql = "SELECT
		*
		FROM reservas
		WHERE
		id_medico = :medico AND
		( NOT ( data_inicio > :data_fim OR data_fim < :data_inicio ) )";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":medico", $medico);
		$sql->bindValue(":data_inicio", $data_inicio);
		$sql->bindValue(":data_fim", $data_fim);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return false;
		} else {
			return true;
		}

	}

	public function reservar($medico, $data_inicio, $data_fim, $paciente) {
		$sql = "INSERT INTO reservas (id_medico, data_inicio, data_fim, paciente) VALUES (:medico, :data_inicio, :data_fim, :paciente)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":medico", $medico);
		$sql->bindValue(":data_inicio", $data_inicio);
		$sql->bindValue(":data_fim", $data_fim);
		$sql->bindValue(":paciente", $paciente);
		$sql->execute();
	}














}