<?php /* Smarty version Smarty-3.1.13, created on 2013-11-17 18:26:09
         compiled from "application/views/tpl/fieldType/Data.html" */ ?>
<?php /*%%SmartyHeaderCode:71321219452890a41477f07-23070112%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fee866cbf939c270377f0f10008e0a143aa058b0' => 
    array (
      0 => 'application/views/tpl/fieldType/Data.html',
      1 => 1384629549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71321219452890a41477f07-23070112',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Valor' => 0,
    'Campo' => 0,
    'Browse' => 0,
    'Disabled' => 0,
    'Aplicativo' => 0,
    'Tabela' => 0,
    'Array' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52890a4158aee1_52314455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52890a4158aee1_52314455')) {function content_52890a4158aee1_52314455($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/felipe/public_html/application/libraries/smarty/plugins/modifier.date_format.php';
?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>

   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['Default'])){?>

      <?php if ($_smarty_tpl->tpl_vars['Campo']->value['Default']=='now()'||$_smarty_tpl->tpl_vars['Campo']->value['Default']=='NOW()'){?>

         <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable(smarty_modifier_date_format(time(),"%d/%m/%Y"), null, 0);?>
      
      <?php }else{ ?>

         <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable($_smarty_tpl->tpl_vars['Campo']->value['Default'], null, 0);?>
      <?php }?>
   <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable(smarty_modifier_date_format($_smarty_tpl->tpl_vars['Valor']->value,"%d/%m/%Y"), null, 0);?>
   <?php echo $_smarty_tpl->tpl_vars['Valor']->value;?>

<?php }else{ ?>

	<?php if ($_smarty_tpl->tpl_vars['Campo']->value['NotNull']=='f'){?>
	   <?php $_smarty_tpl->createLocalArrayVariable('Campo', null, 0);
$_smarty_tpl->tpl_vars['Campo']->value['NotNull'] = '';?>
	<?php }else{ ?>
	   <?php $_smarty_tpl->createLocalArrayVariable('Campo', null, 0);
$_smarty_tpl->tpl_vars['Campo']->value['NotNull'] = 'required';?>
	<?php }?>

   <?php if ($_smarty_tpl->tpl_vars['Disabled']->value!=''){?>
      <?php $_smarty_tpl->tpl_vars['Disabled'] = new Smarty_variable('disabled="disabled"', null, 0);?>
   <?php }?>

   <input class='Date' type='text' name='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' id='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['Valor']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['Disabled']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['Campo']->value['NotNull'];?>
>
<?php }?><?php }} ?>