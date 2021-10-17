<?php
    declare(strict_types=1);
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    error_reporting(E_ALL);

    use grim_parser\core\SoundCloudParser;
    use grim_parser\utility\DbConfig;

    require_once __DIR__ . '/vendor/autoload.php';

    spl_autoload_register(static function($className) {
        $include = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
        if (is_readable($include)) {
            require_once $include;
        }
    });

    // set config instance
    DbConfig::getInstance()->setInstance(include (__DIR__ . '/config/db.php'));

//    $uri = 'https://soundcloud.com/lakeyinspired';
//    $uri = 'https://soundcloud.com/aljoshakonstanty';
//    $uri = 'https://soundcloud.com/birocratic';
//    $uri = 'https://soundcloud.com/dixxy-2';
//    $uri = 'https://soundcloud.com/dekobe';
//    $uri = 'https://soundcloud.com/perturbator/';
//    $uri = 'https://soundcloud.com/lil_peep';

//    $soundCloudParser = new SoundCloudParser($uri);
//    $soundCloudParser->execute();

//    так же можно сохранить html данные в файл для дальнейшего разбора, на случай ошибки
//    файлы будут сохранены в директории ./html_records
//    $soundCloudParser->setSave(true)->execute();

    echo 'Parsing is finished. Check the database.';
    die();




