<?php

    namespace grim_parser\core;

    use grim_parser\exceptions\DbException;
    use grim_parser\utility\DbConfig;
    use PDO;
    use PDOStatement;

    final class Db
    {
        private PDO $dbh;
        private static ?Db $instance = null;

        public static function getInstance()
        {
            return self::$instance ?: (self::$instance = new self());
        }

        private function __construct()
        {
            $this->dbh = $this->newConnection(DbConfig::getInstance());
        }

        /**
         * Create new connection to database
         * @param $params
         * @return PDO
         */
        protected function newConnection($params) : PDO
        {
                $config = $params;
                $dbConnection = new PDO
                ('mysql:host=' . $config->getHost() . ';dbname=' . $config->getName() . ';charset=' . $config->getChar(),
                    $config->getUser(), $config->getPass(),
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
                        PDO::ATTR_PERSISTENT         => true,
                    ]
                );
            return $dbConnection;
        }

        /**
         * Checks for errors during the execution of the request
         * @param PDOStatement $query
         * @return bool
         * @throws DbException
         */
        protected function checkQueryErr(PDOStatement $query) : bool
        {
            $errInfo = $query->errorInfo();
            if($errInfo[0] !== PDO::ERR_NONE) {
                throw new DbException('Error when querying the database. ERR: ' . $errInfo[0]);
            }
            return true;
        }

        /**
         * Method execute inserts $data into query and return true or false
         * depending on the execution succeeded or not
         * @param string $sql
         * @param array $data
         * @return bool
         * @throws DbException
         */
        public function execute(string $sql, array $data) : bool
        {
            $query = $this->dbh->prepare($sql);
            $success = $query->execute($data);
            $this->checkQueryErr($query);
            return $success;
        }

        /**
         * The method executes the query, inserts $data into it,
         * returns the array of the query result, or null if execution failed
         * @param string $sql
         * @param array $data
         * @param $class
         * @param int $fetchMode
         * @return array|null
         * @throws DbException
         */
        public function queryAll(string $sql, array $data, $class, int $fetchMode = PDO::FETCH_CLASS) : ?array
        {
                $query = $this->dbh->prepare($sql);
                $query->execute($data);
                $this->checkQueryErr($query);
            return ($fetchMode === PDO::FETCH_CLASS) ? $query->fetchAll($fetchMode, $class) : $query->fetchAll($fetchMode);
        }

        /**
         * The method executes the request and returns one object of the specified class or null if failed
         * @param string $sql
         * @param array $data
         * @param $class
         * @return object|null
         * @throws DbException
         */
        public function queryOne(string $sql, array $data, $class) : ?object
        {
            $query = $this->dbh->prepare($sql);
            $query->setFetchMode(PDO::FETCH_CLASS, $class);
            $query->execute($data);
            $this->checkQueryErr($query);
            $result = $query->fetch();
            return  $result ?: null;
        }

        /**
         * Return last insert id
         * @return string
         */
        public function getLastId() : string
        {
            return $this->dbh->lastInsertId();
        }
    }