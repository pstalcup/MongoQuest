<?php
        session_start();

        $loggedin = isset($_SESSION['name']);
        $m = new Mongo("localhost");
		$db = $m->mquest;
        function make_header()
        {
                echo("<header>");
                echo("<title>MongoQuest</title>");
                echo("<link rel='stylesheet' type='text/css' href='style.css'");
                echo("</header>");
        }

        function make_top()
        {
				$m = new Mongo("localhost");
				$db = $m->mquest;
                if(isset($_SESSION['name']))
                {
						$conn = $db->users;
		
						$query = Array('name' => $_SESSION['name']);
		
						$player = $conn->findOne($query);
                        $hpp = round((100*$player['hp_cur'])/$player['hp_max']);
                        $mpp = round((100*$player['mp_cur'])/$player['mp_max']);

                        $name = $_SESSION['name'];

                        echo("<div id='top'>");
                        
                        //HP Bar
                        echo("HP: <div id='bar' style='position: absolute; top: 0px'><div id='outline'><div id='hp'
style='width:$hpp'></div></div></div>");
                        //MP Bar
                        echo("<br>MP: <div id='bar' style='position: absolute; top: 20px;'><div id='outline'><div id='mp'
style='width:$mpp'></div></div></div>");
                        echo("<br>$name");
                        echo("<br><a href='logout.php'>Logout</a>");
						echo("     <a href='location.php?l=class_select'>Heal</a>");
						echo("</div>");
                }
        }
?>
