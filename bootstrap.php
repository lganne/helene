<?php

// constante utiliser dans les templates URL du site
define('URL_SITE', 'http://localhost:82/helene/public/');

define('URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// l'utilisation de la constante __DIR__ rend les inclusions plus portable.

spl_autoload_register('_autoloadServices');
spl_autoload_register('_autoloadModels');

function _autoloadServices($className)
{

    $fileName = __DIR__ . "/src/service/" . $className . ".php";

    if (!file_exists($fileName)) {
        return false;
    }

    require $fileName;
}

function _autoloadModels($className)
{

    $fileName = __DIR__ . "/src/modele/" . $className . ".php";

    if (!file_exists($fileName)) {
        return false;
    }

    require $fileName;
}

// base de données
$database = [
    'host' => 'localhost',
    'username' => 'lganne',
    'password' => 'Helene2015*',
    'dbname' => 'heko'
];

$conn = new Connect($database);
$pdo = $conn->getDB();

if (is_null($pdo)) {
    die("pdo null, la connexion n'est pas disponible dans le script");
}

