<?php
$file = $_FILES['file'];
$file['name']=preg_replace('/\s+/', '_', $file['name']);
$b="C:/wamp64/www/upload/";
move_uploaded_file($file['tmp_name'], $b.$file['name']);
        $handle = fopen($b.$file['name'], "r");

        ## read video file size
        $contents = fread($handle, filesize($b.$file['name']));
        $fi = "C:\\wamp64\\www\\FFmpeg\\bin\\ffmpeg.exe -i C:/wamp64/www/upload/".$file['name']." -f null - 2>&1";
        fclose($handle);
        /*** run cmd command ***/
        exec($fi , $time);
        //print_r($time);
        $needle = " time=";
        /*** loop through result ***/
       foreach ($time as $key => $value) {
           /*** last occurance of time ***/ 
           $c = strrpos($time[$key], $needle);
           $ar="";
           $index="";
           /*** check if needle position is found ***/
           if( $c != null ){
            /*** extract the string ***/
            $ar = substr($time[$key], $c);
            /*** remove initial space ***/
            $q = explode(" ", $ar);
            /*** divide string to get hr:min:sec ***/ 
            $q1 = explode(":", $q[1]);
            $q2=$q1[0]*3600+$q1[1]*60+$q1[2];
            echo $q2;
            }
       }
?>
