<?php /* Smarty version Smarty-3.1.13, created on 2014-02-21 14:48:24
         compiled from "application/views/tpl/Incluir.html" */ ?>
<?php /*%%SmartyHeaderCode:2086795515288ee0039b811-19575037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f23cc82e19ee27c3bba92eadb5810318e0ae703' => 
    array (
      0 => 'application/views/tpl/Incluir.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2086795515288ee0039b811-19575037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5288ee0052c721_81775405',
  'variables' => 
  array (
    'comp' => 0,
    'BaseURL' => 0,
    'fkey' => 0,
    'v' => 0,
    'valor' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5288ee0052c721_81775405')) {function content_5288ee0052c721_81775405($_smarty_tpl) {?>
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

   <input type="hidden" name="Acao" id="Acao" value="Incluir">

   <input type="hidden" name="MasterSchemaId"   id="MasterSchemaId"  value="<?php echo $_smarty_tpl->tpl_vars['comp']->value['AplicativoNome'];?>
">
   <input type="hidden" name="MasterTableId"    id="MasterTableId"   value="<?php echo $_smarty_tpl->tpl_vars['comp']->value['Nome'];?>
">

	<ul class="nav nav-tabs">
	   <li class="active">
	      <a href="#" id='div_primary'>Inclusão</a>
	   </li>

	   
	   <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fkey']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	   <li>
	      <a href="#" id='div_<?php echo $_smarty_tpl->tpl_vars['v']->value['FKeyDesc'];?>
'><?php echo $_smarty_tpl->tpl_vars['v']->value['Descricao'];?>
</a>
	   </li>
	   <?php } ?>
	</ul>

   
   <div class="nav-div active" id='rel_div_primary'>

		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comp']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>

		   <?php if ($_smarty_tpl->tpl_vars['v']->value['Exibicao']==1||$_smarty_tpl->tpl_vars['v']->value['Exibicao']==3){?>		      
            <?php echo $_smarty_tpl->getSubTemplate ("fieldType/Campo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['v']->value,'Aplicativo'=>$_smarty_tpl->tpl_vars['comp']->value['AplicativoNome'],'Tabela'=>$_smarty_tpl->tpl_vars['comp']->value['Nome']), 0);?>

         <?php }?>

		<?php } ?>

   </div>

   
   <?php  $_smarty_tpl->tpl_vars['valor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['valor']->_loop = false;
 $_smarty_tpl->tpl_vars['chave'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fkey']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['valor']->key => $_smarty_tpl->tpl_vars['valor']->value){
$_smarty_tpl->tpl_vars['valor']->_loop = true;
 $_smarty_tpl->tpl_vars['chave']->value = $_smarty_tpl->tpl_vars['valor']->key;
?>
      <div class="nav-div" id='rel_div_<?php echo $_smarty_tpl->tpl_vars['valor']->value['FKeyDesc'];?>
'>
         <button class="btn btn-large btn-block" type="button" onclick="addAppend(this, '<?php echo $_smarty_tpl->tpl_vars['valor']->value['FKeyDesc'];?>
')">Clique para adicionar</button>
      </div> 
   <?php } ?>

   <div class="form-actions">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <button type="reset" class="btn">Cancelar</button>
   </div>
</form>

<?php  $_smarty_tpl->tpl_vars['valor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['valor']->_loop = false;
 $_smarty_tpl->tpl_vars['chave'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fkey']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['valor']->key => $_smarty_tpl->tpl_vars['valor']->value){
$_smarty_tpl->tpl_vars['valor']->_loop = true;
 $_smarty_tpl->tpl_vars['chave']->value = $_smarty_tpl->tpl_vars['valor']->key;
?>
   <div style='display:none' id='<?php echo $_smarty_tpl->tpl_vars['valor']->value['FKeyDesc'];?>
' name='<?php echo $_smarty_tpl->tpl_vars['valor']->value['FKeyDesc'];?>
'>
      <div>
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['valor']->value['Campo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>

	   <?php if ($_smarty_tpl->tpl_vars['v']->value['Exibicao']==1||$_smarty_tpl->tpl_vars['v']->value['Exibicao']==3){?>
         <?php echo $_smarty_tpl->getSubTemplate ("fieldType/Campo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('Campo'=>$_smarty_tpl->tpl_vars['v']->value,'Aplicativo'=>$_smarty_tpl->tpl_vars['valor']->value['AplicativoNome'],'Tabela'=>$_smarty_tpl->tpl_vars['valor']->value['Nome'],'Array'=>1), 0);?>

      <?php }?>

	<?php } ?>

      <img onclick="duplica(this); return false;" class="icon-plus" style='cursor:pointer'>
      <img onclick="remover(this, '<?php echo $_smarty_tpl->tpl_vars['valor']->value['FKeyDesc'];?>
'); return false;" class="icon-ban-circle" style='cursor:pointer'>
      </div>
	</div>
<?php } ?>

</section>
<?php echo $_smarty_tpl->getSubTemplate ("Footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 1);?>


<?php }} ?>