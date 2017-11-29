# **Guia de Instalación para Ubuntu**
* * *
#### Preparando ambiente de desarrollo
1.  **Requisitos Previos**
    - Instalar Apache y PHP 
    - Instalar Composer  
    - Instalar Node `sudo apt-get install nodejs` + `sudo apt-get install npm`
    - Instalar Gulp `sudo npm install gulp-cli -g`
2. **Extension composer assets-plugin**
    `composer global require "fxp/composer-asset-plugin:^1.2.0"`
3.  **Crear hosts upch-padlock.dev**
    `sudo nano /etc/hosts`
    Agregar al final de lo existente: _127.0.0.1 padlock.dev_
4.  **Crear Virtual host**
    `sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/padlock.dev.conf`
    `sudo nano /etc/apache2/sites-available/padlock.dev.conf`
     
        <VirtualHost padlock.dev:80>
            ServerName padlock.dev
            ServerAlias www.padlock.dev
    
            ServerAdmin webmaster@localhost
            DocumentRoot PATH/TO/PROYECTO/padlock/dist/
    
            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>

    Luego se debe habilitar el virtual host : `sudo a2ensite padlock.dev.conf`
    Y para finalizar se reinicia el apache: `sudo service apache2 restart`

### Instalando la aplicacion
**Crear project** `composer create-project insite/padlock padlock -s dev`

