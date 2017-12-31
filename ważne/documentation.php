<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 29.08.2017
 * Time: 09:55
 */

class documentation
{

    php bin/console config:dump-reference [service_name] // wszystko na temat komend konfigurujacych daną usługę w config.yml
    php bin/console doctrin:database:create // tworzy bazę danych na podstawie ORM oraz parametrów konfiguracyjnych
    php bin/console doctrine:schema:update --dump-sql // wyświetla zapytanie które zostało przygotowane przez doctrine
    php bin/console doctrine:schema:update --force // wykonuje przygotowane zapytanie
    php bin/console doctrine:migrations:diff // generowanie klasy niezbędnej do migracji bazy

    // wyrzucanie wyjątku, jeśli nie znaleziono wartości w bazie
    if (!$value){
        throw $this->createNotFoundException('nie znaleziono :'.$value);
    }
}