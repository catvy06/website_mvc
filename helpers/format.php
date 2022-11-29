<?php

// Format Class
class Format{

    // định dạng ngày 
    public function formatDate($data){
        return date('Fj,Y,g:i a',strtotime($data));
    }

    //rút gọn văn bản
    public function textShorten($text,$limit=400){
    $text=$text." ";
    $text=substr($text,0,$limit);
    $text=substr($text,0,strrpos($text,''));
    $text=$text.".....";
    return $text;
    }

    //Thẩm định văn bản
    public function validation($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    //tiêu đề
    public function title(){
        $path=$_SERVER['SCRIPT_FIENAME'];
        $title=basename($path,'.php');
        $title=str_replace('_','',$title);
        if($title=='index'){
            $title='home';
        }
        elseif($title=='contact'){
            $title='contact';
        }
        return $title=ucfirst($title);
    }

}



?>