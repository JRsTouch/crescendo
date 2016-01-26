<?php 

	namespace Manager;

	class UsersManager extends \W\Manager\Manager{
		
		public function findAllOrder(){

			$sql = "SELECT * FROM " . $this->table ."  ORDER BY pupitre, username";

			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetchAll();

		}

		public function updateFromEmail(array $data, $email, $stripTags = true)
		{
					
			$sql = "UPDATE " . $this->table . " SET ";
			foreach($data as $key => $value){
				$sql .= "$key = :$key, ";
			}
			$sql = substr($sql, 0, -2);
			$sql .= " WHERE email = :email";

			$sth = $this->dbh->prepare($sql);
			foreach($data as $key => $value){
				$value = ($stripTags) ? strip_tags($value) : $value;
				$sth->bindValue(":".$key, $value);
			}
			$sth->bindValue(":email", $email);
			return $sth->execute();
		}

	}
