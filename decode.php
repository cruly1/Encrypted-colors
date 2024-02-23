<?php
    $filename = "password.txt";
    $fp = fopen($filename, "r") or die("Error: Couldn't open {$filename}");
    $lines=fread($fp, filesize($filename));
    fclose($fp);

    $lines = explode("\n", $lines);
    $arr = array(5, -14, 31, -9, 3);

    foreach ($lines as $password) {
        $pass = "";
        $current_index = 0;
        for ($i = 0; $i < strlen($password); $i++) {
            $char = ord($password[$i]);
            $char -= $arr[$current_index];
            $current_index++;
            
            $char = chr($char);
            $pass = $pass . $char;
            
            if ($current_index == 5) {
                $current_index = 0;
            }
        }
        
        $curr = explode("*", $pass);
        $passwords[$curr[0]] = $curr[1];
    }
?>
