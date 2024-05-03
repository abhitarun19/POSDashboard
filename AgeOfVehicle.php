<?php
session_start();
if($_SESSION['user']==""){
	header("Location: ./index.php");
}
?>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "300";
?>
<?php
require 'dbconfig.php';


function numberToCurrency($num)
{

      $explrestunits = "" ;
      if(strlen($num)>3){
          $lastthree = substr($num, strlen($num)-3, strlen($num));
          $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
          $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
          $expunit = str_split($restunits, 2);
          for($i=0; $i<sizeof($expunit); $i++){
              // creates each of the 2's group and adds a comma to the end
              if($i==0)
              {
                  $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              }else{
                  $explrestunits .= $expunit[$i].",";
              }
          }
          $thecash = $explrestunits.$lastthree;
      } else {
          $thecash = $num;
      }
      return $thecash;

}

?>
<?php
@$cat=$_POST['categories'];

?>
<?php
@$cat1=$_POST['divisions'];

?>
<?php
@$cat2=$_POST['class'];

?>
<?php
@$cat3=$_POST['divisions'];

?><?php
@$cat4=$_POST['year'];

?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TNSTC Dashboard</title>
    <meta name="description" content="TNSTC Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
	<link rel="stylesheet" href="assets/css/posChanges.css">
	<link rel="stylesheet" href="assets/css/scrollBarPos.css">

    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	<!-- Date Picker -->
	<link rel="stylesheet" href="assets/css/posChanges.css">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.jqueryscript.net/table/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel.html"></script>
<style>
 td
 {
    padding: 19px;
}
</style>
  <script>
  $( function() {
    $( "#fdate" ).datepicker({
		dateFormat: 'dd-mm-yy'
		//maxDate: "+12m"

	});
  } );
  $( function() {
    $( "#tdate" ).datepicker({
		dateFormat: 'dd-mm-yy'
		//maxDate: "+12m"
	});
  } );
  </script>
  <script type="text/javascript">
  	function myfunc(){
    var start= $("#fdate").datepicker("getDate");
    var end= $("#tdate").datepicker("getDate");
    days = (end- start) / (1000 * 60 * 60 * 24);
    return Math.round(days);
}
  	function validate(){
	//alert(myfunc());
		if(document.forms[0].fdate.value==""){
			alert("Please Enter From Date.");
			document.forms[0].fdate.focus();
			$('#myform').attr('onSubmit','return false');
		}else if(document.forms[0].tdate.value==""){
			alert("Please Enter To Date.");
			document.forms[0].tdate.focus();
			$('#myform').attr('onSubmit','return false');
		}else if(myfunc() > 30){
			alert("Selected Dates are more than one month, Please select one month.");
			document.forms[0].fdate.focus();
			$('#myform').attr('onSubmit','return false');
		}else{
			document.forms[0].submit();
		}
	}


  </script>
 <script>  
 $(document).ready(function(){  
 //alert("hello");
      $('#create_excel').click(function(){  
	   //alert("hello");
           var excel_data = $('#employee_table').html();  
		   // alert("hello");
           var page = "excel.php?data=" + excel_data;  
		   // alert("hello");
           window.location = page;  
	
      });  
 });  
 </script> 
 
  <script>
    function loadDivisions() {
        var selectedCorporation = document.getElementById("mode").value;

        // Make an AJAX request to fetch divisions based on the selected corporation
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the divisions dropdown with the fetched data
                document.getElementById("division").innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", "getDivisions.php?corporation=" + selectedCorporation, true);
        xhr.send();
    }
</script>

<script>
function getDepots() {
    var divisionFetch = document.getElementById("division").value;

    // Similar to getDivisions, use AJAX to fetch depots based on the selected division
    var url = 'getDepots.php?divisionId=' + divisionFetch;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("depot").innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', url, true);
    xhr.send();
}
</script>
<style>
#employee_table {
    margin-left: 63px; 
  }
   #loginuser {
	  margin-right: -101px;
  }
</style>


