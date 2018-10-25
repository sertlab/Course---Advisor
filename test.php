<?php 

require 'vendor/autoload.php';

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

const NUM = 100;
const PROBABILITY_PURCHASED = 0.1;

$client = new Client('sertlabgr', '0xEAsWHT33cji2E0A4hOr9vJkc10XwVg96zZHpZ27FAIU681gAbAvfPYEvzbcR8B');
$client->send(new Reqs\ResetDatabase()); //Clear everything from the database

try
{
    // Generate some random purchases of items by users
    $purchase_requests = array();
    for($i=0; $i < NUM; $i++) {
        for($j=0; $j < NUM; $j++) {
            if(mt_rand() / mt_getrandmax() < PROBABILITY_PURCHASED) {

                $request = new Reqs\AddPurchase("user-{$i}", "item-{$j}",
                    ['cascadeCreate' => true] // Use cascadeCreate to create the
                                              // yet non-existing users and items
                );
                array_push($purchase_requests, $request);
            }
        }
    }
    echo "Send purchases\n";
    $res = $client->send(new Reqs\Batch($purchase_requests)); //Use Batch for faster processing of larger data

    
    // Get 5 recommendations for user 'user-25'
    $recommended = $client->send(new Reqs\UserBasedRecommendation('user-25', 5));
    //$recommended1 = $client->send(new Reqs\ItemBasedRecommendation('user-25', 5));

    echo 'Recommended items: ' . implode(',',$recommended) . "\n";
    //echo 'Recommended items: ' . implode(',',$recommended1) . "\n";
}
catch(Ex\ApiException $e)
{
    //use fallback
} 

?>