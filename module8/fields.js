var a=jQuery .noConflict();
a(document).ready(function() {
var max_fields = 15; //maximum input boxes allowed
var wrapper = a(".input_fields_wrap"); //Fields wrapper
var add_button = a(".add_field_button"); //Add button ID
var x = 1; //initlal text box count
a(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
a(wrapper).append('<tr><td><input type="text" name="drugs[]"></td><td><div class="row"><div class="col-md-12"><div class="form-group"><input type="text" class="form-control" name="tabz[]"placeholder="Enter tabs"/></div></div></div></td><td><div class="row"><div class="col-md-12"><div class="form-group"><select name="frequency[]" onchange="check_value("tabs<?php echo $coun; ?>","frequency<?php echo $coun; ?>","duration<?php echo $coun; ?>","quantity<?php echo $coun; ?>");" id="frequency<?php echo $coun; ?>" class="form-control"><option disabled="disabled">Select Frequency</option><option value="4">Q.D.S</option><option value="2">B.D</option><option value="1">DLY</option><option value="3">T.D.S</option><option value="5">STAT</option><option value="6">NOCT</option></select></div></div></div></td><td><div class="row"><div class="col-md-12"><div class="form-group"><input type="text" name="duration[]" class="form-control" id="duration<?php echo $coun; ?>" placeholder="Times Per Day"></div></div></div></td><td><div class="row"><div class="col-md-12"><div class="form-group"><input type="text" class="form-control" id="quantity<?php echo $coun; ?>" name="quantity[]"  onkeyup="myFunction("tabs<?php echo $coun; ?>","frequency<?php echo $coun; ?>","duration<?php echo $coun; ?>","quantity<?php echo $coun; ?>");"/></div></div></div></td><td><div class="row"><div class="col-md-12"><div class="form-group"><input type="number" class="form-control" id="price1" name="price[]"  /></div></div></div></td><td><a id="sale_delete" class="btn btn-danger btblack" onclick="sure(<?php echo $id; ?>,"<?php echo $dname; ?>")"><i class="fas fa-trash"></i></a></td></tr>'); //add input box
}
});

a(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault(); a(this).parent('div').remove(); x--;
})
a(".toggle").click(function(){
    a(".toggleDrop").fadeToggle("slow");
});
});
function filterFunction() {
                                                        var input, filter, ul, li, a, i;
                                                        input = document.getElementById("myInput");
                                                        filter = input.value.toUpperCase();
                                                        div = document.getElementById("myDropdown");
                                                        a = div.getElementsByTagName("p");
                                                        for (i = 0; i< a.length; i++) {
                                                            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                                a[i].style.display = "";
                                                            } else {
                                                                a[i].style.display = "none";
                                                            }
                                                        }                       
                                                    }