</head>
<body style="background-color:#FFFFFF;">
<form name="myform" method="post" action="AgeOfvehicle.php" id="myform">

     <?php
            require_once("leftPane.php");
        ?>

    <!-- Right Panel -->

    <!-- <div id="right-panel"> -->
    <div id="right-panel" class="right-panel">
      <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>

                </div>

		<div id="loginuser" class="user-area dropdown float-right">
                        <a style="color:black">
                            <font size="3">Welcome <b><?php echo $_SESSION['user'];?></b></font></a><font size="3"><a href="./logout.php" style="color:red"> (<i>Logout</i>)</a></font>

        </div>



        <div class="breadcrumbs" style="background-color:#FFFFFF;">
    <div class="col-sm-9" >
      <div class="page-header float-center" style="background-color:#FFFFFF;">
        <div class="page-title">
          <h3 align="center" style="margin-left:280px">AGE OF VEHICLE</h3>
        </div>
      </div>
    </div>
        </div>
		
<div class="container-fluid">  
<div class="row">
<div class="col-sm-9" >
						<div >
							<table border="0px" align="center" width="80%">
								<tr>
														
									<td align="right">Corporation:</td>
									<td align="left">
										<?php if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "0"){ ?>
								<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
								        <option value="0" selected >All</option>
                                        <option value="1">SETC</option>
                                        <option value="40" >VILLUPURAM  </option>
                                        <option value="41">KUMBAKONAM  </option>
										<option value="42" >SALEM </option>
                                        <option value="43" >COIMBATORE  </option>
										<option value="44" >MADURAI     </option>
                                        <option value="80">TIRUNELVELI </option>
                                  </select>
									 <?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "1"){ ?>
									<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value= "0">All</option>
										<option value="1" selected>SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										<option value="80">TIRUNELVELI</option>
									</select>
								<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "40"){ ?>
										<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40" selected>VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
								<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "41"){ ?>
										<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41" selected>KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
								<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "42"){ ?>
										<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42" selected>SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
								<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "43"){ ?>
							 			<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43" selected>COIMBATORE</option>
										<option value="44">MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
								<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "44"){ ?>
										<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44" selected>MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
								
									<?php }else if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "80"){ ?>
										<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										<option value="80" selected>TIRUNELVELI</option>
									</select>
							<?php }else{ ?>
								<select id="mode" name="mode" onchange="loadDivisions()" style="border-radius:8px">
										<option value="0">All</option>
										<option value="1" >SETC</option>
										<option value="40">VILLUPURAM</option>
										<option value="41">KUMBAKONAM</option>
										<option value="42">SALEM</option>
										<option value="43">COIMBATORE</option>
										<option value="44">MADURAI</option>
										
										<option value="80">TIRUNELVELI</option>
									</select>
							<?php } ?>
									</td>
									
									
									 <td class="col-md-4">Region:
    <td align="left">
        <select id="division" name="divisions" onClick ="getDepots()" style="border-radius:8px">
            <?php
            $modeSelected = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : "40";
            $sql = "SELECT RM_ID AS Id, RM_NAME AS RegionName FROM REGIONMASTER WHERE RM_CORP_ID = $modeSelected";
            $result1 = $conn->query($sql);

            while ($divisions = $result1->fetch_assoc()) {
                $selected = ($divisions['Id'] == @$cat1) ? "selected" : "";
                echo "<option value='{$divisions['Id']}' $selected>{$divisions['RegionName']}</option>";
            }
            ?>
        </select>
    </td>
</td>


<td class="col-md-4">Depot:
   <td align="left">
