<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->smarty->assign('Titulo', 'CodeBreak');

$this->smarty->assign('BaseURL', base_url());

$this->smarty->display('Login.html');

/*
 * End of file Login.php
 *
 * */