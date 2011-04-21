<?php include("db_connect.php") ?>

<html>
        <?php make_header()?>
        <body>
<?php
make_top();

function add_battle_log($text)
{
        $_SESSION['last'] = $_SESSION['last'] . $text . '<br>';
}
function roll($max)
{
        return rand() % $max;
}

$name = $_SESSION['name'];
$enemy = $_SESSION['monster']['name'];
$player = $db->users->findOne(Array('name' => $name));

$battleover = false;

if($_SESSION['last'] == "")
{
        add_battle_log("$name encountered $enemy");
}
if($player['hp_cur'] <= 0)
{
        add_battle_log("$name lost!");
        $battleover = true;
}
if($_SESSION['monster']['hp'] <= 0)
{
        add_battle_log("$enemy lost!");
        $battleover = true;
}

echo($_POST['action']);

if($_POST['action'] == 'attack')
{
        $damage = round(($player['attack'] +
			(25+roll(25)*$player['attack'])/100) - $_SESSION['monster']['defense']);
		if($damage < 1)
		{
			$damage = 1;
		}
		$_SESSION['monster']['hp'] -= $damage;
        add_battle_log("$name hits $enemy for $damage damage!");
}
elseif($_POST['action'] == "runaway")
{
        //TODO
}
if($battleover)
{
        add_battle_log("<a href='location.php'>Main Map</a>");  
}
else
{
	$damage = round(($_SESSION['monster']['attack'] + (25+roll(25)*$_SESSION['monster']['attack'])/100) - $player['defense']);
	if($damage < 1)
	{
		$damage = 1;
	}
	$db->users->update(Array("name" => $player['name']), Array('$set' => Array('hp_cur' => $player['hp_cur'] - $damage)));
	add_battle_log("$enemy hits $name for $damage damage");
}
?>
                <div id="content" align=center>
                        <div id="player" style="position:absolute; left:0; top:0">
                                <?php echo($player['name']) ?>
                                <img src='img/player.png'>
                                <?php //For now we hard code in certain actions
                                        if(!$battleover)
                                        {
                                                echo("<form method='post' action='battle.php'>");
                                                echo("<input type='hidden' class='button' name='action' value='attack'>");
                                                echo("<input type='Submit' value='Attack!'>");
												echo("</form>");
												
												
                                                echo("<form method='post' action='battle.php'>");
                                                echo("<input type='hidden' class='button' name='action' value='runaway'>");
                                                echo("<input type='Submit' value='Run Away!'>");
												echo("</form>");
                                        }
                                ?>
                        </div>
                        <div id="battle" align=center style="position:absolute; left:200px;">
                                <?php echo($_SESSION['last']);?>
                        </div>
                        <div id="monster" style="position: absolute; left:700">
                                <?php
                                echo($enemy);
                                $eimg = $_SESSION['monster']['img'];
                                echo("<img src=$eimg>");
                                ?>
                        </div>
                </div>
        </body>
</html>