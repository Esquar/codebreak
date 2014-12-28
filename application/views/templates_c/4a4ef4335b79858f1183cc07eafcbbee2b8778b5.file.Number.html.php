<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/fieldType/Number.html" */ ?>
<?php /*%%SmartyHeaderCode:62100117852890a33a8f787-61766084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a4ef4335b79858f1183cc07eafcbbee2b8778b5' => 
    array (
      0 => 'application/views/tpl/fieldType/Number.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62100117852890a33a8f787-61766084',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52890a33b8f474_77622585',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52890a33b8f474_77622585')) {function content_52890a33b8f474_77622585($_smarty_tpl) {?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
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