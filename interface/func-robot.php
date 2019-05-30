<?php
include 'db_con.php';
include 'config.php';


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

function turtlebot_sound($param=0)
{
	global $debug;
	$cmd="/home/pi/ros.sh rostopic pub /sound turtlebot3_msgs/Sound ".(int)$param." -1";
	exec($cmd);
  if ($debug) echo($cmd);
}

function emoji($param="усмихнат",$time=1)
{
  global $debug,$PT,$allem;
  $emoji=$allem[$param];
    $ptype=4;
    $cmd="sudo /usr/bin/fbi -d /dev/fb0 -1 -t $time -T 1 -a -noverbose -nocomments /home/pi/emotics/emoji_".(int)$emoji.".png"; 
    exec($cmd);
  if ($debug) echo($cmd);
}

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

//play video or audio file
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
  if ($switch==0) $cmd="sudo /var/www/html/libs/disp_off.sh";
  else $cmd="sudo /var/www/html/libs/disp_on.sh";
  shell_exec($cmd);
  if ($debug) echo($cmd);
}

function move($lin_speed, $angle_speed)
{
	global $debug;
  $x=(float)$x;
  $y=(float)$y;
  $angle=(float)$angle;
     
  $cmd = "sudo /home/pi/ros.sh python /var/www/html/libs/run.py $lin_speed $angle_speed";
  $msg = exec($cmd);
	if ($debug) echo $cmd;
	
	echo $res;
}

function move_base($offset){
	move($offset, 0);
}

function rotate_base($angle){
	move(0, $angle);
}
?>
