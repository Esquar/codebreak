<?php /* Smarty version Smarty-3.1.13, created on 2013-11-17 16:56:51
         compiled from "/home/felipe/public_html/application/views/tpl/fieldType/TextArea.html" */ ?>
<?php /*%%SmartyHeaderCode:383065235288f5531e83f3-12578976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d61816eb6da6294b1125769bd2cadb4aa1e0576' => 
    array (
      0 => '/home/felipe/public_html/application/views/tpl/fieldType/TextArea.html',
      1 => 1384629549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '383065235288f5531e83f3-12578976',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Valor' => 0,
    'Browse' => 0,
    'Disabled' => 0,
    'Aplicativo' => 0,
    'Tabela' => 0,
    'Campo' => 0,
    'Array' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5288f553359e49_53796574',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288f553359e49_53796574')) {function content_5288f553359e49_53796574($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/felipe/public_html/application/libraries/smarty/plugins/modifier.replace.php';
?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   
   <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['Valor']->value,"\n","<br>");?>

<?php }else{ ?>

   <?php if ($_smarty_tpl->tpl_vars['Disabled']->value!=''){?>
      <?php $_smarty_tpl->tpl_vars['Disabled'] = new Smarty_variable('disabled="disabled"', null, 0);?>
   <?php }?>

   <textarea name='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
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
><?php echo $_smarty_tpl->tpl_vars['Valor']->value;?>
</textarea>

<?php }?><?php }} ?>