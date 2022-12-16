<?php
include('db.php');

$sql = "SELECT * FROM wordlist";
$result = $conn->query($sql);


$sentence = $_GET['sent'];
$countofwords = str_word_count($sentence);
$delimiter = " ";
$words = explode($delimiter, $sentence);
$upperw = 0;


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        foreach ($words as $word) {
          if($row['text'] == $word){
            $upperw += $row['weight'];
          }
        }
      }

}


$result1 = $upperw  / $countofwords;
  if($result1==0){
    $state="neutral";
  }
  elseif(($result1==1) || ($result1>=0.25)){
    $state="positive";
  }
  else{
    $state="negative";
  }
  
  $data = array(
    'String' => $sentence,
    'No of Words' => $countofwords,
    'State' => $state,
    'Polarity Score' => $result1
  );
  echo json_encode($data,JSON_PRETTY_PRINT);
?>