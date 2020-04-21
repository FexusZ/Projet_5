<?php

	namespace Core\Database;
	use \PDO;

	/**
	* Class Database
	* Permet la connexion a la base de données ainsi que la gestion des requêtes 
	*/

	class Database
	{
		/**
		* @var string nom de la base de données
		*/
		private $db_name;
		/**
		* @var string nom d'utilisateur pour la connexion a la bdd
		*/
		private $db_user;
		/**
		* @var string mot de passe pour la connexion a la bdd
		*/
		private $db_pass;
		/**
		* @var string IP/Domaine de connexion pour la bdd
		*/
		private $db_host;
		/**
		* @var PDO classe PDO pour la connexion SQL
		*/
		private $dbh;


		/**
		* @param string $db_name 
		* @param string $db_user
		* @param string $db_pass
		* @param string $db_host
		* Même description que les variables au dessus
		*/
		public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
		{
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_host = $db_host;
		}
		/**
		* @return PDO
		*/
		private function init()
		{
			if ($this->dbh == NULL) 
			{
				$dbh = new PDO("mysql:dbname={$this->db_name};host={$this->db_host}", $this->db_user, $this->db_pass);

				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->dbh = $dbh;
			}


			return $this->dbh;
		}

		/**
		* @param $statement string requete SQL
		* @param $fetch bool permet de bloquer a un resultat
		* @return array
		*/
		public function query($statement, $class_name = NULL, $fetch = false)
		{

			$requete = $this->init()->query($statement);
			if ($class_name == NULL) {
				$requete->setFetchMode(PDO::FETCH_OBJ);
			}
			else
			{
				$requete->setFetchMode(PDO::FETCH_CLASS, $class_name);
			}

			if ($fetch === 'No') 
			{
				$reponse ='';
			}
			elseif ($fetch) 
			{
				$reponse = $requete->fetch();
			}
			else
			{
				$reponse = $requete->fetchAll();
			}

			return $reponse;
		}
		/**
		* @param $statement string requete SQL
		* @param $array array parametre de la requete sql
		* @param $fetch bool permet de bloquer a un resultat
		* @return array
		*/
		public function execute($statement, $class_name = NULL, $fetch = false, $array = array())
		{
			$requete = $this->init()->prepare($statement);
			if ($class_name == NULL) {
				$requete->setFetchMode(PDO::FETCH_OBJ);
			}
			else
			{
				$requete->setFetchMode(PDO::FETCH_CLASS, $class_name);
			}
		
			$requete->execute($array);


			if ($fetch === 'No') 
			{
				$reponse ='';
			}
			elseif ($fetch) 
			{
				$reponse = $requete->fetch();
			}
			else
			{
				$reponse = $requete->fetchAll();
			}

			return $reponse;
		}
	}