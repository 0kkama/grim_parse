<?php

    namespace grim_parser\core;

    use DiDom\Document;
    use DiDom\Exceptions\InvalidSelectorException;
    use grim_parser\exceptions\NoDocumentException;
    use grim_parser\interfaces\IConcreteParser;

    /**
     * Extract data about tracks from document
     */
    final class ArtistsTracksParser implements IConcreteParser
    {
        private Document $document;

        /**
         * @param Document $document
         */
        public function loadDocument(Document $document): void
        {
            $this->document = $document;
        }

        /**
         * @throws InvalidSelectorException|NoDocumentException
         */
        public function executeParsing(): array
        {
            if(!isset($this->document)) {
                throw new NoDocumentException('Document for parsing required');
            }
            return $this->parseArtistTracks();
        }

        /**
         * @return array
         * @throws InvalidSelectorException
         */
        private function parseArtistTracks(): array
        {
            $onlyNumbersRegExp = '~[^0-9]~';
            $cssSelectorDiv = '.sound__content';
            $cssSelectorLink = '.sc-link-primary';
            $cssSelectorList = '.sc-ministats-item';
            $cssSelectorSpan = '.sc-tagContent';

            $tracksContainer = $this->document->find($cssSelectorDiv);

            $tracksInfo = [];
            $titles = ['plays', 'comments'];
            foreach ($tracksContainer as $index => $trackContainer) {
                $tracksInfo[$index]['title'] = $trackContainer->find($cssSelectorLink)[0]->text();

                if ($trackContainer->has($cssSelectorSpan)) {
                    $tracksInfo[$index]['tag'] = $trackContainer->find($cssSelectorSpan)[0]->text();
                } else {
                    $tracksInfo[$index]['tag'] = 'unknown';
                }

                $subindex = 0;
                foreach ($titles as $title) {
                    if ($trackContainer->has($cssSelectorList) && isset($trackContainer->find($cssSelectorList)[$subindex])) {
                        $item = $trackContainer->find($cssSelectorList)[$subindex]->getAttribute('title');
                        $tracksInfo[$index][$title] = preg_replace($onlyNumbersRegExp, '', $item);
                    } else {
                        $tracksInfo[$index][$title] = null;
                    }
                    $subindex++;
                }
            }
            return $this->prepare($tracksInfo);
        }

        /**
         * removes all spaces from array elements
         * @param array $array
         * @return array
         */
        private function prepare(array $array): array
        {
            foreach ($array as &$innerArray) {
                array_walk($innerArray, static function (&$element) {$element = trim($element);});
                unset($innerArray);
            }
            return $array;
        }
    }