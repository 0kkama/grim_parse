<?php

    namespace grim_parser\models;

    use grim_parser\exceptions\DbException;

    /**
     * Model for 'tracks' table
     */
    final class Track extends Model
    {
        protected const TABLE_NAME = 'tracks';
        protected string $title, $tag, $plays, $comments, $artist_id;
        protected ?string $duration = null;

        public function exist(): bool
        {
            return (!empty($this->id) && !empty($this->artist_id));
        }

        /**
         * If a track with the same name and the same artist number is already exist in the database,
         * it's ID will be return, otherwise 0 will be return
         * @return int
         */
        private function isItAlreadyExist(): int
        {
            $falseId = 0;
            $objectsArray = self::getAllBy('title', $this->title);
            foreach ($objectsArray as $object) {
                if ($object->exist() && $object->getArtistId() === $this->artist_id) {
                    return $object->getId();
                }
            }
            return $falseId;
        }

        /**
         * For the reason that several artists can have tracks with the same name,
         * the tracks require more complex verification
         * @return bool
         * @throws DbException
         */
        public function save(): bool
        {
            $falseId = 0;
            $this->makeSql();
            $trackId = $this->isItAlreadyExist();

            if ($trackId !== $falseId) {
                $this->id = $trackId;
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
         * @return Track
         */
        public function setTitle(string $title): self
        {
            $this->title = $title;
            return $this;
        }

        /**
         * @return string
         */
        public function getTag(): string
        {
            return $this->tag;
        }

        /**
         * @param string $tag
         * @return Track
         */
        public function setTag(string $tag): self
        {
            $this->tag = $tag;
            return $this;
        }

        /**
         * @return string
         */
        public function getPlays(): string
        {
            return $this->plays;
        }

        /**
         * @param string $plays
         * @return Track
         */
        public function setPlays(string $plays): self
        {
            $this->plays = $plays;
            return $this;
        }

        /**
         * @return string
         */
        public function getComments(): string
        {
            return $this->comments;
        }

        /**
         * @param string $comments
         * @return Track
         */
        public function setComments(string $comments): self
        {
            $this->comments = $comments;
            return $this;
        }

        /**
         * @return string
         */
        public function getArtistId(): string
        {
            return $this->artist_id;
        }

        /**
         * @param string $artist_id
         * @return Track
         */
        public function setArtistId(string $artist_id): self
        {
            $this->artist_id = $artist_id;
            return $this;
        }

        /**
         * @return string|null
         */
        public function getDuration(): ?string
        {
            return $this->duration;
        }

        /**
         * @param string|null $duration
         * @return Track
         */
        public function setDuration(string $duration): self
        {
            $this->duration = $duration;
            return $this;
        }
    }