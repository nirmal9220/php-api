<?php

$request=$_SERVER['REQUEST_METHOD'];
$data=array();
//print($request);

switch ($request){

         case 'POST':
        response(addData());
            break;
        
    default:
        break;
}


function addData(){
    global $dbcon;
    $id=$_POST["username"]; 
   $pwd=$_POST["password"]; 
    
    //for successfull login
     if($id=="vaibhav" && $pwd=="abcd12")
    {
        $data[]=array("status"=>"200", "msg"=>"Success");
    }
    
    //to check length of password
     if(strlen($pwd)<6)
    {
      $data[]=array("status"=>"201", "msg"=>"Failure: password should be of length 6");   
    }
    
    //to check password with character and number
    if(!preg_match("#[0-9]+#",$pwd))
    {
         $data[]=array("status"=>"202", "msg"=>"Failure: password to have 1 character and 1 number");
    }
    
    // to check that user name only contain characters
    if(preg_match("/^[a-zA-Z\s]+$/", $id)==false)
    {
        $data[]=array("status"=>"203", "msg"=>"Failure: only characters allowed in username");
    }

    // to check that the fields are not empty
    if($id=="" && $pwd=="")
    {
        $data[]=array("status"=>"205", "msg"=>"Please fill Details"); 
    }
   
    
    if(!empty($id)&& empty($pwd))
    {
        $data[]=array("status"=>"206", "msg"=>"Please fill password"); 
    }
    
   
    return $data;
}

function response($data)
{
    echo json_encode($data);
}
    
?>
