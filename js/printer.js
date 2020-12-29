function printer()
{ 
  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
      disp_setting+="scrollbars=no,width=0, height=0"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width:auto; font-size: 12pt; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}

function printered()
{ 
  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
      disp_setting+="scrollbars=yes,width=800, height=300, left=100, top=10"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 11pt; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}