<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<link rel="stylesheet" type="text/css" href="css/main.css" />
<style>
.table {
	width: 100%;
	margin-bottom: 10px;
	border: 3px solid #F2F8F8;
	border-top: 5px solid #F2F8F8;
	border-collapse: collapse; 
        color: silver;
}
.table th {
	font-weight: bold;
	padding: 5px;
	background: #F2F8F8;
	border: none;
	border-bottom: 5px solid #F2F8F8;
}
.table td {
	padding: 5px;
	border: none;
	border-bottom: 5px solid #F2F8F8;
}
</style>
<?php
  /*                                *************************   СОЗДАНИЕ НОВОЙ СОБАКИ */
Class GreateNewDog{
    
    /* функция создает ДНК для щенка в зависимости от предков возвращает hr0w0f0b0t0m0*/
    public function DoDnaMumDad($mum,$dad) {
    $array1 = $mum;
    $array2 = $dad;
//echo '$array1 ' . $array1 = 'hr0w0f0b0t0m0';
//echo '<br>$array2 ' . $array2 = 'hr1w1f1b1t1m1';
echo '<br>$array3 ' . $array3 = 'hr0w0f0b0t0m0';
    $num = 0;

    for($i = 2; $i < strlen($array1); $i+=2){ // прогоняет первый стринг
        if(($array1[$i] == $array2[$i]) AND ($array1[$i] == 0)){ //hr0 == hr0  100% будет 0
            echo '<br>1 вариант == 0 ';
            $array3[$i] = 0;

            echo '<br>0: ' . $array3;
        }
        if(($array1[$i] == $array2[$i]) AND ($array1[$i] == 1)){ //hr1 == hr1  100% будет 75% - 1, 25% - 0
            echo '<br>2 вариант == 1 ';
            echo '<br>num' . $num = Rand(1,4);   //1 - 25%
            if( 1 == $num ){    //0 - 25%
                 $array3[$i] = 0;
            }
            else{   //1 - 75%
                $array3[$i] = 1;
            }
          echo '<br>1: ' . $array3;  
         }
         if($array1[$i] != $array2[$i]){ // если hr1 -50% hr0 - 50%    hr1 - 75%  hr0 -25%
             echo '<br>3-тий вариант не равны ';
             echo '<br>num' . $num = Rand(1,4);   //1 - 25%
             if( 1 == $num ){    //0 - 25%
                 echo ' 25% - 0 ';
                  $array3[$i] = 0;
             }
             if ( 3 == $num){ //1 - 75%
                 echo ' 75% - 1 ';
                 $array3[$i] = 1;
             }
             else{ // 2,3 - 50%
                  echo '<br>num' . $num = Rand(1,2);   //1 - 50% , 0 - 50%
                  echo ' 2,3 - 50%  = 1';
                   if( 1 == $num ){ //50%
                       $array3[$i] = 1;
                   }
                   else{
                       echo ' 2,3 - 50%  = 0';
                       $array3[$i] = 0;
                   }

             }

        }
    }
    return $array3;
}
    /* Заполнение данными ДНК+статы*/
    public function InsertDogDna($id_m,$id_d,$puppy_dna) {
        
        $mat = new Matting();
        $dna = new Dna();
        $rand = new RandDog();
        $plus =  $mat->bdikaMutation($id_m, $id_d);
        $mutation=Rand(1,100)/100;
        $dna_m = $dna->retAllDna($id_m);
        $dna_d = $dna->retAllDna($id_d);
        $sex = Rand(0,1);  
        $lucky = Rand(1,100);
        $url = $rand->doUrl($puppy_dna);
        $url_puppy = $rand->DoUrlPuppy($url);
        
        $bean = R::dispense('randodna');
       
        
         $bean->sex = $sex;
         $bean->lucky = $lucky;
         $bean->spd = $this->StatsFromMumDad($dna_m['spd'],$dna_d['spd'],$mutation,$plus);
         $bean->agl = $this->StatsFromMumDad($dna_m['agl'],$dna_d['agl'],$mutation,$plus);
         $bean->tch = $this->StatsFromMumDad($dna_m['spd'],$dna_d['tch'],$mutation,$plus);
         $bean->jmp = $this->StatsFromMumDad($dna_m['spd'],$dna_d['jmp'],$mutation,$plus);
         $bean->nuh = $this->StatsFromMumDad($dna_m['spd'],$dna_d['nuh'],$mutation,$plus);
         $bean->fnd = $this->StatsFromMumDad($dna_m['spd'],$dna_d['fnd'],$mutation,$plus);
         $bean->mut = $mutation*100;
         $bean->dna = $puppy_dna;
         $bean->about = 'owner';
         $bean->url = $url;
         $bean->url_puppy = $url_puppy;
         
        // debug($bean);
            
                  
        return R::store($bean);
        
    }
    /**********************  Рандомный подсчет стат в зависимости от мутаций и родителей***************/
    public function StatsFromMumDad($param_m,$param_d,$mutation,$plus){
        
       $temp = 0;       
        $temp=($param_m+$param_d)/2;
       echo '<br> m: ' .  $param_m . ' +d:' . $param_d . ' = ' . $temp;
        if(1==$plus){
          $temp=$temp+($temp*$mutation/100);
        }
        if(0==$plus){
          $temp=$temp-($temp*$mutation/100);
        }
       
        $temp = number_format ($temp , $decimals = 2 ,$dec_point = "." , $thousands_sep = " " );

        return $temp;

    }     
    
   public function retDna($id) {
        return R::getCell('SELECT dna FROM randodna WHERE id = ? LIMIT 1', [$id]);
    } 
   
   public function insertDogAnimals($owner,$dna_id){
       echo '<br> insertDogAnimals($owner,$dna_id)';
    $kennel=R::getCell('SELECT `name_k` FROM `kennels` WHERE `owner_k` = ? LIMIT 1', [$owner]);
    $sex = R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
    
    $date=date('d.m.Y');
    $dogs = R::dispense('animals');
     $dogs->name='Без имени';
     $dogs->race='КХС';
     $dogs->origin='1';
     $dogs->breeder='Бесты-первый лучший';
     $dogs->owner=$owner;
     $dogs->kennel=$kennel;
     $dogs->age_id=13;
     $dogs->dna_id=$dna_id;
     $dogs->family_id=0;
     $dogs->mark_id=1; //отлично оценка
     $dogs->birth=$date;
     
     // установить течку у суки
     if(0 == $sex){
         $dogs->estrus = 14;
     }
     
     //debug($dogs);
     /*сохраняем id новой собаки*/
     $id_new_dog1 = R::store($dogs);
     
    return $id_new_dog1;
 
    }
    public function insertDogFamilyTree($id){
        
    $dog22 = R::dispense('family');
        foreach ($dog22 as $key) {
            if($key!='id'){
                $dog22->$key=0;  //вносим всех предков по нулям
            }
        }     
        
   $family_id2 = R::store($dog22);  
    
    /* созраняем данные о семье в таблице animals*/
    $book = R::load('animals', $id);
    $book->family_id = $family_id2;
    return R::store($book);
    
    }
    public function insertNewPuppyFamilyTree($id_m,$id_d) {
        echo '<br> insertNewPuppyFamilyTree($id_m,$id_d)';
        $fam = new Family();
        
        $puppy = R::dispense( 'family' );
        
        $puppy->mum = $id_m;
        $puppy->dad = $id_d;
        $puppy->g1dad = $fam->retDad($id_d);
        $puppy->g1mum = $fam->retMum($id_d);
        $puppy->g0dad = $fam->retDad($id_m);
        $puppy->g0mum = $fam->retMum($id_m);
        $puppy->gg1dad1 = $fam->retG1Dad($id_d);
        $puppy->gg1mum2 = $fam->retG1Mum($id_d);
        $puppy->gg1dad3 = $fam->retG0Dad($id_d);
        $puppy->gg1mum4 = $fam->retG0Mum($id_d);
        $puppy->gg0dad1 = $fam->retG1Dad($id_m);
        $puppy->gg0mum2 = $fam->retG1Mum($id_m);
        $puppy->gg0dad3 = $fam->retG0Dad($id_m);
        $puppy->gg0mum4 = $fam->retG0Mum($id_m);
        
        return R::store($puppy);
        
    }
    public function addPupAndLit($id_m,$id_d,$count_puppy) {
        $dog = new Dog();
        $tabl = new Tabl();
        $mum_pup = $dog->retPuppy($id_m);
        $dad_pup = $dog->retPuppy($id_d);   
        $mum_lit = $dog->retLitter($id_m);
        $dad_lit = $dog->retLitter($id_d);
        
        //echo '<br>mumPup ' . ++$mum_pup;
        $tabl->UpdateData('animals', $id_m, 'puppy', $mum_pup+=$count_puppy);
        $tabl->UpdateData('animals', $id_d, 'puppy', $dad_pup+=$count_puppy);
        $tabl->UpdateData('animals', $id_m, 'litter', ++$mum_lit);
        $tabl->UpdateData('animals', $id_d, 'litter', ++$dad_lit);
        
        echo '<br>mumPup ' . $mum_pup = $dog->retPuppy($id_m);
        echo '<br>dadPup ' . $dad_pup = $dog->retPuppy($id_d);   
        echo '<br>mumLit ' . $mum_lit = $dog->retLitter($id_m);
        echo '<br>dadLit ' . $dad_lit = $dog->retLitter($id_d);
     
    }
    
    public function buying($owner,$money) {
        $itm = new OwnerItems();
        
// $money = 5000;
        $item = 1;
        
        $now = $itm->retItemByOwner($item, $owner);
        //echo $now;
        $itm->removeItemByOwner($item, $owner, $money);
        $now = $itm->retItemByOwner($item, $owner);
        //echo ' soff ' . $now;
    }
  
        
    
} //end class GreateNewDog
 /*                                *************************    РАСПЕЧАТКА Собаки на экране КАРТИНКА  */
