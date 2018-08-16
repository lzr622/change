<?php
 /*
 3 * 遍历文件夹下所有文件
 4 * 
 5 * 作者：郭猛
 6 * 邮箱：martin.guo@qq.com
 7 *
 8 */
 header("content-type:text/html; charset= utf-8");
 function read_all ($dir){
     if(!is_dir($dir)) {
        $path = $dir;
     }
     else{
     $handle = opendir($dir);
     $i = 0;
     if($handle){
         
         while(($fl = readdir($handle)) !== false){
             $temp = iconv('GBK','utf-8',$dir.DIRECTORY_SEPARATOR.$fl);//转换成f-8格式
             //如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
             if(is_dir($temp) && $fl!='.' && $fl != '..'){
                 echo '目录：'.$temp.'<br>';
                 read_all($temp);
             }else{
                 if($fl!='.' && $fl != '..'){
                    $filename .= $temp.",";
                    
                    echo $filename."<br>";
                    
                    $i++; 
                    
                 }
             }
         }
     }
    }
    $filename = trim($filename,",");
    $filename = explode(",",$filename);
    $a = 0;
    for($s=0;$s<count($filename);$s++){
        $postfix = trim(strrchr($filename[$s],'.'),'.');
        $set = "txt,html,htm,doc,docx,php,js,css";
        if(stristr($set,$postfix)){
            $path[$a] = $filename[$s];
            $a++;
            
        }
     
    }
    return $path;
    }
 
 read_all('E:\test');
 
 ?>