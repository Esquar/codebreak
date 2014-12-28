<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:18
         compiled from "application/views/tpl/Menu.html" */ ?>
<?php /*%%SmartyHeaderCode:9017659225287cc8f9325f3-04776207%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40ffee05a51dc325fe38b14801571dd096e7897f' => 
    array (
      0 => 'application/views/tpl/Menu.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9017659225287cc8f9325f3-04776207',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287cc8f9a0018_17754575',
  'variables' => 
  array (
    'BaseURL' => 0,
    'Menu' => 0,
    'v' => 0,
    'mk' => 0,
    'k' => 0,
    'mv' => 0,
    'userLevel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287cc8f9a0018_17754575')) {function content_5287cc8f9a0018_17754575($_smarty_tpl) {?><div class="navbar navbar-inverse navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container" style='width:98%'>
         <a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Index" class="brand">CodeBreak</a>
         <div class="nav-collapse collapse">
            <ul class="nav">
               <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
               <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['Descricao'];?>
 <b class="caret"></b></a>
	               <ul class="dropdown-menu">
	                  <?php  $_smarty_tpl->tpl_vars['mv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mv']->_loop = false;
 $_smarty_tpl->tpl_vars['mk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value['Table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mv']->key => $_smarty_tpl->tpl_vars['mv']->value){
$_smarty_tpl->tpl_vars['mv']->_loop = true;
 $_smarty_tpl->tpl_vars['mk']->value = $_smarty_tpl->tpl_vars['mv']->key;
?>
	                      <?php if ($_smarty_tpl->tpl_vars['mk']->value!='Descricao'){?>
	                          <li><a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
.<?php echo $_smarty_tpl->tpl_vars['mk']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['mv']->value;?>
</a></li>
                         <?php }?>
	                  <?php } ?>
	               </ul>
               </li>
               <?php } ?>
            </ul>
            <ul class="nav pull-right">
               <li><a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Logout">Logout</a></li>
               <?php if ($_smarty_tpl->tpl_vars['userLevel']->value=='1'){?>
               <li><a href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/Compilar">Compilar</a></li>
               <?php }?>
            </ul>
         </div>
      </div>
   </div>
</div>
<br><?php }} ?>