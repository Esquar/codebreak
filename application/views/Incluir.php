<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->smarty->assign('Titulo', 'CodeBreak Listagem ' . $this->uri->segment(3));

$this->smarty->assign('userLevel', $this->session->userdata('Tipo') );

$this->smarty->assign('BaseURL', base_url());

$this->smarty->assign('Menu',  $menu);

$fkey = array();

if (isset($comp['ChaveEstrangeira_ParaOutros'])){

   foreach($comp['ChaveEstrangeira_ParaOutros'] as $ofk){

      $ret = getFkeyResolution($C, $ofk, $comp);

      $comp['Campo'] = $ret['Campo'];
   }

}

if(isset($comp['ChaveEstrangeira_ParaMim'])){

   // busca as compilações das chaves estrangeiras que irão ser apresentadas
   foreach($comp['ChaveEstrangeira_ParaMim'] as $fk){

      $data = array(
            'schema' => $fk['AplicativoId'],
            'table'  => $fk['TabelaId'],
            'row'    => array()
      );

      $this->modelmaster->setData($data);

      // Não adiciono os campos que são relativos à pk da tabela pai
      $compPart = $this->modelmaster->getCompPart();
      
      $pkeyRel = array();

      foreach($fk['ChaveEstrangeiraCampo'] as $fkeyCampo){

         $i = (integer) $fkeyCampo->CampoId;
         $pkeyRel[$i] = $fkeyCampo->CampoRefId;
      }
      
      if (isset($compPart['ChaveEstrangeira_ParaOutros'])){
      
         foreach($compPart['ChaveEstrangeira_ParaOutros'] as $ofk){
      
            $ret = getFkeyResolution($C, $ofk, $compPart);
            $compPart['Campo'] = $ret['Campo'];
         }
      
      }

      foreach($compPart['Campo'] as $campo){

         if( !isset($pkeyRel[$campo['Id']]) ){
            $campos[] = $campo;
         }

      }

      // zera
      $compPart['Campo'] = array();

      // adiciona
      $compPart['Campo'] = $campos;

      $compPart['FKeyDesc'] = $fk['Descricao'];

      array_push($fkey, $compPart);

   }

}

$this->smarty->assign('comp',  $comp);

$this->smarty->assign('pkey', $pkey);

$this->smarty->assign('fkey', $fkey);

$this->smarty->assign('ClassId', $this->uri->segment(3));

$this->smarty->display('Incluir.html');


function getFkeyResolution($C, $ofk, $comp){
   
   if(!is_array($ofk)){
      $ofk = (array) $ofk;
   }
   // ajustes para array
   if(!is_array($ofk['ChaveEstrangeiraCampo'])){
      $ofk['ChaveEstrangeiraCampo'] = (array) $ofk['ChaveEstrangeiraCampo'];
   }
   
   if(isset($ofk['ChaveEstrangeiraCampo']['ChaveEstrangeiraId'])){
      $ofk['ChaveEstrangeiraCampo'] = array($ofk['ChaveEstrangeiraCampo']);
   }
   
   for($i=0; $i<count($ofk['ChaveEstrangeiraCampo']); $i++){
      $ofk['ChaveEstrangeiraCampo'][$i] = (array) $ofk['ChaveEstrangeiraCampo'][$i];
   }
   
   $C->setData(
         array(
               'schema' => $ofk['AplicativoId'],
               'table'  => $ofk['TabelaId'],
               'ChaveEstrangeiraId' => $ofk['Id']
         ));
   
   $campo = array();
   $ret = $comp;
   
   foreach($ret['Campo'] as $field){
      
      if(!isset($field['Id'])){
         continue;
      }

      // $b reflete o indice do último campo da lista
      $b = count($ofk['ChaveEstrangeiraCampo'])-1;
      
      $a = $ofk['ChaveEstrangeiraCampo'][$b]['CampoId'];
       
      // para poder montar os campos que serão resolvidos, preciso saber os anteriores
      for($i=0; $i<$b; $i++){
   
         if($ofk['ChaveEstrangeiraCampo'][$i]['CampoId'] == $field['Id']){
            $campo[$i] = $field['Nome'];
   
            $ret['Campo'][$field['Id']]['FKres'][] = $ofk['Id'];
         }
   
      }
   
      if ($field['Id'] == $a &&
            $field['Handler'] == 'ForeingKey'){
          
         if($b > 0){
   
            // caso ele não seja o primeiro nível, preciso estruturas as informações para que ele possa
            // ser chamado depois, via ajax.
             
             
            // as informações necessárias, atualmente são:
            // schema
            // table
            // ChaveEstrangeiraId
            // Campos que influencia acima dele  (texto)
   
            $json = array('Schema' => $ret['AplicativoNome'],
                  'Table'  => $ret['Nome'],
                  'ChaveEstrangeiraId' => $ofk['Id'],
                  'CampoPai' => $campo, // campos pais, para poder descobrir os valores
                  'CampoRes' => $field['Nome'] // campo a ser resolvido pela fk(ultimo nível)
            );
   
            $ret['Campo'][$field['Id']]['ResInfo'] = json_encode($json);
             
         }else{
   
            $res = array(
                  'ChaveEstrangeira' => $ofk,
                  'Resolved' => $C->getFkResolutor()
            );
   
            $ret['Campo'][$field['Id']]['resolution'] = $res;
         }
   
      }
   }
   return $ret;
}


/*
 * End of file Incluir.php
 *
 * */