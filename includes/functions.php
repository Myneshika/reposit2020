<?php
// ***************  ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ *********************  //

$GLOBALS['name']=' ';
$GLOBALS['age']='15';
//***** multipliers множители характеристик ****// 
$GLOBALS['buy_stats']='100';
$GLOBALS['timer']=1440;




// ***********************************************************

function globals(){
   echo '<br> Глобальные переменные:';
    $array=$GLOBALS;
    foreach ($array as $key => $value) {
         echo '<br>[' . $key . '] ' . $value;
    }    
}
function test(){
	echo 'подключен файл functions.php';
}
/*Функция возвращает залогиненого пользователя из куки*/
function ret_owner(){
	return $_SESSION['logged_user']->login;
}
/* Функция выводит дату в формате 12.01.2001  */ 
 function do_date($date){
        $date = new DateTime($date);
        return $date->Format('d.m.Y');
                 
}
/* функция выводит собак по владельцу */
function ret_dogs_by_owner($owner){
    return R::getAssoc ('SELECT id,name,dna_id FROM animals WHERE owner =:owner and status=1', array(':owner' => $owner));
}

/*Функция возвращает id на dna*/
function ret_dna($id){
	 return R::getCell('SELECT dna_id FROM animals WHERE id = :id',
       [':id' => $id]);
}
/*Функция возвращает id на family*/
function ret_family($id){
	 return R::getCell('SELECT family_id FROM animals WHERE id = :id',
       [':id' => $id]);
}
/*Функция возвращает id на registry*/
function ret_reg($id){
	 return R::getCell('SELECT reg_id FROM animals WHERE id = :id',
       [':id' => $id]);
}
/*Функция возвращает id на оценку*/
function ret_mark($id){
	 return R::getCell('SELECT mark_id FROM animals WHERE id = :id',
       [':id' => $id]);
}

/*Функция возвращает id на mamy*/
function ret_mum($id){
    $data_mum = ret_f_data_by_dog($id);
    return $data_mum['mum'];
   
}
/*Функция возвращает id на папу*/
function ret_dad($id){
   $data_dad = ret_f_data_by_dog($id);
   return $data_dad['dad'];
    
}
function debug($arr){
    echo '<pre>' . print_r($arr, true). '</pre>';
}

/*Функция возвращает данные по id собаки из таблицы animals в стиле array*/
function data_animals($id){ //http://dog.ru/kennel.php

return R::getRow( 'SELECT * FROM animals WHERE id = :id',
     [':id' => $id]);

}

/*Функция создает электронную подпись 6 цыфр и записывает ее а поле sign в таблице users*/
function rand_sign($id){
	 $row = R::getRow( 'SELECT * FROM users WHERE id = :id',
       [':id' => $id]);
	
	while ($row['sign'] == $value=Rand(100000,999999))
	 {
	 	//echo 'одинаковые';  	
      }
      R::exec( 'UPDATE users SET sign=:sign WHERE id = :id ', array(':sign'=> $value, ':id' => $id));
      $row = R::getRow( 'SELECT * FROM users WHERE id = :id',
       [':id' => $id]);
      echo 'цифровая подпись: ' . $row['sign'];
}
/*Функция распечатывает все опции собак из таблицы*/
function print_all(){

	 $array = R::getAll( 'SELECT * FROM animals' );
       foreach($array as $item) {
              foreach ($item as $key => $value) {
                 echo " | " . "$value";
                }    
              echo "<br><br>";
            }
}
//  возвращает путь до иконки нужного предмета по ID
function ret_item($item_id){
  return ret_cell('icons',$item_id,'item');
}
//  рисует предмет и его количство
function print_item($login,$item_id){
 // echo $owner_id=get_id($login);

  ?><img src = "<?php echo ret_item($item_id);?>"> 
  <?php echo  print_money($login);
}




//************************ функции связанные со выставками    СОБАКИ **********************//
//функция печатает свидетельство об происхождении РКФ
function print_origin($id){
    if( 0!=ret_Cell('origin',$id,'animals') ){
     echo 'РКФ' ;
    }
 else {
    echo 'нет документов';    
    }
}

// Функция печатает оценку по id собаки
function print_mark($id){
    if(0!=ret_mark($id)){
     echo ret_Cell('namerus',ret_mark($id),'marks');
    }
 else {
    echo 'нет оценок';    
    }
}
//////////////////  Функция создания рандомного пола для собаки
function rand_sex(){
    return Rand(0,1);
}

/* функция возвращает пол собаки по ее id*/
function ret_sex($id){
   // $id_dna=ret_Cell('dna_id', $id, 'animals');
    
    //return ret_Cell('sex',$id_dna, 'randodna');
  return ret_Cell('sex',ret_Cell('dna_id',$id,'animals'),'randodna');
}

////////////////  пол буквами
function w_sex($id){
    $sex=ret_sex($id);
    if(0==$sex){
        return 'сука';
    }
    if(1==$sex){
        return 'кобель';
    }
    else{
        return 'стерильно';
    }
}
/*** функции по выводу на экран собак нужного ПОЛА SEX **************/


//функция дает суке течку при рождении
function get_estrus($id){
    $est = rand(12,15);
    //echo ret_sex($id);
    if( '0' == ret_sex($id)){
       insert_data('animals',$id, 'estrus', $est);
    }
}
//функция возвращает данные (стринг) когда следующая течка
function bdika_estrus($id){
    $est=ret_Cell('estrus', $id, 'animals');
    $array='';
  // echo 'в: ' . ret_age($id) . 'т: ' .$est . '<br>';
    if( '0' == ret_sex($id)){   //если собака сука
        ;
        if(ret_age($id) == $est){
           
            $array = 'у суки течка';
        }
        if(ret_age($id) < $est){
                     
          $age=ret_Cell('estrus', $id, 'animals');
          $age2=ret_Cell('age', $age, 'ages');
          $array = 'течка будет в: ' . $age2;
        }
        if (ret_age($id) > $est) {
            $est=$est+3;
            insert_data('animals',$id, 'estrus', $est);
             $age=ret_Cell('estrus', $id, 'animals');
          $age2=ret_Cell('age', $age, 'ages');
          $array= 'течка будет в: ' . $age2;
        
        }
         return $array;       
    }
      
}

//функция выводит картинку собаки по параметру сука / кобель
function maleFemale($id,$param_sex){
    $sex= ret_sex($id);
    $lit= ret_Cell('litter', $id,'animals');
    $pup=ret_cell('puppy', $id,'animals');
    $age= print_age($id);
    $age_norma=ret_cell('age_id',$id,'animals');
    $name=ret_Cell('name', $id, 'animals');
    if(($param_sex==$sex) && ('0'== $sex) && (13<$age_norma)){  //и старше 6 месяцев
          ?><td><a href="/name.php?id=<?php echo $id;?>"><img src="<?php echo bdika_url($id);?>" width="100px"> </a> <?php
   ?><div><?php
        echo '<br>имя: ' . $name;
         echo '<br> возраст ' . $age . '<br>';
          echo bdika_estrus($id);
         echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup . '</a>'; 
?></div><?php                
                
    }
    if(($param_sex==$sex) && ('1'== $sex) && (13<$age_norma)){
        ?><a href="/name.php?id=<?php echo $id;?>"><img src="<?php echo bdika_url($id);?>" width="100px"> </a> <?php
           ?><div><?php
         echo '<br>имя: ' . $name;
         echo '<br> возраст ' . $age;
         echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup . '</a>'; 
         ?></div><?php   
    }
    else return '-1';
       
}
//выводит функция id собаки по параметру dna_id
function ret_id_by_param($dna_id){  //4
   return R::getcell('SELECT id FROM animals WHERE dna_id =:dna_id', array(':dna_id'=> $dna_id));
    
}
//печатает картинку партнера размера 100 пикселей
function print_partner($test){
    dog_pic_size($test, 100);
    
}

