<?php 
/*
 Assignment 2: Converting Roman Numerals to integer
 Name: Shridhar Puntambekar
 Course: CS-174
 */

//convertRomanToDecimal("VI");
testerFunctionForRomanNum();


/**
* @param $inputString to convert roman to int
* @return the converted integer
*/
function convertRomanToDecimal($inputString){

    if(sanitiseInput($inputString) ){

      return null;
    }

    echo "<br/>Roman Numeral = ".($inputString)."<br/>";
    $calcValue = 0;
    $lengthOfString = strlen($inputString);
    $i = 0;
    while($i < $lengthOfString){
      if(returnCharValue(substr($inputString,0,2))!== 0){
        //echo "Entered1:";
        $calcValue = $calcValue + returnCharValue(substr($inputString,0,2));
        $inputString = substr($inputString,2,$lengthOfString-2);
        $i=$i+2;
      }
      else{
        //echo "Entered2:";
        $calcValue = $calcValue + returnCharValue(substr($inputString,0,1));
        $inputString = substr($inputString,1,$lengthOfString-1);
        $i=$i+1;

      }
      //echo "<br/>--->".$calcValue;
    }

    
    echo "Integer value = ".($calcValue)."<br/>";
    return $calcValue;

}

/**
* @param $singleChar one or 2 character string
* @return the equivalent integer value
*/
function returnCharValue($singleChar){
  //echo "Recevied= ".$singleChar. "<br/>";
    switch ($singleChar) {
      case "I":
          //echo "1<br/>";
          return 1;          
      case "V":
          //echo "5<br/>";
          return 5;  
      case "X":
          //echo "10<br/>";
          return 10;  
      case "L":
          //echo "50<br/>";
          return 50;  
      case "C":
          //echo "100<br/>";
          return 100;  
      case "D":
          //echo "500<br/>";
          return 500;  
      case "M":
          //echo "1000<br/>";
          return 1000;  
      case "CM":
          //echo "900<br/>";
          return 900;          
      case "CD":
          //echo "400<br/>";
          return 400;  
      case "XC":
          //echo "90<br/>";
          return 90;  
      case "XL":
          //echo "40<br/>";
          return 40;  
      case "IX":
          //echo "9<br/>";
          return 9;  
      case "IV":
          //echo "4<br/>";
          return 4;  
      default:
          //echo "0<br/>";
          return 0;
    }
}

/**
  * @param A string
 * @return Boolean ||  if input is dirty, return true
 *
 */
function sanitiseInput($inputString){
  // PHP NULL check to see if that variable actually holds any value
  if(!isset($inputString)){
    return true;
  }

  // get type determines if the variable is of type integer || istring does the same 
    if(!(gettype($inputString) ==='string' && is_string ($inputString))){
    return true;
  }

  if (preg_match('/[^IVXLCDM]/', $inputString)) {
    // string contains characters other than uppercase Roman character
  return true;
  }


}

function testerFunctionForRomanNum(){
  if(convertRomanToDecimal("MIV") == 1004)
  {
      echo "Test case ('MIV') passed. " . "<br>";
  }
    else
    {
      echo "Test case ('MIV') failed. ";
    }
    if(convertRomanToDecimal("MCMXC") == 1990)
    {
      echo "Test case ('MCMXC') passed. " . "<br>";
    }
    else
    {
      echo "<br> Test case ('MCMXC') failed. ";
    }
    if(convertRomanToDecimal("MCMXc") == null)
    {
      echo "<br> Test case ('MCMXc') passed. " . "<br>";
    }
    else
    {
      echo "<br> Test case ('MCMXc') failed. ";
    }
    if(convertRomanToDecimal("12.3") == null)
    {
      echo "Test case (12.3) passed. " . "<br>";
    }
    else
    {
      echo "Test case (12.3) failed. ";
    }
    if(convertRomanToDecimal("107") == null)
    {
      echo "Test case (107) passed. " . "<br>";
    }
    else
    {
      echo "Test case (107) failed. ";
    }
    if(convertRomanToDecimal(-1) == null)
    {
      echo "Test case (-1) passed. " . "<br>";
    }
    else
    {
      echo "Test case (-1) failed. ";
    }
    if(convertRomanToDecimal("Hello") == null)
    {
      echo "Test case ('Hello') passed. " . "<br>";
    }
    else
    {
      echo "Test case ('Hello') failed. ";
    }
    if(convertRomanToDecimal(null) == null)
    {
      echo "Test case (null) passed. " . "<br>";
    }
    else
    {
      echo "Test case (null) failed. ";
    }
  
}

 ?>