<select id="depot" name="categories" style="border-radius:8px">
<option value="189">ANTHIYUR</option>
<option value="238">ARANTHANGI</option>
<option value="485">ARIYALUR DEPOT</option>
<option value="267">ARUPPUKOTTAI</option>
<option value="262">ARUPPUKOTTAI</option>
<option value="340">ATHIPALLE</option>
<option value="380">ATTUR</option>
<option value="193">BHAVANI</option>
<option value="256">BODI</option>
<option value="24">CHENNAI DEPOT-B</option>
<option value="25">CHENNAI DEPOT4</option>
<option value="9">CHENNAI-A</option>
<option value="23">CHENNAI-C</option>
<option value="169">CHIDAMBARAM</option>
<option value="215">CHIDAMBARAM</option>
<option value="259">CHINNAMANUR</option>
<option value="124">COIMBATORE</option>
<option value="247">COLACHEL</option>
<option value="168">CUDDALORE</option>
<option value="480">CUDDALORE</option>
<option value="257">CUMBUM</option>
<option value="176">DHARMAPURI</option>
<option value="253">DINDIGUL</option>
<option value="481">DINDIGUL DEPOT</option>
<option value="441">EDAPADI</option>
<option value="188">ERODE</option>
<option value="381">ERUMAIPALAYAM</option>
<option value="163">GINGEE</option>
<option value="190">GOBI</option>
<option value="202">GUDALUR</option>
<option value="162">GUDIYATHAM</option>
<option value="178">HARUR</option>
<option value="174">HOSUR</option>
<option value="482">HOSUR DEPOT</option>
<option value="341">HUNSUR</option>
<option value="181">JOHNSONPET</option>
<option value="164">KALLAKURICHI</option>
<option value="269">KALPAKKAM</option>
<option value="229">KAMUDHI</option>
<option value="268">KANCHEEPURAM</option>
<option value="191">KANGAYAM</option>
<option value="104">KANYAKUMARI</option>
<option value="248">KANYAKUMARI</option>
<option value="211">KARAIKKAL</option>
<option value="226">KARAIKUDI</option>
<option value="142">KARAIKUDI</option>
<option value="219">KARUR</option>
<option value="231">KELLAKARAI</option>
<option value="260">KODAIKANAL</option>
<option value="251">KOLLENCODE</option>
<option value="446">KONAVATTAM</option>
<option value="401">KOYAMBEDU</option>
<option value="420">KOYAMBEDU</option>
<option value="160">KOYAMBEDU CHENNAI</option>
<option value="161">KRISHNA NAGAR</option>
<option value="175">KRISHNAGIRI</option>
<option value="252">KULASEKHARAM</option>
<option value="225">KULITHALAI</option>
<option value="203">KUMBAKONAM</option>
<option value="101">KUMBAKONAM</option>
<option value="223">LALGUDI</option>
<option value="121">MADURAI</option>
<option value="22">MADURAI-2</option>
<option value="208">MANNARKUDI</option>
<option value="246">MARTHANDAM</option>
<option value="103">MARTHANDAM</option>
<option value="165">MELMARUVATHUR</option>
<option value="197">METTUPALYAM</option>
<option value="183">METTUR</option>
<option value="184">MEYYANUR</option>
<option value="241">MOF NORTH</option>
<option value="224">MUSIRI</option>
<option value="213">MYLADUTHURAI</option>
<option value="141">NAGAPATTINAM</option>
<option value="210">NAGAPATTINAM</option>
<option value="102">NAGERCOIL</option>
<option value="187">NAMAKKAL</option>
<option value="258">ODDANCHATRAM</option>
<option value="180">OMALUR</option>
<option value="200">OOTY</option>
<option value="234">OPPILAN</option>
<option value="312">OTHERS</option>
<option value="310">OTHERS</option>
<option value="315">OTHERS</option>
<option value="311">OTHERS</option>
<option value="313">OTHERS</option>
<option value="306">OTHERS</option>
<option value="307">OTHERS</option>
<option value="308">OTHERS</option>
<option value="309">OTHERS</option>
<option value="305">OTHERS</option>
<option value="304">OTHERS</option>
<option value="140">OTHERS</option>
<option value="314">OTHERS</option>
<option value="303">OTHERS</option>
<option value="316">OTHERS</option>
<option value="301">OTHERS</option>
<option value="302">OTHERS</option>
<option value="177">PALACODE</option>
<option value="195">PALANI</option>
<option value="255">PALANI</option>
<option value="484">PALLAPATTI</option>
<option value="218">PALLAPATTI</option>
<option value="171">PANRUTTY</option>
<option value="244">PAPANASAM</option>
<option value="232">PARAMKUDI</option>
<option value="205">PATTUKOTTAI</option>
<option value="382">PENNAGARAM</option>
<option value="220">PERAMBALUR</option>
<option value="206">PERAVURANI</option>
<option value="400">PERIYAKULAM</option>
<option value="233">PERIYAPATTINAM</option>
<option value="261">PERUMALMALAI</option>
<option value="201">POLLACHI</option>
<option value="123">PONDICHERRY</option>
<option value="322">PONNAMARAVATHY</option>
<option value="444">PONNERI</option>
<option value="212">PORAIYAR</option>
<option value="170">PUDUCHERRY</option>
<option value="237">PUDUKKOTAI</option>
<option value="266">RAJAPALAYAM</option>
<option value="235">RAMESWARAM</option>
<option value="230">RAMNAD</option>
<option value="300">RANITHOTTAM</option>
<option value="186">RASIPURAM</option>
<option value="126">SALEM</option>
<option value="173">SALEM</option>
<option value="185">SANKARI</option>
<option value="265">SATHUR</option>
<option value="192">SATHY</option>
<option value="125">SHENCOTTAH</option>
<option value="447">SHENCOTTAH</option>
<option value="214">SIRKAZHI</option>
<option value="228">SIVAGANGAI</option>
<option value="263">SIVAKASI</option>
<option value="122">SPL-VELANKANNI</option>
<option value="198">SUNGAM</option>
<option value="270">TAMBARAM</option>
<option value="100">THANJAVUR</option>
<option value="204">THANJAVUR</option>
<option value="460">THARAMANAGALAM</option>
<option value="221">THATHAIYANGARPET</option>
<option value="254">THENI</option>
<option value="280">THENKASI</option>
<option value="166">THIRUKOILUR</option>
<option value="236">THIRUPPATHUR</option>
<option value="194">THIRUPPUR</option>
<option value="271">THIRUTHANI</option>
<option value="443">THIRUVALLORE</option>
<option value="272">THIRUVALLORE</option>
<option value="486">THIRUVANANTHAPURAM</option>
<option value="442">THIRUVANNAMALAI</option>
<option value="207">THIRUVARUR</option>
<option value="222">THIRUVARUR</option>
<option value="249">THISAYANVILAI</option>
<option value="243">THOOTHUKUDI</option>
<option value="250">THUCKALAY</option>
<option value="321">THURAIYUR</option>
<option value="245">TIRUCHENDUR</option>
<option value="440">TIRUCHENGODE</option>
<option value="240">TIRUMANGALAM</option>
<option value="242">TIRUNELVELI</option>
<option value="80">TIRUNELVELI-1</option>
<option value="483">TIRUNELVELI-2</option>
<option value="360">TIRUPPUR</option>
<option value="209">TIRUTHURAIPOONDI</option>
<option value="227">TIRUVADANAI</option>
<option value="217">TRICHY</option>
<option value="21">TRICHY-1</option>
<option value="26">TRICHY-2</option>
<option value="60">TRIVANDRUM</option>
<option value="120">TUTICORIN</option>
<option value="199">UKKADAM</option>
<option value="196">UPPILIPALAYAM</option>
<option value="239">USILAMPATTI</option>
<option value="179">UTHANGARI</option>
<option value="445">UTHUKOTTAI</option>
<option value="182">VALAIYAPATTI</option>
<option value="320">VALLAPADI</option>
<option value="216">VEDARANYAM</option>
<option value="167">VILLUPURAM</option>
<option value="264">VIRUDHUNAGAR</option>
<option value="172">VRIDHACHALAM</option>
									</select></td>