class PrintDog extends Dog{
    function printStats($id){
      $array =  R::getRow('SELECT * FROM `randodna` WHERE `id` LIKE :search LIMIT 1', [
                'search' => "%$id%"]);  
      //debug($str);
      ?>
<table class="table">
    <tr> 
        <td>удача</td>
        <td><?php echo $array['lucky']?></td>
    </tr>
    <tr>
        <td>скорость</td>
        <td><?php echo $array['spd']?></td>
    </tr>
    <tr>
        <td>уворот</td>
        <td><?php echo $array['agl']?></td>
    </tr>
    <tr>
        <td>обучение</td>
        <td><?php echo $array['tch']?></td>
    </tr>
    <tr>
        <td>прыжки</td>
        <td><?php echo $array['jmp']?></td>
    </tr>
    <tr>
        <td>обоняние</td>
        <td><?php echo $array['nuh']?></td>
    </tr>
    <tr>
        <td>поиск</td>
        <td><?php echo $array['fnd']?></td>
    </tr>
</table>
       <?php
    
    }
    public function picCoins() {
        echo '<img src = "/pici/coins_mini.png"> ';
    }
    /* функция проверяет и возвращает ссылку на собаку в зависимости от возраста*/ 
     public function bdikaUrl($id){
         //возвращаем age_id из animals
         $age_id = $this->retAgeId($id);
         $dna_id = $this->retDnaId($id);
         
        if (13<=$age_id){   //age_id = 4 (6 мес)  age_id = 9 (15 мес = 1 год 3 мес)
            return $this->retCell('url', $dna_id, 'randodna');
        }
        else{
           return $this->retCell('url_puppy', $dna_id, 'randodna');
        }
    }

    /*функция печатает собаку как ссылку, можно указать размер картинки в пикселях. проверяет щенок или нет(печатает из ANIMALS)*/
    function picLink($id,$size='100%'){
        // $dna_id=$this->retDnaId($id);
         //$url=$this->retCell('url', $dna_id, 'randodna');
        $owner = $this->retOwner($id);
         $url = $this->bdikaUrl($id);
         ?><a href="/name.php?id=<?php echo $id . "&owner=" . $owner; ?>">
                <img src="<?php echo $url;?>" width="<?php echo $size?>">
                    </a>
             <?php 
         
    
    }
    
    /*функция печатает собаку , можно указать размер картинки в пикселях. проверяет щенок или нет(печатает из ANIMALS)*/
    function printDogPic($id,$size='100%'){
        $owner = $this->retOwner($id);
        $url = $this->bdikaUrl($id);
         ?><img src="<?php echo $url;?>" width="<?php echo $size?>"><?php 
    }
    
