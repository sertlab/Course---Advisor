<?php 
   
	session_start();

    require 'vendor/autoload.php';

    use Recombee\RecommApi\Client;
    use Recombee\RecommApi\Requests as Reqs;
    use Recombee\RecommApi\Exceptions as Ex;

    $client = new Client('sertlabgr', '0xEAsWHT33cji2E0A4hOr9vJkc10XwVg96zZHpZ27FAIU681gAbAvfPYEvzbcR8B');


    $grade=$_POST['grade'];

    if ($grade<5) {
    	$grade=0-$grade;
    	# code...
    }

   // else {
   //	$client->send(new Reqs\AddPurchase($_SESSION['lastname'], $_SESSION['item'], [ //optional parameters:
  //
  	//		'cascadeCreate' => true
	//	]));
    //}

    $grade=$grade/10;

	$client->send(new Reqs\AddRating($_SESSION['lastname'], $_SESSION['item'], $grade, [ //optional parameters:
  
  		'cascadeCreate' => true
	]));

	$id=$_SESSION['cur_page'];

	header("Location: course_index.php?id=".$id);

    ?>