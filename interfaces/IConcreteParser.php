<?php

    namespace grim_parser\interfaces;

    use DiDom\Document;

    interface IConcreteParser
    {
        public function loadDocument(Document $document): void;
        public function executeParsing(): array;
    }