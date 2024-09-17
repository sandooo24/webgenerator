#!/bin/bash
mkdir $1
chmod 757 $1
cd $1/ #abre el directorio proyecto
echo $2 | cat > index.php
chmod 757 index.php
mkdir css
chmod 757 css
cd css #abre el directorio css
mkdir user
chmod 757 user
cd user/ #abre el directorio user
echo " " | cat > estilo.css
chmod 757 estilo.css
cd ../ #cierra el directorio user
mkdir admin
chmod 757 admin
cd admin/ #abre el directorio admin
echo " " | cat > estilo.css
chmod 757 estilo.css
cd ../ #cierra el directorio admin
cd ../ #cierra el directorio css

mkdir img
chmod 757 img
cd img/ #abre el directorio img
mkdir avatars
chmod 757 avatars
mkdir buttons
chmod 757 buttons
mkdir products
chmod 757 products
mkdir pets
chmod 757 pets
cd ../ #cierra el directorio img

mkdir js
chmod 757 js
cd js/ #abre el directorio js
mkdir validations
chmod 757 validations
cd validations/ #abre el directorio validations
echo " " | cat > login.js
chmod 757 login.js
echo " " | cat > register.js
chmod 757 register.js
cd ../ #cierra el directorio validations
mkdir effects
chmod 757 effects
cd effects/ #abre el directorio effects
echo " " | cat > panels.js
chmod 757 panels.js
cd ../ #cierra el directorio effects
cd ../ #cierra el directorio js

mkdir tpl
chmod 757 tpl
cd tpl/ #abre el directorio tpl
echo " " | cat > main.tpl
chmod 757 main.tpl
echo " " | cat > login.tpl
chmod 757 login.tpl
echo " " | cat > register.tpl
chmod 757 register.tpl
echo " " | cat > panel.tpl
chmod 757 panel.tpl
echo " " | cat > profile.tpl
chmod 757 profile.tpl
echo " " | cat > crud.tpl
chmod 757 crud.tpl
cd ../ #cierra el directorio tpl

mkdir php
chmod 757 php
cd php/ #abre el directorio php
echo " " | cat > create.php
chmod 757 create.php
echo " " | cat > read.php
chmod 757 read.php
echo " " | cat > update.php
chmod 757 update.php
echo " " | cat > delete.php
chmod 757 delete.php
echo " " | cat > dbconect.php
chmod 757 dbconect.php
cd ../ #cierra el directorio php

cd ../ #cierra el directorio proyecto