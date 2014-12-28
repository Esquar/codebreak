<?php /* Smarty version Smarty-3.1.13, created on 2014-03-06 17:14:14
         compiled from "application/views/tpl/fieldType/TextArea.html" */ ?>
<?php /*%%SmartyHeaderCode:113648890552890a4134e159-73418321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf73b9aa3b5f9d5de411c3ee1b20fa9adfc51fc8' => 
    array (
      0 => 'application/views/tpl/fieldType/TextArea.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113648890552890a4134e159-73418321',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52890a4146a602_25931151',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52890a4146a602_25931151')) {function content_52890a4146a602_25931151($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/var/www/application/libraries/smarty/plugins/modifier.replace.php';
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