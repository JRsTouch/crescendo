<?php

	namespace Manager;

	class VideosManager extends \W\Manager\Manager{

		public function findLimit($limit){

			$sql = "SELECT * FROM " . $this->table;

			if (!empty($orderBy)){

				//sécurisation des paramètres, pour éviter les injections SQL
				if(!preg_match("#^[a-zA-Z0-9_$]+$#", $orderBy)){
					die("invalid orderBy param");
				}
				$orderDir = strtoupper($orderDir);
				if($orderDir != "ASC" && $orderDir != "DESC"){
					die("invalid orderDir param");
				}

				$sql .= " ORDER BY $orderBy $orderDir LIMIT $limit";
			}

			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetchAll();
		}


	}