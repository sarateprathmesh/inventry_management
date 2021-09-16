<?php

require 'database.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) || !empty($postdata))
{

    $request = json_decode($postdata);
   

    if($request->id < 1 || trim($request->number) == '' || (float)$request->amount < 0)
    {
        
        return http_response_code(200);
    }
  
    $id = mysqli_real_escape_string($con, (int)$request->id);
    $number = mysqli_real_escape_string($con, trim($request->number));
    $amount = mysqli_real_escape_string($con, (float)$request->amount);
    
    $sql = "UPDATE policies SET number = '$number', amount = '$amount' WHERE id = '{$id}' LIMIT 1 ";

    if(mysqli_query($con, $sql))
    {
        http_response_code(200);
    }
    else
    {
        http_response_code(422);
    }
}

?>