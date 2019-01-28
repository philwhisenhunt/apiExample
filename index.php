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
           

        // $returnedArray = fgetcsv($file);

        // foreach ($returnedArray as $piece){
        //     echo $piece;
        // }

        $namesList= [];
        $megaArray = [];

        fgetcsv($file);
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE) {

                // if($row === 1){
                //     $row++;
                //     continue; //skip the first line and move along
                // }
                // $namesList[$data[0]] = $data[1];
                // $namesList[] = $data[1];
                //or, perhaps encode the data, then assign it to an array?
                // $namesList[] = json_encode($data[1]);

                // $namesList[$data[0]] = json_encode($data[1]);

                // print_r($data);
                // $namesList[] = json_encode($data);
            
                $namesList['firstName'] = $data[0];
                $namesList['lastName'] = $data[1];
                // print_r($namesList);
                $megaArray[] = $namesList;

                //create megaArray?


               
        }
        // print_r($namesList);
        // print_r($megaArray);
        echo json_encode($megaArray);

        // foreach($namesList as $item){
        //    echo json_encode($namesList);

        // }

        // print_r($namesList);

        // echo json_encode($namesList);
        

        //do the json encode on the entire array, send it back as one whole thing. 

        //respond with the entries under name
        // print_r($returnedArray);
        fclose($file);

    }

    else{
        //return 404 error
        http_response_code(404);

    }
}