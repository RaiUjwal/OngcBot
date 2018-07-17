<?php

include("/storage/ssd3/139/6311139/public_html/connection.php");

$botToken = "6068126686:AAG-xQc_nHcEedxI434u2PENNRYf7xI1_FY";//insert bot token here
$url = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents("php://input");
$update = json_decode($update,TRUE);
$chatId=$update["message"]["chat"]["id"];
$message=$update["message"]["text"];
print_r($chatId);
print_r($message);

include("/storage/ssd3/139/6311139/public_html/Authorisation.php");


if($flag)
{
    
	if($message=="/test")  
	{ 
		file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=This Bot is working Fine");
	}
	else if($message == "/hii")
	{
		file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Hello! Please enter Cpf to know details");
	}
	else if(is_numeric($message))
	{
		
		$sql = "SELECT * FROM EmpDetails where CPF_NO = ".$message;
		
		$result = mysqli_query($con, $sql);
		
		if($result -> num_rows > 0)
		{
			
			while($row = mysqli_fetch_array($result))
			{
				$Rep_CPF = "".$row['CPF_NO'];
				$Rep_Name = " ".$row['NAME'];
				$Rep_Designation = " ".$row['DESIGNATION'];
				$Rep_EPA = " ".$row['EPBAX_NO'];
				$Rep_Mobile = " ".(int)$row['MOBILE'];
				$Rep_Direct = " ".(int)$row['DIRECT'];
				$Rep_FaxNo = " ".(int)$row['FAX_NO'];
				$Rep_Residence = " ".(int)$row['RESIDENCE'];
				$Rep_Cabin = " ".$row['CABIN_NO'];
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=CPF Number : ".$Rep_CPF);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Name : ".$Rep_Name);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Designation : ".$Rep_Designation);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=EPA BX Number : ".$Rep_EPA);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Mobile Number = ".$Rep_Mobile);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Direct = ".$Rep_Direct);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Fax Number = ".$Rep_FaxNo);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Residence Number = ".$Rep_Residence);
				file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Cabin Number = ".$Rep_Cabin);
			}
		}
		
		else
		{
			file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=ERROR. RECORD NOT FOUND");
		}
	}
	else
	{
		file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Please enter correct cpf");
	}
}


?>
