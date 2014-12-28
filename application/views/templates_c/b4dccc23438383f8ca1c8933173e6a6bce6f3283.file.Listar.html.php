<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/Listar.html" */ ?>
<?php /*%%SmartyHeaderCode:11126891905287d3f4b68257-40393736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4dccc23438383f8ca1c8933173e6a6bce6f3283' => 
    array (
      0 => 'application/views/tpl/Listar.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11126891905287d3f4b68257-40393736',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287d3f4e2c614_17749303',
  'variables' => 
  array (
    'comp' => 0,
    'BaseURL' => 0,
    'ClassId' => 0,
    'row' => 0,
    'lv' => 0,
    'where' => 0,
    'value' => 0,
    'v' => 0,
    'size' => 0,
    'key' => 0,
    'recomp' => 0,
    'res' => 0,
    'pkey' => 0,
    'primary' => 0,
    'contador' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287d3f4e2c614_17749303')) {function content_5287d3f4e2c614_17749303($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("Head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php echo $_smarty_tpl->getSubTemplate ("Menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<section id='listagem'>
<div class='page-header'>
<h2><?php echo $_smarty_tpl->tpl_vars['comp']->value['Descricao'];?>
</h2>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("MenuAction.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>

<form action='<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Browse' method='post'>
<table style="empty-cells:show;width:100%;" class='table table-hover'>

<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
 $_smarty_tpl->tpl_vars['v']->index++;
 $_smarty_tpl->tpl_vars['v']->first = $_smarty_tpl->tpl_vars['v']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['lista']['first'] = $_smarty_tpl->tpl_vars['v']->first;
?>

   <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['lista']['first']){?>
      <thead>
	      <tr>
	         
	         <?php $_smarty_tpl->tpl_vars['recomp'] = new Smarty_variable(array(), null, 0);?>
	         <?php  $_smarty_tpl->tpl_vars['lv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lv']->_loop = false;
 $_smarty_tpl->tpl_vars['lk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lv']->key => $_smarty_tpl->tpl_vars['lv']->value){
$_smarty_tpl->tpl_vars['lv']->_loop = true;
 $_smarty_tpl->tpl_vars['lk']->value = $_smarty_tpl->tpl_vars['lv']->key;
?>

	           
	           <?php $_smarty_tpl->createLocalArrayVariable('recomp', null, 0);
$_smarty_tpl->tpl_vars['recomp']->value[$_smarty_tpl->tpl_vars['lv']->value['Nome']] = $_smarty_tpl->tpl_vars['lv']->value;?>
	           <?php if ($_smarty_tpl->tpl_vars['lv']->value['Exibicao']!=3){?>
		         <th>
		            <?php echo $_smarty_tpl->tpl_vars['lv']->value['Descricao'];?>

		         </th>
	           <?php }?>
	         <?php } ?>
	         <th>
              &nbsp;
            </th>
	      </tr>
	      <tr>
            <?php  $_smarty_tpl->tpl_vars['lv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lv']->_loop = false;
 $_smarty_tpl->tpl_vars['lk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lv']->key => $_smarty_tpl->tpl_vars['lv']->value){
$_smarty_tpl->tpl_vars['lv']->_loop = true;
 $_smarty_tpl->tpl_vars['lk']->value = $_smarty_tpl->tpl_vars['lv']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['lv']->value['Exibicao']!=3){?>
            <th>
               <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable('', null, 0);?>
               <?php if (isset($_smarty_tpl->tpl_vars['where']->value)){?>
	               <?php if (isset($_smarty_tpl->tpl_vars['where']->value[$_smarty_tpl->tpl_vars['lv']->value['Nome']])){?>
	                  <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable($_smarty_tpl->tpl_vars['where']->value[$_smarty_tpl->tpl_vars['lv']->value['Nome']], null, 0);?>
	               <?php }else{ ?>
	                  <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable('', null, 0);?>
	               <?php }?>
               <?php }?>
               <input type='text' name='<?php echo $_smarty_tpl->tpl_vars['lv']->value['Nome'];?>
' id='<?php echo $_smarty_tpl->tpl_vars['lv']->value['Nome'];?>
' value='<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
' style='min-width:30px;width:90%;'>
            </th>
            <?php }?>
            <?php } ?>
            <th style='vertical-align:middle;'>
              <input type='submit' class='btn btn-primary' value='Busca'>
            </th>
         </tr>
      </thead>
      <tbody>
   <?php }?>
   <tr>
   <?php $_smarty_tpl->tpl_vars['primary'] = new Smarty_variable('', null, 0);?>

   <?php  $_smarty_tpl->tpl_vars['lv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lv']->_loop = false;
 $_smarty_tpl->tpl_vars['lk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lv']->key => $_smarty_tpl->tpl_vars['lv']->value){
$_smarty_tpl->tpl_vars['lv']->_loop = true;
 $_smarty_tpl->tpl_vars['lk']->value = $_smarty_tpl->tpl_vars['lv']->key;
?>
   
      <?php if (substr($_smarty_tpl->tpl_vars['lv']->value['key'],0,3)=='_r_'){?>
         <?php continue 1?>
      <?php }?>

      <?php if (substr($_smarty_tpl->tpl_vars['lv']->value['key'],0,3)=='_v_'){?>
	      <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(strlen($_smarty_tpl->tpl_vars['lv']->value['key']), null, 0);?>
	      <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['lv']->value['key'],3,$_smarty_tpl->tpl_vars['size']->value), null, 0);?>
      <?php }else{ ?>
         <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['key'], null, 0);?>
      <?php }?>
      
      <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['value'], null, 0);?>
      
      <?php if (isset($_smarty_tpl->tpl_vars['lv']->value['resolutor'])){?>
         <?php $_smarty_tpl->tpl_vars['res'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['resolutor'], null, 0);?>
      <?php }else{ ?>
         <?php $_smarty_tpl->tpl_vars['res'] = new Smarty_variable($_smarty_tpl->tpl_vars['value']->value, null, 0);?>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['recomp']->value[$_smarty_tpl->tpl_vars['key']->value]['Exibicao']!=3){?>
      <td>
         <?php echo $_smarty_tpl->getSubTemplate ("fieldType/Campo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['recomp']->value[$_smarty_tpl->tpl_vars['key']->value],'Browse'=>1,'Valor'=>$_smarty_tpl->tpl_vars['value']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value), 0);?>

      </td>
      <?php }?>

      <?php if (isset($_smarty_tpl->tpl_vars['pkey']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
         <?php $_smarty_tpl->tpl_vars['primary'] = new Smarty_variable((((($_smarty_tpl->tpl_vars['primary']->value).($_smarty_tpl->tpl_vars['key']->value)).('=')).($_smarty_tpl->tpl_vars['value']->value)).('&'), null, 0);?>
      <?php }?>
   <?php } ?>
	   <td style='white-space:nowrap;'>
	     <?php if ($_smarty_tpl->tpl_vars['primary']->value!=''){?>
	     <a class="btn" href="/controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Select?<?php echo $_smarty_tpl->tpl_vars['primary']->value;?>
" title='Detalhes'><i class="icon-cog"></i></a>
	     <a class="btn" href="/controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Update?<?php echo $_smarty_tpl->tpl_vars['primary']->value;?>
" title='Editar'><i class="icon-edit"></i></a>
	     <a class="btn" href="/controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Delete?<?php echo $_smarty_tpl->tpl_vars['primary']->value;?>
" title='Excluir'><i class="icon-remove"></i></a>
	     <?php }?>
	   </td>
   </tr>
<?php }
if (!$_smarty_tpl->tpl_vars['v']->_loop) {
?>
<thead>
   <tr>
      <?php $_smarty_tpl->tpl_vars['contador'] = new Smarty_variable(0, null, 0);?>
      <?php  $_smarty_tpl->tpl_vars['lv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lv']->_loop = false;
 $_smarty_tpl->tpl_vars['lk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lv']->key => $_smarty_tpl->tpl_vars['lv']->value){
$_smarty_tpl->tpl_vars['lv']->_loop = true;
 $_smarty_tpl->tpl_vars['lk']->value = $_smarty_tpl->tpl_vars['lv']->key;
?>
      <?php if ($_smarty_tpl->tpl_vars['lv']->value['Exibicao']!=3){?>
      <?php $_smarty_tpl->tpl_vars['contador'] = new Smarty_variable($_smarty_tpl->tpl_vars['contador']->value+2, null, 0);?>
      <th>
         <?php echo $_smarty_tpl->tpl_vars['lv']->value['Descricao'];?>

      </th>
      <th>
         &nbsp;
      </th>
      <?php }?>
      <?php } ?>
   </tr>
</thead>
<tbody>
   <tr>
      <td colspan=<?php echo $_smarty_tpl->tpl_vars['contador']->value;?>
>
         Nenhum registro encontrado
      </td>
   </tr>
<?php } ?>
</tbody>
</table>
</form>
</section>
<?php echo $_smarty_tpl->getSubTemplate ("Footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php }} ?>