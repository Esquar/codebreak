<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/fieldType/Boolean.html" */ ?>
<?php /*%%SmartyHeaderCode:82819086652890a397df748-28398351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d93f41e2b627727fd8fca74ff1d196beeb6612e' => 
    array (
      0 => 'application/views/tpl/fieldType/Boolean.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82819086652890a397df748-28398351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52890a398d5e61_79906818',
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
<?php if ($_valid && !is_callable('content_52890a398d5e61_79906818')) {function content_52890a398d5e61_79906818($_smarty_tpl) {?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
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