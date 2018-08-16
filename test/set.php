<?php
$name = $_POST["fn"];
//var_dump($before);
// echo count($before);
if(file_exists($name)){
    $filename = read_all ($name);
   // var_dump($filename);
    $path = set ($filename);
    // echo $path[0];
    if($path){
    }
    else{
        echo "3";
        // echo "<>文件格式不符"."<br>"."文件格式应为".$set."中之一";
        
    }



}
else{
    echo "2";
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
                
                $filename .= read_all ($temp);
                
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