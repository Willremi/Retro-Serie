﻿# Retro-Serie

**Pour faire redirection de l'index dans dossier public** 

D:\laragon\etc\apache2\sites-enabled

Dans auto.poo.local.conf, il faut ajouter /public dans DocumentRoot

<VirtualHost *:80>  
    DocumentRoot "D:/projetsWeb/mes-annonces/public"  
    ServerName mes-annonces.local  
    ServerAlias *.mes-annonces.local  
    <Directory "D:/projetsWeb/mes-annonces">  
        AllowOverride All  
        Require all granted  
    </Directory>  
</VirtualHost>  
