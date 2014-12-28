<?php /* Smarty version Smarty-3.1.13, created on 2013-11-17 16:26:19
         compiled from "/home/felipe/public_html/application/views/tpl/fieldType/Number.html" */ ?>
<?php /*%%SmartyHeaderCode:19856891715288ee2bbb3484-66896878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fb3b0b727020f7b001f09e5a7601f6475bb955e' => 
    array (
      0 => '/home/felipe/public_html/application/views/tpl/fieldType/Number.html',
      1 => 1384629549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19856891715288ee2bbb3484-66896878',
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
  'unifunc' => 'content_5288ee2bc79931_46223222',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288ee2bc79931_46223222')) {function content_5288ee2bc79931_46223222($_smarty_tpl) {?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>
   
   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['Default'])){?>
      <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable($_smarty_tpl->tpl_vars['Campo']->value['Default'], null, 0);?>
   <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   
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

   <input class='Number' type='text' name='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
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