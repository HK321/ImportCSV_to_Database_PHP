<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/21/17
 * Time: 6:36 PM
 */
error_reporting(E_ALL & ~E_NOTICE);
class Excel
{
    private $file;
    private $parse_header;
    private $header;
    private $delimeter;
    private $length;

    //Constructor to initialize the values
    function __construct($filename,$parse_header=FALSE,$delimeter="\t",$length=8000)
    {
        $this->file=fopen($filename,'r');
        $this->parse_header=$parse_header;
        $this->delimeter=$delimeter;
        $this->length=$length;

        if($this->parse_header==TRUE)
            $this->header=fgetcsv($this->file,$this->length,$this->delimeter);


    }

    //Destructor method
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        if($this->file)
            fclose($this->file);

    }

    //function to read csv file and save data in array
    function get($max_lines=0){
        $row_ret=array();
        if($max_lines>0)
            $lines_count=0;
        else
            $lines_count=-1; //$max_lines less than zero then ignore the loop limit

        while($lines_count < $max_lines && ($row=fgetcsv($this->file,$this->length,$this->delimeter)) !== FALSE)
        {


            if($this->parse_header) {

                foreach ($this->header as $key => $value)
                {

                      $row_value=explode(',',$row[0]); //explode the string to save data in arrays

                      foreach ($row_value as $value){
                          $row_result[]= "'".$value."'"; //formatting each element of array so that it can be used in query

                      }

                      $final=implode(',',$row_result); //convert the formatted array into string again
                      $row_new[]='('.$final.')';//finally put concatenate round brackets with the string
                      unset($row_result);//unset array to avoid redundancy
                }


            }
            else
            {
                $row_ret[]=$row;
            }

            if($max_lines>0)
                $lines_count++;



            }
            if($row_new!=NULL) {

                $row_ret[] = $this->header; //save excel sheet headings in array
                $row_ret[] = $row_new; // save data under headings in same array

            }
            return $row_ret; // return the array

    }





}