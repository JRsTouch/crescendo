<?php 

	namespace Manager;

	class CalendarsManager extends \W\Manager\Manager{

		public function findAll(){

			$day = $_GET['day'];
			$mounth = $_GET['mounth'];
			$year = $_GET['year'];

			$sql = "SELECT * FROM " . $this->table . " WHERE day = :day AND mounth = :mounth AND year = :year";

			$sth = $this->dbh->prepare($sql);

			$sth->bindValue(':day', $day);
			$sth->bindValue(':mounth', $mounth);
			$sth->bindValue(':year', $year);

			$sth->execute();

			$data = $sth->fetchAll();

			echo json_encode($data);

		}

	}
