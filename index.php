<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //PHP doesn't know how to handle JSON in $_POST, so we have to get the contents from the input 
    //and decode it
    $content = json_decode(file_get_contents("php://input"), true);

    if($content['firstName']){
        //respond with the name
        // echo "firstName received";
        // print_r($content);
        //

        $file = fopen("mimic.csv", "a");

        fputcsv($file, $content);
        fclose($file);
    }

    else{
        //HTTP error
       http_response_code(400);
       echo "Input is not correct";

    }


}

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    if(file_exists("mimic.csv")){
        
        // echo "GETTT";
        $file = fopen('mimic.csv', 'r');

        $arrayMaker = [];
        
        fgetcsv($file);

        while(($line = fgetcsv($file, 1000, ",")) !== false){
            $arrayMaker[] = $line;
        }
        
        fclose($file);
        print_r($arrayMaker);
        
}

else{
        //Return 404 error and say why missing, in JSON. 
    http_response_code(404);
    echo "The file is missing";

    }

}