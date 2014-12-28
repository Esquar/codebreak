<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->smarty->assign('Titulo', 'CodeBreak Listagem ' . $this->uri->segment(3));

$this->smarty->assign('userLevel', $this->session->userdata('Tipo') );

$this->smarty->assign('BaseURL', base_url());

$this->smarty->assign('Menu',  $menu);

$newRow = array();

// array auxiliar, para facilitar o processamento das FKs
$fkArray = array();

$i = 0;

if(isset($row)){
   //preciso ordenar o conte�do do row
   //cada row
   foreach($row as $r){

      // cada coluna da row
      foreach($r as $col => $val){

         if(substr($col,0,3) != '_r_'){

            //  cada campo da compilação
            foreach($comp['Campo'] as $campo){
                
               if(substr($col,0,3) == '_v_'){
                   
                  $nomecomposto = '_v_' . $campo['Nome'];

                  if($col == $nomecomposto){
                     
                     $fkArray[$campo['Nome']] = $val;

                     $newRow[$i][$campo['Ordem']]['key']   = $col;
                     $newRow[$i][$campo['Ordem']]['value'] = $val;
                      
                     // busca o resolutor, se houver
                     foreach($r as $colres => $valres){

                        $nomecomposto = '_r_' . $campo['Nome'];

                        if($colres == $nomecomposto){

                           $newRow[$i][$campo['Ordem']]['resolutor'] = $valres;
                        }

                     }

                  }

               }else{
                  // creio que não será mais usado, mas antes, os campos poderiam vir com e sem _v_
                  // então, era tratado diferente.

                  if($col == $campo['Nome']){
                     $newRow[$i][$campo['Ordem']] = array('key' => $col,
                                                          'value' => $val);
                  }

               }

            }

            // segredo para funcionar
            if(isset($newRow[$i])){
               ksort($newRow[$i]);
            }
         }
      }
      // itera linha à linha
      $i++;
   }

}else{
   $newRow = null;
}

$this->smarty->assign('row',  $newRow);

$fkey = array();

if (isset($comp['ChaveEstrangeira_ParaOutros'])){

   foreach($comp['ChaveEstrangeira_ParaOutros'] as $ofk){

      $data = array('schema'  => $comp['AplicativoNome'],
                     'table'  => $comp['Nome'],
                     'ChaveEstrangeiraId' => $ofk['Id'],
                     'Campo' => array() );

      // monta o campo, que é o where
      $i = 0;
      // o while percorre os campos da chave estrangeira, em ordem, até chegar no campo final.
      // assim, pode montar o where, filtrado
      //while($field['Id'] != $ofk['ChaveEstrangeiraCampo'][$i]) {
      for($i=0; $i < count($ofk['ChaveEstrangeiraCampo'])-1; $i++){

         $desc = '';
         
         // acha a descricao do campo
         foreach($comp['Campo'] as $field){
            if($field['Id'] == $ofk['ChaveEstrangeiraCampo'][$i]['CampoId']){
               $desc = $field['Nome'];
            }
         }

         // encontra o valor correspondente
         /*foreach($row as $r){

            // agora, precisa identificar qual o valor do campo pesquisado, é igual ao da row
            foreach($r as $col => $val){

               if($col == $desc){
*/
                  $data['Campo'][] = array($desc => $fkArray[$desc]);
/*               }

            }
         }*/
      }
      
      $res = array(
            'ChaveEstrangeira' => $ofk,
            'Resolved' => $C->requestFKParcial($data)
      );


      foreach($comp['Campo'] as $field){

         $b = count($ofk['ChaveEstrangeiraCampo'])-1;
         $a = $ofk['ChaveEstrangeiraCampo'][$b]['CampoId'];

         if ($field['Id'] == $a){

            if ($field['Handler'] = 'ForeingKey'){
               //print_r($comp['Campo'][$field['Id']]);

               $comp['Campo'][$field['Id']]['resolution'] = $res;
               //print_r($comp['Campo'][$field['Id']]);
            }

         }
      }

   }

}


$this->smarty->assign('comp',  $comp);

$this->smarty->assign('pkey',  $pkey);

$this->smarty->assign('fkey', $fkey);

$this->smarty->assign('ClassId', $this->uri->segment(3));

$this->smarty->display('Alterar.html');



/*
 * End of file Incluir.php
 *
 * */