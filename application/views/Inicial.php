<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->smarty->assign('Erro', $this->uri->segment(3));

$this->smarty->assign('userLevel', $this->session->userdata('Tipo') );

$this->smarty->assign('BaseURL', base_url());

$this->smarty->assign('Titulo', 'CodeBreak');

$menu = $this->modelmaster->getMenu();

$this->smarty->assign('Menu',  $menu);

$this->smarty->display('Inicial.html');



/*
 * End of file Incial.php
 *
 * */