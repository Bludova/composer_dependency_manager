<?php
## Подключение автозагрузчика.
  require_once(__DIR__ . '/vendor/autoload.php');

//   # Теперь можно использовать компонент Monolog
//   $log = new Monolog\Logger('name');
//   $handler = new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING);
//   $log->pushHandler($handler);
//   $log->addWarning('Предупреждение');
// // var_dump($log);

$api = new \Yandex\Geo\Api();

// Можно искать по точке
$api->setPoint(30.5166187, 50.4452705);

// Или можно икать по адресу
// $api->setQuery($adres);

// Настройка фильтров
$api
    ->setLimit(1) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
$collection = $response->getList();
foreach ($collection as $item) {
    $item->getAddress(); // вернет адрес
    $item->getLatitude(); // широта
    $item->getLongitude(); // долгота
    $item->getData(); // необработанные данные
}

if(!empty($_POST)){
$adres = $_POST["description"];
echo 'Наш адрес:'. $response->getQuery().'<br>';
echo 'Широта '.$item->getLatitude().'<br>';
echo 'Долгота '.$item->getLongitude().'<br>';
$latitude = $item->getLatitude();
$longitude = $item->getLongitude();
}

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Менеджер зависимостей Composer</title>
  </head>
  <body>
    <h1>Менеджер зависимостей Composer</h1>
    <form method="POST">
      <input type="text" name="description" placeholder="Введите адрес" value="">
      <input type="submit" name="save" value="Найти">
    </form>

<script type="text/javascript"></script>
<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Задание собственного изображения для метки</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...) -->
   <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<style>
        html, body, #map {
            width: 90%; height: 100%; padding: 10px; margin: 0;
        }
    </style>
    <script type="text/javascript">ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [<?=$latitude;?>, <?=$longitude;?>],
            zoom: 9
        }, {
           searchControlProvider: 'yandex#search'
        }),

        // Создаём макет содержимого.
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),

        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Собственный значок метки',
            balloonContent: 'Это красивая метка'
        }, {
            //Опции.
        //     //Необходимо указать данный тип макета.
        //    iconLayout: 'default#image',
        //     //Своё изображение иконки метки.
        //    iconImageHref: 'images/myIcon.gif',
        //     //Размеры метки.
        //     iconImageSize: [30, 42],
        //     // Смещение левого верхнего угла иконки относительно
        //     // её "ножки" (точки привязки).
        //     iconImageOffset: [-5, -38]
        // }),

        // myPlacemarkWithContent = new ymaps.Placemark([55.661574, 37.573856], {
        //     hintContent: 'Собственный значок метки с контентом',
        //     balloonContent: 'А эта — новогодняя',
        //     iconContent: '12'
         }, 
        {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#imageWithContent',
            // Своё изображение иконки метки.
            iconImageHref: 'images/ball.png',
            // Размеры метки.
            iconImageSize: [48, 48],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-24, -24],
            // Смещение слоя с содержимым относительно слоя с картинкой.
            iconContentOffset: [15, 15],
            // Макет содержимого.
            iconContentLayout: MyIconContentLayout
        });

    myMap.geoObjects
        .add(myPlacemark)
        .add(myPlacemarkWithContent);
});</script>
</head>
<body>
<div id="map"></div>
</body>
</html>

