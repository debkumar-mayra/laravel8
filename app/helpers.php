<?php 
use App\Members;
use App\Models\SiteSetting;

 function dateDifferent($date1, $date2)
{
    $date1 = $date1 ? $date1 : date('Y-m-d H:i:s');
    $date2 = $date2 ? $date2 : date('Y-m-d H:i:s');
  $date1 = strtotime($date1);
  $date2 = strtotime($date2);  

$diff = abs($date2 - $date1);  

$years = floor($diff / (365*60*60*24));  

$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  

$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 
  
$hours = floor(($diff - $years * 365*60*60*24  
       - $months*30*60*60*24 - $days*60*60*24) 
                                   / (60*60));  
  
$minutes = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60);  
  
$seconds = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24 
                - $hours*60*60 - $minutes*60));

// return $time = ("%d years, %d months, %d days, %d hours, "
//      . "%d minutes, %d seconds", $years, $months, 
//              $days, $hours, $minutes, $seconds);

$time = '';
if($years > 0 ){
  $time .= ($years > 1) ? $years."years ": $years."year ";
  return $time;

}

if($months > 0 ){
  $time .= ($months > 1) ? $months."months ": $months."month ";
  return $time;
}

if($days > 0 ){
  // $time .= ($days > 1) ? "$days days ": "$days day ";
  $time .= $days."d ";
  return $time;
}

if($hours > 0 ){
  // $time .= ($hours > 1) ? "$hours hours ": "$hours hour ";
  $time .= $hours."h ";
  return $time;
}

if($minutes > 0 ){
  // $time .= ($minutes > 1) ? "$minutes minutes ": "$minutes minute ";
  $time .=  $minutes."m ";
} else{
    $time .=  '0m';
  return $time;
}

return $time;
}




function getSetting($key)
{
  $setting = SiteSetting::where('key',$key)->first();
  return $setting ? $setting->value : false ;
}

// function getLocaltime($){
//              $dt = new \DateTime();
//              $ts = strtotime($dt);
//              GMT+0530
//              $tz = new \DateTimeZone('Asia/Kolkata');
//              $dt->setTimezone($tz);
//              $ping->poll_time = $dt->format('Y-m-d H:i:s');
// }
