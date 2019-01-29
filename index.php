<?php

if($_REQUEST == $_POST){
    if($_POST['firstName']){
        //respond with the name
        echo "firstName received";
        //
    }

    elseif($_POST['lastName']){

    }

    else{
        //HTTP error
       echo http_response_code(400);

    }


}

if($_REQUEST == $_GET){
    if($_GET){
        echo "get Request";
    }

    else{
        //Return 404 error and say why missing, in JSON. 
        echo http_response_code(404);

    }

}