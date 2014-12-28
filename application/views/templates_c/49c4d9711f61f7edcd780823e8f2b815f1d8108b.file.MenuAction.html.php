<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/MenuAction.html" */ ?>
<?php /*%%SmartyHeaderCode:9334811875287d3f4e3fa74-82632449%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49c4d9711f61f7edcd780823e8f2b815f1d8108b' => 
    array (
      0 => 'application/views/tpl/MenuAction.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9334811875287d3f4e3fa74-82632449',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287d3f4e56fa4_25883947',
  'variables' => 
  array (
    'BaseURL' => 0,
    'ClassId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287d3f4e56fa4_25883947')) {function content_5287d3f4e56fa4_25883947($_smarty_tpl) {?><div>
   <nav id='actionLink'>
	   <a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Browse"><button type="button" class="btn btn-primary">Listar</button></a>
	   <a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Insert"><button type="button" class="btn btn-primary">Incluir</button></a>
   </nav>
   
   <hr class="bs-docs-separator">
</div><?php }} ?>