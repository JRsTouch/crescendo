<?php

namespace W\Manager;

/**
 * Le manager de base à extender
 */
abstract class Manager 
{

	/** @var string $table Le nom de la table */
	protected $table;

	/** @var \Pdo $dbh Connexion à la base de données */
	protected $dbh;

	/**
	 * Constructeur
	 */
	public function __construct()
	{
		$this->setTableFromClassName();
		$this->dbh = ConnectionManager::getDbh();
	}

	/**
	 * Déduit le nom de la table en fonction du nom du Manager enfant
	 * @return W\Manager $this
	 */
	private function setTableFromClassName()
	{
		$app = getApp();

		//nom de la class enfant
		$className = get_class($this);

		//retire le Manager, les backslashes et ajoute un "s"
		$tableName = str_replace("Manager", "", $className);
		$tableName = strtolower(str_replace("\\", "", $tableName));
		if (substr($tableName, -1) != "s"){
			$tableName .= "s";
		}

		$this->table = $app->getConfig('db_table_prefix') . $tableName;

		return $this;
	}

	/**
	 * Définit le nom de la table (si le nom déduit ne convient pas)
	 * @param string $table Nom de la table
	 * @return W\Manager $this
	 */
	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	/**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  integer Identifiant
	 * @return mixed Les données
	 */
	public function find($id)
	{
		if (!is_numeric($id)){
			return false;
		}

		$sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $id);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Récupère toutes les lignes de la table
	 * @param   $orderBy La colonne en fonction de laquelle trier
	 * @param   $orderDir La direction du tri, ASC ou DESC
	 * @return array Toutes les données de la table
	 */
	public function findAll($orderBy = "", $orderDir = "ASC")
	{

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

			$sql .= " ORDER BY $orderBy $orderDir";
		}
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Efface une ligne en fonction de son identifiant
	 * @param mixed $id L'identifiant de la ligne à effacer
	 * @return mixed La valeur de retour de la méthode execute()
	 */
	public function delete($id)
	{
		if (!is_numeric($id)){
			return false;
		}

		$sql = "DELETE FROM " . $this->table . " WHERE id = :id LIMIT 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $id);
		return $sth->execute();
	}

	/**
	 * Ajoute une ligne
	 * @param array $data Un tableau associatif de valeurs à insérer
	 * @param boolean $stripTags Active le strip_tags automatique sur toutes les valeurs
	 * @return mixed La valeur de retour de la méthode execute()
	 */
	public function insert(array $data, $stripTags = true)
	{

		$colNames = array_keys($data);
		$colNamesString = implode(", ", $colNames);

		$sql = "INSERT INTO " . $this->table . " ($colNamesString) VALUES (";
		foreach($data as $key => $value){
			$sql .= ":$key, ";
		}
		$sql = substr($sql, 0, -2);
		$sql .= ")";

		$sth = $this->dbh->prepare($sql);
		foreach($data as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			$sth->bindValue(":".$key, $value);
		}
		return $sth->execute();
	}

	/**
	 * Modifie une ligne en fonction d'un identifiant
	 * @param array $data Un tableau associatif de valeurs à insérer
	 * @param mixed $id L'identifiant de la ligne à modifier
	 * @param boolean $stripTags Active le strip_tags automatique sur toutes les valeurs
	 * @return mixed La valeur de retour de la méthode execute()
	 */
	public function update(array $data, $id, $stripTags = true)
	{
		if (!is_numeric($id)){
			return false;
		}
		
		$sql = "UPDATE " . $this->table . " SET ";
		foreach($data as $key => $value){
			$sql .= "$key = :$key, ";
		}
		$sql = substr($sql, 0, -2);
		$sql .= " WHERE id = :id";

		$sth = $this->dbh->prepare($sql);
		foreach($data as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			$sth->bindValue(":".$key, $value);
		}
		$sth->bindValue(":id", $id);
		return $sth->execute();
	}
}