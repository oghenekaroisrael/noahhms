shortcut.add("Alt+F",function() {
var answer = window.confirm("Are you sure you want to find a sales transaction details?");
if(answer){
window.location = "print_it.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+N",function() {
var answer = window.confirm("Are you sure you want to start a new transaction? Please finish any current transaction or place current sales on laywait before you proceed");
if(answer){
window.location = "reset.php";
return true;
}else{
return false;
}
})

shortcut.add("Alt+P",function() {
var answer = window.confirm("Do you want to open the pos mainpage to make sales!");
if(answer){
window.location = "mainpoint.php";
return true;
}else{
return false;
}
})

shortcut.add("Alt+L",function() {
var answer = window.confirm("Are you sure you want to logout?");
if(answer){
window.location = "logout.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+W",function() {
var answer = window.confirm("Are you sure you want to place the current sales on laywait?");
if(answer){
window.location = "laywait.php";
return true;
}else{
return false;
}
})

shortcut.add("Alt+M",function() {
var answer = window.confirm("Are you sure you want to open the laywait manager?");
if(answer){
window.location = "laywait_panel.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+O",function() {
var answer = window.confirm("Are you sure you want to open outward sales return manager?");
if(answer){
window.location = "outward.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+I",function() {
var answer = window.confirm("Are you sure you want to open inward sales return manager?");
if(answer){
window.location = "inward_return.php";
return true;
}else{
return false;
}

})

shortcut.add("Ctrl+1",function() {
var answer = window.confirm("Are you sure you want to go back to the homepage?");
if(answer){
window.location = "/retails";
return true;
}else{
return false;
}

})

shortcut.add("Ctrl+2",function() {
var answer = window.confirm("Are you sure you want to view your profile?");
if(answer){
window.location = "profile.php";
return true;
}else{
return false;
}

})

shortcut.add("Ctrl+3",function() {
var answer = window.confirm("Are you sure you want to make purchases?");
if(answer){
window.location = "purchases_system.php";
return true;
}else{
return false;
}

})

shortcut.add("Ctrl+4",function() {
var answer = window.confirm("Are you sure you want to open stocks photo manager?");
if(answer){
window.location = "picture.php";
return true;
}else{
return false;
}

})
shortcut.add("Ctrl+0",function() {
var answer = window.confirm("Are you sure you want to go to the previous page?");
if(answer){
window.history.back();
return true;
}else{
return false;
}

})


shortcut.add("Alt+S",function() {
var answer = window.confirm("Are you sure you want to open stock count manager?");
if(answer){
window.location = "poscount.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+G",function(){
var answer = window.confirm("Are you sure you want to generate sales report?");
if(answer){
window.location = "gen.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+A",function(){
var answer = window.confirm("Are you sure you want to open asset manager?");
if(answer){
window.location = "asset_management.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+C",function(){
var answer = window.confirm("Are you sure you want to open csv manager?");
if(answer){
window.location = "csv.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+1",function(){
var answer = window.confirm("Are you sure you want to open Dashboard?");
if(answer){
window.location = "/php_stock";
return true;
}else{
return false;
}

})

shortcut.add("Alt+2",function(){
var answer = window.confirm("Are you sure you want to open Employee manager?");
if(answer){
window.location = "emp.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+3",function(){
var answer = window.confirm("Are you sure you want to browse all employee data?");
if(answer){
window.location = "allemp.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+4",function(){
var answer = window.confirm("Are you sure you want to open the calculator?");
if(answer){
window.location = "calculator.php";
return true;
}else{
return false;
}

})



shortcut.add("Alt+H",function() {

$("#helpmee").slideToggle("slow");

});

shortcut.add("Alt+V",function() {

$("#showsale").slideToggle("slow");

});


document.onkeydown = function (e) {
	        if(e.which == "65"){
				
			
					$(":radio.a").attr("checked","checked");
					result("a");
					
	

	        }
	        else if(e.which == "66"){
				
					$(":radio.b").attr("checked","checked");
					result("b");
					
				
				}
				else if(e.which == "67"){
				
					$(":radio.c").attr("checked","checked");
					result("c");
				
					
					}
					
					else if(e.which == "68"){
				
					$(":radio.d").attr("checked","checked");
					
					result("d");
					
		
						
						}
						else{
							return true;
							
							}
	}

function shu(){


var answer = window.confirm("Are you sure you want to logout?");
if(answer){
window.location = "logout.php";
return true;
}else{
return false;
}
}