function ret_dog_by_sex($owner,$param_sex){
    $data[] =  ret_dogs_by_owner($owner);
    // debug($data);
?>
  <table class="table">
      <tr>
          
<?php     foreach($data as $item) {
         $countf='0'; // считает количество столбиков не больше 4
        
         foreach ($item as $id => $value) {
             if('0'==$param_sex){
                If('4'>$countf){ //если еще не 4 столбика, вписываем  
 ?>
           <!-- <td> строка таблицы --> 
 <?php             
                 maleFemale($id,$param_sex);
                 $countf=$countf+1;
                 var_dump($countf);
                 
                }
                else{
                    ?></td></tr><?php
                    $countf=0;
                }
             }
         
             
             
         }    
     }
}


//******************************************** В О З Р А С Т  ****************************

function bdika_for_breed($id){
    $sex= ret_sex($id);
    $mark=ret_mark($id);
   // echo '<br> собака:' . $id;
   // echo '<br> пол:' . $sex;
    //echo '<br> оценка: ' . $mark;
    $error = false;
    $errort = '';
   if( '1' != ret_Cell('origin', $id, 'animals') ):
       $error = true;
       $errort = 'Не документов РКФ';
 
        elseif( $mark >2 || 0==$mark): //если  нет "хорошо" или "очень хорошо"
           $error = true;
            $errort = 'не получены положительные оценки';
   
        elseif( '1'==$sex )://кобель
   
            if( ret_age($id)<17 ):
                    $error = true;
                    $errort = 'кобель слишком молодой';
            else:
                $errort = 'Кобель готов к вязке';    
            endif;
        elseif(0==$sex): //сука
            if( ret_Cell('estrus', $id, 'animals')<15 ||  (ret_Cell('estrus', $id, 'animals'))!= ret_age($id) ):
                    $error = true;
                    $errort = 'сука не готова к вязке';
            elseif( ret_age($id)>58):
            $error = true;
            $errort = 'возраст суки превышен';
             elseif( ret_Cell('litter', $id,'animals')>7):
            $error = true;
            $errort = 'количество вязок уже 7';
            else:
                 $errort = 'Сука готова к вязке';    
            endif;
    else:
         echo 'Что-то пошло не так! ';
            
     endif;
     
    // if ($error) {
       //  echo '<br>' . $errort;
     //}
     return $errort;
}

// Функция проверяет возраст по id собаки и разрешает вязку для кобелейц и сук возвращает 0, если не может вязаться, возвращает 1, если 0(не может)
function bdika_age_for_breeding($data_dog){
  
  if ((13>$data_dog['age_id']) || (('сука' == $data_dog) && (58>=$data_dog['age_id'])) ){   //age_id = 13 (6 мес)  age_id = 58 (15 мес = 7/5 лет)

    echo "<br>Нет допуска для вязки, не проходит по возрасту";
    //var_dump(from_id_to_url_puppy($data_dog['id']));
    return 0;

  }
  else {
    
    //echo "<br>взрослая";
   //echo "Возраст подходитю для разведения , но ";
   return 1;
  }

}




// Функция возвращает возраст по id собаки полное название
function print_age($dog_id){
   $age_id = R::getCol( 'SELECT age_id FROM animals WHERE id = :id',[':id' => $dog_id]);  //получаем цыфру возраста из табл animals
      
    
   //var_dump($age_id);

    return ret_cell('age',$age_id[0],'ages'); // находим аналог(2 месяца) этой цыфры в таблице ages и выводим текст возраста
}
// Функция возвращает возраст по id 
function ret_age($id){
       return ret_cell('age_id',$id,'animals'); // находим аналог(2 месяца) этой цыфры в таблице ages и выводим текст возраста
}

// функция увеличивает возраст собаки
function add_age($dog_id){

   $age_id = R::getCol( 'SELECT age_id FROM animals WHERE id = :id',[':id' => $dog_id]); //получаем цыфру возраста из табл animals
     
     $age_id=$age_id[0] + '1';  //увеличивает на 1 пункт
    // echo '  $age_id ' . $age_id . '  $dog_id  ' . $dog_id;
     
     insert_data('animals',$dog_id,'age_id', $age_id);  //вставляем новые данные в таблицу по id 
   

}


/**************************** функция печатает на экран статы и ГП*************************/
function detalis($id){
    
    $data_dna= take_data_from(ret_dna($id), 'randodna');
    
?>
    <div align="left">
      
        <table width="100" cellpadding="2" cellspacing="0" border="1" >
              <colgroup width="150">
                  <colgroup span="9" align="center" width="10">
                  <col span="5">
                  <col span="4">
              </colgroup>
              <tr border="1"> 
                     <td>имя</td><td><b><?php echo ret_cell('name',$id,'animals'); ?></b></td>
                     <td>пол</td><td><b><?php echo w_sex($id);?></b></td>
              </tr>
              <tr border="1"> 
                     <td>Скорость</td><td><?php echo $data_dna['spd']; ?></td>
                     <td>вид</td><td><?php echo $data_dna['hr']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Уворот</td><td><?php echo $data_dna['agl']; ?></td>
                      <td>белый</td><td><?php echo $data_dna['ww']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Обучение</td><td><?php echo $data_dna['tch']; ?></td>
                     <td>рыжий</td><td><?php echo $data_dna['ff']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Прыжки</td><td><?php echo $data_dna['jmp']; ?></td>
                      <td>черный</td><td><?php echo $data_dna['bb']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Обоняние</td><td><?php echo $data_dna['nuh']; ?></td>
                     <td>пятна</td><td><?php echo $data_dna['mm']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Поиск</td><td><?php echo $data_dna['fnd']; ?></td>
                     <td>крап</td><td><?php echo $data_dna['tt']; ?></td>
              </tr>
              
              </colgroup>
        </table>
      </div>

<?php

}

/**************************** функции печатает на экран статы и ГП с подсветкой для новой собаки*************************/
/*************** проверка собака и родитель и возврат "зеленый" если 
 * статлы дучше, сем у родителей ****************/
function bdika_param($dog, $parent){
    if($dog>$parent){
        return 'green';
    }
    else
        return 'black';
    
}
/************ проверка родителей статы и вызов функции по проверка 
 * параметров, если статы собаки лучше , чем у родителя ****************/ 
function bdika_parent($id,$parent){
    
     $data_dna = take_data_from(ret_dna($id),'randodna');
        //debug($data_dna);
        $data_family= take_data_from(ret_family($id),'family');
      //debug($data_family);
        
        
    if('mum'==$parent){
      
    echo $parent_id_dna= ret_dna(ret_mum($id));
    debug($parent_id_dna);
   //echo '<br> мама: ' . ret_mum($id) . ' dna_id_ ' . $parent_id_dna;
    //echo '<br> $data_family[$parent] ' . $data_family[$parent];
    }
      if('dad'==$parent){
      
    $parent_id_dna= ret_dna(ret_dad($id));
    //echo '<br> мама: ' . ret_dad($id);
    }
   
    if(0!=$data_family[$parent]){
        //echo '<br> тут ';
       
        $data_parent= take_data_from($parent_id_dna,'randodna');
        //debug($data_parent);
        $col_spd= bdika_param($data_dna['spd'], $data_parent['spd']);
        $col_agl= bdika_param($data_dna['agl'], $data_parent['agl']);
        $col_tch= bdika_param($data_dna['tch'], $data_parent['tch']);
        $col_jmp= bdika_param($data_dna['jmp'], $data_parent['jmp']);
        $col_nuh= bdika_param($data_dna['nuh'], $data_parent['nuh']);
        $col_fnd= bdika_param($data_dna['fnd'], $data_parent['fnd']);
        
         return $data_col = array ($col_spd,$col_agl,$col_tch,$col_jmp,$col_nuh,$col_fnd);
        
        
    }
}       
 /***********  сравнение цвета у мамы и папы, слияние массива цвета   ****/   
