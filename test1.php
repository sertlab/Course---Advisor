<?php 

require 'vendor/autoload.php';

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

const NUM = 100;
const PROBABILITY_PURCHASED = 0.1;

$client = new Client('sertlabgr', '0xEAsWHT33cji2E0A4hOr9vJkc10XwVg96zZHpZ27FAIU681gAbAvfPYEvzbcR8B');
$client->send(new Reqs\ResetDatabase()); //Clear everything from the database

?>