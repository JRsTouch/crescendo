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
	
	}