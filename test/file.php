<?php
header("content-type:text/html; charset= utf-8");
$dir = $_POST['fn'];
$before = $_POST["before"];
$after = $_POST["after"];

if(file_exists($dir)){
    $filename = read_all ($dir);
   // var_dump($filename);
    $path = set ($filename);
    // echo $path[0];
    if($path){
    for($i=0;$i<count($path);$i++){
        $fp = fopen($path[$i],"r");
        $str = fread($fp,filesize($path[$i]));
        echo "修改".$path[$i]."文件:<br>";
        $w = implode("", $before);
        if(!empty($w)){
            for($s=0;$s<count($before);$s++){
              if(!empty($before[$s])){ 
                $str = str_replace($before[$s],$after[$s],$str);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;".$before[$s]."---->".$after[$s]."<br><br>";
            
            }
           
            }
            file_put_contents($path[$i],$str);
        }
        else{
            echo "daole";
                $str = str_replace("line-small","row-small",$str);
                $str = str_replace("line-middle","row-middle",$str);
                $str = str_replace("line-big","row-big",$str);
            for($p=1;$p<13;$p++){
                $str = str_replace(".x".$p,".col-xs-".$p,$str);
                $str = str_replace(".xl".$p,".col-xs-".$p,$str);
                $str = str_replace(".xs".$p,".col-sm-".$p,$str);
                $str = str_replace(".xm".$p,".col-md-".$p,$str);
                $str = str_replace(".xb".$p,".col-lg-".$p,$str);
            }
            file_put_contents($path[$i],$str);
        }

        fclose($fp);
        header("Refresh:10;url=index.html");
    }
    }
    else{
        $set = "txt,html,htm,doc,docx,php,js,css";
        echo "文件格式不符"."<br>"."文件格式应为".$set."中之一";
        header("Refresh:4;url=index.html");
        
    }



}
else{
    echo "文件不存在,请检查文件路径后再运行!";
    header("Refresh:4;url=index.html");
}
function read_all ($dir){
    $filename = "";
    if(!is_dir($dir)) {
        $filename = $dir.",";
        
    }
    else{
    $handle = opendir($dir);
    if($handle){
        
        while(($fl = readdir($handle)) !== false){
            $temp = iconv('GBK','utf-8',$dir.DIRECTORY_SEPARATOR.$fl);//转换成f-8格式
            //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
            
            if(is_dir($temp) && $fl!='.' && $fl != '..'){
                
                return read_all ($temp);
                
            }else{
                if($fl!='.' && $fl != '..'){
                   $filename .= $temp.",";
                   
                }
            }
        }
    }
   }
   return $filename;
}
function set($filename){
  $filename = trim($filename,",");
  $filename = explode(",",$filename);
  $path = array();
   for($s=0;$s<count($filename);$s++){
       $postfix = trim(strrchr($filename[$s],'.'),'.');
       $set = "txt,html,htm,doc,docx,php,js,css";

       if(stristr($set,$postfix)){
           $path[] = $filename[$s];   
        
       }
    
   }
   if(empty($path)){
    return 0;
   } 
   

   return $path;
}
 

?>