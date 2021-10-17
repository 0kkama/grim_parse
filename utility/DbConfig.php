<?php

    namespace grim_parser\utility;

    use grim_parser\exceptions\ConfigParamsException;
    use grim_parser\traits\TSingleton;

    final class DbConfig
    {
        private array $configurations;
        private static $instance;

        use TSingleton;

        public function setInstance($params) : void
        {
            if (!isset($this->configurations)) {
                $this->configurations = $params;
            }
        }

        public function getHost(): string
        {
            $key = 'host';
            $this->check($key);
            return $this->configurations[$key];
        }

        public function getName(): string
        {
            $key = 'name';
            $this->check($key);
            return $this->configurations[$key];
        }

        public function getChar(): string
        {
            $key = 'char';
            $this->check($key);
            return $this->configurations[$key];
        }

        public function getUser(): string
        {
            $key = 'user';
            $this->check($key);
            return $this->configurations[$key];
        }

        public function getPass(): string
        {
            $key = 'pass';
            $this->check($key);
            return $this->configurations[$key];
        }

        /**
         * @throws ConfigParamsException
         */
        private function check(string $key): void
        {
            if(empty($this->configurations[$key])) {
                throw new ConfigParamsException("The requested config parameter '$key' is not set");
            }
        }
    }