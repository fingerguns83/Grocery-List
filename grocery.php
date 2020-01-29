<?php

// Functions
//---------------------

function writeList($str) {
  $json = json_encode($str);
  file_put_contents('./list.txt', $json);
}

function readList() {
  $json = file_get_contents('./list.txt');
  return json_decode($json, true);
}

// Get current list from file
//-----------------------------

$listCurrentArr = readList();

// Add Item
//--------------------

if (preg_match('/^add.*/i', $_POST['Body'])) {

   $body = $_POST['Body'];
   $newItems = preg_replace ('/^add /i', '', $body);
   $newItemsArr = explode(', ', $newItems);
   foreach ($newItemsArr as $i) {
      $i = strtolower(trim($i));
      $listCurrentArr[] = $i;
   }

   writeList($listCurrentArr);

   $listCurrentArr = readList();
   $response = "Grocery List:\n" . implode(",\n", $listCurrentArr);
}


// Remove Item
//--------------------
elseif (preg_match('/^remove.*/i', $_POST['Body'])) {

   $body = $_POST['Body'];
   $removedItems = preg_replace ('/^remove /i', '', $body);
   $removedItemsArr = explode(', ', $removedItems);
   foreach ($removedItemsArr as $i) {
      $i = trim($i);
   }

   foreach ($listCurrentArr as $i) {
      if (!in_array($i, $removedItemsArr)) {
         $listNewArr[] = $i;
      }
   }

//   $listNewJson = json_encode($listNewArr);
//   file_put_contents('./list.txt', $listNewJson);

   writeList($listNewJson);
   $response = "Grocery List:\n" . implode(",\n", $listNewArr);
}

// Read List
//--------------------
elseif (preg_match('/^read.*/i', $_POST['Body'])) {
   if ($listCurrentArr != "") {
   $response = "Grocery List:\n" . implode(",\n", $listCurrentArr);
   } else {
      $response = "Grocery List:\n-Empty-";
   }
}

// Clear List
//--------------------
elseif (preg_match('/^clear.*/i', $_POST['Body'])) {

   file_put_contents('./list.txt', '');
   $response = "Grocery List:\n-Empty-";
}


// Help
//--------------------
elseif (preg_match('/^support.*/i', $_POST['Body'])) {
   $response = "Valid commands are 'Add', 'Remove', 'Read', 'Clear', or 'Support'.\n\n";
   $response .= "Examples:\n";
   $response .= "'Add eggs, milk, butter'\n";
   $response .= "'Remove eggs, yogurt'\n";

}


// Bad Command
//--------------------
else {
   $response = "Please enter a valid command.\n\n";
   $response .= "Valid commands are 'Add', 'Remove', 'Read', 'Clear', or 'Support'.\n\n";
}

header('Content-Type: text/xml');
?>

<Response>
   <Message><?=$response; ?></Message>
</Response>
