<?php
/**
 * @author freegeek
 * 包含了常用的时间日期操作
 */
class timeDate{
    public $timeUnit;
    
    function __construct(){
     
         $this->timeUnit=['day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1];
    }
    
    //计算两个时间的差
    function timeDifference($maxTime,$minTime){
          $maxTime=$this->timeFormat($maxTime,'timestamp');
          $minTime=$this->timeFormat($minTime,'timestamp');
           
          $second=$maxTime-$minTime;
          return $this->toTimeUnit($second);
   }
    
    function timeFormat($time,$format){
        switch ($format){
            case 'date':
                return date('Y-m-d',$time);
                break;
           case 'timestamp':
                return is_int($time)?$time:strtotime($time);
               break;
           case 'datetime':
                return date('Y-m-d H:i:s',strtotime($time));
                break;
        }
    }
    
  function toTimeUnit(int $second){
      foreach ($this->timeUnit as $key=>$v){
          $res[$key]=intval($second/$v);
      }
      return $res;
  }
   
   
   function dateAgo($time){
       
       $timestamp=$this->timeFormat($time,'timestamp');
       
       $timeAgo=$this->toTimeUnit((time()-$timestamp));
        
        if($timeAgo['second']<60){
           return $timeAgo['second'].'秒前';
        }else if($timeAgo['minute']<60){
           return $timeAgo['minute'].'分钟前';
        } else if($timeAgo['hour']<10){
           return $timeAgo['hour'].'小时前';
        } 
   
       //day ago
       if(date('Y-m-d',$timestamp)==date('Y-m-d')){
           return '今天'.date('H:i',$timestamp);
       }
       if(date('Y-m-d',$timestamp)==date('Y-m-d',strtotime('-1 day'))){
           return  '昨天';
       }
       
       if($timeAgo['day']<30){
           return $timeAgo['day'].'天前';
       }
       $monthsAgo=intval($timeAgo['day']/30);
       
       if($monthsAgo<12){
           return  $monthsAgo.'个月前';
       }
       
       $yearsAgo=intval($monthsAgo/12);
        
       if($yearsAgo<4){
           return  $yearsAgo.'年前';
       }
       return date('Y-m-d',$timestamp);
       
   }
   
} 
$obj=(new timeDate())->dateAgo('2017-12-08');
print_r($obj);
 
 