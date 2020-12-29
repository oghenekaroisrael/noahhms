var a=jQuery .noConflict();
a(document).ready(function(){
  a(".toggle").click(function(){
    a(".toggleDrop").fadeToggle("slow");
  });
});