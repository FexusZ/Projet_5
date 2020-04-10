<?php

	namespace APP;

	use \PDO;

	/**
	* Class Database
	*/

	class Database{

		private $db_name;
		private $db_user;
		private $db_pass;
		private $db_host;
		private $dbh;

		public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost'){
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_host = $db_host;
		}
		private function init(){
			if ($this->dbh == NULL) {
				$dbh = new PDO('mysql:host= ' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERMMODE_EXCEPTION);
				$this->dbh = $dbh;
			}

			return $this->dbh;
		}
		public function query($statement){
			$requete = $this->init()->query($statement);

			if ($requete->RowCount() > 1) {
				$reponse['query'] = $requete->fetchAll();
			}elseif($requete->RowCount() > 0){
				$reponse['query'] = $requete->fetch();
			}

			$reponse['num'] = $requete->RowCount();

			return $reponse;
		}
		public function execute($statement, $array){
			$requete = $this->init()->prepare($statement);

			foreach ($array as $key => $value) {
				$requete->BindValue($key, $value);
			}

			$requete->execute();

			if ($requete->RowCount() > 1) {
				$reponse['execute'] = $requete->fetchAll();
			}elseif($requete->RowCount() > 0){
				$reponse['execute'] = $requete->fetch();
			}
			$reponse['num'] = $requete->RowCount();

			return $reponse;
		}
	}