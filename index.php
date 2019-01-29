<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //PHP doesn't know how to handle JSON in $_POST, so we have to get the contents from the input 
    //and decode it
    $content = json_decode(file_get_contents("php://input"), true);
    if($content['firstName']){
        //respond with the name
        // echo "firstName received";
        print_r($content);
        //

        $file = fopen("mimic.csv", "a");

        fputcsv($file, $content);
    }

    if($content['lastName']){
        echo "lastName received";

    }

    else{
        //HTTP error
       http_response_code(400);

    }


}

if($_SERVER['REQUEST_METHOD'] === 'GET'){

// echo "GETTT";
$arrayMaker = [];
$file = fopen('mimic.csv', 'r');

fgetcsv($file);
while($line = fgetcsv($file, 1000, ",") !== false){
    $arrayMaker[] = ($line);
}

fclose($file);
print_r($arrayMaker);

    // $content = fgetcsv($file, 1000);
    // print_r($content);
}

else{
        //Return 404 error and say why missing, in JSON. 
    http_response_code(404);

    }

