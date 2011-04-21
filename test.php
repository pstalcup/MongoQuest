<?php
try{
 $m = new Mongo();
 $db = $m->testDB;
  $collection = $db->users;

  // Insert two documents (objects) into the db
  $collection->insert(array("username" => "John", "email" =>
                     "john@doe.de", "password" => "jd"));
  $collection->insert(array("username" => "Jane", "email" =>
                     "jane@doe.de", "password" => "jd"));

  // Display the documents inside the users collection
  $obj = $collection->find();
  foreach ($obj as $user) {
    echo($user["username"]);
    echo "</br>";
  }
  }
  catch(Exception $e)
  {
	echo $e->getMessage();
  }
?>