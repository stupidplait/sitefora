<?
require('incl/connect.php');
session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <? switch ($uri) {
            case '/news':
                echo 'Новости';
                break;
            case '/webinars':
                echo 'Вебинары';
                break;
            case '/faq':
                echo 'Вопросы и ответы';
                break;
            case '/faq-user':
                echo 'Руководство пользователя';
                break;
            case '/admin':
            case '/admin/tim':
                echo 'Админ-панель';
                break;
            case '/':
                echo 'Центр ЦТСО РТ';
                break;
            default:
                echo 'Страница не найдена';
                break;
        } ?>
    </title>
    <link rel="shortcut icon" href="assets/img/logo-1.svg" type="image/x-icon">
    <? switch ($uri) {
        case '/news':
        case '/webinars':
        case '/faq':
        case '/faq-user':
        case '/admin':
        case '/admin-tim': ?>
            <link rel="stylesheet" href="assets/css/style_for_web.css">
        <? break;
        case '/': ?>
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/css/style.css">
    <? } ?>
</head>

<body>
    <? if (in_array($uri, ['/', '/news', '/webinars', '/faq', '/faq-user', '/admin', '/admin-tim'])) require('incl/header.php');
    switch ($uri) {
        case '/':
            require('incl/pages/home.php');
            break;
        case '/news':
            require('incl/pages/news.php');
            break;
        case '/webinars':
            require('incl/pages/KB_Webinars.php');
            break;
        case '/faq':
            require('incl/pages/KB_Faq.php');
            break;
        case '/faq-user':
            require('incl/pages/KB_UserQ.php');
            break;
        case '/admin':
        case '/admin-tim':
            require('incl/pages/admin.php');
            break;
        default:
            require('incl/pages/404.php');
    } ?>
</body>

</html>