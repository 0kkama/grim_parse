<?php

    namespace grim_parser\core;

    use grim_parser\models\Artist;
    use grim_parser\models\Track;

    /**
     *  The class works with models Artist and Track
     *  to save the parsing result to the database
     */
    final class ModelsMediator
    {
        private array $artist, $tracks;

        public function __construct(array $artistData, array $tracksData)
        {
            $this->artist = $artistData;
            $this->tracks = $tracksData;
        }

        public function saveToDataBase()
        {
            $artistModel =  new Artist();
            $artistModel->setFields($this->artist)->save();
            $artistId = $artistModel->getId();

            foreach ($this->tracks as $track) {
                $tracksModel = new Track();
                $tracksModel->setArtistId($artistId);
                $tracksModel->setFields($track)->save();
            }
        }
    }
