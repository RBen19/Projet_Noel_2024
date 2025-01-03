<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
//define('ROOT_DIR', __DIR__ . '/../../');
define('ROOT_DIR', __DIR__ . '/../../'); // On remonte de deux niveaux pour atteindre la racine

require_once "../vendor/autoload.php";
//require_once "../../vendor/autoload.php";
//require_once "./autoload.php";
//require_once "../src/models/Products.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '\..\src\models'],
    isDevMode: true,
);
// or if you prefer XML
// $config = ORMSetup::createXMLMetadataConfiguration(
//    paths: [__DIR__ . '/config/xml'],
//    isDevMode: true,
//);

// configuring the database connection
/*$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
], $config);*/
$conn = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => 'passer',
    'dbname'   => 'v3'
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($conn, $config);
/*$productRepository = $entityManager->getRepository(products::class);
////
$product = new Products();
$product->setName("prodxxxx");

try {
    $entityManager->persist($product);
} catch (\Doctrine\ORM\Exception\ORMException $e) {
    $errorMessage = $e->getMessage();
}

$entityManager->flush();*/
