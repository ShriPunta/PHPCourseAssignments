<!-- /**
 Assignment 1: Finding Prime Numbers
 Name: Shridhar Puntambekar
 Course: CS-174
  -->

<!DOCTYPE HTML>  
<html>
<head>
<title>Assignment 1- Finding prime Numbers</title>
</head>
<?php

// Calling the testing function
primeNumberTestFunction();


/**
 * PHP doc syntax for function header

 * @param An integer (inputNumber)
 * @return [Array] || All the prime numbers from 2 --> inputNumber
 *
 */
function calculatePrimes($inputNumber){

  // Santise input
  if(sanitiseInput($inputNumber))
  {
    return null;
  }

  // Declare an array to hold the prime numbers || This variable will be returned
  $arrayToRet = array();

  // Iterate till the number
  for ($i = 2; $i <= $inputNumber; $i++){ 
    // The function returns true or false
    if (isPrime($i))
    { 
        // Populate the array to return
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
      
    // square root for mathematical efficiency
    for ($i = 2; $i <= sqrt($number); $i++){ 
        if ($number % $i == 0) 
        {
            return 0; 
        }
    } 
    return 1; 
} 

/**
 * PHP doc syntax for function header

 * @param An integer (number)
 * @return Boolean ||  if input is dirty, return true
 *
 */
function sanitiseInput($inputNumber){
  // PHP NULL check to see if that variable actually holds any value
  if(!isset($inputNumber)){
    return true;
  }

  // get type determines if the variable is of type integer || isInt does the same (no decimals)
  if(!(gettype($inputNumber) ==='integer' && is_int($inputNumber))){
    return true;
  }

  // additional check to see that no integer below 2 is passed (2 is the first prime number)
  if($inputNumber < 2){
    return true;
  }

  return false;


}


/**
 * PHP doc syntax for function header

 * Tester function to test the above methods
 *
 */
function primeNumberTestFunction() {
    if(calculatePrimes(1) == "")
    {
      echo "Test for 1 passed. It returned null. " . "<br>";
    }
    else
    {
      echo "Test for 1 failed. " . "<br>";
    }

    $array_of_primes_till_20 = array(2, 3, 5, 7, 11, 13, 17, 19);
    if(calculatePrimes(20) ==  $array_of_primes_till_20)
    {
      echo "Test for 20 passed. It returned the prime numbers." . "<br>";
    }
    else
    {
      echo "Test for 20 failed. " . "<br>";
    }

    if(calculatePrimes(-8817) == null) 
    {
      echo "Test for -8817 passed. It returned null." . "<br>";
    }
    else
    {
      echo "Test for -8817 failed. " . "<br>";
    }

    if(calculatePrimes("abcdefgh") == null)
    {
      echo "Test for 'abcdefgh' passed. It returned null." . "<br>";
    }

    else
    {
      echo "Test for 'abcdefgh' failed. " . "<br>";
    }

    if(calculatePrimes("11.0.1") == null)
    {
      echo "Test for '11.0.1' passed. It returned null." . "<br>";
    }
    else
    {
      echo "Test for '11.0.1' failed. " . "<br>";
    }

    if(calculatePrimes("There are no strings on me.") == null)
    {
      echo "Test for 'There are no strings on me.' passed.  It returned null." . "<br>";
    }
    else
    {
      echo "Test for 'There are no strings on me. failed.' " . "<br>";
    }

   }

?>

</body>
</html>