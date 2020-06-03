Para utilizar este projeto e conectar-se ao banco cria uma base de dados em mysql com o nome produtos ulizando as confs abaixo.
	'server' => 'localhost',
	'db' => 'produtos',
	'port' => 3306,
	'user' => 'root',
	'pass' => '',

Cria um vhost no arquivo httpd-vhosts.conf do apache, com as seguintes configurações

<VirtualHost testesupernow.com.br:80>
    ServerAdmin postmaster@testesupernow.com.br
    DocumentRoot "PASTA DO APACHE OU XAMPP\testesupernow.com.br"
    ServerName testesupernow.com.br
    ServerAlias www.testesupernow.com.br

    SetEnv CONFIG_NAME "devlocal"

    <Directory "PASTA DO APACHE OU XAMPP\testesupernow.com.br">

         Options -Indexes +FollowSymLinks
         AllowOverride All
         Order allow,deny
         Allow from all

         #RewriteEngine on
         #RewriteCond %{REQUEST_FILENAME} !-f
         #RewriteCond %{REQUEST_FILENAME} !-d
         #RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]
     </Directory>
</VirtualHost>

E POR ULTIMO ...
Va no arquivos hosts do windows e cria os encaminhamentos.

127.0.0.1       testesupernow.com.br
127.0.0.1       www.testesupernow.com.br

Por fim execute o arquivo de sql dentro do projeto para ter a base em que foi desenvolvido.

-------------------------------------------------------------

Caso não funcione revise o arquivo settings-devlocal.php e verifique se as confs batem com os dados do BD, etc.
Framework desenvolvido por Gabriel Vieira
