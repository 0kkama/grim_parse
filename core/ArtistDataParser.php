<?php

    namespace grim_parser\core;

    use DiDom\Document;
    use DiDom\Exceptions\InvalidSelectorException;
    use DiDom\Query;
    use grim_parser\exceptions\ParsingException;
    use grim_parser\interfaces\IConcreteParser;

    /**
     * Extract data about artist from document
     */
    final class ArtistDataParser implements IConcreteParser
    {
        private const BLINDPLUG = 'unknown';
        private Document $document;

        /**
         * Loads an object of the Document class for processing
         * @param Document $document
         */
        public function loadDocument(Document $document): void
        {
            $this->document = $document;
        }

        /**
         * Starts the parsing process
         * @return array - result of parsing. Content information about artist
         * @throws ParsingException|InvalidSelectorException
         */
        public function executeParsing(): array
        {
            if(!isset($this->document)) {
                throw new ParsingException('Document for parsing required');
            }
            return array_merge($this->parseArtistPersonalData(), $this->parseArtistSocialData());
        }

        /**
         * Gets the following data from the document:
         * the number of followers,
         * the number of other musicians that artist is following,
         * and the number of uploaded tracks
         * @return array
         * @throws InvalidSelectorException
         */
        private function parseArtistSocialData(): array
        {
            $onlyNumbersRegExp = '~[^0-9]~';
            $cssSelectorTable = '.infoStats__table';
            $cssSelectorLink = '.infoStats__statLink';
            $artistMetaInfo = $this->document->find($cssSelectorTable)[0]->find($cssSelectorLink);

            $artistSocialData = [];
            $titles = ['followers', 'musicians', 'tracks'];
            $element = 0;

            foreach ($titles as $title) {
                $artistSocialData[$title] = preg_replace(
                    $onlyNumbersRegExp,
                    '',
                    $artistMetaInfo[$element]->getAttribute('title')
                );
                $element++;
            }
            return $this->prepare($artistSocialData);
        }

        /**
         * Gets the following data from the document:
         * the artist's pseudonym, his name and location
         * @return array
         * @throws InvalidSelectorException
         */
        private function parseArtistPersonalData(): array
        {
            $cssSelectorDiv = '.profileHeaderInfo__content';
            $cssSelectorHeadTwo = '.profileHeaderInfo__userName';
            $xpathForName = "//h3[contains(@class, 'profileHeaderInfo__additional g-type-shrinkwrap-block theme-dark g-type-shrinkwrap-large-secondary')]";
            $xpathForLocation = "//h3[contains(@class, 'sc-mt-1x')]";

            $artistPersonalDataBlock = $this->document->find($cssSelectorDiv);
            $title = $artistPersonalDataBlock[0]->find($cssSelectorHeadTwo)[0]->text();

            if (false !== strpos($title, "Verified")) {
                $title = explode('Verified', $title);
                $title = $title[0];
            }

            $artistData['title'] = $title;

            if ($artistPersonalDataBlock[0]->has($xpathForLocation, Query::TYPE_XPATH)
            && 'Pro Unlimited' !== trim($artistPersonalDataBlock[0]->find($xpathForLocation, Query::TYPE_XPATH)[0]->text())) {
                $artistData['location'] = $artistPersonalDataBlock[0]->find($xpathForLocation, Query::TYPE_XPATH)[0]->text();
            } else {
                $artistData['location'] = self::BLINDPLUG;
            }

            if ($artistPersonalDataBlock[0]->has($xpathForName, Query::TYPE_XPATH)
                && $artistPersonalDataBlock[0]->find($xpathForName, Query::TYPE_XPATH)[0]->text() !== $artistData['location']) {
                $artistData['name'] = $artistPersonalDataBlock[0]->find($xpathForName, Query::TYPE_XPATH)[0]->text();
            } else {
                $artistData['name'] = self::BLINDPLUG;
            }
            return $this->prepare($artistData);
        }

        /**
         * @param array $array
         * @return array
         */
        private function prepare(array $array): array
        {
            array_walk($array, static function (&$element) {$element = trim($element);});
            return $array;
        }
    }