function bdika_col ($arr1,$arr2){
    for($i=0;$i<count($arr1);$i++){
        if(('green' == $arr1[$i]) || ('green'==$arr2[$i]))
        $arr1[$i] = 'green';
    }
    return $arr1;
    
    
}
function detalis_green($id){
    
   $data_col = array_fill(0, 6, 'black'); 
    //debug($data_col);
    
    /****** данные Дна кода собаки  *///////////////
    $data_dna = take_data_from(ret_dna($id),'randodna');
    //debug($data_dna);
    $parent='mum';
    $array1=bdika_parent($id,$parent);  
    $parent='dad';
    $array2=bdika_parent($id,$parent);  
    
    
    //debug($array1);
    //debug($array2);
    $array3=bdika_col($array1,$array2);
    //debug($array3);
    
    

?>
<div align="left">
      
        <table width="100" cellpadding="2" cellspacing="0" border="1" >
              <colgroup width="150">
                  <colgroup span="9" align="center" width="10">
                  <col span="5">
                  <col span="4">
              </colgroup>
              <tr border="1"> 
                  <td>имя</td><td><b><?php echo ret_Cell('name', $id, 'animals'); ?></b></td>
                     <td>пол</td><td><b><?php echo w_sex($id);?></b></td>
              </tr>
              <tr border="1"> 
                     <td>Скорость</td><td><font color=<?php echo $array3[0];?>><?php echo $data_dna['spd'];?></font></td>
                     <td>вид</td><td><?php echo $data_dna['hr']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Уворот</td><td><font color=<?php echo $array3[1];?>><?php echo $data_dna['agl'];?></font></td>
                      <td>белый</td><td><?php echo $data_dna['ww']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Обучение</td><td><font color=<?php echo $array3[2];?>><?php echo $data_dna['tch'];?></font></td>
                     <td>рыжий</td><td><?php echo $data_dna['ff']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Прыжки</td><td><font color=<?php echo $array3[3];?>><?php echo $data_dna['jmp'];?></font></td>
                      <td>черный</td><td><?php echo $data_dna['bb']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Обоняние</td><td><font color=<?php echo $array3[4];?>><?php echo $data_dna['nuh']; ?></font></td>
                     <td>пятна</td><td><?php echo $data_dna['mm']; ?></td>
              </tr>
              <tr border="1"> 
                     <td>Поиск</td><td><font color=<?php echo $array3[5];?>><?php echo $data_dna['fnd']; ?></font></td>
                     <td>крап</td><td><?php echo $data_dna['tt']; ?></td>
              </tr>
              
              </colgroup>
        </table>
</div>
<?php
}
/**************************** функция печатает на экран дерево(родственников)*************************/
function f_tree($id){

    //find_where('animals', $id,'family_id');
    $data_dog= take_data_from($id, 'family');
    
   // echo '<br>Семья: ';
          echo '<hr>';
          echo 'мама: ' . $data_dog['mum'];
          echo '<br>дед: ' . $data_dog['g0dad'];
          echo '<br>бабка: ' . $data_dog['g0mum'];
          echo '<br>прадед(по деду): ' . $data_dog['gg0dad1'];
          echo '<br>прабабка(по деду): ' . $data_dog['gg0mum2'];
          echo '<br>прадед(по бабке): ' . $data_dog['gg0dad3'];
          echo '<br>прабабка(по бабке): ' . $data_dog['gg0mum4'];
          echo '<hr>';
          echo 'папа: ' . $data_dog['dad'];
           echo '<br>дед: ' . $data_dog['g1dad'];
          echo '<br>бабка: ' . $data_dog['g1mum'];
          echo '<br>прадед(по деду): ' . $data_dog['gg1dad1'];
          echo '<br>прабабка(по деду): ' . $data_dog['gg1mum2'];
          echo '<br>прадед(по бабке): ' . $data_dog['gg1dad3'];
          echo '<br>прабабка(по бабке): ' . $data_dog['gg1mum4'];
    
}

/*****************цена подсчета собаки*****************************/

function pricing($sex, $dog_id){  //пол собаки и ее id  / возвращает сумму в цифрах

//echo '<br>' . $dog_id;
//echo '<br>' . $sex;
$cost=0;

$array[]=R::getRow( 'SELECT * FROM dna WHERE dog_id = :dog_id',
       [':dog_id' => $dog_id]);
//debug($array);

  if('кобель'==$sex){
    //echo '<br>male';
    foreach($array as $item) {
          foreach ($item as $id => $value) {  //id индекс, value - значение 

        //  если индекс равен наименованию, напечатать его значение
             if('hr'==$id){    //hrhr-пух  Hrhr-голая
              //echo '<br>1' . $value;
                  if('Hrhr'==$value){
                    //echo ' Голый^ ';
                    $cost=35000;
                    foreach ($item as $id => $value) {  //id индекс, value - значение 

                            if('bb'==$id){  //если шоколадный голый
                              
                                if('bb'==$value){
                                    $cost=55000;
                                }
                            }
                    }

                   
                  }
                   if('hrhr'==$value){
                    //echo ' Пуховый^ ';
                    $cost=10000;
                    foreach ($item as $id => $value) {  //id индекс, value - значение 

                            if('bb'==$id){
                                if('bb'==$value){ //если шоколадный пух
                                    $cost=35000;
                                }
                            }
                    }
                  }

            } //if('hr'==$id)
           
      } //foreach ($item as $id => $value)
    

    }  //foreach($array as $item)
  } //if('кобель'==$sex)




  if('сука'==$sex){
    //echo '<br>famale';
        foreach($array as $item) {
          foreach ($item as $id => $value) {  //id индекс, value - значение 

        //  если индекс равен наименованию, напечатать его значение
             if('hr'==$id){    //hrhr-пух  Hrhr-голая
              //echo '<br>2' . $value;
                  if('Hrhr'==$value){
                   // echo ' Голый^ ';
                    $cost=45000;
                    foreach ($item as $id => $value) {  //id индекс, value - значение 

                            if('bb'==$id){  //если шоколадный голый
                              
                                if('bb'==$value){
                                    $cost=75000;
                                }
                            }
                    }

                   
                  }
                   if('hrhr'==$value){
                    //echo ' Пуховый^ ';
                    $cost=25000;
                    foreach ($item as $id => $value) {  //id индекс, value - значение 

                            if('bb'==$id){
                                if('bb'==$value){ //если шоколадный пух
                                    $cost=40000;
                                }
                            }
                    }
                  }

            } //if('hr'==$id)
           
      } //foreach ($item as $id => $value)
    

    }  //foreach($array as $item)
} //if('сука'==$sex)   
       
$mult=find_where('stats',$dog_id,'total');
echo $mult;
$mult=$mult*$GLOBALS['buy_stats'];

$cost=$cost+$mult;

return $cost;      

}

function bdika_balance($owner,$price){  //проверяет хватает ли денег если все ок возвращает TRUE
  //***************************  if(bdika_balance($owner,$price)) ОК  else echo 'не хватает денег'************************

  
  //echo '<br>' . $owner;
  //echo '<br>' . $price;

  //echo '<br>' . get_id($owner);

  //echo '<br>' . get_count('1', get_id($owner));   //выдает количество денег у юзера

  if($price>get_count('1', get_id($owner))){
    return false;
  }
  return true;

}




/***************получает сумму денег по имени владельца************/
function print_money($login){
   $id=get_id($login);
         $coins = get_count('1', $id);
         $coins=number_format ($coins , $decimals = 0 ,$dec_point = "." , $thousands_sep = " " ); //number_format — Форматирует число с разделением групп
         return $coins;
}

/***************увеличивает сумму денег  на сумму  $price************/
function put_money($owner,$price){
  $id=get_id($owner);
  $coins = get_count('1', $id);
  $coins = $coins + $price;

 R::exec( 'UPDATE owner_items SET count= :coins WHERE owner_id = :id AND item_id = :item', array(':coins' => $coins,':item'=> '1', ':id' => $id));
   

}

/***************уменьшает сумму денег  на сумму  $price ************/
function buying($owner,$price){
  $id=get_id($owner);

  //echo '<br>$owner ' . $owner;

  //number_format ($price , $decimals = 0,$dec_point = "." , $thousands_sep = " " ); // формат 10 000  
  //echo '<br>$price ' . $price;

 // echo '<br>get_id($owner) ' . get_id($owner);

  $money=get_count('1', $id);
  $money=$money-$price;
   
//echo '<br>$money ' . $money;
  //echo number_format ($money , $decimals = 0,$dec_point = "." , $thousands_sep = " " ); // формат 10 000 ;
 R::exec( 'UPDATE owner_items SET count= :coins WHERE owner_id = :id AND item_id = :item', array(':coins' => $money,':item'=> '1', ':id' => $id));



}
/*                                             *************************    данные по параметру                 */
 /*Функция возвращает данные противоположного пола при вязке*/
