<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->smarty->assign('Titulo', 'CodeBreak Listagem ' . $this->uri->segment(3));

$this->smarty->assign('userLevel', $this->session->userdata('Tipo') );

$this->smarty->assign('BaseURL', base_url());

$this->smarty->assign('Menu',  $menu);

$newRow = array();

$i = 0;

if(isset($row)){
   //preciso ordenar o conteúdo do row
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

$this->smarty->assign('comp',  $comp);

$this->smarty->assign('pkey',  $pkey);

$this->smarty->assign('ClassId', $this->uri->segment(3));

$this->smarty->display('Visualizar.html');



/*
 * End of file Incluir.php
 *
 * */