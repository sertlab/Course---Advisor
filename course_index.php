<?php 
    $id=$_GET['id'];


    require 'vendor/autoload.php';

    use Recombee\RecommApi\Client;
    use Recombee\RecommApi\Requests as Reqs;
    use Recombee\RecommApi\Exceptions as Ex;

    $client = new Client('sertlabgr', '0xEAsWHT33cji2E0A4hOr9vJkc10XwVg96zZHpZ27FAIU681gAbAvfPYEvzbcR8B');

    ?>


<!DOCTYPE html>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Course Advisor</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">Course Advisor</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                     <?php
                        session_start();
                        // Load in our navigation links from the MySQL database
                        require("sources/connection.php");
                        $sql = "SELECT name, url, title FROM nav";
                        $result = $conn->query($sql) or die(mysqli_error());
                        if($result){
                            while($row = $result->fetch_object()){
                            echo "<li><a href='{$row->url}' title='{$row->title}'>{$row->name}</a></li>";                   
                            }
                        }
            
                    ?>
                        <?php if(!isset($_SESSION['email'])){
                               echo "<li><a href=../diploma/login>Login/Register</a></li>";

                        }
                            else {
                                echo "<li><a href=../diploma/login/logout.php>Logout</a></li>";  
                            }
                            ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/uthhead.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Course Advisor</h1>
                        <hr class="small">
                        <span class="subheading">A Guide to prove your academic identity</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <!-- main page index -->
                    <?php
                    $sql = "SELECT * FROM courses WHERE id='$id'";
                    $result = $conn->query($sql) or die(mysqli_error());
                    $row= $result->fetch_assoc();
                    ?>

                    <h2>Course Title</h2>
                    <p><?php echo $row['title'];?></p>
                    <h2>Course Category</h2>
                    <p><?php echo $row['category'];?></p>
                    <h2>Course Website</h2>
                    <p><?php  echo '<a href='.$row["website"].' target="_blank"> '.$row['website'].' </a>';?></p>
                    <h2>Description</h2>
                    <p><?php echo $row['content'];?></p>

                    <?php

                    //session_start();
                    
                    
                    $item_id=$row['id'];
                    $_SESSION['item']=$item_id;
                    $category=$row['category'];
                    
                    $member_id= $_SESSION['lastname'];

                    $_SESSION['cur_page']=$id;

                    //$client->send(new Reqs\AddItemProperty('category', 'string'));
                    $client->send(new Reqs\SetItemValues("$item_id", 

                        ['category' =>   $category],  //optional parameters:
                        ['cascadeCreate' => true]
                    ));
                    $client->send(new Reqs\AddDetailView($member_id,$item_id,['cascadeCreate' => true]));
                    $recommended = $client->send(new Reqs\UserBasedRecommendation($member_id, 3));

                    ?>

                    <div class="container">
                        <h3 class="">Enter your grade</h3>
                        <form method="post" action="addgrade.php">
                            <div class="form-group" style="width:200px">
                                <label for="exampleInputEmail1">Grade</label>
                                <input type="double" name="grade"class="form-control" placeholder="">
                            </div>

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>


                    <?php
                    echo '<h1> May also interests you </h1>';
                        echo '<div class="row">';
                        foreach ($recommended as $value ) {
                        $sql = "SELECT id ,title, course_code FROM courses WHERE id='$value'";
                        $result = $conn->query($sql) or die(mysqli_error());

                        while ($row = $result->fetch_assoc()){
                          
                        echo    '<div id="page-wrapper">';
                            
                                echo '<div class="col-lg-4" >';
                                    echo '<div class="panel panel-default">';
                                        echo'<div class="panel-heading">';
                                            echo '<a href=course_index.php?id='.$row["id"].'> '.$row['course_code'].'</a>';
                                            
                                        echo '</div>';
                                            echo '<div class="panel-body">';
                                                echo  $row['title'];
                                            echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                                
                        }
                            
                        echo '</div>';
                    //echo 'Recommended items: ' . implode(',',$recommended) . "\n";
                    
                    ?>


 

                </div>
                <hr>
                <!-- Pager -->

            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <p class="copyright text-muted">Copyright &copy; Course advisor 2017-Developed by Strezos Fanis</p>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
