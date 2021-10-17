## grim_parser - Simple SoundCloud Parser

### Используемые библиотеки

* symfony/panther (https://github.com/symfony/panther)
данная библиотека использует WebDriver, поэтому необходимо установить сhromedriver в директорию /drivers
    * либо через apt-get install chromium-chromedriver, 
    * либо напрямую из https://sites.google.com/a/chromium.org/chromedriver/

* imangazaliev/didom (https://github.com/Imangazaliev/DiDOM)

### Базовые настройки

Для работы с базой данных необходимо заполнить конфигурационный файл /config/db.php

### Запуск 
Код необходимый для запуска приложения находится в файле /Example.php

### SQL
Файлы с sql-дампом и структурой таблиц находятся в директории /SQLdump

### Пример использования:
```php
	$uri = 'https://soundcloud.com/lakeyinspired';
	$soundCloudParser = new SoundCloudParser($uri);
	$soundCloudParser->execute(); // запуск

	// возможен так же альтернативный варинат запуска
	// можно сохранить html данные в файл для дальнейшего разбора, на случай ошибки
	$soundCloudParser->setSave(true)->execute();
```


