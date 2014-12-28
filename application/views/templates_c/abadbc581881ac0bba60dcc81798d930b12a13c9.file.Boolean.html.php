<?php /* Smarty version Smarty-3.1.13, created on 2013-11-17 16:26:19
         compiled from "/home/felipe/public_html/application/views/tpl/fieldType/Boolean.html" */ ?>
<?php /*%%SmartyHeaderCode:18311491905288ee2bc83265-55936279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abadbc581881ac0bba60dcc81798d930b12a13c9' => 
    array (
      0 => '/home/felipe/public_html/application/views/tpl/fieldType/Boolean.html',
      1 => 1384702508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18311491905288ee2bc83265-55936279',
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
  'unifunc' => 'content_5288ee2bd8c4a2_67271614',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288ee2bd8c4a2_67271614')) {function content_5288ee2bd8c4a2_67271614($_smarty_tpl) {?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>
   
   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['Default'])){?>
      <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable($_smarty_tpl->tpl_vars['Campo']->value['Default'], null, 0);?>
   <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   
   <?php if ($_smarty_tpl->tpl_vars['Valor']->value=='t'||$_smarty_tpl->tpl_vars['Valor']->value=='true'){?>
      SIM
   <?php }elseif($_smarty_tpl->tpl_vars['Valor']->value=='f'||$_smarty_tpl->tpl_vars['Valor']->value=='false'){?>
      NAO
   <?php }else{ ?>
      &nbsp;
   <?php }?>
<?php }else{ ?>
   <?php if ($_smarty_tpl->tpl_vars['Disabled']->value!=''){?>
      <?php $_smarty_tpl->tpl_vars['Disabled'] = new Smarty_variable('disabled="disabled"', null, 0);?>
   <?php }?>
   <select name='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' autocomplete="off" id='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['Valor']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['Disabled']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['Campo']->value['NotNull'];?>
>
      <?php if ($_smarty_tpl->tpl_vars['Campo']->value['NotNull']!='required'){?><option value='' <?php if ($_smarty_tpl->tpl_vars['Valor']->value==''){?>selected="selected"<?php }?>>* Selecione</option><?php }?>
      <option value='t' <?php if ($_smarty_tpl->tpl_vars['Valor']->value=='t'||$_smarty_tpl->tpl_vars['Valor']->value=='true'){?>selected="selected"<?php }?>>Sim</option>
      <option value='f' <?php if ($_smarty_tpl->tpl_vars['Valor']->value=='f'||$_smarty_tpl->tpl_vars['Valor']->value=='false'){?>selected="selected"<?php }?>>Não</option>
   </select>

<?php }?>
<?php }} ?>