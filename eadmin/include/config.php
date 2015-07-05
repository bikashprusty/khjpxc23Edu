<?php

//$arrDBTaskManagement = array("db"=>"online_db","username"=>"onlineuser","password"=>"onlinePass","host"=>"localhost");
$arrDBTaskManagement = array("db"=>"edu_db","username"=>"root","password"=>"","host"=>"localhost");


define(TABLE_USER_MASTER,"tbl_user_mst");
define(TABLE_DESIGNATION,"tbl_designation");


$messgaes['users_noavailable'] 			= "No Users available";


$monthList = array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"Jul","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");

$IM_Priority 	= array(1=>"Higher",2=>"Medium",3=>"Lower");
$IM_State 		= array(1=>"New",2=>"Read",3=>"Trash",4=>"Deleted");

?>