function get_where($tabl, $param, $owner){

    return R::getAssoc ('SELECT id,name FROM animals WHERE sex =:pol and owner=:own and status=1', array(':pol'=> $param, ':own' => $owner));

}
 /*Функция возвращает количество итемов у нанного владельца*/
function get_count($item, $owner_id){

    $string=R::getcol('SELECT count FROM owner_items WHERE owner_id =:id and item_id=:item', array(':id'=> $owner_id, ':item' => $item));
    //var_dump($string);
    if (empty($string)){
      $string[0]='0';
    }
    return $string[0];

}
function get_id($login){

    $string =R::getCol('SELECT id FROM users WHERE login = :log',
        [':log' => $login]);

   return $string[0];

}
/*Функция добавления количества вязок для папы и мамы*/
function add_litters($id_m,$id_d){

  (int)$lit_m=ret_Cell('litter',$id_m,'animals');
  (int)$lit_d= ret_Cell('litter',$id_d,'animals');
  $lit_m ++;
  $lit_d ++;

  //echo '<br>' . $lit_m;
 //echo '<br>' . $lit_d;
 insert_data('animals', $id_m, 'litter',$lit_m);
 insert_data('animals', $id_d, 'litter',$lit_d);
}
/*Функция добавления количества щенков для папы и мамы*/
function add_puppies($id_m,$id_d){

  (int)$pup_m=ret_Cell('puppy',$id_m,'animals');
  (int)$pup_d= ret_Cell('puppy',$id_d,'animals');
  $pup_m++;
  $pup_d++;
   //echo '<br>' . $pup_m;
 //echo '<br>' . $pup_d;
 insert_data('animals', $id_m, 'puppy',$pup_m);
 insert_data('animals', $id_d, 'puppy',$pup_d);
 
}



//************** функция выводит рандомный размер в зависимости от пола и  числа(роста)собаки *************//
 function wtht($sex,$height){
  echo 'wtht($sex)';

  if('кобель'==$sex){
    
    return find_where('male',$height,'wt');
  }
  if('сука'==$sex){
   
    return find_where('female',$height,'wt');
  }
  
 }
//********** функция выводит рандомное число в зависимости от пола*********//
 function wtht_rand($sex){
  if ('кобель'==$sex)
    $rand=Rand(28,33);
  if ('сука'==$sex)
    $rand=Rand(23,30);
  return $rand;

}







?>
<!-------------------<img src="<?php echo $_POST['url']?>" width="100%"> -----$_POST['url']= $anwer;---------->

 
 <?php

 /*                                *************************    РАСПЕЧАТКА Собаки на экране КАРТИНКА  */
 
  
 function bdika_url($id){

   $data_dog= take_data_from($id, 'animals');
   

  if (13>$data_dog['age_id']){   //age_id = 4 (6 мес)  age_id = 9 (15 мес = 1 год 3 мес)
      return  $data_dog['url_puppy'];
  }
  else
     return $data_dog['url'];
 }


 /*Функция печатает собаку  */

Function dog_pic($id){
   $url=bdika_url($id);
   ?><img src="<?php echo $url;?>"><?php
}
function dog_pic_mesh(){
    ?><img style="position:relative;left:-200px" src="pici/mesh.png"><?php
}
/*Функция печатает собаку  c заданным размером в% или пикселях + пишет имя во всплыв. окне*/
function dog_pic_size($id,$size){
    ?><img src="<?php echo bdika_url($id);?>" height="<?php echo $size?>"><?php
}
function pic_link($id,$size){
    ?><a href="/name.php?id=<?php echo $id?>">
        <img src="<?php echo bdika_url($id);?>" title="<?php echo ret_Cell('name', $id, 'animals')?> " width="<?php echo $size?>">
            </a><?php
}

/*Функция пишет тип собаки по русски в зависимоти от Генетического типа*/
function print_hr($id){
    
   ret_dna($id);
   $hr_val=take_data_from(ret_dna($id), 'randodna');
   //echo $hr_val['hr'];
   
    if ('Hrhr'==$hr_val['hr'])
        return 'голая';
    else
        return 'пуховая';
}
 /*Функция возвращает данные по собаке по ее ID*/
function print_all_d($id){
	
  $array =  R::getAll( 'SELECT * FROM animals WHERE id = :id',
        [':id' => $id]); 
	foreach($array as $item) {
              foreach ($item as $key => $value) {
                 echo " | " . " $value";
                }    
              echo "<br><br>";
            }
}
function print_stats_d($id){
  
  $array =  R::getAll( 'SELECT * FROM stats WHERE dog_id = :id',
        [':id' => $id]); 
  foreach($array as $item) {
              foreach ($item as $key => $value) {
                 echo " | " . "$value";
                }    
              echo "<br><br>";
            }
}

/*Функция возвращает название картинки в зависимости от пола собаки по ее ID*/
function ret_pic_sex($id){
    
        
    $sex=ret_sex($id);
	if(0==$sex){
		return '<img src = "/pic/female_mini.png">';
        }
	else{
		return '<img src = "/pic/male_mini.png">';
        }
                
}
/*  Функция дает ссылку на страничку lit/puppy*/
function print_lit_pup($id){
    
    $lit= ret_Cell('litter', $id,'animals');
    $pup=ret_cell('puppy', $id,'animals');
    $array='<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup. '</a>';
    echo $array;
}

//////////////////////// ///////////////////////////РАБОТА с DNA //////////////////


/*                                             *************************  рандомная собака  */
function f_rand_col($param, $param2, $param3){
	$num=Rand(1,3);
	if ( $num == 1)
		$col = $param;
	if ($num == 2)
		$col = $param2;
	else
		$col = $param3;
	return $col;
	
}
/*                                             *************************   рандомная пол собаки  */
function f_bdika_sex(){
	if(Rand(1,2)==1)
		$sex='1';   //кобелль
	else
		$sex='0';   //сука
	return $sex;

}
function do_dna($id){

 //$data_dna=R::getRow( 'SELECT * FROM dna WHERE dog_id = :id',
   //   [':id' => $id]);
     
    
   $dna_id=ret_dna($id);
     $data_dna=R::getRow( 'SELECT * FROM randodna WHERE id = :id',
        [':id' => $dna_id]);
     
 
   ('Hrhr'==$data_dna['hr'] ? $Hr='hr1' : $Hr='hr0');   //hr1 Hrhr - голая  // hr0 - hrhr  - пух
    ('ww'==$data_dna['ww'] ? $W='w0' : $W='w1');
    ('ff'==$data_dna['ff'] ? $F='f0' : $F='f1');
    ('bb'==$data_dna['bb'] ? $B='b0' : $B='b1');
    ('tt'==$data_dna['tt'] ? $T='t0' : $T='t1');
    ('mm'==$data_dna['mm'] ? $M='m0' : $M='m1');

    $dna=$Hr . $W . $F . $B . $T . $M;

    return $dna;  
/*  индексы в data_dna  hr0w0f1b0t0m1
[2] - 1пух/0гол  -hr0
[4] - 1белый/0нет-wo 
[6] - 1рыжий/0нет-f1
[8] - 1черный/0шоко  - b0
[10] - 1пятна есть/0 нету  - t0   TT
[12] - 1крап есть/0 нету  - m0   MM
*/

 }
 /*Функция ссылку на картинку  собаки,     pici/hrhr/hr0w0f1b0t0m1_01.png   */
