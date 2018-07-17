<?php

if($message == "/logout")
    {
        mysqli_query($con, "DELETE FROM Authorisation WHERE CHAT_ID = $chatId");
        file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=You have been successfully logged out. Please login to use the bot.");
    }
    
else
{
    $sql1 = "SELECT * FROM Authorisation where CHAT_ID = ".$chatId;
    $result = mysqli_query($con, $sql1);
    $flag = 0;
    
    if($result -> num_rows > 0)
    {
    	while($row = mysqli_fetch_array($result))
    	{
    		$Auth_CPF_NO = "".$row['CPF_NO'];
    		$Auth_AUTH = "".$row['AUTH'];
    		if($Auth_CPF_NO == NULL)
    		{
    			if(is_numeric($message))
    			{
    			
    				$sql1 = "SELECT * FROM EmpDetails where CPF_NO = ".$message;
    				$result1  = mysqli_query($con, $sql1);
    				
    				$sql1 = "SELECT * FROM Authorisation where CPF_NO = ".$message;
    				$result2  = mysqli_query($con, $sql1);
    			    
    			    if($result2 -> num_rows == 0)
    			    {
        				if($result1 -> num_rows != 0)
        				{
        					mysqli_query($con,"UPDATE Authorisation SET CPF_NO = $message WHERE CHAT_ID = $chatId");
        					file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Now please get your account authorised from Tech Department");
        					exit();
        				}
        			
        				else
        				{
        					file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=CPF Number does not exist. Enter a valid CPF Number");
        					exit();
        				}
    			    }
    			    
    			    else
    			    {
    			        	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Another account is already linked with this CPF");
    			        	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Please enter your correct CPF. If problem persists, please contact Tech Department");
    			        	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=ChatID = $chatId");
    			        	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=CPF Entered by you = $message");
    			        	exit();
    			    }
    			}
    			
    			else
    			{
    				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Please enter valid CPF Number to login");
    				exit();
    			}
    		}
    		
    		else
    		{
    			
    			if($Auth_AUTH != 1)
    			{
    			file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Your CPF Number is yet to be authorised.");
    			exit();
    			}
    			
    			else
    			{
    				$flag = 1;
    			}
    		}
    	}
    }
    
    else
    {
    	mysqli_query($con,"INSERT INTO Authorisation(CHAT_ID) VALUES($chatId)");
    	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Please Login to continue");
    	file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Enter your CPF Number to Login: ");
    	exit();
    }
}

?>
