<?php

    namespace grim_parser\core;

    use DiDom\Document;
    use DiDom\Exceptions\InvalidSelectorException;
    use Exception;
    use grim_parser\exceptions\NoDocumentException;
    use grim_parser\exceptions\ParsingException;
    use grim_parser\utility\HtmlSaver;

    final class SoundCloudParser
    {
        private bool $save = false;
        private array $artistData, $tracksData;
        private HtmlHarvester $harvester;
        private Document $document;
        private ArtistDataParser $artistParser;
        private ArtistsTracksParser $tracksParser;
        private TracksInspector $inspector;

        public function __construct(string $uri)
        {
            $this->harvester = new HtmlHarvester($uri);
            $this->document = new Document();
            $this->artistParser = new ArtistDataParser();
            $this->tracksParser = new ArtistsTracksParser();
            $this->inspector = new TracksInspector();
        }

        /**
         * Starting the parsing process
         * @throws Exception
         */
        public function execute(): void
        {
            $html = $this->harvester->collectHtml();

            if(true === $this->save) {
                $this->saveToFile($html);
            }

            $this->parseHtml($html);
            unset($html);

            $this->tracksData = $this->inspector->loadTracks($this->tracksData)->executeInspection();

            $mediator = new ModelsMediator($this->artistData, $this->tracksData);
            $mediator->saveToDataBase();
        }


        /**
         * @param string $html
         */
        private function saveToFile(string $html): void
        {
            HtmlSaver::saveData($html);
        }

        /**
         * @throws InvalidSelectorException
         * @throws ParsingException|NoDocumentException
         */
        private function parseHtml(string $html): void
        {
            $this->document->loadHtml($html);
            $this->artistParser->loadDocument($this->document);
            $this->tracksParser->loadDocument($this->document);

            $this->artistData = $this->artistParser->executeParsing();
            $this->tracksData = $this->tracksParser->executeParsing();
        }


        /**
         * Sets the function of saving html to a file
         * @param bool $tumbler
         * @return $this
         */
        public function setSave(bool $tumbler): self
        {
            $this->save = $tumbler;
            return $this;
        }
    }