Function do_url($data_dna){
  
    $num=Rand(1,5);  //количество варианций окраса собаки

      if(1 == $data_dna[2]){  //если собака голая
        if(1==$data_dna[10] && 1==$data_dna[12]){ //если и крап и пятна
          //echo 'ТМ';
          $data_dna[4]=0; //ww=0    собака не модет быть белой
          $data_dna[6]=0; //ff=0    собака не модет быть рыжей

          $url="pici/TM/" . $data_dna . '_0' . $num . '.png';
        }
        else if(1==$data_dna[12]){  //если крап
          //echo 'MM';
          $data_dna[4]=0; //ww=0    собака не модет быть белой
          $url="pici/MM/" . $data_dna . '_0' . $num . '.png';
        }
        else if(1==$data_dna[10]){  //если пятна
          //echo 'TT';
          $data_dna[4]=0; //ww=0    собака не модет быть белой
          $data_dna[6]=0; //ff=0    собака не модет быть рыжей
          $url="pici/TT/" . $data_dna . '_0' . $num . '.png';
        }
        else{   //если чистая собака

            $url="pici/" . $data_dna . '_0' . $num . '.png';

            
        }
      }
      if(0 == $data_dna[2]){  //если собака пуховая
          $data_dna[10]=0; //tt=0    собака нет крапа
          $num2=Rand(1,3);  //количество варианций окраса собаки
          if(1==$data_dna[4]){   //если собака бела пух, то нет пятен и крапа    
              $data_dna[6]=0; //ff=0    собака не модет быть рыжей
              $data_dna[12]=0; //mm=0    собака нет пятен
              
              $url="pici/hrhr/" . $data_dna . '_0' . $num2 . '.png';
          }
          else if(1==$data_dna[6]){   //если соабка рыжая
              $data_dna[4]=0;   //всегда не белая
              $data_dna[8]=0;   //всегда шоко
              
              $url="pici/hrhr/" . $data_dna . '_0' . $num2 . '.png';
          }   
          else
            
          $url="pici/hrhr/" . $data_dna . '_0' . $num2 . '.png';

      }



    return $url;  //получаем $URL
}

Function insert_url($id,$url){
  insert_data('animals',$id,'url', $url);  //вставляем новые данные в таблицу по id
}

 /*Функция вносит путь до картинки Щенка*/
function insert_url_puppy($dog_id){
   // $data_dog=take_data_from($dog_id, 'dna');
   $dna_id = ret_dna($dog_id);
    $data_dog=take_data_from($dna_id, 'randodna');
       $num=Rand(1,3);  //количество варианций окраса собаки

     // echo "<br>hr: " . $data_dog['hr'];
   // echo "<br>ww: " . $data_dog['ww'];
    // echo "<br>bb: " . $data_dog['bb'];
    //echo "<br>ff: " . $data_dog['ff'];
   // echo "<br>tt: " . $data_dog['tt'];
   // echo "<br>mm: " . $data_dog['mm'];

        if('hrhr'==$data_dog['hr']){   //если пух
          if('ww'==$data_dog['ww']){   //если не белый
                if( 'ff'==$data_dog['ff'] ){ //если не рыжий
                    if('bb'==$data_dog['bb'])  //если шоко
                      $dna='hr0b0';
                    if(('Bb'==$data_dog['bb']) || ('BB'==$data_dog['bb']))  //еcли черный
                      $dna='hr0b1';
                }
                if( ('Ff'==$data_dog['ff']) || ('FF'==$data_dog['ff']) ) //если рыжий
                  $dna='hr0f1';
          }      
          else    //если белый
          $dna='hr0w1';
        }
        if('Hrhr'==$data_dog['hr']){    //если голый
           if('ww'==$data_dog['ww']){   //если не белый
                if('ff'==$data_dog['ff']){ //если не рыжий
                    if('bb'==$data_dog['bb'])  //если шоко
                      $dna='hr1b0';
                    if( ('Bb'==$data_dog['bb']) || ('BB'==$data_dog['bb']))  //ечли черный
                      $dna='hr1b1';
                }
                if( ('Ff'==$data_dog['ff']) || ('FF'==$data_dog['ff']) ) //если рыжий
                    $dna='hr1f1';
            }
          else    //если белый
          $dna='hr1w1';
        }

      $url="pici/puppy/" . $dna . '_0' . $num . '.png';


      R::exec( 'UPDATE animals SET url_puppy=:url WHERE id = :id ', array(':url'=> $url, ':id' => $dog_id));

}


 /*Функция получаем номер собаки, возвращаем ее ГК     str($data_dna) hr1w0f0b0t1m1   */

 
 /*Функция вносит данные с таблицу Генетический код*/
function insert_new_dna($dog_id,$url_id,$hr,$ww, $ff,$bb,$mm,$tt,$aa){

   $dna = R::dispense( 'dna' );
    $dna->dog_id = $dog_id;
    $dna->url_id = $url_id;
    $dna->hr = $hr;
    $dna->ww = $ww;
    $dna->ff = $ff;
    $dna->bb = $bb;
    $dna->mm= $mm;
    $dna->tt = $tt;
    $dna->aa = $aa;

    $id = R::store( $dna );
    return $id;
}



/*      проверка если URL мамы = URL папы, т.е. собаки идентичные */
//                    

//function bdika_url_mum_dad($id){
////  $id_mum=find_where('animals',$id,'mum');
////  $id_dad=find_where('animals',$id,'dad');
////  $url_mum=find_where('animals',$id_mum,'url');
////  $url_dad=find_where('animals',$id_dad,'url');
////  echo '$url_mum ' . $url_mum . '<br>';
////  echo '$url_dad ' . $url_dad;
////  if($url_mum==$url_dad){     //если равны, то сразу вставляем данные
////    insert_data('animals',$id,'url',$url_mum);
////  }
////  else
////    return false;
//    
//   $f_id= find_where('animals', $id, 'family');
//    $data_family=take_data_from($id, 'family');
//    $id_mum=$data_family['mum'];
//    $id_dad=$data_family['dad']; 
//    $url_mum=find_where('animals',$id_mum,'url');
//    $url_dad=find_where('animals',$id_dad,'url');
//    echo '$url_mum ' . $url_mum . '<br>';
//    echo '$url_dad ' . $url_dad;
//    if($url_mum==$url_dad){     //если равны, то сразу вставляем данные
//        insert_data('animals',$id,'url',$url_mum);
//    }
//    else
//        return false;
//        
//
//}                                  

/////////////////////////////////////////  ВЯЗКА   /////////////////////////////////
function breeding($on,$ona,$temp, $temp2,$temp3){
//$on="TT";
//$ona="Tt";
//$temp="TT";
//$temp2="tt";
//$temp3="Tt";
$num=0;

	//echo "<br>код самца: $on <br>";
	//echo "код самки: $ona <br>";

	if ($on==$temp && $ona==$temp){	//AA
		//	echo 'Оба родителя ';
			$num=$on;
			return $num;
			die();
	}
	if($on==$temp2 && $ona==$temp2){	//аа
	//	echo 'Оба родителя ';
		$num=$ona;
		return $num;
		die();
	}
	if($on==$temp3 && $ona==$temp3){	//AaАа
		$num=rand(1,100);
	//	echo $num;
		if($num>1 && $num<50){
			$num=$on;
			return $num;
			die();
		}
		else{							//AA
			$num=rand(1,2);
		//	echo $num;
			if($num%2){
				$num=$temp;
				return $num;
				die();
			}
			else{						//aa
				$num=$temp2;
				return $num;
				die();
			}
		}
	}
	if($on==$temp3 && $ona==$temp2){	//Aa aa
		$num=rand(1,100);
	//	echo $num;
		if($num>=1 && $num<=50){
			$num=$on;
			return $num;
			die();
		}
		else{						//aa
				$num=$ona;
				return $num;
				die();
			}
	}
	if($on==$temp2 && $ona==$temp3){	//aa Aa
		$num=rand(1,100);
		//echo $num;
		if($num>1 && $num<50){		//aa
			$num=$ona;
			return $num;
			die();
		}
		else{						//Aa
				$num=$on;
				return $num;
				die();
			}
	}
	if($on==$temp && $ona==$temp3){	//AA Aa
		$num=rand(1,100);
		//echo $num;
		if($num>=1 && $num<=50){		//AA
			$num=$on;
			return $num;
			die();
		}
		else{						//aa
				$num=$ona;
				return $num;
				die();
			}
	}
	if($on==$temp3 && $ona==$temp){	//Aa AA
		$num=rand(1,100);
	//	echo $num;
		if($num>=1 && $num<=50){		//AA
			$num=$ona;
			return $num;
			die();
		}
		else{						//aa
				$num=$on;
				return $num;
				die();
			}
	}
	else{ 
		//echo 'разные';
		$num=$temp3;
		return $num;
		die();
	}
}

