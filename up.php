<?php
set_time_limit(0);

$inputHandler = fopen('php://input', "r");
// create a temp file where to save data from the input stream
$file=($_GET['file'])?$_GET['file']:'test.txt';
$file1=($_GET['file1'])?$_GET['file1']:'test.txt';
$chkEnd=($_GET['end'])?$_GET['end']:'false';
$strFile='folder/'.$file;

$uid=OA_Permission::getUserId(); 
$uid=($uid==148)?148:$uid;
$fileHandler = fopen($strFile1, "aw+");

if($chkEnd==='true'){
	echo $fileHandler;
	
	if($info['http_code']!=200){
		echo('ERROR: upload file images in server');
	}
	else{
		echo('upload file success');
	}
	exit;
}



// save data from the input stream

while(true) {
    $buffer = fgets($inputHandler, 4096);
    if (strlen($buffer) == 0) {
        fclose($inputHandler);
        fclose($fileHandler);
        return true;
    }
    fwrite($fileHandler, $buffer);
}

?>
