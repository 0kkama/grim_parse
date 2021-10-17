<?php

    namespace grim_parser\core;


    use grim_parser\exceptions\NoArrayException;

    final class TracksInspector
    {
        private array $tracks;

        /**
         * @param array $tracks
         * @return $this
         */
        public function loadTracks(array $tracks): self
        {
            $this->tracks = $tracks;
            return $this;
        }


        /**
         * If some tracks has empty strings,
         * then such elements will be removed from the array
         * @return array
         * @throws NoArrayException
         */
        public function executeInspection(): array
        {
            if (empty($this->tracks)) {
                throw new NoArrayException('Array for inspection required');
            }

            foreach ($this->tracks as $index => $track) {
                foreach ($track as $value) {
                    if (empty($value)) {
                        unset($this->tracks[$index]);
                    }
                }
            }
            return  $this->tracks;
        }
    }