</td>

						</tr>
							</table>
						</div>
					</div>
  </div>
</div>	
<div class="container-fluid">  
<div class="row">
<div class="col-sm-12"  >
						<div >
							<table border="0px" align="center" width="80%">
								<tr>

				<td class="col-md-4" align="right" >Class:
										 <td align="center">

										<?php
//$sql = "SELECT 0 AS PLM_PLACEID , 'ALL' AS PLM_PLACENAME FROM DUAL UNION select PLM_PLACEID, PLM_PLACENAME from PLACEMASTER where PLM_STATUS='A'";

$sql = " SELECT CLM_CLASSID,CLM_CLASSDSCPRN  FROM CLASSMASTER where CLM_STATUS='A' order by CLM_CLASSDSCPRN;";
 $result1 = $conn->query($sql);
 ?>
 <select name="class" style="border-radius:8px" >
<?php 
while ($class = $result1->fetch_assoc())
{ 
if($class['CLM_CLASSID']==@$cat2){echo "<option selected value='$class[CLM_CLASSID]'>$class[CLM_CLASSDSCPRN]</option>";}
else{echo  "<option value='$class[CLM_CLASSID]'>$class[CLM_CLASSDSCPRN]</option>";}
   
}
 
?>
</td>        
</select></td>
									<td align="right">AGE:</td>
									<td align="left">
									
                            <?php if(isset($_REQUEST['year']) && $_REQUEST['year'] == "10"){ ?>
                                    <select id="year" name="year" style="border-radius:8px">
                                        <option value="10" selected>BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2">BELOW 2 YEARS</option>
                                        <option value="1">BELOW 1 YEARS</option>
                                </select>
                            <?php }else if(isset($_REQUEST['year']) && $_REQUEST['year'] == "7"){ ?>
                                <select id="year" name="year" style="border-radius:8px">
                                    <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" selected>BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2">BELOW 2 YEARS</option>
                                        <option value="1">BELOW 1 YEARS</option>
                            </select>
							<?php }else if(isset($_REQUEST['year']) && $_REQUEST['year'] == "5"){ ?>
                                <select id="year" name="year" style="border-radius:8px">
                                    <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5" selected>BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2">BELOW 2 YEARS</option>
                                        <option value="1">BELOW 1 YEARS</option>
                            </select>
							<?php }else if(isset($_REQUEST['year']) && $_REQUEST['year'] == "3"){ ?>
                                <select id="year" name="year" style="border-radius:8px">
                                    <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3" selected>BELOW 3 YEARS</option>
                                        <option value="2">BELOW 2 YEARS</option>
                                        <option value="1">BELOW 1 YEARS</option>
                            </select>
							<?php }else if(isset($_REQUEST['year']) && $_REQUEST['year'] == "2"){ ?>
                                <select id="year" name="year" style="border-radius:8px">
                                    <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2" selected>BELOW 2 YEARS</option>
                                        <option value="1">BELOW 1 YEARS</option>
                            </select>
                           <?php }else if(isset($_REQUEST['year']) && $_REQUEST['year'] == "1"){ ?>
                                <select id="year" name="year" style="border-radius:8px">
                                    <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2" >BELOW 2 YEARS</option>
                                        <option value="1" selected>BELOW 1 YEARS</option>
                            </select>
						   <?php }else{ ?>
                           <select id="year" name="year" style="border-radius:8px">
                                        <option value="10" >BELOW 10 YEARS</option>
                                        <option value="7" >BELOW 7 YEARS</option>
                                        <option value="5">BELOW 5 YEARS</option>
                                        <option value="3">BELOW 3 YEARS</option>
                                        <option value="2">BELOW 2 YEARS</option>
                                        <option value="1" selected>BELOW 1 YEARS</option>

                                </select>
                            <?php } ?>
									</td>
									
									<td align="left"><button id="viewButton" onClick="validate()">View</button></td>
									
								
								</tr>
							</table>
						</div>
					</div>


	 
  </div>
