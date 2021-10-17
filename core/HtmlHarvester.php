<?php

    namespace grim_parser\core;

    use grim_parser\exceptions\InvalidUriException;
    use Symfony\Component\Panther\Client;

    /**
     * This class is a wrapper for symfony\panther client.
     * It's purpose collect html form site and transmit it to handlers
     */
    final class HtmlHarvester
    {
        private string $uri;

        public function __construct(string $uri)
        {
            $this->uri = $uri;
        }

        /**
         * Colest html from SoundCloud
         * @throws InvalidUriException
         */
        public function collectHtml(): string
        {
            $this->generateUri();
            $client = Client::createChromeClient();
            $client->request('GET', $this->uri);
            $html =  $client->getPageSource();
            $client->close();
            return $html;
        }

        /**
         * Checks for a forward slash sign at the end of uri string,
         * and add word 'tracks'
         * @throws InvalidUriException
         */
        private function generateUri(): void
        {
            $slash = ('/' === mb_substr($this->uri, -1)) ? '' : '/';
            $this->uri .= $slash . 'tracks';
            $this->checkUri();
        }

        /**
         * @throws InvalidUriException
         */
        private function checkUri()
        {
            if (false === filter_var($this->uri, FILTER_VALIDATE_URL)) {
                throw new InvalidUriException('Invalid URI given');
            }
        }
    }