<?php

namespace src;

use src\Controller\TariffController;

include_once "db_cfg.php";

/**
 * Classes autoupload
 */
spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once __DIR__ . '/' . $className . '.php';
});

/**
 * Get params from URL
 *
 * @return mixed
 */
function getParams()
{
    $request = explode('/', $_SERVER['REQUEST_URI']);
    return [
        'user_id' => $request[count($request) - 4], //4 - param position from array end
        'service_id' => end($request)//service id must be in the array end
    ];
}

/**
 * Get tarifId from php input
 * @return mixed
 */
function getTarifId()
{
    $_PUT = json_decode(file_get_contents("php://input"), true);
    return $_PUT['tarif_id'];
}

if (!$_GET['user_id'] || !$_GET['service_id']) {
    $_GET = getParams();
}

/**
 * GET
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['user_id'] && $_GET['service_id']) {
    $connector = new Controller\TariffController();
    $connector->getTariffByUserId($_GET['user_id'], $_GET['service_id']);
}

/**
 * PUT
 */
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['user_id'] && $_GET['service_id']) {
    $connector = new Controller\TariffController();
    $connector->updateTariffForUser($_GET['user_id'], $_GET['service_id'], getTarifId());
}
