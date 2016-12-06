<?php

?>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Upload file Admupload</title>

	<script type="text/javascript">
	var MAX = 1024 *1024; // MB
	
	function upload(fileInputId, fileIndex)
			{
				document.getElementById('upload').style.display='none'
				document.getElementById('load').innerHTML='<img src="loading.gif" />';
				var i = 0;
				var flagEnd = false;
			
				// take the file from the input				
				var file = document.getElementById(fileInputId).files[fileIndex];
				var time=((new Date().getTime()));
				var name=file.name+'';
				var name1=name;
				name1=name.replace(/(\.[a-zA-Z0-9]+$)/,'_'+time+'$1');
				


				//name=time+name.substring(name.length-4,name.length);
				
				var that = this;
				var start=0;
				var stop=0;
				this.success=function(){
					xhr = new XMLHttpRequest();
					var file = document.getElementById(fileInputId).files[fileIndex];
					// send the file through POST
					xhr.open("POST", 'up.php?file1='+name1+'&file='+name+'&end=true&path='+document.getElementById('path').value, true);
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4)
						{
							if(xhr.status == 200)
							{
								var id=document.getElementById('percen');
								id.innerHTML='100%';
								var strfile='http://adi.admicro.vn/adt/banners/nam2015/<?php $uid=OA_Permission::getUserId(); echo $uid==148?148:$uid;?>/'+document.getElementById('path').value+name;
								var html=document.getElementById('myDiv').innerHTML;
								
								document.getElementById('myDiv').innerHTML=html+'file: <a target="_blank" href="'+strfile+'">'+strfile+'</a><br />';
								
								var len = document.getElementById(fileInputId).files.length;
								if((fileIndex+1)<len){
									upload('file',fileIndex+1);
								}else{
									document.getElementById('load').innerHTML='';
								}
							}else{
								// process error
							}
						}
					};
					xhr.send();
				}
				this.sender = function()
				{
					if( flagEnd ){
						document.getElementById('upload').style.display=''
						that.success();
						return;
					}
						
					start = i * MAX;
					stop = start + MAX;
					console.log(file.size);
					if( stop > file.size || file.size< MAX )
					{
						flagEnd = true;
						stop = file.size;
					}
					
					var blob = file.slice(start, stop );
					
					var percentage = Math.floor((start/file.size)*100);
								
					var id=document.getElementById('percen');
					id.innerHTML=percentage+'%';

					i++;
		
					var reader = new FileReader();
					reader.readAsBinaryString(blob);
					
					//reader.readAsBinaryString(file); // alternatively you can use readAsDataURL
					
					//reader.readAsArrayBuffer(0,1024*1024);
					reader.onloadend  = function(evt)
					{
							// create XHR instance
							xhr = new XMLHttpRequest(); 
							// send the file through POST
							xhr.open("POST", 'up.php?file1='+name1+'&file='+name, true);
		 
							// make sure we have the sendAsBinary method on all browsers
							XMLHttpRequest.prototype.mySendAsBinary = function(text){
								var data = new ArrayBuffer(text.length);
								var ui8a = new Uint8Array(data, 0);
								for (var i = 0; i < text.length; i++) ui8a[i] = (text.charCodeAt(i) & 0xff);
					 
								if(typeof window.Blob == "function")
								{
									 var blob = new Blob([data]);
								}else{
									 var bb = new (window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
									 bb.append(data);
									 var blob = bb.getBlob();
								}
		 
								this.send(blob);
							}
							 
							// let's track upload progress
							var eventSource = xhr.upload || xhr;
							eventSource.addEventListener("progress", function(e) {
								// get percentage of how much of the current file has been sent
								var position = e.position || e.loaded;
								var total = e.totalSize || e.total;
								var percentage = Math.round((position/total)*100);
								
								
								
								// here you should write your own code how you wish to proces this
							});
							 
							// state change observer - we need to know when and if the file was successfully uploaded
							xhr.onreadystatechange = function()
							{
								if(xhr.readyState == 4)
								{
									if(xhr.status == 200)
									{
										
										that.sender();
									}else{
										// process error
									}
								}
							};
							// start sending
							xhr.mySendAsBinary(evt.target.result);
					};
				};
				this.sender();
			}
	</script>

	</head>
	<body>

	 <input type="file" multiple="multiple" name="file[]" id="file"/><br />
    Đường dẫn: <input value="" type="text" style="width:300px;" name="path" id="path"/>
    <br />
    <span style="color:#999;">ex:(images/) hoặc (banner2015/images/)</span>
	
    <div id="percen"></div>
	<div id="myDiv"></div>


    <input  type="button" name="upload" id="upload" onClick="upload('file',0);" value="UPload" />
	<div id="load"></div>
	</body>
</html>