    /* функция печатает собаку по ее URL */
    public function dogPic($url,$size=100){
       ?><img src="<?php echo $url;?>" width="<?php echo $size?>"><?php
    }
    public function picSex($id_dog) {
        $dna_id = $this->retDnaId($id_dog);
        
        $sex = R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
      
        if(0==$sex){
            return '<img src = "/pici/female_mini.png">';
        }
        else{
            return '<img src = "/pici/male_mini.png">';
        }
    }
 
}
class Kennels{
    ///////////////////////  Работа с kennels питомники ////////////////
    /* возвращает количесво собак в питомнике*/
    public function retCountDog($owner) {
        
       return R::getcell('SELECT dogs FROM kennels WHERE owner_k =:owner', array(':owner'=> $owner));
        
    }
    /* возвращает количесво сук в питомнике*/
    public function retCountFemaleDog($owner) {
        
       $count=0;
       $dog = new Dog();
         $array = R::getCol('SELECT id FROM animals WHERE owner = :owner && status = 1' ,
       [':owner' => $owner]);
     //debug($array);
    foreach($array as $id => $id_dog) {
        $sex = $dog->retSex($id_dog);
        $age_norma = $dog->retAgeId($id_dog);
        
       if(('0' == $sex) && (13 <= $age_norma)){  //и старше 6 месяцев
          // echo $id_dog . ' / ';
            $count = $count + 1;
        }
    }    
    return $count;
        
    }
    /* возвращает количесво КОБЕЛЕЙ в питомнике*/
    public function retCountMaleDog($owner) {
        
       $count=0;
       $dog = new Dog();
         $array = R::getCol('SELECT id FROM animals WHERE owner = :owner && status = 1' ,
       [':owner' => $owner]);
     //debug($array);
    foreach($array as $id => $id_dog) {
        $sex = $dog->retSex($id_dog);
        $age_norma = $dog->retAgeId($id_dog);
        
       if(('1' == $sex) && (13 <= $age_norma)){  //и старше 6 месяцев
                //echo $id_dog . ' \ ';
                $count = $count + 1;
        }
    }    
    return $count;
        
    }
     /* возвращает количесво Щенков (младше 6 месяцев) в питомнике*/
    public function retCountPuppyDog($owner) {
        
       $count=0;
       $dog = new Dog();
         $array = R::getCol('SELECT id FROM animals WHERE owner = :owner && status = 1' ,
       [':owner' => $owner]);
    // debug($array);
    foreach($array as $id => $id_dog) {
        $sex = $dog->retSex($id_dog);
        $age_norma = $dog->retAgeId($id_dog);
        //echo $id_dog;
       if(13 > $age_norma){  //и младше 6 месяцев
           //echo $id_dog . ' / ';
           $count = $count + 1;
        }
    }    
    return $count;
        
    }
    /*Получаем запросом  навание питомника, при условии что владелец идентифицируется по куку Сессии*/
    public function retKennel($owner) {
        return R::getCell('SELECT kennel FROM users WHERE login = :owner',
        [':owner' => $owner]);
    }    
 
