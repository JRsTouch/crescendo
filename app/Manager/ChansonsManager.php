<?php
	
	namespace Manager;

	class ChansonsManager extends \W\Manager\Manager{

		/**
		 * Appelle de la fonction Insert Native
		 * Recupere en plus le lastInsertId
		 * @return int 
		 *
		**/
		public function insert($data){
			parent::insert($data);
			return $this->dbh->lastInsertId();
		}

		/**
		 * Appelle de la fonction Insert Native
		 * Recupere en plus le lastInsertId
		 * @return int 
		 *
		**/
		public function getSongBySection($id,$pupitre){
			$sql = "SELECT " . $this->table . ".titre, " . $this->table . ".informations, " . $this->table . ".choregraphie, ";
			$sql.= "musiques.mp3_".$pupitre.", musiques.ogg_".$pupitre.", pdfs.pdf_".$pupitre.", musiques.mp3_tutti, musiques.ogg_tutti, pdfs.pdf_tutti ";
			$sql.= "FROM " . $this->table . " LEFT JOIN musiques ON musiques.id_chanson = chansons.id LEFT JOIN pdfs ON pdfs.id_chanson=chansons.id ";
			$sql.= "WHERE chansons.id = ".$id.";";
			if (!empty($orderBy)){

			//sécurisation des paramètres, pour éviter les injections SQL
			if(!preg_match("#^[a-zA-Z0-9_$]+$#", $orderBy)){
				die("invalid orderBy param");
			}
			$orderDir = strtoupper($orderDir);
			if($orderDir != "ASC" && $orderDir != "DESC"){
				die("invalid orderDir param");
			}

			}
			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetch();
		}
	
	}