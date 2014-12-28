<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:20:57
         compiled from "application/views/tpl/Login.html" */ ?>
<?php /*%%SmartyHeaderCode:11724350805287c65500f2f0-39103137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b562ace9b5a346f16f1f4b1ab1e6b127d39b6f2a' => 
    array (
      0 => 'application/views/tpl/Login.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11724350805287c65500f2f0-39103137',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287c6550802a8_78722769',
  'variables' => 
  array (
    'BaseURL' => 0,
    'Titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287c6550802a8_78722769')) {function content_5287c6550802a8_78722769($_smarty_tpl) {?><!doctype html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="description" content="Login CodeBreak">
   <meta name="author" content="Felipe Müller">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <script language='JavaScript'>
      var baseURL = '<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
';
   </script>

   <link href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
css/estilo.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
css/bootstrap.min.css" rel="stylesheet" media="screen">

   <style type="text/css">

		body {
		   padding-top: 40px;
		   padding-bottom: 40px;
		   background-color: #f5f5f5;
		}

   </style>

   <title><?php echo $_smarty_tpl->tpl_vars['Titulo']->value;?>
</title>

</head>
<body>
   <div id="container" class='container'>
   
      <form action="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
controller/doLogin" method="post" class="form-signin">
	      <img src='<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
img/Logo.png' border=0 />
	      <br><br>
         <h2 class="form-signin-heading">Faça seu login</h2>

         <label> Usuário: </label>
         <input type="text" name="Login" id="Login"  class="input-block-level" placeholder="Usuário">
         <br>
         <label> Senha: </label>
         <input type="password" name="Pass" id="Pass" class="input-block-level" placeholder="Senha">
         <br>
         <label class="checkbox">
	         <input type="checkbox" value="remember-me"> Lembrar do Login
	      </label>
         <button type="submit" class="btn btn-large btn-primary">Logar</button>
         
      </form>
      
   </div>
   
   <script src="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
js/jquery.js"></script>
   <script src="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
js/bootstrap.min.js"></script>
</body>
</html><?php }} ?>