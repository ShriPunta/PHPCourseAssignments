<!DOCTYPE HTML>  
<html>
<head>
<style> 
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

// define variables and set to empty values
$inputErr = "";
$inputNumber = "";
$resp = '';


// TODO understand how to redirect flow

// Handle the GET incoming request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // If the incoming GET request is empty, show error.
  if (empty($_GET["numberIncoming"])) {
    $inputErr = "min value = 2 & max is 100000";
  } else {
    // Confirm the input is a number
    // Capture the parameter from the URL
    $inputNumber = sanitiseInput($_GET["numberIncoming"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$inputNumber)) {
      // Update the error  messgae
      $inputErr = "Only enter numbers"; 
    }
    else{
      // Call the heroku hosted website which will return an array of prime numbers
      $resp = doCurl('whispering-stream-18882.herokuapp.com',$inputNumber);
    }

    
  }
  
  
}

/**

 * @param number received
 * @return Return a cleaned data form
 *
 */
function sanitiseInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/**

 * @param URL to HIT - Where should the CURL request be done to
 * @return array of prime numbers
 *
 */

function doCurl($urlToHit,$inputNumber){
    
    // Check if there is an existing network connection
    if(!isConnectedToNet($urlToHit)){
      // if a connection is not present, calculate prime numbers on your own
     return calculatePrimes($inputNumber);
    }
    else{

      // Get cURL resource
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => "$urlToHit/$inputNumber",
      CURLOPT_USERAGENT => 'Get PRimes'
      ));
      // Send the request & save response to $resp
      // the resp resource will contain the string of comma separated prime numbers if everything goes right
      $resp = curl_exec($curl);
      
      curl_close($curl);

      // If the website is not UP, it will give an error
      foreach(explode(" ", $resp) as $ele){
        if(strpos($ele, 'error') !== FALSE)
        {
          // If the website is not UP, generate prime on your own
          $resp = calculatePrimes($inputNumber);
        }
               
      }

      // If the website is UP, $resp will contain a string of primes else an array of primes
      return $resp;
    }
}

/**

 * @param Which URL to hit to check
 * @return A boolean which returns if the PHP server is connected to the internet
 *
 */
function isConnectedToNet($urlToHit)
{
    
    $connected = @fsockopen("$urlToHit", 80); 
                                        //website, port  (try 80 or 443)

    if ($connected){
        fclose($connected);
        $isConnected = TRUE;
    }else{
        $isConnected = FALSE; //action in connection failure
    }
    
    return $isConnected;

}

/**
 * PHP doc syntax for function header

 * @param An integer (inputNumber)
 * @return [Array] || All the prime numbers from 2 --> inputNumber
 *
 */
function calculatePrimes($inputNumber){
  $arrayToRet = array();
  for ($i = 2; $i <= $inputNumber; $i++){ 
      if (isPrime($i))
      { 
          array_push($arrayToRet, $i);
      }
    } 
 return $arrayToRet;

}

/**
 * PHP doc syntax for function header

 * @param An integer (number)
 * @return [Boolean]|| Check if the given number is prime or not 
 *
 */
function isPrime($number){ 
    if ($number == 1) 
    {
      return 0; 
    }
      
    for ($i = 2; $i <= sqrt($number); $i++){ 
        if ($number % $i == 0) 
        {
            return 0; 
        }
    } 
    return 1; 
} 

?>


<h2>Getting Prime Numbers</h2>
<p><span class="error">* required field</span></p>
<form >                       
  Enter number: <input onchange="validateOnChange()" onkeypress="validate()" min="2" max="100000" type="number" id="inputNum" name="inputNum" value="<?php echo $inputNumber;?>">
  <span class="error">* <?php echo $inputErr;?></span>
      <br><br>
  <input type="button" name="submit" onclick="buttonClicked()" value="Get Primes">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $inputNumber;
echo "<br>";
echo "<h3> The primes are: </h3>";
echo "<span style='display: inline-block;width:100vw;'>";

// If resp is an array, iterate over each element
if(gettype($resp) === 'array')
{
  foreach($resp as $ele) {
      echo $ele, ',';
  }
}
else{
  // if resp is a comma separated string, split the string and iterate
  foreach(explode(",", $resp) as $ele){
    echo $ele, ',';
  }
}
echo "</span>";

?>

<script>
  // javascript functions to validate the input field
  function validate(){
    var value = document.getElementById("inputNum").value;
    if(parseInt(value)>parseInt(document.getElementById("inputNum").max)){
      console.log('Entered');
      document.getElementById("inputNum").value=document.getElementById("inputNum").max;
    }
    
  }

  function validateOnChange(){
     if(parseInt(value)<parseInt(document.getElementById("inputNum").min)){
      document.getElementById("inputNum").value=document.getElementById("inputNum").min;
    }
  }

  // Javascript function to call the PHP page with a parameter in the URL
  function buttonClicked(){
    var url = window.location.hostname;
    var value = document.getElementById("inputNum").value;
    var query = 'numberIncoming='+value;
    console.log('value-->',value);

    window.location.href = 'PrimeNumbers_Advanced.php?' + query;

  }
</script>



</body>
</html>