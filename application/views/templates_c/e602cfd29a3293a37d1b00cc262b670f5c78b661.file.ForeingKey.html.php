<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:22
         compiled from "application/views/tpl/fieldType/ForeingKey.html" */ ?>
<?php /*%%SmartyHeaderCode:107634015452890a395f8f37-62942642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e602cfd29a3293a37d1b00cc262b670f5c78b661' => 
    array (
      0 => 'application/views/tpl/fieldType/ForeingKey.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107634015452890a395f8f37-62942642',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52890a397c7535_43126022',
  'variables' => 
  array (
    'Valor' => 0,
    'Campo' => 0,
    'Browse' => 0,
    'res' => 0,
    'Aplicativo' => 0,
    'Tabela' => 0,
    'Disabled' => 0,
    'Array' => 0,
    'resfk' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52890a397c7535_43126022')) {function content_52890a397c7535_43126022($_smarty_tpl) {?><?php if (!isset($_smarty_tpl->tpl_vars['Valor']->value)||$_smarty_tpl->tpl_vars['Valor']->value==''){?>
   <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable('', null, 0);?>
   
   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['Default'])){?>
      <?php $_smarty_tpl->tpl_vars['Valor'] = new Smarty_variable($_smarty_tpl->tpl_vars['Campo']->value['Default'], null, 0);?>
   <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['Browse']->value=='1'){?>
   <?php echo $_smarty_tpl->tpl_vars['res']->value;?>

<?php }else{ ?>
<?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['ResInfo'])||isset($_smarty_tpl->tpl_vars['Campo']->value['FKres'])){?>

   <script type="text/javascript">

	   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['FKres'])){?>
	       var obj = <?php echo json_encode($_smarty_tpl->tpl_vars['Campo']->value['FKres']);?>
;
	       localStorage.setItem('FK_<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
', JSON.stringify(obj) );
	   
      <?php }?>
	       
	   <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['ResInfo'])){?>

	      var obj = <?php echo $_smarty_tpl->tpl_vars['Campo']->value['ResInfo'];?>
;
         localStorage.setItem('FK_' + obj.ChaveEstrangeiraId, JSON.stringify(obj) );

      <?php }?>

   </script>
<?php }?> 

<?php if ($_smarty_tpl->tpl_vars['Disabled']->value!=''){?>
   <?php $_smarty_tpl->tpl_vars['Disabled'] = new Smarty_variable('disabled="disabled"', null, 0);?>
<?php }?>

 <select class='ForeingKey' name='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' autocomplete="off" id='<?php echo $_smarty_tpl->tpl_vars['Aplicativo']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Tabela']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['Campo']->value['Nome'];?>
<?php echo $_smarty_tpl->tpl_vars['Array']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['Valor']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['Disabled']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['Campo']->value['NotNull'];?>
>
    <option value=''>* Selecione</option>
    <?php if (isset($_smarty_tpl->tpl_vars['Campo']->value['resolution'])){?>
       <?php  $_smarty_tpl->tpl_vars['resfk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resfk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Campo']->value['resolution']['Resolved']['resolved']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resfk']->key => $_smarty_tpl->tpl_vars['resfk']->value){
$_smarty_tpl->tpl_vars['resfk']->_loop = true;
?>
          <option value='<?php echo $_smarty_tpl->tpl_vars['resfk']->value['Id'];?>
' <?php if ($_smarty_tpl->tpl_vars['resfk']->value['Id']==$_smarty_tpl->tpl_vars['Valor']->value){?>selected=selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['resfk']->value['Resolutor'];?>
</option>
       <?php } ?>
    <?php }?>
 </select>
	   
<?php }?><?php }} ?>