<?php

// echo "hello";

//handle whether or not its a get or post 
// $name = "land";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo "its a post";

    //what does this line do?
    //My guess is that 

    //gets the entire contents of a file, converts it to JSON, and assigns it to $content
    $content = json_decode(file_get_contents("php://input"), true);
    // echo 'The $content is:  ';
    // print_r($content);

    if($content["firstName"]){

        //open the file and make it writeable
        $file = fopen("apiExample.csv","a");

        fputcsv($file, $content);

        //close the file
        fclose($file);

    
    }
    
    else{
        //respond with 400 error
        http_response_code(400);
        //explain why

    }
}



if($_SERVER['REQUEST_METHOD'] === 'GET'){

    if(file_exists("apiExample.csv")){
        //return the names in the csv file
        $file = fopen("apiExample.csv","r");
        $returnedArray = fgetcsv($file);

        //respond with the entries under name
        print_r($returnedArray);
        fclose($file);

    }

    else{
        //return 404 error
        http_response_code(404);

    }
}