<?php

/*

crontab -e

und füge das hinzu

* * * * * sleep 5 && php /path/to/your/index/file/of/the/leaderboard/index.php?token=YOUR_myToken

*/

session_start();
require_once 'ts3admin.class.php';
$website_name = "Your Website Name"; //Website Name
$ts3ip = "127.0.0.1"; //TS3IP
$ts3port = "9987"; //TS3Port
$ts3qport = "10011"; //TS3Query Port
$ts3user = "serveradmin"; //TS3User Login
$ts3pass = ""; //TS3Query Login
$seconreq = "5"; //Seconds on Req.
$myToken = "4234534645645645645"; //Token for TimeQuery
$denyGroups = array("99999999"); // array("234234", "32434", "123423"); So fügt man mehrere Gruppen hinzu!

$conn = mysqli_connect("localhost", "testtest", "testtest", "test"); //Database

if(isset($_GET['token'])){
	$token = $_GET['token'];
	if($token == $myToken){
		$tsAdmin = new ts3admin($ts3ip, $ts3qport);
		
		if($tsAdmin->getElement('success', $tsAdmin->connect())) {
			$tsAdmin->login($ts3user, $ts3pass);
			$tsAdmin->selectServer($ts3port);
			$clients = $tsAdmin->clientList("-uid -ip -groups");
			
			foreach($clients['data'] as $client) {
				$cname = $client['client_nickname'];
				$ip = $client['connection_client_ip'];
				$uid = $client['client_unique_identifier'];
				$groups = $client['client_servergroups'];
				$skip = "1";
				foreach($denyGroups as $keyFrame){
					if (strpos($groups, $keyFrame) !== false) {
						$skip = "2";
					}
				}
				if($ip == ""){
					
				} elseif($ip == "127.0.0.1"){
					
				} else {
					if($skip == "1"){
						$sql = "SELECT * FROM ts3_timetable WHERE uid = '$uid' LIMIT 1";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$sql = "UPDATE ts3_timetable SET time = time + '$seconreq' WHERE uid = '$uid'";
								$res = $conn->query($sql);
								$sql = "UPDATE ts3_timetable SET username = '$cname' WHERE uid = '$uid'";
								$res = $conn->query($sql);
								$sql = "UPDATE ts3_timetable SET ip = '$ip' WHERE uid = '$uid'";
								$res = $conn->query($sql);
							}
						} else {
							$sql = "INSERT INTO ts3_timetable(id, username, uid, ip, time)VALUES('', '$cname', '$uid', '$ip', '$seconreq')";
							$res = $conn->query($sql);
						}
					}
				}
			}
			exit;
		}
		
	} else {
		die("NOC");
	}
}
?>
<head>
	<title><?php echo $website_name; ?> - TeamSpeak³ Leaderboard</title>
	<link rel="stylesheet" href="//cdn.flareco.net/bootswatch/superhero/bootstrap.css"/>
	<link rel="stylesheet" href="//cdn.flareco.net/font-awesome/css/font-awesome.css"/>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			</br></br>
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel panel-heading"><center><i class="fa fa-check"></i> TeamSpeak³ Leaderboard</center></div>
					<div class="panel panel-body">
						<table class="table table-responsive">
							<thead>
								<th>#</th>
								<th>Username</th>
								<th>UID</th>
								<th>Zeit</th>
							</thead>
							<tbody>
									<?php
										$sql = "SELECT * FROM ts3_timetable WHERE ip != '' ORDER By time Asc LIMIT 25";
										$result = $conn->query($sql);
										$rank = "1";
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												$username = $row['username'];
												$uid = $row['uid'];
												$time = $row['time'];
												$tsAdmin = new ts3admin($ts3ip, $ts3qport);
												$keylog = $tsAdmin->convertSecondsToArrayTime($time);
												$tage = $keylog['days'];
												$tage = $tage." Tage";
												$stunden = $keylog['hours'];
												$stunden = $stunden." Std.";
												$minuten = $keylog['minutes'];
												$minuten = $minuten." Min.";
												$sekunden = $keylog['seconds'];
												$sekunden = $sekunden." Sek.";
												echo "<tr>\n";
												echo "<td>$rank</td>\n";
												echo "<td>$username</td>\n";
												echo "<td>$uid</td>\n";
												echo "<td>$tage $stunden $minuten $sekunden</td>\n";
												echo "</td>\n";
												$rank = $rank + "1";
											}
										}
										
									?>
							</tbody>
						</table>
					</div>
					<div class="panel panel-footer"><center><center>Made by FlareCO/CoinCaptcha</center></center></div>
				</div>
				<p class="pull-right"><a href="https://r4p3.net">R4P3</a></p>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</div>
</body>