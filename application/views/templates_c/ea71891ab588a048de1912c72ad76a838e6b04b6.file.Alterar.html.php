<?php /* Smarty version Smarty-3.1.13, created on 2013-11-17 15:33:59
         compiled from "application/views/tpl/Alterar.html" */ ?>
<?php /*%%SmartyHeaderCode:5722586185288e1e72cdc39-38118692%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea71891ab588a048de1912c72ad76a838e6b04b6' => 
    array (
      0 => 'application/views/tpl/Alterar.html',
      1 => 1384629549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5722586185288e1e72cdc39-38118692',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'comp' => 0,
    'BaseURL' => 0,
    'row' => 0,
    'v' => 0,
    'lv' => 0,
    'size' => 0,
    'value' => 0,
    'key' => 0,
    'pkey' => 0,
    'cv' => 0,
    'res' => 0,
    'disabled' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5288e1e74ebe48_87521383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288e1e74ebe48_87521383')) {function content_5288e1e74ebe48_87521383($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("Head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php echo $_smarty_tpl->getSubTemplate ("Menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<section id='inclusao'>
<div class='page-header'>
<h2><?php echo $_smarty_tpl->tpl_vars['comp']->value['Descricao'];?>
</h2>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("MenuAction.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/Executar/" class="form-horizontal">

<input type="hidden" name="Acao" id="Acao" value="Atualizar">

<input type="hidden" name="MasterSchemaId"   id="MasterSchemaId"  value="<?php echo $_smarty_tpl->tpl_vars['comp']->value['AplicativoNome'];?>
">
<input type="hidden" name="MasterTableId"    id="MasterTableId"   value="<?php echo $_smarty_tpl->tpl_vars['comp']->value['Nome'];?>
">


<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>

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
      <?php if (isset($_smarty_tpl->tpl_vars['pkey']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
         
         
         <input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' id='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
'>         
         <?php $_smarty_tpl->tpl_vars['disabled'] = new Smarty_variable('disabled', null, 0);?>
      <?php }else{ ?>
         <?php $_smarty_tpl->tpl_vars['disabled'] = new Smarty_variable('', null, 0);?>
      <?php }?>


      <?php  $_smarty_tpl->tpl_vars['cv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cv']->_loop = false;
 $_smarty_tpl->tpl_vars['ck'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cv']->key => $_smarty_tpl->tpl_vars['cv']->value){
$_smarty_tpl->tpl_vars['cv']->_loop = true;
 $_smarty_tpl->tpl_vars['ck']->value = $_smarty_tpl->tpl_vars['cv']->key;
?>

         <?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['cv']->value['Nome']){?>
            

		      

			   <?php if ($_smarty_tpl->tpl_vars['cv']->value['Exibicao']==1){?>

		         <?php echo $_smarty_tpl->getSubTemplate ("fieldType/Campo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['cv']->value,'Valor'=>$_smarty_tpl->tpl_vars['value']->value,'res'=>$_smarty_tpl->tpl_vars['res']->value,'Aplicativo'=>$_smarty_tpl->tpl_vars['comp']->value['AplicativoNome'],'Tabela'=>$_smarty_tpl->tpl_vars['comp']->value['Nome'],'Browse'=>'0','Disabled'=>$_smarty_tpl->tpl_vars['disabled']->value), 0);?>

			   <?php }?>
         <?php }?>

      <?php } ?>
   <?php } ?>
   
<?php } ?>

   <div class="form-actions">
      <button type="submit" class="btn btn-primary">Salvar</button>
   </div>
</form>
</section>
<?php echo $_smarty_tpl->getSubTemplate ("Footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php }} ?>