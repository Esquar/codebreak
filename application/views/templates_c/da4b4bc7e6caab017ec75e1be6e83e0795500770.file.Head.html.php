<?php /* Smarty version Smarty-3.1.13, created on 2014-02-15 09:21:18
         compiled from "application/views/tpl/Head.html" */ ?>
<?php /*%%SmartyHeaderCode:18866533375287cc8f917b77-28802228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da4b4bc7e6caab017ec75e1be6e83e0795500770' => 
    array (
      0 => 'application/views/tpl/Head.html',
      1 => 1392293013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18866533375287cc8f917b77-28802228',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5287cc8f92d476_70419676',
  'variables' => 
  array (
    'BaseURL' => 0,
    'Titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5287cc8f92d476_70419676')) {function content_5287cc8f92d476_70419676($_smarty_tpl) {?><!doctype html>
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
css/estilo.css" rel="stylesheet"  media="screen">
   <link href="<?php echo $_smarty_tpl->tpl_vars['BaseURL']->value;?>
css/bootstrap.min.css" rel="stylesheet" media="screen">

   <style type="text/css">

      body {
         padding-top: 20px;
         padding-bottom: 40px;
         /*background-color: #f5f5f5;*/
      	width:100%;
      }

   </style>

   <title><?php echo $_smarty_tpl->tpl_vars['Titulo']->value;?>
</title>

</head>
<body>
<div id='container' class='container' style='width:98%;text-align:left;'>
<?php }} ?>