    /* функция печатает все собак питомника*/
    public function printDogsByKennel($owner) {
        ?>
        <table class="table">
    <tr>
    <?php
    $printdog = new PrintDog();
    $dog = new Dog();
      $array[] = R::getAssoc('SELECT id,name FROM animals WHERE owner = :owner && status = 1' ,
       [':owner' => $owner]);
    //  debug($array);
    foreach($array as $item) {
        $count=0; // считает количество столбиков не больше 4
        foreach ($item as $key => $value) {
            //echo '<br>' . $count;
/*сохранение данных о голости собаки + вязки/щенки*/
            $lit = $dog->retLitter($key);
            $pup = $dog->retPuppy($key);
            $sex = $dog->retSexText($key);
           $GLOBALS['Data_dog']= R::getRow( 'SELECT * FROM animals WHERE id = :id',
                                            [':id' => $key]);;    //сохраняем данные по собаке
               
/*выводим на экран имя собаки как ссылку*/
            If('4'>$count){ //если еще не 4 столбика, вписываем
            ?>
            <td> <!-- строка таблицы --> 
                <!-- http://dog.ru/test.php?id=8&owner=nesh -->
               
                <?php $printdog->picLink($key, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $value;
                            echo '<br> пол : ' . $sex . '<br>';
                            echo $dog->retEstrusStatus($key);
                            echo '<a href="/lit&pup.php?id=' . $key . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;
                            $count=$count+1;
                            ?>
               </div>                           
                               
            
  <?php     }else{ //если закончилась стрка перехрдить на следующую
                ?></td></tr><td> <!-- строка таблицы -->
                 <?php $printdog->picLink($key, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $value;
                            echo '<br> пол : ' . $sex . '<br>';
                            echo $dog->retEstrusStatus($key);
                            echo '<a href="/lit&pup.php?id=' . $key . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;?>
               </div>                       
                <?php
                 $count=1;   
                //}
            }
                            
             }    //foreach ($item as $key => $value) {
            echo "<br/>";
            }   // foreach($array as $item)
            
    }
    
 /* Функция печатает всех сук питомника*/   
    public function printFemalesByKennel($owner) {
        $printdog = new PrintDog();
        $dog = new Dog();
                       
        ?><table class="table"><tr>
        <?php 
        $count=0;
         $array[] = R::getAssoc('SELECT id,name FROM animals WHERE owner = :owner && status = 1' ,
       [':owner' => $owner]);
     // debug($array);
    foreach($array as $item) {
        $countf=0; // считает количество столбиков не больше 4
        foreach ($item as $id => $value) {
                $countf='0'; // считает количество столбиков не больше 4
                $sex = $dog->retSex($id); 
                $sex_txt = $dog->retSexText($id);
                $lit = $dog->retLitter($id);
                $pup = $dog->retPuppy($id);
               // $age = $dog->retAgeText($id);
                $age_norma = $dog->retAgeId($id); //ret_cell('age_id',$id,'animals');
                //$name= $dog->retName($id); //ret_Cell('name', $id, 'animals');
                if(('0'== $sex) && ($age_norma >= 13)){  //и старше 6 месяцев
                    if(4 > $count){ //если еще не 4 столбика, вписываем
            ?>
            <td> <!-- строка таблицы --> 
                <!-- http://dog.ru/test.php?id=8&owner=nesh -->
               
                <?php $printdog->picLink($id, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $value;
                            echo '<br> пол : ' . $sex_txt . '<br>';
                            echo $dog->retEstrusStatus($id);
                            echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;
                            $count=$count+1;
                            ?>
               </div>                           
                               
            
  <?php     }else{ //если закончилась стрка перехрдить на следующую
                ?></td></tr><td> <!-- строка таблицы -->
                 <?php $printdog->picLink($id, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $value;
                            echo '<br> пол : ' . $sex_txt . '<br>';
                            echo $dog->retEstrusStatus($id);
                            echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;?>
               </div>                       
                <?php
                 $count=1;   
                //}
            }
                            }//elseif(('0'== $sex) && (13<$age_norma)){  //и старше 6 месяцев   
                        } //foreach ($item as $id => $value) 
                }//foreach($data as $item)
            }
  /* Функция печатает всех кобелей питомника*/   
    public function printMalesByKennel($owner) {
        $printdog = new PrintDog();
        $dog = new Dog();
        $ken = new Kennels();
        $count = 0;
                
        ?><table class="table"><tr>
        <?php 
 //         $array[] = R::getAssoc('SELECT id,name FROM animals WHERE owner = :owner && status = 1' ,
//       [':owner' => $owner]);
        $data = R::getCol('SELECT id FROM animals WHERE owner = :owner && status = 1' , [':owner' => $owner]);
     // debug($data);
    foreach($data as $id) {
       // $countm=0; // считает количество столбиков не больше 4
                       ?> <!-- <td> строка таблицы --> 
                <?php
                $sex = $dog->retSex($id); 
                $sex_txt = $dog->retSexText($id);
                $lit = $dog->retLitter($id);
                $pup = $dog->retPuppy($id);
                $age_norma = $dog->retAgeId($id); //ret_cell('age_id',$id,'animals');
                $name = $dog->retName($id); //ret_Cell('name', $id, 'animals');
                if(('1'== $sex) && ($age_norma >= 13)){  //и старше 6 месяцев
                   if(4 > $count){ //если еще не 4 столбика, вписываем
            ?>
            <td> <!-- строка таблицы --> 
                <!-- http://dog.ru/test.php?id=8&owner=nesh -->
               
                <?php $printdog->picLink($id, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $name;
                            echo '<br> пол : ' . $sex_txt . '<br>';
                            echo $dog->retEstrusStatus($id);
                            echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;
                            $count=$count+1;
                            ?>
               </div>                           
                               
            
  <?php     }else{ //если закончилась стрка перехрдить на следующую
                ?></td></tr><td> <!-- строка таблицы -->
                 <?php $printdog->picLink($id, '25%'); ?>
               <div><?php   //  вывод на экран количество вязок и щенков
                            echo '<br>имя: ' . $name;
                            echo '<br> пол : ' . $sex_txt . '<br>';
                            echo $dog->retEstrusStatus($id);
                            echo '<a href="/lit&pup.php?id=' . $id . '">' . "<br> вязки/дети: ". $lit .'/'. $pup;?>
               </div>                       
                <?php
                 $count=1;   
                //}
                    }
                  }//elseif(('0'== $sex) && (13<$age_norma)){  //и старше 6 месяцев   
              }//foreach($data as $id)
            }       
            public function printPuppyByKennel($owner) {
                // if(13>$GLOBALS['Data_dog']['age_id']){ //возраст <6 месяцев
                $printdog = new PrintDog();
                $dog = new Dog();
                $count = 0;
                ?><table class="table"><tr> <?php
                $data = R::getCol('SELECT id FROM animals WHERE owner = :owner && status = 1' , [':owner' => $owner]);
                // debug($data);
                foreach($data as $id) {
                $sex_txt = $dog->retSexText($id);
                $age_norma = $dog->retAgeId($id); //ret_cell('age_id',$id,'animals');
                $name = $dog->retName($id); //ret_Cell('name', $id, 'animals');
                if($age_norma < 13){  //младше 6 месяцев
                    if(4 > $count){ //если еще не 4 столбика, вписываем
                        ?><td><?php
                        $printdog->picLink($id, '25%'); 
                        ?><div><?php   //  вывод на экран количество вязок и щенков
                        echo '<br>имя: ' . $name;
                        echo '<br> пол : ' . $sex_txt . '<br>';
                        echo '<a href="/lit&pup.php?id=' . $id . '">';
                        $count=$count+1;
                        ?></div><?php         
                    }else{ //если закончилась стрка перехрдить на следующую
                        ?></td></tr><td> <!-- строка таблицы -->
                        <?php $printdog->picLink($id, '25%');
                        $count=1;
                        ?><div><?php   //  вывод на экран количество вязок и щенков
                        echo '<br>имя: ' . $name;
                        echo '<br> пол : ' . $sex_txt . '<br>';
                        echo '<a href="/lit&pup.php?id=' . $id . '">';
                        ?></div><?php
                    } //if(4 > $count){
                  } //if(13>$age_norma){ 
              } //foreach($data as $id)
            
            }
            
}
class Family extends PrintDog{
    ///////////////////////  Работа с FAMILY СЕМЬЕЙ ////////////////
    public function retFamilyId($id) {
        return R::getcell('SELECT family_id FROM animals WHERE id =:id', array(':id'=> $id));
    }
    public function retPicMumDad($id) {
        if($id!=0)
            return $this->picLink($id,100);
        else 
            return "нет данных";
    }
    public function retMum($id) {
        $f_id=$this->retFamilyId($id);
        return R::getcell('SELECT mum FROM family WHERE id =:id', array(':id'=> $f_id));
    }
    public function retDad($id) {
        $data_dad=0;
        $f_id=$this->retFamilyId($id);
        return R::getcell('SELECT dad FROM family WHERE id =:id', array(':id'=> $f_id));
        
    }
    /*бабушка по линии мамы*/
    public function retG0Mum($id) {
        $f_id=$this->retFamilyId($id);
        return R::getcell('SELECT g0mum FROM family WHERE id =:id', array(':id'=> $f_id));
    }
    /*дедушка по линии мамы*/
    public function retG0Dad($id) {
        $f_id=$this->retFamilyId($id);
       return R::getcell('SELECT g0dad FROM family WHERE id =:id', array(':id'=> $f_id));
        
    }
    /*бабушка по линии папы*/
    public function retG1Mum($id) {
        $f_id=$this->retFamilyId($id);
        return R::getcell('SELECT g1mum FROM family WHERE id =:id', array(':id'=> $f_id));
    }
    /*дедушка по линии папы*/
    public function retG1Dad($id) {
        $f_id=$this->retFamilyId($id);
       return R::getcell('SELECT g1dad FROM family WHERE id =:id', array(':id'=> $f_id));
     
    }
}
/***************** работа с таблицами ****************************/
class Tabl{
    /*Функция вносит изменения имени собаки по ее Id*/
    public function UpdateData($tabl,$id,$cell,$value){  //$tabl - название таблицы \\ $id-ай ди выбранного\\ $cell-названия столба\\ $value- значение
         R::exec( 'UPDATE ' .  $tabl . ' SET ' . $cell . '=:aa WHERE id = :id ', [
                ':aa'=> $value,
                ':id' => $id]);

    }
    
    /*Функция достает даннные из заданного поля($cell) по ее Id из таблицы $tabl*/
    public function retCellById($id, $cell,$tabl){
        $sql = 'SELECT ' . $cell . ' FROM ' . $tabl . 'WHERE id=' . $id; 
        return R::getCell($sql);
    }

    public function getSql($id,$tabl){
    $sql = 'SELECT * FROM ' . $tabl . ' WHERE id=' . $id; 
    return $sql;
    }
    /*Функция возвращает данные по параметру $cell из таблицы $tabl по индексу $id*/
    public function retCell($bdika,$id,$tabl){
        //if('animals'==$tabl){
        $array = R::getAssoc($this->getSql($id,$tabl));
            foreach($array as $item) {
                foreach ($item as $key => $value) {
                    if($key == $bdika){
                        return $item[$bdika];
                    }
                }
            }
    }

    /*Функция возвращает данные из таблицы $tabl по индексу $id*/
    public function retRow($id,$tabl){

        return R::getRow(get_sql($id,$tabl));   //$id - индекс ; $tabl - таблица с данными

    }
    /*Функция достает даннные собаки по ее Id из нужно таблицы*/
    function TakeDataFrom($id,$tabl){   //$id - индекс ; $tabl - таблица с данными

       $sql = 'SELECT * FROM ' . $tabl .  ' WHERE id =' . $id; 
        return R::getRow($sql);
        
    }

}
/************************ Работа с таблицей USERS ***************/
class Users{
   static $owner;
   
   //возвращает имя заводчика, который зологинен
   public function retOwner(){
	return $_SESSION['logged_user']->login;
   }
   
   //возвращает ID по имени заводчика
   public function retId($owner) {
       return R::getcell('SELECT id FROM users WHERE login =:log', array(':log'=> $owner));
   }
   //возвращает Питомник по имени заводчика
    public function retKennel($owner){
        return R::getcell('SELECT kennel FROM users WHERE login =:log', array(':log'=> $owner));
    }
    //возвращает Дату создания питомника по имени заводчика
    public function retFTime($owner){
        return R::getcell('SELECT f_time FROM users WHERE login =:log', array(':log'=> $owner));
    }
    //возвращает дату последнего визита по имени заводчика
    public function retLTime($owner){
        return R::getcell('SELECT l_time FROM users WHERE login =:log', array(':log'=> $owner));
    }
    //возвращает статус онлайн 1/неонлайн 0 по имени заводчика
   public function retOnLine($owner){
        return R::getcell('SELECT online FROM users WHERE login =:log', array(':log'=> $owner));
    }
    //возвращает количество визитов по имени заводчика
    public function retVisits($owner){
        return R::getcell('SELECT visits FROM users WHERE login =:log', array(':log'=> $owner));
    }
    
    //возвращает все данные(*) по имени заводчика
    public function retAll($owner) {
        return R::getRow('SELECT * FROM users WHERE login =:log', array(':log'=> $owner));
    }
    public function retDogByOwner($owner){
        return R::getCol ('SELECT id FROM animals WHERE owner =:owner and status=1', array(':owner' => $owner));
         
    }
    public function retMoney($owner){ //indeks ltytu = 1
        $user = new Users();
        $owner_id = $user->retId($owner);
        $dog = new Dog();
        $money = (int) $dog->getCount('1', $owner_id);
        return $money;
    }
    
}
Class Office extends Dog {
    
    public function randoEvent(){
        $num = rand(1, 100);
        //echo $num;
        $print = new PrintDog();
        $rand = new RandDog();
        
        if ( 1 == $num ){
            //подкинули деньги
           echo 'Утром кто-то подкинул вам денег';
           $price = rand(500,2900);
           $owner = $this->retOwnerNoId();
           $this->putMoney($owner, $price);
           $print->picCoins(); echo $price;
        }
        if ( 2 == $num){
            echo 'Ночью кто-то подкинул вам щенка. Пристройте его или оставьте себе<br>';
            $id=6;
            $obj6 = new RandDog;
            $tabl = new Tabl;
            $obj6->InsertData($id);
            $url=$obj6->retUrl($id); //рисуте URL
            //echo ' Url ' . $url;
            //$obj6->dogPic($url);
            $url_pup=$obj6->retUrlPuppy($id);
           // echo " url_pup " . $url_pup;
            echo '<br>' . $obj6->dogPic($url_pup);
            $tabl->UpdateData('randodna', $id, 'about', 'puppyPodkinut');
            
        }
        if ( 3 == $num){
            echo 'Кто-то подбросил вам старую собаку. Что будете делать с ней?!<br>';
             $id=7;
            $obj6 = new RandDog;
            $tabl = new Tabl;
            $obj6->InsertData($id);
            $url=$obj6->retUrl($id); //рисуте URL
            //echo ' Url ' . $url;
            $obj6->dogPic($url);
            $url_pup=$obj6->retUrlPuppy($id);
           // echo " url_pup " . $url_pup;
           //echo '<br>' . $obj6->dogPic($url_pup);
            $tabl->UpdateData('randodna', $id, 'about', 'OldPodkinut');
            
        }
        return $num;
      
    }
}
/************************ Работа с таблицей RANDODNA ***************/
Class Dna extends Dog{
    public function retDna($dna_id) {
        return R::getCell('SELECT dna FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
    }
    public function retUrl($dna_id) {
        return R::getCell('SELECT url FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
    }
    public function retUrlPuppy($dna_id) {
        return R::getCell('SELECT url_puppy FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
    }
    public function retSex($id_dna) {
        return R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$id_dna]);
    }
   
    public function retSexText($dna_id) {
        if($this->retSex($dna_id)){
            return 'кобель';
        }
        else {
            return 'сука';
        }
    }
    public function retGolPooh($dna_id) {
        $string = $this->retDna($dna_id);
        if(0 == $string[2]){
           return 'Пуховая (шерстная)';
        }
        if(1 == $string[2]){
            return 'Голая(бесшерстная)';    
        }
    }
    public function retShocoGen($dna_id) {
        $string = $this->retDna($dna_id);
        if(0 == $string[8]){
           return 'Ген шоколадности есть';
        }
        if(1 == $string[8]){
            return 'Нет гена шоколадности';    
        }
    }
    public function retAllDna($id) {
        
        $dna_id = $this->retDnaId($id);
        $dna_array = R::getRow('SELECT * FROM randodna WHERE id =:id', array(':id' => $dna_id));
        return $dna_array;
        
    }
    
}

/************************ Работа с ANIMALS ***************/
Class Dog extends Tabl{
    static $id;
    static $dog_arr;
    static $owner;
    
    //Возвращает все id собак по владельцу
    public function allDog($owner){
        $this->dog_id = $_SESSION['logged_user']->login;
        $this->dog_arr = R::getAssoc ('SELECT id FROM animals WHERE owner =:owner and status=1', array(':owner' => $owner));
        return $this->dog_arr;
    }
    public function retName($id){
        return R::getCell('SELECT name FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retRace($id){
        return R::getCell('SELECT race FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retOrign($id){
        return R::getCell('SELECT origin FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retBreeder($id){
        return R::getCell('SELECT breeder FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retOwner($id){
        return R::getCell('SELECT owner FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retOwnerNoId(){
        return $_SESSION['logged_user']->login;
    }
    public function retKennel($id){
        return R::getCell('SELECT kennel FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retEstrus($id){
        return R::getCell('SELECT estrus FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retRegId($id){
        return R::getCell('SELECT reg_id FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retAgeId($id){
        return R::getCell('SELECT age_id FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retDnaId($id){
        return R::getCell('SELECT dna_id FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retFamilyId($id){
        return R::getCell('SELECT family_id FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retMarkId($id){
        return R::getCell('SELECT mark_id FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retWeight($id){
        return R::getCell('SELECT weight FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retHeight($id){
        return R::getCell('SELECT height FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retVitality($id){
        return R::getCell('SELECT vitality FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retHp($id){
        return R::getCell('SELECT hp FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retJoy($id){
        return R::getCell('SELECT joy FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retBirth($id){
        return R::getCell('SELECT birth FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retNow($id){
        return R::getCell('SELECT now FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retStatus($id){
        return R::getCell('SELECT status FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retPuppy($id){
        return R::getCell('SELECT puppy FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
    public function retLitter($id){
        return R::getCell('SELECT litter FROM animals WHERE id = ? LIMIT 1', [$id]);
    }
     public function retSex($id) {
         $dna_id = $this->retDnaId($id);
        return R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$dna_id]);
    }
     public function retSexPartner($id) {
         
      return $this->retSex($id) ? '0' : '1';
           
    }
   

    public function countDogs($owner){ // функция пересчитывает количество собак и списываем в kennel
        $books = R::getAll('SELECT `id` FROM `animals` WHERE `owner` = ?', [$owner]);
        $cont = count($books);

        //возвращаем строку питомника
        $id_ken = R::getCell('SELECT `id` FROM `kennels` WHERE `owner_k` = ? LIMIT 1', [$owner]);

        //вносим обновленные данные в таблицу
       $book = R::load('kennels', $id_ken);
        $book->dogs = $cont;
        R::store($book);
    }
    public function retAgeText($id){
        $age_id = $this->retAgeId($id);
     //находим аналог(2 месяца) этой цыфры в таблице ages и выводим текст возраста
        return R::getcell('SELECT age FROM ages WHERE id =:id', array(':id'=> $age_id));
             
    }
    public function retMarkText($id){
        $mark_id = $this->retMarkId($id);
        return R::getcell('SELECT namerus FROM marks WHERE id =:id', array(':id'=> $mark_id));
        
    }
     public function retOrignText($id){
         if($this->retOrign($id)){
         //if(R::getCell('SELECT orign FROM animals WHERE id = ? LIMIT 1', [$id])){
             return 'РКФ';
         }
        else {
            return 'не известно';
        }
    }
    public function retEstrusText($id) {
        $est_id= $this->retEstrus($id);
        return R::getCell('SELECT age FROM ages WHERE id =:id', array(':id'=> $est_id));
        
    }
    public function retEstrusStatus($id){
      // сделать функцию
        $est = $this->retEstrus($id);
        $age = $this->retAgeId($id);
        $sex = $this->retSex($id);
        $array='';
            //находим аналог(2 месяца) этой цыфры в таблице ages и выводим текст возраста
    
      // echo 'возраст: ' . $age . ' течка: ' .$est . "<br>";
        if( '0' == $sex){   //если собака сука
            
            if($age == $est){

                 $array = 'у суки течка';
             }
            elseif($age < $est){
                                          
                $array = "течка будет в: " . $this->retEstrusText($id);  
            }
            elseif($age > $est){
                $this->addEstus($id,3);
                $est_text= $this->retEstrusText($id);
                $array = 'течка будет в: ' . $est_text;

             }
               return $array; 
         }
      
    }
    /*увеличивает возраст на 1 тик*/
    public function addAge($id){
        $age_id = $this->retAgeId($id); //получаем цыфру возраста из табл animals
        $age_id+=1;  //увеличивает на 1 пункт

        $this->UpdateData('animals',$id,'age_id', $age_id); //вставляем новые данные в таблицу по id 
    }
       /*устанавливаем возраст на 1 */
    public function setAge1($id){
       $this->UpdateData('animals',$id,'age_id', 1); //вставляем новые данные в таблицу по id 
    }
     public function addEstus($id,$num){
        $est_id = $this->retEstrus($id); //получаем цыфру возраста из табл animals
        $est_id=$est_id+$num;  //увеличивает на 1 пункт
        $this->UpdateData('animals',$id,'estrus', $est_id); //вставляем новые данные в таблицу по id 
    }
    function getId($login){

            $string =R::getCol('SELECT id FROM users WHERE login = :log',
                [':log' => $login]);

           return $string[0];

    }
     /*Функция возвращает количество итемов у нанного владельца*/
    function getCount($item, $owner_id){

        $string=R::getcol('SELECT count FROM owneritems WHERE owner_id =:id and item_id=:item', array(':id'=> $owner_id, ':item' => $item));
        //var_dump($string);
        if (empty($string)){
          $string[0]='0';
        }
        return $string[0];

    }
    /***************получает сумму денег по имени владельца************/
    public function printMoney($login){
        $id=$this->getId($login);
        $coins = $this->getCount('1', $id);
        $coins=number_format ($coins , $decimals = 0 ,$dec_point = "." , $thousands_sep = " " ); //number_format — Форматирует число с разделением групп
        return $coins;
     }
     /***************увеличивает сумму денег  на сумму  $price************/
    public function putMoney($owner,$price){
          $id=$this->getId($owner);
          $coins = $this->getCount('1', $id);
          $coins = $coins + $price;
          R::exec( 'UPDATE owneritems SET count= :coins WHERE owner_id = :id AND item_id = :item', array(':coins' => $coins,':item'=> '1', ':id' => $id));
        }
    public function retSexText($dna_id) {
        if($this->retSex($dna_id)){
            return 'кобель';
        }
        else {
            return 'сука';
        }
    }
    
}  
 /*                                *************************    РАСПЕЧАТКА Собаки на экране КАРТИНКА  */
Class RandDog extends PrintDog{
    public function randDna(){
        $dna='hr0w0f0b0t0m0';
        for($i=1;$i<=strlen($dna);$i++){

                if(!($i%2)){  //еcли четные равны 0 (!1)
                    $dna[$i]=Rand(0,1);
                }
        }
        return $dna;
    }

    public function insertData($id){
        $dna = $this->randDna();
        
        //$id = 3;
        // Загружаем объект с ID = 3
       // echo '<br>insertData';
        $dog = R::load('randodna', $id);
        // Обращаемся к свойству объекта и назначаем ему новое значение
        
        $new = $this->stats();
       // debug($new);
        
        $dog->lucky = $new['lucky'];
        $dog->spd = $new['spd'];
        $dog->agl = $new['agl'];
        $dog->tch = $new['tch'];
        $dog->jmp = $new['jmp'];
        $dog->nuh = $new['nuh'];
        $dog->fnd = $new['fnd'];
        $dog->mut = $new['mut'];
        //$dog->dna = $this->startDna();
        $dog->dna = $dna;
        $dog->about='shop';
        $dog->sex = Rand(0,1);

        // Сохраняем объект
       R::store($dog);
       
       //создаем картинки собак
      
       $dog->url = $this->doUrl($dna);
       $dog->url_puppy = $this->DoUrlPuppy($dog->url);
       
       return R::store($dog);
    }

    public function doUrl($data_dna){ //получаем данные DNA hr0w0f0b0t0m0
       // echo '<br>DoUrl';
        //$data_dna = R::getCell('SELECT dna FROM randodna WHERE id = ? LIMIT 1', [$id]);
        $num=Rand(1,3);  //количество вариаций окраса собаки взрослые
        
        if(1 == $data_dna[2]){  //если собака голая hr1
            if(1==$data_dna[10] && 1==$data_dna[12]){ //если и крап и пятна
              $data_dna[4]=0; //ww=0    собака не модет быть белой
              $data_dna[6]=0; //ff=0    собака не модет быть рыжей
             $url="pici/TM/" . $data_dna . '_0' . $num . '.png';
            }
            else if(1==$data_dna[10]){  //если крап TT
             $data_dna[4]=0; //ww=0    собака не модет быть белой
             $data_dna[6]=0; //ff=0    собака не модет быть рыжей
             $url="pici/TT/" . $data_dna . '_0' . $num . '.png';
            }
            else if(1==$data_dna[12]){  //если пятна MM
              //$data_dna[4]=0; //ww=0    собака не модет быть белой
              
              $url="pici/MM/" . $data_dna . '_0' . $num . '.png';
            }
            else{   //если чистая собака
                $url="pici/" . $data_dna . '_0' . $num . '.png';
            }
          }
          if(0 == $data_dna[2]){  //если собака пуховая
              $data_dna[10]=0; //tt=0    собака нет крапа
              $num2=Rand(1,5);  //количество варианций окраса собаки
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
              else{ $url="pici/hrhr/" . $data_dna . '_0' . $num2 . '.png';}
          } 
        return $url;  //получаем $URL
    }
/*   public function dogPic($url){
 ?><img src="<?php echo $url;?>"><?php 
} */
    public function randSex(){
        return Rand(0,1);
    }
    public function stats(){
        $arr = [
          "lucky" => Rand(1,100),
          "spd" => rand(9,11),
          "agl" => rand(9,11),
          "tch" => rand(9,11),
          "jmp" => rand(9,11),
          "nuh" => rand(9,11),
          "fnd" => rand(9,11),
          "mut" => rand(1,100)
          ];
        
        return $arr;
    }     
    
    
    public function picSex($id_dna) {
        $sex = R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$id_dna]);
      
        if(0==$sex){
            return '<img src = "/pici/female_mini.png">';
        }
        else{
            return '<img src = "/pici/male_mini.png">';
        }
    }
    public function DoUrlPuppy($url){  //получаем данные из url
      //  echo '<br>' . $dna  = R::getCell('SELECT url FROM randodna WHERE id = ? LIMIT 1', [$dna_id]); //pici/hr1w0f1b0t0m0_04.png
        
       $offset = strpos($url, '_'); //берем все до _
        $result = ($offset) ? substr($url,0,$offset) : $source;
        //echo "{$url} => {$result}";   
       // echo '<br>' . $result;

        $result = substr($result, strpos($result, '/') + 1, strlen($result)); //берем       все после /
        //echo '<br>' . $result;
        if(strripos($result, '/')){
            $result = substr($result, strpos($result, '/') + 1, strlen($result)); //берем все после /
        }
//echo '<br>' . $result;

        $dna=$result;
        $num = Rand(1,4);  //количество варианций окраса собаки щенки
        
        if(0 == $dna['2']){   //если пух
               if(0 == $dna['4']){   //если не белый 
                     if(0 == $dna['6']){ //если не рыжий
                         if(0 == $dna['8'])  //если шоко
                           $url_dna='hr0b0';
                         if(1 == $dna['8'])  //еcли черный
                           $url_dna='hr0b1';
                     }
                     if(1 == $dna['6']) //если рыжий
                       $url_dna='hr0f1';
               }      
               else    //если белый
               $url_dna='hr0w1';
             }
             if(1 == $dna['2']){    //если голый
                 if(1 == $dna['10'] && 1 == $dna['12']){ //и крап и пятна
                     $url_dna='hr1w1';
                     
                 }
                if(0 == $dna['4'] && 0 == $dna['10']){   //если не белый и нет крапа TT
                     if(0 == $dna['6']){ //если не рыжий
                         if(0 == $dna['8'])  //если шоко
                           $url_dna='hr1b0';
                         if(1 == $dna['8'])  //ечли черный
                           $url_dna='hr1b1';
                     }
                     if(1 == $dna['6']) //если рыжий
                         $url_dna='hr1f1';
                 }
               else    //если белый
               $url_dna='hr1w1';
             }

           
           return $url = "pici/puppy/" . $url_dna . '_0' . $num . '.png';
       
    }
    public function dogPrice($id){
      $sex = R::getCell('SELECT sex FROM randodna WHERE id = ? LIMIT 1', [$id]);
      $dna = R::getCell('SELECT dna FROM randodna WHERE id = ? LIMIT 1', [$id]);
      //echo 'sex: ' . $sex . 'dna: ' . $dna;
      
        if(1 == $sex) //кобель
        { 
            //echo ' кобель/';
            if(1 == $dna[2]){ //голая
                $cost=35000;
               // echo 'голый/';
                if(0 == $dna[8]){ //шоко
                    //echo ' шоко.';    
                    $cost=$cost+20000;
                }
            }

            if(0 == $dna[2]){ //пух
               // echo ' пух/';
                $cost=10000;
                if(0 == $dna[8]){ //шоко
                   // echo 'шоко.';    
                    $cost=$cost+25000;
                }
            }

        }
        if(0 == $sex){ //cука
            //echo ' сука/';
           if(1 == $dna[2]){//голая
              //echo ' голая/';
                $cost=45000;
                 if(0 == $dna[8]){ //шоко
                   // echo ' шоко.';    
                   $cost=$cost+30000;
                }
            }

            if(0 == $dna[2]){ //пух
               // echo ' пуховая/';
                $cost=25000;
                 if(0 == $dna[8]){ //шоко
                   // echo ' шоко.';    
                   $cost=$cost+15000;
                }
            }

        }
         return $cost;  
    }
    public function retDna($id) {
        return R::getCell('SELECT dna FROM randodna WHERE id = ? LIMIT 1', [$id]);
    }
    public function retUrl($id) {
        return R::getCell('SELECT url FROM randodna WHERE id = ? LIMIT 1', [$id]);
    }
    public function retUrlPuppy($id) {
        return R::getCell('SELECT url_puppy FROM randodna WHERE id = ? LIMIT 1', [$id]);
    }
   
}// end class NewDog
class Matting extends Dog {
    
    public function bdikaSexPartner($str,$sex_partner){
       // debug($str);  
        //echo '<br>';
       for($i=0;$i<count($str);$i++){
           if($this->retSex($str[$i]) == $sex_partner){
               $str2[] = $str[$i];
//               $dog = new PrintDog;
//               $dog->picLink($str[$i], '30%');
//               //echo $str[$i];
           }
        }
        return $str2;
        
        
    }
    function bdikaForBreed($id){
    // $tabl = new Tabl;  
     $dog = new Dog;
     
    $sex= $this->retSex($id);
    $mark=$this->retMarkId($id);
   // echo '<br> собака:' . $id;
   // echo '<br> пол:' . $sex;
    //echo '<br> оценка: ' . $mark;
    $error = false;
    $errort = '';
    
   if( '1' != $dog->retOrign($id) ):
       $error = true;
       $errort = 'Не документов РКФ';
 
        elseif( $mark > 2 || 0==$mark): //если  нет "хорошо" или "очень хорошо"
           $error = true;
            $errort = 'не получены положительные оценки';
   
        elseif( '1' == $sex )://кобель
   
            if( $dog->retAgeId($id) < 17 ):
                    $error = true;
                    $errort = 'кобель слишком молодой';
            else:
                $errort = 'Кобель готов к вязке';    
            endif;
        elseif(0 == $sex): //сука
            if( $dog->retEstrus($id) < 15 ||  $dog->retEstrus($id) !=  $dog->retAgeId($id)):
                    $error = true;
                    $errort = 'сука не готова к вязке';
            elseif( $dog->retAgeId($id) >58):
            $error = true;
            $errort = 'возраст суки превышен';
             elseif( $dog->retLitter($id) > 7):
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
public function bdikaMutation($id_m,$id_d) {
    $family_mum = new Family();
    $family_dad = new Family();
    $tabl = new Tabl();


$f_data_m  = $tabl->TakeDataFrom($family_mum->retFamilyId($id_m), 'family'); // получаем id на фамилию  //родственники по линии матери
$f_data_d = $tabl->TakeDataFrom($family_dad->retFamilyId($id_d), 'family'); //Получаем данные из семьи  //родственники по линии отца


    echo '<br>function bdika_mutation <br>';
    $temp =0; //нет мутации
    $num =Rand(1,100);   //шанс получения мутации
 
    ////////////////////////////////////////////////проверка самки и родни партнера
    
    if($f_data_m['id']==$f_data_d['mum']){  //самка и мать партнера 75% мутация
        echo 'партнерша - мать';
        if($num>0 && $num<75){
            $temp=1;
        }
    }
     if( ($f_data_m['id']==$f_data_d['g1mum']) || ($f_data_m['id']==$f_data_d['g0mum']) ){  //самка и бабки партнера 50% мутация
        echo 'партнерша - бабка';
        if($num>50 && $num<100){
            $temp=1;
        }
    }
    if( ($f_data_m['id']==$f_data_d['gg1mum2']) || ($f_data_m['id']==$f_data_d['gg0mum2']) || ($f_data_m['id']==$f_data_d['gg1mum4']) || ($f_data_m['id']==$f_data_d['gg0mum4']) ){
        //самка и пробабки партнера 25% мутация
        echo 'партнерша - пробабка';
        if($num>0 && $num<25){
            $temp=1;
        }
    }
    
       /////////////////////////////////////////////проверка самца и родни партнера
    if($f_data_d['id']==$f_data_m['dad']){  //самец и отец партнерши 75%
        echo 'партнер - отец';
        if($num>0 && $num<75){
            $temp=1;
        }
    }
     if( ($f_data_d['id']==$f_data_m['g1dad']) || ($f_data_d['id']==$f_data_m['g0dad']) ){
         //самец и деды партнерши 50%
        echo 'партнер - дед';
        if($num>50 && $num<100){
            $temp=1;
        }
    }
    if( ($f_data_d['id']==$f_data_m['gg1dad1']) || ($f_data_d['id']==$f_data_m['gg0dad1']) || ($f_data_d['id']==$f_data_m['gg1dad3']) || ($f_data_d['id']==$f_data_m['gg0dad3']) ){
        //самец и прадеды партнерши 25%
        echo 'партнер прадед';
        if($num>0 && $num<25){
            $temp=1;    //если прошла мутация
        }
    }
    return $temp;
}

}
class OwnerItems{
    
    public function retIdOwnerItems($item,$owner) {
          $user = new Users();
          
        $owner_id = $user->retId($owner); //возвращает id Юзера
         $id = R::getCell('SELECT id FROM owneritems WHERE owner_id = :id AND item_id = :item', [
        'id' => $owner_id,
        'item' => $item
        ]);
         return $id;
    }
    public function retItemByOwner($item,$owner) {
        $user = new Users();
        
        $owner_id = $user->retId($owner); //возвращает id Юзера
        $sql = R::getCell('SELECT count FROM owneritems WHERE owner_id = :id AND item_id = :item', [
        'id' => $owner_id,
        'item' => $item
        ]);
        //var_dump($sql);
        if (empty($sql)){
          $sql='0';
        }
        return $sql;
    }
    public function removeItemByOwner($item,$owner,$count) {
        //echo ' function removeItemByOwner($item,$owner,$count) ';
        $tabl = new Tabl();
        $now = $this->retItemByOwner($item, $owner);
        if($now >= $count){
            $now = $now - $count;
            $id = $this->retIdOwnerItems($item, $owner);
            $tabl->UpdateData('owneritems', $id, 'count', $now);
        }
        else{
            echo '<br> Не хватает предметов! ';
        }
        
        
    }
    
}
class Registry{
    /******************* ВНЕСЕНИЕ В табл REGISTRY   ************************/
/*ФУНКЦИЯ проверяет последнюю будку помета и увеличивает ее на 1*/

    public function retLit($id) {
        $lit = R::getCell('SELECT `lit` FROM registry WHERE `id` = ? LIMIT 1', [$id]);
        return $lit;
    }
    function addLit($id){
        echo 'сравниваем букву ' . $lit = $this->retLit($id);
        if('Я' == $lit){ //если конец алфавита, начинаем сначала
            $lit = 'А';
            return $lit;
            //break;
        }
        //$array[] = range('А','Я');
        $array [] = array(
	'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 
	'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        );
       foreach($array as $item) {
        foreach ($item as $key => $value) {
           
            if($lit == $value){
                 echo '[' . $key . ']= ' . $value;
                $key++;
                $lit = $item[$key];
                return $lit;
                break;
            }
        }
       }
        
    }

    function insertReg($id_m,$id_d,$id_new){
        $dog = new Dog;
        $tabl = new Tabl;
        $sex_puppy = $dog->retSex($id_new);
   
    $date = date("Y-m-d");    
    $datebirth=Rand(55,70);
    $count=1;
    $male = $female = 0;
    $count45=$count;
    $sex_puppy ? $male = 1 : $female = 1;
            
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
    $id = R::store($book);
    echo 'новый ИД ' . $id; //= R::getInsertID();
    $id--;
    echo '<br>старый ИД ' . $id;
    //$lit=ret_Cell('lit', $id, 'registry');
    echo 'буква новая ' . $lit = $this->addLit($id);
    $id++;
    $tabl->UpdateData('registry', $id, 'lit', $lit);
    }
}