</div>		
		
		
		
			<div class="col-sm-12" >
			
 

        <div class="col-sm-12" id="employee_table" style="background-color: #c0c5ff ; border-radius:10px;">
<br>
  <!-- <h2>Basic Table</h2> -->
  <table class="table table-striped" border = "1">
   <thead>
			<tr>
				<th>CORPORATION CODE</th>
				<th>REGION</th>
				<th>DEPOT</th>
		        <th>CLASS</th>
		        <th>VEHICLE COUNT</th>
		    </tr>
		    </thead>
    <tbody>

      <?php
	  
	  //corp
	$mode = "l";
            if(isset($_REQUEST['mode']) && $_REQUEST['mode']!=""){
                $mode = $_REQUEST['mode'];
            }
		
			
		//depot	
		$categories ="0";
if(isset($_POST['categories'])){
           // $reasons = $_REQUEST['reasons'];
            $categories = str_replace("-"," ",$_POST['categories']);
            }
			
			//division
if(isset($_POST['divisions'])){
           // $reasons = $_REQUEST['reasons'];
            $divisions = str_replace("-"," ",$_POST['divisions']);
            }
			
			//class
if(isset($_POST['class'])){
           // $reasons = $_REQUEST['reasons'];
            $class = str_replace("-"," ",$_POST['class']);
            }
				
		//age	
	$year = "";	
			if(isset($_REQUEST['year']) && $_REQUEST['year']!=""){
                $year = $_REQUEST['year'];
            }

   
	
	
	
	//$sql="SELECT CORPCODE(DVM_CORPORATIONID) AS CORP_CODE,DIVISIONNAME(VM_DIVISION_ID) AS DIVISION,DEPOTNAME(VM_DEPOT_ID) AS DEPO,CLASSNAME(VM_VEHICLE_TYPE) AS CLASS,COUNT(1) AS VEHICLE_COUNT FROM ETM_VEHICLE_MASTER,DIVISIONMASTER where VM_DIVISION_ID=DVM_DIVISIONID AND DVM_CORPORATIONID=(CASE WHEN '".$mode."'='".$mode."' then DVM_CORPORATIONID else '".$mode."' end) AND VM_DIVISION_ID=(CASE WHEN '".$divisions."'='".$divisions."' THEN VM_DIVISION_ID ELSE '".$divisions."' END) AND VM_DEPOT_ID=(CASE WHEN '".$categories."'=0 THEN VM_DEPOT_ID ELSE '".$categories."' END) AND VM_VEHICLE_TYPE=(CASE WHEN '".$class."'=0 then VM_VEHICLE_TYPE else '".$class."' end) and cast(datediff(current_date,VM_PUTONROAD)/365 as signed integer)<'".$year."' group by CORP_CODE,DIVISION,DEPO,CLASS order by  CORP_CODE,DIVISION,DEPO,CLASS";
	
	
	
	
	$sql="SELECT CORPCODE(DVM_CORPORATIONID) AS CORP_CODE,REGION_NAME(DPM_REGION_ID) AS REGION,DEPOTNAME(VM_DEPOT_ID) AS DEPO,CLASSNAME(VM_VEHICLE_TYPE) AS CLASS,COUNT(1) AS VEHICLE_COUNT FROM ETM_VEHICLE_MASTER,DIVISIONMASTER,DEPOTMASTER where VM_DIVISION_ID=DVM_DIVISIONID AND VM_DEPOT_ID=DPM_DEPOTID AND DVM_CORPORATIONID=(CASE WHEN '".$mode."'='".$mode."' then DVM_CORPORATIONID else '".$mode."' end) AND DPM_REGION_ID=(CASE WHEN '".$divisions."'='".$divisions."' THEN DPM_REGION_ID ELSE '".$divisions."' END) AND VM_DEPOT_ID=(CASE WHEN '".$categories."'=0 THEN VM_DEPOT_ID ELSE '".$categories."' END) AND VM_VEHICLE_TYPE=(CASE WHEN '".$class."'=0 then VM_VEHICLE_TYPE else '".$class."' end) and cast(datediff(current_date,VM_PUTONROAD)/365 as signed integer)<'".$year."' group by CORP_CODE,REGION,DEPO,CLASS order by  CORP_CODE,REGION,DEPO,CLASS";
	
	
	echo $sql;
      $result = $conn->query($sql);
        //echo "Coneected Successfully...";
        if ($result->num_rows > 0) {
            //echo "IN IFFF  Coneected Successfully...";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            ?>
		<tr>
		
		
			<td><?php echo $row["CORP_CODE"];?></td>
			<td><?php echo $row["REGION"];?></td>
			<td><?php echo $row["DEPO"];?></td>
			<td><?php echo $row["CLASS"];?></td>
			<td><?php echo $row["VEHICLE_COUNT"];?></td>
      </tr>

      <?php
      }
    }else {
		echo"Records Not Found";
	}
