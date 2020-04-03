<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<!-- <div class="col-xs-4">
    <button type="submit" class="btn btn-primary btn-block btn-flat">RDBMS</button> -->

<form method="POST" >
<label for="Manufacturer">RDBMS : </label>
  <select id="cmbMake" name="Make"     onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
     <option value="0">Select RDBMS</option>
     <option value="1">MySQL</option>
     <option value="2">Ms. SQL Server</option>
</select>
<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="submit" name="search" value="Search"/>
</form>


 <?php

if(isset($_POST['search']))
{

    $makerValue = $_POST['Make']; // make value
    
    $maker = mysqli_real_escape_string($_POST['selected_text']); // get the selected text
    $bool=true;
    echo $makerValue; 
}
 ?>
<!-- </div> -->