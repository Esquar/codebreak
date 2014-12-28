<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/fieldType/Campo.html" */ ?>
<?php /*%%SmartyHeaderCode:11142079825287d3f4e5c353-67386711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d5b06b7ab27b94420482f214417e9bdd120230a' => 
    array (
      0 => 'application/views/tpl/fieldType/Campo.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11142079825287d3f4e5c353-67386711',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287d3f545dbc5_41099588',
  'variables' => 
  array (
    'Valor' => 0,
    'res' => 0,
    'Disabled' => 0,
    'Campo' => 0,
    'Browse' => 0,
    'pgsqlArr' => 0,
    'matches' => 0,
    'field' => 0,
    'filename' => 0,
    'val' => 0,
    'Array' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287d3f545dbc5_41099588')) {function content_5287d3f545dbc5_41099588($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>
<?php }?>

<?php if (!isset($_smarty_tpl->tpl_vars['res']->value)){?>
   <?php $_smarty_tpl->tpl_vars['res'] = new Smarty_variable('', null, 0);?>
<?php }?>

<?php if (!isset($_smarty_tpl->tpl_vars['Disabled']->value)){?>
   <?php $_smarty_tpl->tpl_vars['Disabled'] = new Smarty_variable('', null, 0);?>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['Campo']->value['Handler']==''){?>
   <?php $_smarty_tpl->tpl_vars['filename'] = new Smarty_variable("fieldType/Text.html", null, 0);?>
<?php }else{ ?>
   <?php if ($_smarty_tpl->tpl_vars['Campo']->value['Handler']!='serial'){?>
      <?php $_smarty_tpl->tpl_vars['filename'] = new Smarty_variable((("fieldType/").($_smarty_tpl->tpl_vars['Campo']->value['Handler'])).(".html"), null, 0);?>
   <?php }else{ ?>
      <?php $_smarty_tpl->tpl_vars['filename'] = new Smarty_variable("fieldType/Text.html", null, 0);?>
   <?php }?>
<?php }?>

<?php if (!isset($_smarty_tpl->tpl_vars['Browse']->value)){?>
   <?php $_smarty_tpl->tpl_vars['Browse'] = new Smarty_variable('0', null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   

   <?php if ($_smarty_tpl->tpl_vars['Campo']->value['Array']=='1'){?>

	   <?php $_smarty_tpl->tpl_vars['pgsqlArr'] = new Smarty_variable($_smarty_tpl->tpl_vars['res']->value, null, 0);?>

	   <?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(preg_match('/^{(.*)}$/',$_smarty_tpl->tpl_vars['pgsqlArr']->value,$_smarty_tpl->tpl_vars['matches']->value), null, 0);?>
	
	   <?php if (isset($_smarty_tpl->tpl_vars['matches']->value[1])){?>

	      <?php $_smarty_tpl->tpl_vars['field'] = new Smarty_variable(str_getcsv($_smarty_tpl->tpl_vars['matches']->value[1]), null, 0);?>

         <ul>
	      <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>

            <li>
            <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filename']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['Campo']->value,'Valor'=>$_smarty_tpl->tpl_vars['val']->value,'res'=>$_smarty_tpl->tpl_vars['val']->value,'Browse'=>'1'), 0);?>

            </li>

	      <?php } ?>
	      </ul>

	   <?php }else{ ?>
	      &nbsp;
	   <?php }?>
   <?php }else{ ?>
      <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filename']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['Campo']->value,'Valor'=>$_smarty_tpl->tpl_vars['Valor']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value,'Browse'=>1), 0);?>

   <?php }?>
<?php }else{ ?>

   <?php if ($_smarty_tpl->tpl_vars['Campo']->value['Handler']!='serial'){?>
	
	   <div class="control-group">
	      <label class="control-label" for="div<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
"><?php echo $_smarty_tpl->tpl_vars['Campo']->value['Descricao'];?>
</label>
	
	         <?php if ($_smarty_tpl->tpl_vars['Campo']->value['Array']=='1'){?>
		         <?php $_smarty_tpl->tpl_vars['pgsqlArr'] = new Smarty_variable($_smarty_tpl->tpl_vars['Valor']->value, null, 0);?>
		         <?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(preg_match('/^{(.*)}$/',$_smarty_tpl->tpl_vars['pgsqlArr']->value,$_smarty_tpl->tpl_vars['matches']->value), null, 0);?>
		         <?php if (isset($_smarty_tpl->tpl_vars['matches']->value[1])){?>
		
		            <?php $_smarty_tpl->tpl_vars['field'] = new Smarty_variable(str_getcsv($_smarty_tpl->tpl_vars['matches']->value[1]), null, 0);?>
	
		            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
	
	                  <div class="controls" id='div<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
'>
						      <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filename']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['Campo']->value,'Valor'=>$_smarty_tpl->tpl_vars['val']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value,'Array'=>'[]','Browse'=>'0','Disabled'=>$_smarty_tpl->tpl_vars['Disabled']->value), 0);?>

		                  <img onclick="duplica(this); return false;" class="icon-plus" style='cursor:pointer;'>
		                  <img onclick="removerArray(this); return false;" class="icon-ban-circle" style='cursor:pointer;'>
		               </div>
		            <?php } ?>
		         <?php }else{ ?>
		            <div class="controls" id='div<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
'>
		              <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filename']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['Campo']->value,'Valor'=>$_smarty_tpl->tpl_vars['Valor']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value,'Array'=>'[]','Browse'=>'0','Disabled'=>$_smarty_tpl->tpl_vars['Disabled']->value), 0);?>

		               <img onclick="duplica(this); return false;" class="icon-plus" style='cursor:pointer;'>
		               <img onclick="removerArray(this); return false;" class="icon-ban-circle" style='cursor:pointer;'>
		            </div>
		         <?php }?>
	         <?php }else{ ?>
	            <div class="controls" id='div<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
'>
	               <?php if (!isset($_smarty_tpl->tpl_vars['Array']->value)){?>
	                  <?php $_smarty_tpl->tpl_vars['Array'] = new Smarty_variable('', null, 0);?>
	               <?php }else{ ?>
	                  
	                  <?php $_smarty_tpl->tpl_vars['Array'] = new Smarty_variable('[]', null, 0);?>
	               <?php }?>
				      <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filename']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['Campo']->value,'Valor'=>$_smarty_tpl->tpl_vars['Valor']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value,'Array'=>$_smarty_tpl->tpl_vars['Array']->value,'Browse'=>'0','Disabled'=>$_smarty_tpl->tpl_vars['Disabled']->value), 0);?>

				   </div>
	         <?php }?>
	   </div>
   <?php }?>

<?php }?><?php }} ?>