/*                                   *************************    данные Для бридинга готовой собаки**********  */
function Start($id_m,$id_d){
////////////////////////////////////////////////////////////////TT
//        данные из поля      TT  мамы
$dogs_m =  R::getAssoc('SELECT *  FROM animals WHERE id = :id',
        [':id' => $id_m]);  
foreach ($dogs_m as $dog) {

	$race_m=$dog['race'];
        $breeder_m=$dog['breeder'];
	$owner_m=$dog['owner'];
	$kennel_m=$dog['kennel'];
	$puppy=$dog['puppy'];
	
	$puppy += 1;
	/*величить кол-во вязок у мамы*/
	insert_data('animals',$id_m,'puppy',$puppy);
	
//echo '<br>предки мамы: ';
	
        $G0dad=$dog['dad'];   //отец матери для щенка дед
        $G0mum=$dog['mum'];    //мать матери для женка бабка
	$GG0dad1=$dog['g1dad'];
	$GG0mum2=$dog['g1mum'];
	$GG0dad3=$dog['g0dad'];	//прадед
	$GG0mum4=$dog['g0mum'];	//прабабка


	
}
//        данные из поля      TT  папы
$dogs_d =  R::getAssoc('SELECT *  FROM animals WHERE id = :id',
        [':id' => $id_d]);  
foreach ($dogs_d as $dog) {

	$puppy=$dog['puppy'];
	
	$puppy += 1;
	/*величить кол-во вязок у папы*/
	insert_data('animals',$id_d,'puppy',$puppy);
	
//echo '<br>предки папы: ';
	$G1dad=$dog['dad'];
	$G1mum=$dog['mum'];
	$GG1dad1=$dog['g1dad'];
	$GG1mum2=$dog['g1mum'];
	$GG1dad3=$dog['g0dad'];
	$GG1mum4=$dog['g0mum'];
	
}


//echo '<br> рандомный пол!';
$pol=f_bdika_sex();

$birth=date("d.m.Y");

//////////////////////////////////////////////////////////// обновление данных во всей таблице по столбцу

//Создаем объект (bean) работающий с таблицей dogs

//выставляем значение полей, тип поля будет автоматически модифицирован в зависимости от значения
$dogs=R::dispense( 'animals' );
//$dogs->name='';
$dogs->race=$race_m;
$dog->origin='1';
$dogs->breeder=$breeder_m;
$dogs->owner=$owner_m;
$dogs->kennel=$kennel_m;
$dogs->birth=$birth;
$dogs->now='0';


$dogs->sex=$pol;


$dogs->status='1';

echo '<br>создаем удачу!';
$lucky=Rand(1,100);

$dogs->lucky=$lucky;




//Сохраняем, первичный ключ id создается автоматически
$id = R::store( $dogs );

$id_temp=$id;
//======================================  Создаем данные из DNA ============================
echo '$id_m ' . $id_m;
$dogs_m =  R::getAssoc('SELECT * FROM dna WHERE dog_id = :id',
        [':id' => $id_m]);

debug($dogs_m);

foreach ($dogs_m as $dog) {

  echo $TT_m=$dog['tt'];
  echo $AA_m=$dog['aa'];
  echo $BB_m=$dog['bb'];
  echo $MM_m=$dog['mm'];
  echo $WW_m=$dog['ww'];
  echo $FF_m=$dog['ff'];
  echo $hr_ona=$dog['hr'];
}
echo '<br>';

echo '$id_d ' . $id_d;
$dogs_d =  R::getAssoc('SELECT *  FROM dna WHERE dog_id = :id',
        [':id' => $id_d]);

debug($dogs_d);

foreach ($dogs_d as $dog) {

  echo $TT_d=$dog['tt'];
  echo $AA_d=$dog['aa'];
  echo $BB_d=$dog['bb'];
  echo $MM_d=$dog['mm'];
  echo $WW_d=$dog['ww'];
  echo $FF_d=$dog['ff'];
  echo $hr_on=$dog['hr'];
}



//echo '=================';
$hr_new=gol_pooh($hr_on,$hr_ona);
//echo '=================';



echo '<br>даем окрас!';
$tt_new = breeding($TT_d,$TT_m,'TT','tt','Tt');
//echo "<br> tt_new: " . $tt_new;
$aa_new = breeding($AA_d,$AA_m,'AA','aa','Aa');
//echo "<br> aa_new: " . $aa_new;
$bb_new = breeding($BB_d,$BB_m,'BB','bb','Bb');
//echo "<br> bb_new: " . $bb_new;
$mm_new = breeding($MM_d,$MM_m,'MM','mm','Mm');
//echo "<br> mm_new: " . $mm_new;
$ww_new = breeding($WW_d,$WW_m,'WW','ww','Ww');
//echo "<br> ww_new: " . $ww_new;
$ff_new = breeding($FF_d,$FF_m,'FF','ff','Ff');
// "<br> ff_new: " . $ff_new;


echo '<br>создаем DNA';
$dogs=R::dispense( 'dna' );

$dogs->dog_id=$id_temp;
$dogs->aa=$aa_new;
$dogs->bb=$bb_new;
$dogs->ww=$ww_new;
$dogs->tt=$tt_new;
$dogs->mm=$mm_new;
$dogs->ff=$ff_new;
$dogs->hr=$hr_new;

//$url=bdika_color ($hr_new,$ww_new,$ff_new,$bb_new,$tt_new,$mm_new);


//$dogs->url_id=ret_id_from_url($url);

$id = R::store( $dogs );
insert_data('animals',$id_temp,'dna_id',$id); //вставлянем данные в поле на ссылку dna

echo '<br>создаем семеные узы';

$dogs=R::dispense( 'family' );
$dogs->id=$id_temp;
$dogs->mum=$id_m;
$dogs->dad=$id_d;


/*по линии отца */
$dogs->g1dad=$G1dad;
$dogs->g1mum=$G1mum;
$dogs->gg1dad1=$GG1dad1;
$dogs->gg1mum2=$GG1mum2;
$dogs->gg1dad3=$GG1dad3;
$dogs->gg1mum4=$GG1mum4;
/*по линии матери*/

$dogs->g0dad=$G0dad;
$dogs->g0mum=$G0mum;
$dogs->gg0dad1=$GG0dad1;
$dogs->gg0mum2=$GG0mum2;
$dogs->gg0dad3=$GG0dad3;
$dogs->gg0mum4=$GG0mum4;

$id=R::store( $dogs );

$id=$id_temp;


unset($dogs);

return $id;

}

///////////////////////  Работа с FAMILY СЕМЬЕЙ ////////////////

/*функция получает id собаки и возвращает данные по семье*/
function ret_f_data_by_dog($id){
    $f_id= ret_Cell('family_id', $id, 'animals'); //получаем id на фамилию
    return take_data_from($f_id, 'family'); //Получаем данные из семьи
}
/*проверяет партнера на родство и выводит степень родства*/
function ret_str_contact($partner,$dog){

    
    $f_data = ret_f_data_by_dog($dog); //функция возвращает данные по родственникам собаки
  if( $partner==$f_data['dad'] ){

      return ' отец!';
  }
  if( $partner==$f_data['mum'] ){

      return ' мать!';
  }
  if( ( $partner==$f_data['g1dad'] ) || ( $partner==$f_data['g0dad'] ) ){

      return ' дед!';
  }
  if( ( $partner==$f_data['g1mum'] ) || ( $partner==$f_data['g0mum'] ) ){

      return ' бабка!';
  }
  if( ( $partner==$f_data['gg0dad1'] ) || ( $partner==$f_data['gg0dad3'] ) || ( $partner==$f_data['gg1dad1'] ) || ( $partner==$f_data['gg1dad3'] )){

      return ' прадед!';
  }
  if( ( $partner==$f_data['gg0mum2'] ) || ( $partner==$f_data['gg1mum2'] ) || ( $partner==$f_data['gg0mum4'] ) || ( $partner==$f_data['gg1mum4'] )){

      return ' пробабка!';
  }
  else return '';
    
}
////////////////////////////  Работа с ТАБЛИЦЕЙ /////////////////////////

