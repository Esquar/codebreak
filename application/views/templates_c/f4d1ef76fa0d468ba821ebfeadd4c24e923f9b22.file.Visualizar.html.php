<?php /* Smarty version Smarty-3.1.13, created on 2014-01-12 14:20:46
         compiled from "application/views/tpl/Visualizar.html" */ ?>
<?php /*%%SmartyHeaderCode:6274284255288e0e2849338-42218961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4d1ef76fa0d468ba821ebfeadd4c24e923f9b22' => 
    array (
      0 => 'application/views/tpl/Visualizar.html',
      1 => 1384629550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6274284255288e0e2849338-42218961',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5288e0e2a6cd20_47147413',
  'variables' => 
  array (
    'comp' => 0,
    'BaseURL' => 0,
    'row' => 0,
    'v' => 0,
    'lv' => 0,
    'size' => 0,
    'value' => 0,
    'cv' => 0,
    'key' => 0,
    'lk' => 0,
    'desc' => 0,
    'recomp' => 0,
    'res' => 0,
    'pkey' => 0,
    'primary' => 0,
    'ClassId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288e0e2a6cd20_47147413')) {function content_5288e0e2a6cd20_47147413($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("Head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php echo $_smarty_tpl->getSubTemplate ("Menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<section id='inclusao'>
<div class='page-header'>
<h2><?php echo $_smarty_tpl->tpl_vars['comp']->value['Descricao'];?>
</h2>
</div>
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Executar/" class="form-horizontal">
<?php echo $_smarty_tpl->getSubTemplate ("MenuAction.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>

   <?php $_smarty_tpl->tpl_vars['primary'] = new Smarty_variable('', null, 0);?>


   <?php  $_smarty_tpl->tpl_vars['lv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lv']->_loop = false;
 $_smarty_tpl->tpl_vars['lk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lv']->key => $_smarty_tpl->tpl_vars['lv']->value){
$_smarty_tpl->tpl_vars['lv']->_loop = true;
 $_smarty_tpl->tpl_vars['lk']->value = $_smarty_tpl->tpl_vars['lv']->key;
?>

      <?php if (substr($_smarty_tpl->tpl_vars['lv']->value['key'],0,3)=='_r_'){?>
         <?php continue 1?>
      <?php }?>

      <?php if (substr($_smarty_tpl->tpl_vars['lv']->value['key'],0,3)=='_v_'){?>
         <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(strlen($_smarty_tpl->tpl_vars['lv']->value['key']), null, 0);?>
         <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['lv']->value['key'],3,$_smarty_tpl->tpl_vars['size']->value), null, 0);?>
      <?php }else{ ?>
         <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['key'], null, 0);?>
      <?php }?>
      
      <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['value'], null, 0);?>
      
      <?php if (isset($_smarty_tpl->tpl_vars['lv']->value['resolutor'])){?>
         <?php $_smarty_tpl->tpl_vars['res'] = new Smarty_variable($_smarty_tpl->tpl_vars['lv']->value['resolutor'], null, 0);?>
      <?php }else{ ?>
         <?php $_smarty_tpl->tpl_vars['res'] = new Smarty_variable($_smarty_tpl->tpl_vars['value']->value, null, 0);?>
      <?php }?>

	   <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable('', null, 0);?>
	   
      <?php $_smarty_tpl->tpl_vars['recomp'] = new Smarty_variable(array(), null, 0);?>

	   <?php  $_smarty_tpl->tpl_vars['cv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cv']->_loop = false;
 $_smarty_tpl->tpl_vars['ck'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cv']->key => $_smarty_tpl->tpl_vars['cv']->value){
$_smarty_tpl->tpl_vars['cv']->_loop = true;
 $_smarty_tpl->tpl_vars['ck']->value = $_smarty_tpl->tpl_vars['cv']->key;
?>

	      <?php $_smarty_tpl->createLocalArrayVariable('recomp', null, 0);
$_smarty_tpl->tpl_vars['recomp']->value[$_smarty_tpl->tpl_vars['cv']->value['Nome']] = $_smarty_tpl->tpl_vars['cv']->value;?>

	      <?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['cv']->value['Nome']){?>
	        <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable($_smarty_tpl->tpl_vars['cv']->value['Descricao'], null, 0);?>
	      <?php }?>
	   <?php } ?>
      <div class="control-group">
	      <label class="control-label" for="<?php echo $_smarty_tpl->tpl_vars['lk']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
:</label>
	      <div class="controls" id='<?php echo $_smarty_tpl->tpl_vars['lk']->value;?>
'>
            <?php echo $_smarty_tpl->getSubTemplate ("fieldType/Campo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['recomp']->value[$_smarty_tpl->tpl_vars['key']->value],'Browse'=>1,'Valor'=>$_smarty_tpl->tpl_vars['value']->value,'Res'=>$_smarty_tpl->tpl_vars['res']->value), 0);?>

	      </div>
	   </div>
	   <?php if (isset($_smarty_tpl->tpl_vars['pkey']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
         <?php $_smarty_tpl->tpl_vars['primary'] = new Smarty_variable((((($_smarty_tpl->tpl_vars['primary']->value).($_smarty_tpl->tpl_vars['key']->value)).('=')).($_smarty_tpl->tpl_vars['value']->value)).('&'), null, 0);?>
      <?php }?>
   <?php } ?>
   
<?php } ?>
   <div class="form-actions">
	   <a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Update?<?php echo $_smarty_tpl->tpl_vars['primary']->value;?>
" title='Editar'><i class="icon-edit"></i> Editar</a>
	   <a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Acesso/<?php echo $_smarty_tpl->tpl_vars['ClassId']->value;?>
/Delete?<?php echo $_smarty_tpl->tpl_vars['primary']->value;?>
" title='Excluir'><i class="icon-remove"></i> Excluir</a>
   </div>
</form>
</section>
<?php echo $_smarty_tpl->getSubTemplate ("Footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php }} ?>