<?php

    namespace grim_parser\traits;

    trait TSingleton
    {
        public static function getInstance()
        {
            return self::$instance ?: (self::$instance = new self());
        }

        private function __construct()
        {
            // forbid constructor
        }

        private function __clone()
        {
            // forbid clone
        }

        public function __wakeup()
        {
            //  forbid deserialization
            throw new \Exception("Deserialization of singleton is forbidden");
        }
    }