<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/21/17
 * Time: 1:31 PM
 */
include_once ('config/config.php');
$conn=new \MYSQL\DB_con();
$con=$conn->connect(); //Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset=" UTF-8" />
<title>Excel</title>
</head>
<body>
<h2 align="center"> Upload New Excel File </h2>
<form class="form-horizontal" role="form" method="POST" action="test1.php" enctype="multipart/form-data"    accept-charset='UTF-8'>
    <div class="form-group" >
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Choose CSV File </label>
        <div class="col-sm-9">
            <input id="form-field-1"  class="col-xs-10 col-sm-5" type="file" name="file" id="file"   required/>
        </div>
    </div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit" name="submit1"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
            &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset"> <i class="ace-icon fa fa-undo bigger-110"></i> Reset </button>
        </div></div></form>
</body>
</html>

<?php


if(isset($_POST['submit1'])) {
    $filename = $_FILES["file"]["tmp_name"];//get file name
    $importer = new \Excel($filename, true);//creating object
    //call get method with parameter to get values for one time insertion it can be max of 1000 but preferred to set 1
    while($data=$importer->get(1)) {
        $fields=implode('',$data[0]); //convert headings as array element to string
        $fields="(".$fields.")"; //concatenate the string with brackets
        $values=implode(',',$data[1]); // convert values as array element to string

        //preparing the query
        $query="INSERT INTO excel_entry ".$fields."  VALUES  ".$values."";

        if(mysqli_query($con,$query)){
            echo "Done ! <br>";
        }
        else
            echo "Failed <br>";
    }


}
