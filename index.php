<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //gets the entire contents of a file, converts it to JSON, and assigns it to $content
    $content = json_decode(file_get_contents("php://input"), true);
   

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
           

        $namesList= [];
        $megaArray = [];

        fgetcsv($file);
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE) {

              
            
                $namesList['firstName'] = $data[0];
                $namesList['lastName'] = $data[1];
                // print_r($namesList);
                $megaArray[] = $namesList;

        }
      
        echo json_encode($megaArray);

        fclose($file);

    }

    else{
        //return 404 error
        http_response_code(404);

    }
}