<?php
define ( 'HOSTNAME' , 'localhost' ) ;
define( 'DB_USERNAME' , 'root' ) ;
define( 'DB_PASSWORD' , '' ) ;
define ( 'DB_NAME' , 'noahhms' ) ;
$con = mysqli_connect ( HOSTNAME ,DB_USERNAME , DB_PASSWORD , DB_NAME )or die ( "error" ) ;
if ( mysqli_connect_errno ( $con )) echo "Failed to connect MySQL: " . mysqli_connect_error () ;
?>
<div class= "container-fluid" >
<div class= "row" >
<div class = "col-xs-12 col-md-sm-6 col-md-3" >
<label> Continent : </label>
<select name = "continent" class = "form-control" id ="continent" >
<option value='' > ------- Select -------- </option>
<?php
$sql = "select * from `accounts`";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) > 0) {
while($row = mysqli_fetch_assoc($res)) {
echo"<option value='".$row['id']."'>".$row['front_desk']." </option> ";
}
}
?>
</select>
</div>
<div class = "col-xs-12 col-md-sm-6 col-md-3" >
<label> Country : </label>
<select name = "country" class = "form-control" id ="country" disabled = "disabled" >
	<option> ------- Select -------- </option>
</select>
</div>
<div class = "col-xs-12 col-md-sm-6 col-md-3" >
<label> State / Province / County : </label>
<select name = "state" class = "form-control" id ="state" disabled = "disabled" >
	<option> ------- Select -------- </option>
</select>
</div>
<div class = "col-xs-12 col-md-sm-6 col-md-3" >
<label> City / Popular Place : </label>
<select name = "city" class = "form-control" id ="city" disabled = "disabled" >
	<option> ------- Select -------- </option></select>
</div>
</div>
</div>
<script>
$ ( document ). ready( function () {
$ ( document ). on( 'change' , '#continent' , function() {
var continent_id = $ (this ). val();
if ( continent_id != "" ) {
$ .ajax ({
url : "link.php" ,
type : 'POST' ,
data :{ continent_id : continent_id },
success: function ( response ) {
//var resp = $.trim(response);
if ( response != '' ) {
$( "#country" ). removeAttr( 'disabled' , 'disabled' ). html( response );
$( "#state, #city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
} else {
$( "#country, #state, #city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
}
});
} else {
$( "#country, #state, #city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
});
$ ( document ). on( 'change' , '#country' , function () {
var country_id = $ ( this ). val ();
if ( country_id != "" ) {
$ . ajax ({
url : "link.php" ,
type : 'POST' ,
data :{ country_id : country_id },
success: function ( response ) {
if ( response != '' ) {
$ ( "#state" ). removeAttr( 'disabled' , 'disabled' ). html( response );
$ ( "#city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}else $ ( "#state, #city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
});
} else {
$( "#state, #city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
});

$ ( document ). on ( 'change' ,'#state' ,function () {
var state_id = $ ( this ). val ();
if ( state_id != "" ) {
$ . ajax ({
url : "link.php" ,
type : 'POST' ,
data :{ state_id : state_id },
success: function ( response ) {
if ( response != '' ) $ ( "#city" ). removeAttr( 'disabled' , 'disabled' ). html( response );
 else $ ( "#city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
});
} else {
$ ( "#city" ). attr( 'disabled' , 'disabled' ). html( "<option value=''>------- Select --------</option>" );
}
});
});
</script>
3. <?php
if ( isset( $_POST ['continent_id' ])){
$qry = "select * from countries_new where continent_id=" . mysqli_real_escape_string( $con , $_POST [ 'continent_id' ]) . " order by country" ;
$res = mysqli_query ( $con , $qry );
if ( mysqli_num_rows ( $res ) > 0 ) {
echo '<option value="">------- Select -------</option>' ;
while( $row = mysqli_fetch_object( $res )) {
echo '<option value="' . $row->country_id . '">' . $row->country. '</option>' ;
}
} else {
echo '<option value="">No Record</option>' ;
}
} else if (isset ( $_POST[ 'country_id' ])) {
$qry = "select * from states_new where country_id=" . mysqli_real_escape_string( $con , $_POST [ 'country_id' ]) . " order by state" ;
$res = mysqli_query ( $con , $qry ) ;
if ( mysqli_num_rows ( $res ) > 0 ) {
echo '<option value="">------- Select -------</option>' ;
while( $row = mysqli_fetch_object( $res )) {
echo '<option value="' . $row->state_id . '">' . $row->state. '</option>' ;
}
} else {
echo '<option value="">No Record</option>' ;
}
} else if (isset ( $_POST[ 'state_id' ])) {
$qry = "select * from cities where state_id=" . mysqli_real_escape_string( $con , $_POST [ 'state_id' ]) ." order by city" ;
$res = mysqli_query ( $con , $qry ) ;
if ( mysqli_num_rows ( $res ) > 0 ) {
echo '<option value="">------- Select -------</option>' ;
while( $row = mysqli_fetch_object( $res )) {
echo '<option value="' . $row->city_id .'">' . $row->city . '</option>' ;
}
} else {
echo '<option value="">No Record</option>' ;
}
}
?>