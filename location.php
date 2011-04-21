<?php include("db_connect.php") ?>

<html>
        <?php make_header() ?>
<body>
<?php
make_top();
echo("<div id='content'>");
        $query = Array('url' => $_GET['l']);
		if($_GET['l'] == "class_select")
		{
			$db->users->update(Array('name' => $_SESSION['name']),Array('$set' => Array('hp_max' => 10, 'hp_cur' => 10, 'mp_cur' => 10, 'mp_max' => 10, 'attack' => 3, 'defense' => 20, 'speed' => 7)));
		}
        if(!isset($_GET['l']) || $db->locations->find($query)->count() == 0)
        {
                $query = Array('url' => 'main');        
        }

        $result = $db->locations->findOne($query);
        $type = $result['typeof'];
		$img = $result['img'];
		
        if($type == 'container')
        {
                //Create a container of links
                $i = 0;
                $locations = $db->containers->find(Array('outside' => $result['name']));
                echo("<table>");
                foreach($locations as $square)
                {
                        if($i == 0)
                        {
                                echo("<tr>");
                        }
                        $temp = $db->locations->findOne(Array('name' => $square['name']));
                        $img  = $temp['img'];
                        $url  = $temp['url'];
                        echo("<td><a href='location.php?l=$url'><img src='$img'></a></td>");

                        $i++;
                        if($i == 3)
                        {
                                echo("</tr>");
                                $i = 0;
                        }
                }
                echo("</table>");
        }
        elseif($type == 'battle')
        {
                $monsters = $db->monsters->find(Array('location' => $result['name']));
                srand(time());
				$_SESSION['last'] = "";
                $i = rand()%$monsters->count();
                foreach($monsters as $monster)
                {
                        if($i == 0)
                        {
                                $_SESSION['monster'] = $monster;
                        }
                        $i--;
                }
                $mname = $_SESSION['monster']['name'];
                echo("You encounter a $mname. <a href='battle.php'>Fight</a> or <a
href='location.php'> Flee? </a>");
        }
        echo("</div>");
?>
</body>
</html>