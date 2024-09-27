<?php
	exec(". /opt/tor/get-ip.src", $msg, $ret);
	if($msg[0] == "Services"){
		$toronion = $msg[0];
	}else{
		if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){
			exec("/usr/bin/wget --quiet -O /tmp/search.json https://onionoo.torproject.org/details?search=" . $msg[0], $output, $ipret);
			$file = file_get_contents("/tmp/search.json");
			$json = json_decode($file);
			if($json == null){
				$toronion = "Services";
			}else{
				if(isset($json->relays[0]->exit_addresses)){
					foreach($json->relays[0]->exit_addresses as $val){
							if($msg[0] == $val){
							$tor = file_get_contents("/var/opt/tor/service/hostname");
							$toronion = str_replace(PHP_EOL, '', $tor);
							break;
						}
					}
				}else{
					$toronion = "Services";
				}
			}
		}else{
			$toronion = "Services";
		}
	}
?>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="/www/html/public/images/mush.ico" sizes="32x32"/>
		<title>Zoeurk JukeBox</title>
	</head>
	<body>
		<?php
			if($toronion != "Services"){
				echo "<h3>Access by Tor</h3>";
				echo "<h4>It looks like what you are using Tor</h4>Your ip is: <b style='color:green'>" . $msg[0] . "</b><br>And your country is: <b style='color:green'>" . $json->relays[0]->country_name . "</b><br>You while be redirected in few seconds to:<i style='color:green'>" . $toronion . "</i></b><br>If you are not redirected click <a href='http://" . $toronion . "'>here</a>";
			}
		?>
	</body>
	<script type="text/javascript">
		var url = <?php echo '"' . $toronion . '"';?>;
		if(url != "Services"){
			setTimeout(function(){window.location.replace("http://" + url);}, 2250);
		}
	</script>
</html>
<?php
	if($toronion != "Services"){
		exit;
	}
?>