?>

    

    </tbody>
  </table>
  </div>
  

</div>


   



        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
	<!--<script src="assets/js/lib/chart-js/chartjs-init.js"></script>
     <script src="assets/js/dashboard.js"></script>-->
    <script src="assets/js/widgets.js"></script>
	
	
	
	
	
	
	<script  type="text/javascript">
		
			function downloadToCSV(csv, filename) {
				var csvFile;
				var downloadLink;
			
				// CSV file
				csvFile = new Blob([csv], {type: "xlsx"});
			
				// Download link
				downloadLink = document.createElement("a");
			
				// File name
				downloadLink.download = filename;
			
				// Create a link to the file
				downloadLink.href = window.URL.createObjectURL(csvFile);
			
				// Hide download link
				downloadLink.style.display = "none";
			
				// Add the link to DOM
				document.body.appendChild(downloadLink);
			
				// Click download link
				downloadLink.click();
			}
			
			function exportTbToCSVformat(filename) {
				var csv = [];
				var rows = document.querySelectorAll("table tr");
				
				for (var i = 0; i < rows.length; i++) {
					var row = [], cols = rows[i].querySelectorAll("td, th");
					
					for (var j = 0; j < cols.length; j++) 
						row.push(cols[j].innerText);
					
					csv.push(row.join(","));        
				}
			
				// Download CSV file
				downloadToCSV(csv.join("\n"), filename);
			}
		</script>

    <?php
		$serverName = $_SERVER['HTTP_HOST'];
		//ini_set('include_path',ini_get('include_path').':'.$_SERVER['DOCUMENT_ROOT'].'/includes');
		//ini_set('allow_url_include','On');
		$fdate = date('d-m-Y');
		//$tdate = date('d-m-Y');
		//echo $fdate;
		if(isset($_REQUEST['fdate']) && $_REQUEST['fdate']!=""){
			$fdate = $_REQUEST['fdate'];
		}
		//if(isset($_REQUEST['tdate']) && $_REQUEST['tdate']!=""){
		//	$tdate = $_REQUEST['tdate'];
       // }
