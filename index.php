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

        
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                //trying to encode to JSON


                // print_r($data);

                $namesList[$data[0]] = $data[1];
                //set up assoc array with first and last
                //append it to the reg array


                // $array = array_map("str_getcsv", $data);
                //does it have something to do with not being an object?

                // $nowJSON = json_encode($array);
                // print_r($array);
                // echo $nowJSON;



                // echo json_encode($array) . "\n";
                // echo "The array is: \n";
                // print_r($array);
                //perhaps use array map?
                // echo json_encode($array) . "\n";
          
            // print_r($data);
        }
        // print_r($namesList);
        echo json_encode($namesList);

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