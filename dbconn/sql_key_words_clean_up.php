<?php
/*
   清除SQL关键字,防注入类
   PHP万能钥匙 'or 1=1 or 1=1 or'
*/
   class sqlin {

      function dowith_sql($str){
         $str = str_replace("and","",$str);
         $str = str_replace("execute","",$str);
         $str = str_replace("update","",$str);
         $str = str_replace("count","",$str);
         $str = str_replace("chr","",$str);
         $str = str_replace("mid","",$str);
         $str = str_replace("master","",$str);
         $str = str_replace("truncate","",$str);
         $str = str_replace("char","",$str);
         $str = str_replace("declare","",$str);
         $str = str_replace("select","",$str);
         $str = str_replace("create","",$str);
         $str = str_replace("delete","",$str);
         $str = str_replace("insert","",$str);
         $str = str_replace("'","",$str);
         $str = str_replace('"',"",$str);
         $str = str_replace(" ","",$str);
         $str = str_replace("or","",$str);
         $str = str_replace("=","",$str);
         $str = str_replace("%20","",$str);
         return $str;
      }

      function sqlin(){
         foreach ($_GET as $key=>$value)
         {
             $_GET[$key]=$this->dowith_sql($value);
         }
         foreach ($_POST as $key=>$value)
         {
             $_POST[$key]=$this->dowith_sql($value);
         }
      }

   }

   $dbsql=new sqlin();

?>