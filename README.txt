Instalação:

*** No windows, com "XAMP" ou "WAMP Server"

-No "php.ini", descomentar os seguintes modulos:
   extension=php_pdo_pgsql.dll
   extension=php_pgsql.dll
   
-Se nao existir na pasta do apache, copiar a dll "libpq.dll" que reside na pasta bin do php para a pasta bin do apache.

-No postgres, criar o banco "codebreak", e rodar neste banco o arquivo "sql.backup", que cria toda a estrutura basica do banco.

***

*** No linux (Distro de teste foi o openSUSE, ainda nao finalizado o readme)

Pacotes necessarios:

apache2
apache2-devel
php5
php5-devel
apache2-mod_php5
php5-pgsql
postgres92* (sim, todos os pacotes do postgres92)

Para ativar o mod_rewrite no openSUSE, deve-se editar o arquivo /etc/sysconfig/apache2. No bloco "APACHE_MODULES" adicionar a diretiva "rewrite"

Para ativar o php5-pgsql, deve-se descomentar as extensoes no php.ini.


No postgres, criar o banco "codebreak", e rodar neste banco o arquivo "sql.backup", que cria toda a estrutura basica do banco.