/*Функция вносит изменения имени собаки по ее Id*/
function insert_data($tabl,$id,$cell,$value){  //$tabl - название таблицы \\ $id-ай ди выбранного\\ $cell-названия столба\\ $value- значение
     R::exec( 'UPDATE ' .  $tabl . ' SET ' . $cell . '=:aa WHERE id = :id ', [
            ':aa'=> $value,
            ':id' => $id]);
    
}
/*Функция достает даннные собаки по ее Id из нужно таблицы*/
function take_data_from($id,$tabl){   //$id - индекс ; $tabl - таблица с данными
    
    $sql = 'SELECT * FROM ' . $tabl. ' WHERE id=' . $id; 
    return R::getRow($sql);
      
}

/*Функция достает даннные из заданного поля($cell) по ее Id из таблицы animals*/
function ret_id_by_cell($id, $cell){
    $sql = 'SELECT ' . $cell . ' FROM animals WHERE id=' . $id; 
    return R::getCell($sql);
}



/*Функция создает строку запроса и возвращает ее как тескт*/
function get_sql($id,$tabl){
    $sql = 'SELECT * FROM ' . $tabl . ' WHERE id=' . $id; 
    return $sql;
}


/*Функция возвращает данные по параметру $cell из таблицы $tabl по индексу $id*/
function ret_Cell($bdika,$id,$tabl){
    //if('animals'==$tabl){
    $array = R::getAssoc(get_sql($id,$tabl));
        foreach($array as $item) {
            foreach ($item as $key => $value) {
                if($key==$bdika){
                    return $item[$bdika];
                }
            }
        }
}

/*Функция возвращает данные из таблицы $tabl по индексу $id*/
function ret_Row($id,$tabl){
    
    return R::getRow(get_sql($id,$tabl));
    
}

/////////////////////////////// РАБОТА со СТАТАМИ ////////////////////////////
/*Функция вносит данные с таблицу статы*/
function insert_new_stats($id_new,$speed_new,$agility_new,$teach_new, $jump_new,$scent_new,$find_new,$total_new,$mutation){
  $total_new=number_format ($total_new , $decimals = 1 ,$dec_point = "." , $thousands_sep = " " );
   $stats = R::dispense( 'stats' );
    $stats->dog_id = $id_new;
    $stats->speed = $speed_new;
    $stats->agility = $agility_new;
    $stats->teach = $teach_new;
    $stats->jump = $jump_new;
    $stats->scent = $scent_new;
    $stats->find= $find_new;
    $stats->total = $total_new;
    $stats->mutation = $mutation;

    $id = R::store( $stats );
}

function insert_2_new_dogs($name,$sex,$race,$owner,$kennel,$birth,$url_id){

    $new = R::dispense('animals');
    $lucky=Rand(1,100);
    $new->lucky = $lucky;
    $new->name = $name;
    $new->sex = $sex;
    $new->race = $race;
    $new->breeder = $owner;
    $new->owner = $owner;
    $new->kennel = $kennel;
    $new->birth = $birth;
    $new->status = '1';
    $new->url = $url_id;

    $id = R::store( $new );
    return $id;

}

///////////////////////////////////////////// создание СОБАКИ //////////////////////////////////



/* Функция возвращает тип собаки Hrhr / hrhr  */

Function ret_hr($id){
    
    return ret_cell('hr',ret_dna($id),'randodna');
  
}
/* функция Создает данные по собаке    */ 

