<?php

    namespace grim_parser\models;

    /**
     * Model for 'artists' table
     */
    final class Artist extends Model
    {
        protected const TABLE_NAME = 'artists';
        protected string $title, $name, $location, $followers, $musicians, $tracks;

        public function exist(): bool
        {
            return (!empty($this->id) && !empty($this->title));
        }

        public function save() : bool
        {
            $this->makeSql();
            $object = self::findOneBy('title', $this->title);
            if ($object->exist()) {
                $this->id = $object->getId();
                return $this->update();
            }
            return $this->insert();
        }

        /**
         * @return string
         */
        public function getTitle(): string
        {
            return $this->title;
        }

        /**
         * @param string $title
         * @return Artist
         */
        public function setTitle(string $title): self
        {
            $this->title = $title;
            return $this;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @param string $name
         * @return Artist
         */
        public function setName(string $name): self
        {
            $this->name = $name;
            return $this;
        }

        /**
         * @return string
         */
        public function getLocation(): string
        {
            return $this->location;
        }

        /**
         * @param string $location
         * @return Artist
         */
        public function setLocation(string $location): self
        {
            $this->location = $location;
            return $this;
        }

        /**
         * @return string
         */
        public function getFollowers(): string
        {
            return $this->followers;
        }

        /**
         * @param string $followers
         * @return Artist
         */
        public function setFollowers(string $followers): self
        {
            $this->followers = $followers;
            return $this;
        }

        /**
         * @return string
         */
        public function getMusicians(): string
        {
            return $this->musicians;
        }

        /**
         * @param string $musicians
         * @return Artist
         */
        public function setMusicians(string $musicians): self
        {
            $this->musicians = $musicians;
            return $this;
        }

        /**
         * @return string
         */
        public function getTracks(): string
        {
            return $this->tracks;
        }

        /**
         * @param string $tracks
         * @return Artist
         */
        public function setTracks(string $tracks): self
        {
            $this->tracks = $tracks;
            return $this;
        }
    }