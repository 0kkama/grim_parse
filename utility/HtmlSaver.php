<?php

    namespace grim_parser\utility;

    use RuntimeException;

    /**
     * The class saves html data to file
     */
    final class HtmlSaver
    {
        private const PERMISSION = 0755;
        private const PATH = __DIR__ . '/../html_reports/';

        public static function saveData(string $html): bool
        {
            $date = date('d-m-Y H:i:s');
            if (
                !file_exists(self::PATH)
                && !mkdir(self::PATH, self::PERMISSION, true)
                && !is_dir(self::PATH)
            ) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', self::PATH));
            }
            file_put_contents(self::PATH . "test_$date.html", $html);
            return true;
        }
    }