function greate_animal($id_m,$id_d){
           // echo '<br>function greate_animal';
    $dog_m= take_data_from($id_m,'animals');
    //$dog_d= take_data_from($id_d,'animals');
    
   
    $birth=date("d.m.Y");
//    debug($dog_m);
//    echo '<br>';
//    debug($dog_d);
    $dog_new=R::dispense('animals');        //создаем объект в таблицу
    $dog_new->name='';
    
    $dog_new->race=$dog_m['race'];
    $dog_new->origin='1';
   
    $dog_new->breeder=$dog_m['owner'];
    $dog_new->owner=$dog_m['owner'];
    $dog_new->kennel=$dog_m['kennel'];
    $dog_new->age_id='1'; //только родился малыш
    
    
    $dog_new->birth=$birth;
    $dog_new->status='1';
        
    $id=R::store($dog_new); //сохраняем данные первичный ключ создается автоматом $id Index #@Animal#@

//greate DNA
    $dna_id = greate_dna($id, $id_m, $id_d);
    //echo '<br> insert DNA_ID ' . $dna_id;
    insert_data('animals',$id,'dna_id',$dna_id); //вставлянем данные в поле на ссылку dna
    
    //добавление щенка родителям и вязки Family
    $family_id = greate_family($id, $id_m, $id_d);
    
   //echo '<br> insert_data Fasmily' . $id . ' '.$family_id;
    insert_data('animals',$id,'family_id',$family_id); //вставлянем данные в поле на ссылку family
    
    
 
    return $id; //возвращяем id новой собаки
}
//создаем family
function greate_family($id_new,$id_m,$id_d){
   // echo '<br>function greate_family';
    // echo '<br>new_dog: ' . $id_new;
     //echo '<br>id_m: ' . $id_m;
     //echo '<br>id_d: ' . $id_d;
  
        
    $dog_m = take_data_from(ret_family($id_m),'family');
    //debug($dog_m);
    $dog_d= take_data_from(ret_family($id_d),'family');
    //debug($dog_d);
    
    //  Проверить  $family_data=ret_f_data_by_dog($id_new);
    
    $dog_new=R::dispense('family');        //создаем объект в таблицу
    
        $dog_new->mum=$id_m;
        $dog_new->dad=$id_d;


        /*по линии матери*/
      //  echo '<br>предки мамы: ';
	
        $dog_new->g0dad=$dog_m['dad'];   //отец матери для щенка дед
        $dog_new->g0mum=$dog_m['mum'];    //мать матери для женка бабка
	$dog_new->gg0dad1=$dog_m['g1dad'];
	$dog_new->gg0mum2=$dog_m['g1mum'];
	$dog_new->gg0dad3=$dog_m['g0dad'];	//прадед
	$dog_new->gg0mum4=$dog_m['g0mum'];	//прабабка
        
         /*по линии отца */
       // echo '<br>предки папы: ';
	$dog_new->g1dad=$dog_d['dad'];
	$dog_new->g1mum=$dog_d['mum'];
	$dog_new->gg1dad1=$dog_d['g1dad'];
	$dog_new->gg1mum2=$dog_d['g1mum'];
	$dog_new->gg1dad3=$dog_d['g0dad'];
	$dog_new->gg1mum4=$dog_d['g0mum'];

    $id=R::store($dog_new); //сохраняем данные первичный ключ создается автоматом
       //echo '<br>END function greate_family';
   return $id;  //возвращает ID внести в таблицу animals
   
    
}
function bdika_mutation($id_m,$id_d){
    //echo '<br>function bdika_mutation';
    $temp =0; //нет мутации
    $num =Rand(1,100);   //шанс получения мутации
    $f_data_m = ret_f_data_by_dog($id_m);   //родственники по линии матери
    $f_data_d = ret_f_data_by_dog($id_d);   //родственники по линии отца

    ////////////////////////////////////////////////проверка самки и родни партнера
    
    if($f_data_m['id']==$f_data_d['mum']){  //самка и мать партнера 75% мутация
       // echo 'партнерша - мать';
        if($num>0 && $num<75){
            $temp=1;
        }
    }
     if( ($f_data_m['id']==$f_data_d['g1mum']) || ($f_data_m['id']==$f_data_d['g0mum']) ){  //самка и бабки партнера 50% мутация
        //echo 'партнерша - бабка';
        if($num>50 && $num<100){
            $temp=1;
        }
    }
    if( ($f_data_m['id']==$f_data_d['gg1mum2']) || ($f_data_m['id']==$f_data_d['gg0mum2']) || ($f_data_m['id']==$f_data_d['gg1mum4']) || ($f_data_m['id']==$f_data_d['gg0mum4']) ){
        //самка и пробабки партнера 25% мутация
        //echo 'партнерша - пробабка';
        if($num>0 && $num<25){
            $temp=1;
        }
    }
    
       /////////////////////////////////////////////проверка самца и родни партнера
    if($f_data_d['id']==$f_data_m['dad']){  //самец и отец партнерши 75%
       // echo 'партнер - отец';
        if($num>0 && $num<75){
            $temp=1;
        }
    }
     if( ($f_data_d['id']==$f_data_m['g1dad']) || ($f_data_d['id']==$f_data_m['g0dad']) ){
         //самец и деды партнерши 50%
        //echo 'партнер - дед';
        if($num>50 && $num<100){
            $temp=1;
        }
    }
    if( ($f_data_d['id']==$f_data_m['gg1dad1']) || ($f_data_d['id']==$f_data_m['gg0dad1']) || ($f_data_d['id']==$f_data_m['gg1dad3']) || ($f_data_d['id']==$f_data_m['gg0dad3']) ){
        //самец и прадеды партнерши 25%
       // echo 'партнер прадед';
        if($num>0 && $num<25){
            $temp=1;    //если прошла мутация
        }
    }
    return $temp;
}
/**********************  Рандомный подсчет стат в зависимости от мутаций и родителей***************/
function get_stats($param_m,$param_d,$mutation,$plus){
       // echo '<br> function get_stats';
        $temp=0;
        
        $temp=($param_m+$param_d)/2;
       // echo '<br> m: ' .  $param_m . ' +d:' . $param_d . ' = ' . $temp;
        if(1==$plus){
          $temp=$temp+($temp*$mutation/100);
        }
        if(0==$plus){
          $temp=$temp-($temp*$mutation/100);
        }
       
        $temp = number_format ($temp , $decimals = 2 ,$dec_point = "." , $thousands_sep = " " );

        return $temp;
}
//создаем DNA
function greate_dna($id_new,$id_m,$id_d){
    
  //  echo '<br>function greate_dna';
    $dna_m= take_data_from(ret_dna($id_m),'randodna');
    //debug($dna_m);
    $dna_d= take_data_from(ret_dna($id_d),'randodna');
   // debug($dna_d);
    
    
   // echo '<br>даем окрас!';
    $tt = breeding($dna_m['tt'],$dna_d['tt'],'TT','tt','Tt');
    $bb = breeding($dna_m['bb'],$dna_d['bb'],'BB','bb','Bb');
    $mm = breeding($dna_m['mm'],$dna_d['mm'],'MM','mm','Mm');
    $ww = breeding($dna_m['ww'],$dna_d['ww'],'WW','ww','Ww');
    $ff = breeding($dna_m['ff'],$dna_d['ff'],'FF','ff','Ff');
    

    
  $hr_on = $dna_m['hr'];
  $hr_ona = $dna_d['hr'];
            

    $hr=gol_pooh($hr_on,$hr_ona);
    
    $dna = R::dispense( 'randodna' );
    
    $dna->hr = $hr;
    $dna->ww = $ww;
    $dna->ff = $ff;
    $dna->bb = $bb;
    $dna->mm= $mm;
    $dna->tt = $tt;
    
    // echo '<br> рандомный пол!';
    $pol=f_bdika_sex();
 
 //echo '<br>создаем удачу!';
    $lucky=Rand(1,100);   
    
    $dna->sex = $pol;
    $dna->lucky = $lucky;
   
         //////////////////////////////   новые статы    
   $plus= bdika_mutation($id_m, $id_d);
   $mutation=Rand(1,100)/100;
    $spd=get_stats($dna_m['spd'],$dna_d['spd'],$mutation,$plus);
    $agl=get_stats($dna_m['agl'],$dna_d['agl'],$mutation,$plus);
    $tch=get_stats($dna_m['tch'],$dna_d['tch'],$mutation,$plus);
    $jmp=get_stats($dna_m['jmp'],$dna_d['jmp'],$mutation,$plus);
    $nuh=get_stats($dna_m['nuh'],$dna_d['nuh'],$mutation,$plus);
    $fnd=get_stats($dna_m['fnd'],$dna_d['fnd'],$mutation,$plus);
    
    $dna->spd=$spd;
    $dna->agl=$agl;
    $dna->tch=$tch;
    $dna->jmp=$jmp;
    $dna->nuh=$nuh;
    $dna->fnd=$fnd;
    $dna->mut=$mutation;
      
    
            
    $dna->about = 'owner';
    $id = R::store( $dna );
    
    $data_dna= do_dna($id_new);
    //debug($data_dna);
    
    //
    
    return $id;
}



/*Функция считает голая или пух в зависимоти от родителей*/
function gol_pooh($on,$ona){
	//Hrhr - голый
	//hrhr - пух
	
	$temp='hrhr';
	if('hrhr'==$on){			//он пух
		if('hrhr'==$ona) return $ona;	//она пух= малыш пух
		else {							//она голая
			$num=Rand(1,2);
			if(1==$num) return $ona;	//шанс 50% на 50%
			else return $on;
		}
	}
	if('Hrhr'==$on){			//он голый
		if('Hrhr'==$ona){	//она Голая
			$num=Rand(1,3);
			//ECHO $num;
			//echo $ona;
			if(1==$num || 2==$num){
			 return $ona; //шанс 75% голый 25% пух
			}
			if(3==$num){
			 return $temp; // 25% пух
			}
			
		}
		else {							//она пух
			$num=Rand(1,2);
			if(1==$num) return $ona;		//шанс 50% на 50%
			else return $on;
		}
	}

}

/**********************  Регистрационная книга ***************/
/*функция возвращае данные по помету*/
function do_do($reg_id){
     $arr = R::getAssoc( 'SELECT id,name FROM animals WHERE reg_id = :id',[':id' => $reg_id]);  
  //debug($arr); 
  $newAr=array_keys($arr);
   foreach ($newAr as $key => $value){
           //echo '<br>' . $newAr[$key] . ' '  . 
           echo ret_Cell('name', $newAr[$key], 'animals');
           //$url=ret_Cell('url_puppy', $newAr[$key], 'animals');
           pic_link($newAr[$key],100);
          
   } 
}

/******************* ВНЕСЕНИЕ В табл REGISTRY   ************************/
/*ФУНКЦИЯ проверяет последнюю будку помета и увеличивает ее на 1*/

function add_lit($id){
    $lit=ret_Cell('lit', $id, 'registry');
//echo $lit=$litt++;
if('z'==$lit){ //если конец алфавита, начинаем с начала
    $lit='a';
    return $lit;
    //break;
}
$array[]=range('a', 'z');

foreach($array as $item) {
     foreach ($item as $key => $value) {
        if($lit==$value){
           echo $key;
           $key++;
           $lit=$item[$key];
           return $lit;
           break;
        }
        
    }
}
}

function insert_reg($id_m,$id_d){

//$res = R::exec("INSERT INTO book (title, author, price) VALUES (?,?,?)", ['New Book', 'New Author', 10]);
$date= date("Y-m-d");    
$datebirth=Rand(55,70);
$count=Rand(1,3);
$count45=$count;
$female=Rand(0,$count);
$male=$count-$female;

    
    // Указываем, что будем работать с таблицей book
$book = R::dispense('registry');
// Заполняем объект свойствами
$book->date = $date;
$book->mum = $id_m;
$book->dad = $id_d;

$book->datebirth = $datebirth;
$book->count = $count;
$book->count45 = $count45;
$book->female = $female;
$book->male = $male;
$book->tatoo = 0;
// Сохраняем объект
R::store($book);
$id = R::getInsertID();
$id--;
//$lit=ret_Cell('lit', $id, 'registry');
$lit=add_lit($id);
$id++;
insert_data('registry', $id, 'lit', $lit);
}