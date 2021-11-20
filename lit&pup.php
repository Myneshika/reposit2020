<?php
//require_once(__DIR__ . '/libs/up.php');
//подключение библиотеки redBeanphp
require $_SERVER['DOCUMENT_ROOT']."/db.php";
//подключение шапки
require_once(__DIR__ . '/html/header.html');
require_once(__DIR__ . '/includes/func.php');
//включение ошибок//включение отчета по ошибкам
ini_set('display_errors',1);
error_reporting(E_ALL);


      function regbook_mum($id){
        return  $array = R::getAssoc('SELECT * FROM registry WHERE mum= :id ORDER BY date DESC', [':id' => $id]);
    }
    function regbook_dad($id){
        return  $array = R::getAssoc('SELECT * FROM registry WHERE dad= :id ORDER BY date DESC', [':id' => $id]);
    }
    function ret_count($id){
        if(1==ret_Cell('female',$id,'registry')){
            echo '<br>девочек:' . ret_Cell('female',$id,'registry');
        }
        if(1==ret_Cell('male',$id,'registry')){
            echo '<br>мальчиков: ' . ret_Cell('male',$id,'registry');
        }
    }
    
    
      $id = $_GET['id']; 
      $data_dog=ret_Row($id, 'animals');
      if(0==ret_sex($id)){
          $array = regbook_mum($id);
      }
        else {
          $array = regbook_dad($id);
        }
  
    $newAr=array_keys($array);  //возвращает ключи
   // print_r($newAr);
    //echo count($newAr);  //количество сторв массиве
   //for($i=0;$i<count($newAr);$i++){
       //foreach ($array as $key => $value){
          // echo '<br>' . $array[$key]['lit'];
           //echo '<br>' . $array[$key]['date'];
        
        //}  
      
?>
    <p class="kennel"><?php echo "<br>Питомник: " . '"' . $data_dog['kennel'] . '"';
    echo "<br>Заводчик: " . $data_dog['breeder'];
    echo "<br>Владелец: " . $data_dog['owner'];

/*печать данных*/
  //echo '<br>Вязок: ' .  $data_dog['litter'];
 //echo '<br>Щенков: ' .  $data_dog['puppy'] . '<br>';

    if($array): //если есть данные по пометам, то выводим текст
        foreach ($array as $key => $value){?>
            <table width="100%" align="center" cellpadding="0" cellspacing="0" class="main_text" border="0">
            <caption><h1>Помет "<?php echo $array[$key]['lit'];?>"</h1></caption>
            <tbody><tr><td width="40%" align="center" valign="top">
                        отец: <br><br><strong><?php echo ret_cell('name',$array[$key]['dad'],'animals');?></strong> <br>
                        <?php print_lit_pup($array[$key]['dad']);?>
                        <br>оценка: <font color="#569ff6"><strong><?php print_mark($array[$key]['dad'])?></strong></font>
                        </td> 
                        <td width="20%" align="center" valign="middle"></td>
                        <td width="40%" align="center" valign="top">
                         мать: <br><br><strong><?php echo ret_cell('name',$array[$key]['mum'],'animals');?></strong><br>
                         <?php print_lit_pup($array[$key]['mum']);?>
                        <br>оценка: <font color="#569ff6"> <strong><?php print_mark($array[$key]['mum'])?><br></strong></font>
                        </td>
                    </tr> 

                    <tr><td colspan="3" height="10"></td></tr>
                    <tr><td width="40%" align="center" valign="top">
                            <?php pic_link($array[$key]['dad'], 155); //картинка папы?>
                        </td>
                        <td width="20%" align="center" valign="middle"><br><br><strong>
                            дата рождения:</strong><br><?php echo do_date($array[$key]['date']);?>
                            <br><br><?php ret_count($key); //выводит количество рожденных девочек и мальчиков?> <br><br>
                        </td>
                        
                        <td width="40%" align="center" valign="top">
                            <?php pic_link($array[$key]['mum'], 155);//картинка мамы?>
                        </td>
            </tr></tbody></table>

                       
            <table width="90%" align="center" cellpadding="0" cellspacing="0" class="main_text" border="0">
            <caption><h2 align="center">Щенки из этого помета: </h2> </caption>
            <tbody><tr><td width="33%" align="center" valign="top">
                       <?php do_do($key); ?>
                       </td>
                    </tr>

            </tbody></table>
                    <hr>
        <?php  } //end foreach
    Endif?>      
   
      </div>
</div>
        
    <!-- --------------------------------------  class="right_sidebar"  ----------------------------- -->   

<div class="right_sidebar" >
        <!-- ******************** кнопка вязка справа  *****************--> 

   <form method="POST">
      
     
      <a class="buttons" <?php echo '<a href="/name.php?id=' . $id . '">'?>назад</a>
                           
    </form>

</div class="right_sidebar" >

   