$categories = "ALL";
			if(isset($_REQUEST['categories']) && $_REQUEST['categories']!=""){
				$categories = $_REQUEST['categories'];
			}
		//echo "SERVER NAME:::".$serverName;
		//include 'http://10.240.213.234/TNSTCDashboard/assets/js/lib/chart-js/modeWiseSeatPer.php?fdate='.$fdate.'&tdate='.$tdate;
		  //include 'http://'.$serverName.'/TNSTCDashboard/assets/js/lib/chart-js/divisonServiceCanCount1.php?fdate='.$fdate;
		//include 'http://10.240.213.234/TNSTCDashboard/assets/js/lib/chart-js/chartjs-init.php?fdate='.$fdate.'&tdate='.$tdate;
		
    //include './assets/js/lib/chart-js/netAmount.php';
    //include './assets/js/lib/chart-js/netSeats.php';
    //include './assets/js/lib/chart-js/liveServiceCount.php';
//echo "TNSTC";
		//include './assets/js/lib/chart-js/chartjs-init.php?fdate='.$fdate.'&tdate='.$tdate;
		//include './assets/js/lib/chart-js/classWiseSeatsChart.php?fdate='.$fdate.'&tdate='.$tdate;
		//include './assets/js/totalBookingChart.php?fdate='.$fdate.'&tdate='.$tdate;
		//include './assets/js/totalRevenueChart.php?fdate='.$fdate.'&tdate='.$tdate;

    ?>


 </form>
</body>
</html>
