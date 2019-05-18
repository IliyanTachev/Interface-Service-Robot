<?php
include 'db_con.php';
include 'config.php';

if($_GET['func'] == "stop"){
	emergency_stop();
}
else if($_POST['func'] == "move"){
	$lin_speed = $_POST['lin_speed'];
	move($lin_speed);
}


function emergency_stop(){
	$cmd = "pidof omxplayer.bin";
	$result = exec($cmd);
	//echo "result: " . $result;
	$tmp = "kill -15 " . $result; 
	$res = exec($tmp);
	//echo "$tmp";
	//var_dump($res);
}

function init(){
	$cmds=array("roslaunch turtlebot3_bringup bebot.launch", "roslaunch rosbridge_server rosbridge_websocket.launch");
	foreach($cmds as $cmd){
		var_dump(exec($cmd));
	}	
}

function say($text="1 2 3",$lang="bg",$pitch=10,$gap=7,$speed=140)
{ 
 global $debug;
 $pitch=(int)$pitch;
 $gap=(int)$gap;
 $speed=(int)$speed;
 $cmd="/usr/bin/espeak -g $gap -p $pitch -s $speed -v $lang '".$text."'";
 exec($cmd);
 if ($debug) echo($cmd);
}

// Beeps from Turtlebot Buzzer - Requires OpenCR board
function turtlebot_sound($param=0)
{
	global $debug;
	$cmd="/home/pi/ros.sh rostopic pub /sound turtlebot3_msgs/Sound ".(int)$param." -1";
	exec($cmd);
  if ($debug) echo($cmd);
}

function show_emoji($param=0)
{
	global $debug;
	$cmd="sudo /usr/bin/fbi -d /dev/fb0 -T 1 -a -noverbose -nocomments /home/pi/emotics/emoji_".(int)$param.".png"; 
	exec($cmd);
  if ($debug) echo($cmd);
}

//play video or audio file
//function play_media($filename,$aspect="stretch")
function play_media($ID, $aspect="stretch")
{
	global $debug, $conn, $turtlebot_files_dir;
	$ID= (int)$ID;
	$media_dir = "";
	
  $sql = "SELECT file_name FROM media_files WHERE ID='$ID' AND (content_type=2 OR content_type=3) LIMIT 1";
  $res = mysqli_query($conn, $sql);
  if(mysqli_num_rows($res) > 0){
  	$row = mysqli_fetch_assoc($res);
  	$filename = $row['file_name'];
  	$split_filename = explode(".", $filename);
  	if(end($split_filename) == "mp3") $media_dir = "audios";
  	else if(end($split_filename) == "mp4") $media_dir = "videos";
  	//$pid="/usr/bin/omxplayer --aspect $aspect  \"$turtlebot_files_dir/uploads/$media_dir/$filename\" ";
	  //$pid = exec("sudo /usr/bin/omxplayer --aspect $aspect  \"$filename\" ");//  > /dev/null 2>&1 & echo $!");
	  $pid = exec("sudo /usr/bin/omxplayer --aspect $aspect  \"$turtlebot_files_dir/uploads/$media_dir/$filename\" ");//  > /dev/null 2>&1 & echo $!");
	  var_dump ($pid);
	  ///$pid=exec($cmd);
	  if ($debug) echo("CMD:$cmd PID:$pid");
	  return($pid);
  }
  return false;
}

//show image, if filename empty clear screen/framebuffer
function show_image($ID, $apect="stretch")
{
  global $debug, $conn, $turtlebot_files_dir;
	$ID= (int)$ID;
	$sql = "SELECT file_name FROM media_files WHERE ID='$ID' AND content_type=1 LIMIT 1";
  $res = mysqli_query($conn, $sql);
  if(mysqli_num_rows($res) > 0){
  	$row = mysqli_fetch_assoc($res);
  	$filename = $row['file_name'];
  	$cmd="sudo /usr/bin/fbi -d /dev/fb0 -T 1 -a -noverbose -nocomments \"$turtlebot_files_dir/uploads/images/$filename\"";
	  if (!$filename) $cmd="sudo /var/www/html/libs/clr_frame.sh";
	  exec($cmd);
	  if ($debug) echo($cmd);
  }
  return false;
}

//turn on and off the raspberry touchscreen
function display_ctl($switch=1)
{
  global $debug;
  if ($switch==0)  $cmd="sudo /var/www/html/libs/disp_off.sh";
  else             $cmd="sudo /var/www/html/libs/disp_on.sh";
  shell_exec($cmd);
  if ($debug) echo($cmd);
}

function move($x, $y, $angle)
{
				global $debug;
        $x=(float)$x;
        $y=(float)$y;
        $angle=(float)$angle;
        
        $cmd="sudo python /var/www/html/libs/bebot_go.py $x $y $angle";
        echo $cmd;
        $msg = exec($cmd);
				if ($debug) echo $cmd;
				var_dump($msg);
							//$lin_speed = -1.0;
 //echo("/home/pi/ros.sh rostopic pub /cmd_vel geometry_msgs/Twist '{linear: {x: ".(float)$lin_speed.", y: 0, z: 0}, angular: {x: 0, y: 0, z: 
	//$res = exec("/home/pi/ros.sh rostopic pub -1 /cmd_vel geometry_msgs/Twist '{linear: {x: ".(float)$lin_speed.", y: 0, z: 0}, angular: {x: 0, y: 0, z: ".(float)$ang_speed."}}'");
	//echo "rostopic pub -1 /cmd_vel geometry_msgs/Twist 'linear: {x: ".(float)$lin_speed.", y: 0, z: 0}'";
	//$tmp = "sudo rostopic pub -1 /cmd_vel geometry_msgs/Twist 'linear: {x: ".(float)$lin_speed.", y: 0, z: 0}";
	//echo $tmp . " ";
	//shell_exec("screen");
	
	$ang_speed = 0;
	//$res = exec("/home/pi/ros.sh rostopic pub -1 /cmd_vel geometry_msgs/Twist 'linear: {x: 0, y: 0, z: 0}'");
//	exec("/home/pi/ros.sh rostopic pub -1 /cmd_vel geometry_msgs/Twist '{linear: {x: 0, y: 0, z: 0}, angular: {x: 0, y: 0, z: 0}}'");
	echo $res;
}

function move2()
{
	$res = exec("sudo /home/pi/ros.sh rostopic pub -1 /cmd_vel geometry_msgs/Twist '{linear: {x: 0, y: 0, z: 0}, angular: {x: 0, y: 0, z: 0.5}}'");
	var_dump($res);
}
//bash.rc
?>
