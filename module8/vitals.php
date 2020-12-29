
<?php 
	ob_start();
	session_start();
	$pageTitle = "Vitals";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
if (!isset($_GET['page'])) {
      $pn = 1;
    }else{
      $pn=$_GET['page'];
    }

    $lock =  database::getInstance()->select_from_where_ord_0_1('patient_appointment','got',0,'date_time_added','ASC','LIMIT 0,1');
                      $last_count = Database::getInstance()->select_last_person2($pn);
                          /*Queue Management Using Name                         foreach ($last_count as $que) {
                            $text = $que['title']." ".$que['surname']." ".$que['middle_name']." ".$que['first_name'];
                          } 
                            or */
                            foreach ($last_count as $que) {
                            $text = "Patient Number ".$lock;
                            }

                          /**/
    if (isset($_POST['search']) AND !empty($_POST['search'])) {
                      $count = 1; 
                      $notarray = database::getInstance()->search_ord_pn($_POST['search'],$pn);

                      //total pages
                      //$totalPages = database::getInstance()->count_from_where3_ord2('patient_appointment','surname','first_name','middle_name',$_POST['search'],'id','DESC');
    }else{           
                      $count = 1; 
                      $notarray = database::getInstance()->select_from_ord_2('patient_appointment','got','ASC','date_time_added','ASC',$pn);

                      //total pages
                      $totalPages = database::getInstance()->count_from_ord2('patient_appointment','id','DESC');
    }
	}
	include_once '../inc/header-index.php'; //for addding header
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Vitals </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                              <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-4"> <font class="pull-left">Search: </font>
                                <form action="" method="POST">
                                  <input type="text" name="search" class="form-control pull-right" placeholder="search name only..." id="search" onchange="this.form.submit();">
                                </form>
                                </div>
                                <div class="col-lg-1"></div>
                              </div>
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
										<th>Date</th>
                                        <th>Patient</th>
                                    	<th>Temperature</th>
                                    	<th>Weight</th>
                                    	<th>Pulse Rate</th>
                                    	<th>Blood Pressure Standing</th>
                                    	<th>Blood Pressure Sitting</th>
                                    	<th>History</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									    <?php
											foreach($notarray as $row):
											$id = $row['id'];
											$got= $row['got'];
											$p_id = $row['patient_id'];
											$temp = $row['temperature'];
											$bpst = '('.$row['blood_press_stand_s'].'/Sistolic) ('.$row['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$row['blood_press_sit_s'].'/Sistolic) ('.$row['blood_press_sit_d'].'/Diastolic)';
											if($row['blood_press_sit_s'] == ""){
											$bpst ="";											
											$bpsi ="";											
											}
											$weight = $row['weight'];
											$pulse = $row['pulse_rate'];
											$history = $row['history'];
											$surname = "";
										?>
                                        <tr style="<?php if ($got ==1) {echo 'border-left:solid green 5px';}else{echo 'border-left:solid orange 5px;';}?>">
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $row['date_added']; ?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
														$surname = $qw['surname'];
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	
                                        	<td><?php echo $temp; ?></td>
											<td><?php echo $weight; ?></td>
											<td><?php echo $pulse; ?></td>
                                        	<td><?php echo $bpst;?></td>
											<td><?php echo $bpsi;?></td>
											<td><?php echo $history;?></td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" <?php if ($id == $lock OR $got == 1){echo "";}else{echo "disabled";}?> class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a <?php if ($got == 1) {
                            echo "href='edit_vitals?id=".$id."'";
                          }else{
                            ?>
                              onclick="seen(<?php echo $id; ?>,`<?php echo $name; ?>`)"
                          <?php
                          } ?>><?php if ($got == 1) {
                            echo "Update Vitals";
                          }else{
                            echo "Add Vitals";
                          } ?></a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $surname; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                  </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Patient</th>
                                    	<th>Temperature</th>
                                    	<th>Weight</th>
                                    	<th>Pulse Rate</th>
                                    	<th>Blood Pressure Standing</th>
                                    	<th>Blood Pressure Sitting</th>
                                    	<th>History</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="vitals.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="vitals.php?page=1">1</a>
											</li>
											<li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}

										for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
										    if ($i < 1)
										        continue;
										    if ($i > $totalPages)
										        break;
										    if ($i == $pn) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										<li class="page-item">
											<a href="vitals.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
										</li>
										    <?php
										}
										if (($totalPages - ($pn + 1)) >= 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}
										if (($totalPages - ($pn + 1)) > 0) {
										    if ($pn == $totalPages) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										    <li class="page-item">
											<a href="vitals.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="vitals.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
										        <?php
										    }
										    ?>
																			</ul>
																		</nav>
								<!--Pagination End-->
                            </div>
                        </div>
                    </div>
                 </div>



            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> Vitals ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delPatientVital',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'vitals';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function seen(ID,name){ 

          s.notify({
              icon: 'pe-7s-info',
              message: "Are you sure you want to Process Vitals For <b>"+name+"</b>? </br><button type='button' class='btn pop-btn' onclick='end("+ID+")'>Process</button>"

            },{
                type: 'info',
                timer: 100000
            });

      }

      function end(ID){ 
    var val = ID;
     document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=endVitals',
             success: function(data)
            {
        document.getElementById("load").style.display = "block";
        if (data == 'Done') {
          console.log(data);
            window.location = 'new_vitals?add='+val;
          }
          else {
             
            jQuery('#get_det'+ID).html(data).show();
          }
            }
          });
    }
    function rem(name){ 

          s.notify({
              icon: 'pe-7s-check',
              message: "Vitals Was Processed Successfully"

            },{
                type: 'success',
                timer: 300000
            });

      }

    </script>
      <script>
      speaks = [
  {
    "name": "Alex",
    "lang": "en-US"
  },
  {
    "name": "Alice",
    "lang": "it-IT"
  },
  {
    "name": "Alva",
    "lang": "sv-SE"
  },
  {
    "name": "Amelie",
    "lang": "fr-CA"
  },
  {
    "name": "Anna",
    "lang": "de-DE"
  },
  {
    "name": "Carmit",
    "lang": "he-IL"
  },
  {
    "name": "Damayanti",
    "lang": "id-ID"
  },
  {
    "name": "Daniel",
    "lang": "en-GB"
  },
  {
    "name": "Diego",
    "lang": "es-AR"
  },
  {
    "name": "Ellen",
    "lang": "nl-BE"
  },
  {
    "name": "Fiona",
    "lang": "en"
  },
  {
    "name": "Fred",
    "lang": "en-US"
  },
  {
    "name": "Ioana",
    "lang": "ro-RO"
  },
  {
    "name": "Joana",
    "lang": "pt-PT"
  },
  {
    "name": "Jorge",
    "lang": "es-ES"
  },
  {
    "name": "Juan",
    "lang": "es-MX"
  },
  {
    "name": "Kanya",
    "lang": "th-TH"
  },
  {
    "name": "Karen",
    "lang": "en-AU"
  },
  {
    "name": "Kyoko",
    "lang": "ja-JP"
  },
  {
    "name": "Laura",
    "lang": "sk-SK"
  },
  {
    "name": "Lekha",
    "lang": "hi-IN"
  },
  {
    "name": "Luca",
    "lang": "it-IT"
  },
  {
    "name": "Luciana",
    "lang": "pt-BR"
  },
  {
    "name": "Maged",
    "lang": "ar-SA"
  },
  {
    "name": "Mariska",
    "lang": "hu-HU"
  },
  {
    "name": "Mei-Jia",
    "lang": "zh-TW"
  },
  {
    "name": "Melina",
    "lang": "el-GR"
  },
  {
    "name": "Milena",
    "lang": "ru-RU"
  },
  {
    "name": "Moira",
    "lang": "en-IE"
  },
  {
    "name": "Monica",
    "lang": "es-ES"
  },
  {
    "name": "Nora",
    "lang": "nb-NO"
  },
  {
    "name": "Paulina",
    "lang": "es-MX"
  },
  {
    "name": "Samantha",
    "lang": "en-US"
  },
  {
    "name": "Sara",
    "lang": "da-DK"
  },
  {
    "name": "Satu",
    "lang": "fi-FI"
  },
  {
    "name": "Sin-ji",
    "lang": "zh-HK"
  },
  {
    "name": "Tessa",
    "lang": "en-ZA"
  },
  {
    "name": "Thomas",
    "lang": "fr-FR"
  },
  {
    "name": "Ting-Ting",
    "lang": "zh-CN"
  },
  {
    "name": "Veena",
    "lang": "en-IN"
  },
  {
    "name": "Victoria",
    "lang": "en-US"
  },
  {
    "name": "Xander",
    "lang": "nl-NL"
  },
  {
    "name": "Yelda",
    "lang": "tr-TR"
  },
  {
    "name": "Yuna",
    "lang": "ko-KR"
  },
  {
    "name": "Yuri",
    "lang": "ru-RU"
  },
  {
    "name": "Zosia",
    "lang": "pl-PL"
  },
  {
    "name": "Zuzana",
    "lang": "cs-CZ"
  }
];
    </script>
    <?php if (!empty($text)) {
     ?>
<script type="text/javascript">
const msg = new SpeechSynthesisUtterance();
msg.volume = 1; // 0 to 1
msg.rate = 0.8; // 0.1 to 10
msg.pitch = 0.2; // 0 to 2
msg.text  = "<?php echo $text.', Please Proceed To The Nurses Station For Your Vitals.'; ?>";
speechSynthesis.speak(msg);

const voice = speaks[0]; //47
console.log(`Voice: ${voice.name} and Lang: ${voice.lang}`);
msg.voiceURI = voice.name;
msg.lang = voice.lang;
</script>
<?php  
    }?>