<?php
$db = new mysqli('127.0.0.1','root','','brief_myresources');
 if($db->connect_errno){
    echo 'we have a problem here :(';
 }
 
