<?php 

	namespace Manager;

	class TokensManager extends \W\Manager\Manager{

		public function findToken($token){
			
			$sql = "SELECT * FROM " . $this->table . " WHERE token = :token LIMIT 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":token", $token);
			$sth->execute();

			return $sth->fetch();
		}

		public function findEmail($email){
			
			$sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":email", $email);
			$sth->execute();

			return $sth->fetch();
		}

		public function delete($email){

			$sql = "DELETE FROM " . $this->table . " WHERE email = :email LIMIT 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":email", $email);
			return $sth->execute();
		}

		public function updateFromEmail(array $data, $email, $stripTags = true){
				
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
