<?php 

	namespace Manager;

	class DocumentsManager extends \W\Manager\Manager{

		public function getAllDocs() {
			$sql= "SELECT * FROM documents";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
		}
	}
