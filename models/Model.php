<?php

    namespace grim_parser\models;

    use grim_parser\core\Db;
    use grim_parser\exceptions\DbException;
    use PDO;

    /**
     * Class Model it's super class for other models.
     *
     * It implements ActiveRecord pattern.
     */
    abstract class Model
    {
        /**
         * @const TABLE_NAME dynamically changing in inheriting classes
         */
        protected const TABLE_NAME = 'abstract';
        protected ?string $id = null;
        /**
         * @var array|null[] $mata collection of data for forming SQL querie
         */
        private array $meta = ['table' => null, 'cols' => null, 'data' => null, 'separator' => null];


        /**
         * Сhecks the existence of an instance by the specified parameters
         * @return bool
         */
        abstract public function exist() : bool;

        /**
         * Defines whether a record is old or new. If the record is new,
         * then the <b>insert</b> method will be called, otherwise the <b>update</b> method.
         * @return boolean
         * @throws DbException
         */
        abstract public function save() : bool;

        /**
         * Finds needed line in table by given <b>$subject</b> and return it like object of respective class
         * @param string $type type of search subject (id, login, mail etc.)
         * @param string $subject
         * @return Model|object
         * @throws DbException
         */
        public static function findOneBy(string $type, string $subject)
        {
            $db = Db::getInstance();
            $sql = 'SELECT * FROM ' . static::TABLE_NAME . " WHERE `{$type}` = :{$type}";
            $result = $db->queryOne($sql, [$type => $subject], static::class);
            return $result ?? new static;
        }

        /**
         * Return array with objects from table
         * @return array
         */
        public static function getAll(): array
        {
            $db = Db::getInstance();
            $sql = 'SELECT * FROM ' . static::TABLE_NAME;
            return $db->queryAll($sql, [], static::class);
        }

        /**
         * Return array with objects from table by given property (id, date or else)
         * @param string|null $type - name of column in table
         * @param string|null $subject - needle for search
         * @param string|null $sort - type of sorting ASC or DESC
         * @return array
         */
        public static function getAllBy(string $type = null, string $subject = null, string $sort = null): array
        {
            $paramsArr = (isset($type, $subject)) ? [$type => $subject]  : [];
            $where = ($paramsArr === []) ? '' : " WHERE `$type` = :$type";
            $order = $sort ? ("ORDER BY `$sort`") : '';
            $db = Db::getInstance();
            $sql = 'SELECT * FROM ' . static::TABLE_NAME . $where . $order;
            return $db->queryAll($sql, $paramsArr, static::class);
        }

        /** Return array with objects from table by sql IN construction specifying a range of conditions.
         * @param string $type - name of column in table
         * @param array $params - array of values for search
         * @param string|null $sort - type of sorting ASC or DESC
         * @return array
         */
        public static function getAllInBy(string $type, array $params, string $sort = null): array
        {
            $paramsArr = [$type => $params];
            $in  = str_repeat('?,', count($params) - 1) . '?';
            $order = $sort ? ("ORDER BY `$sort`") : '';
            $where = ($paramsArr === []) ? '' : " WHERE `$type` IN ( $in ) " ;
            $db = Db::getInstance();
            $sql = 'SELECT * FROM ' . static::TABLE_NAME . $where . $order;
            return $db->queryAll($sql, $params, static::class);
        }

        /**
         * Count number of all records from the specified table and return result
         */
        public static function getTotalQuantity(): int
        {
            $db = Db::getInstance();
            $sql = 'SELECT COUNT(*) AS ' . static::TABLE_NAME . ' FROM ' . static::TABLE_NAME;
            $result = $db->queryAll($sql, [], static::class, PDO::FETCH_ASSOC) ?: [];
            return ($result === []) ? 0 : array_column($result, static::TABLE_NAME)[0];
        }

        /**
         * The method add new record into table and assign last insert id to $this->id
         * @return bool
         * @throws DbException
         */
        protected function insert(): bool
        {
            // make string look like :title, :text, :author, :category
            $values = implode($this->meta['separator'], $this->meta['cols']);
            // make string look like title, text, author, category
            $insertions = implode($this->meta['separator'], array_flip($this->meta['cols']));
            // make pattern for PDO query such as 'INSERT INTO news (title,text,author,category) VALUES (:title,:text,:author,:category)'
            $sql = "INSERT INTO {$this->meta['table']} ($insertions) VALUES ($values)";

            $db = Db::getInstance();
            $db->execute($sql, $this->meta['data']);
            $this->id = $db->getLastId();
            unset($this->meta);
            return true;
        }

        /**
         * Update already existed record, which was taken from DB by id.
         * @return bool
         * @throws DbException
         */
        protected function update(): bool
        {
            $set = [];
            foreach ($this->meta['cols'] as $index => $value) {
                $set[] = "$index = $value";
            }

            $this->meta['data'][":id"] = $this->id;

            $set = implode($this->meta['separator'], $set);
            // шаблон подобный UPDATE news SET title = :title, text = :text, author = :author WHERE id = :id
            $sql = "UPDATE {$this->meta['table']} SET $set WHERE id = :id";

            $db = Db::getInstance();
            $db->execute($sql, $this->meta['data']);
            unset($this->meta);
            return true;
        }

        /**
         * Delete record from table by it $id
         * @return bool
         * @throws DbException
         */
        public function delete(): bool
        {
            if (isset($this->id)) {
                $table = static::TABLE_NAME;
                $sql = "DELETE FROM $table WHERE id = :id";
                $data[':id'] = $this->id;

                $db = Db::getInstance();
                return $db->execute($sql, $data);
            }
            return false;
        }

        /**
         * The inner method preparing data for sql query.
         * <li><b>table</b> - table name;</li>
         * <li><b>cols</b> - array looks like: 'index' => ':index' for prepared queries;</li>
         * <li><b>data</b> - array with data for substitution (':user' => 'Ahmed');</li>
         * <li><b>separator</b> - separator sign for query;</li></ul>
         * @return void
         */
        protected function makeSql(): void
        {
            // delete values like id, date etc. generated automatically in DB
            $fields = $this->getFormFields();
            $this->meta['cols'] = $this->meta['data'] = [];

            foreach ($fields as $index => $value) {
                $this->meta['cols']["`$index`"] = ":$index"; // array like: 'index' => ':index'
                $this->meta['data'][":$index"] = $value; // data for injection: ':user' => 'Ahmed'
            }

            $this->meta['separator'] = ', '; // separator for current query
            $this->meta['table'] = static::TABLE_NAME; // name of current table
        }

        /**
         * The method extract data from class FormsWithData and return instance of subclass
         * @param array $fields
         * @return Model
         */
        public function setFields(array $fields): self
        {
            foreach ($fields as $index => $field) {
                $method = 'set' . ucfirst($index);
                    if (method_exists($this, $method)) {
                        $this->$method($field);
                    }
            }
            return $this;
        }

        public function getId(): ?string
        {
            return $this->id;
        }

        /**
         * Filters out all fields of the model that are not string
         * @return array
         */
        private function getFormFields(): array
        {
            return array_filter(get_object_vars($this), static function ($var) {
                return is_string($var);
            });
        }
   }