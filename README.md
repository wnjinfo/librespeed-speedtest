# Instalação Manual do LibreSpeed com Nginx (Passo a Passo Completo)

Vou te guiar por todo o processo desde a instalação do servidor até a configuração final do LibreSpeed, incluindo a opção com aaPanel.

## Opção 1: Instalação Manual Completa (Ubuntu 20.04/22.04)

### 1. Atualização do Sistema e Instalação Básica
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl wget git unzip
```

### 2. Instalação do Nginx
```bash
sudo apt install -y nginx
sudo systemctl start nginx
sudo systemctl enable nginx
```

### 3. Instalação do PHP e Extensões Necessárias
```bash
sudo apt install -y php-fpm php-cli php-common php-mbstring php-gd php-curl php-json php-zip php-xml
sudo systemctl start php-fpm
sudo systemctl enable php-fpm
```

### 4. Configuração do Nginx para o LibreSpeed
```bash
sudo nano /etc/nginx/sites-available/speedtest.conf
```

Cole esta configuração (ajuste o `server_name`):
```nginx
server {
    listen 80;
    server_name speedtest.seudominio.com;
    root /var/www/speedtest;
    index index.html index.php;
    access_log /var/log/nginx/speedtest.access.log;
    error_log /var/log/nginx/speedtest.error.log;
    location / {
        try_files $uri $uri/ =404;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    location ~ /\.ht {
        deny all;
    }
}
```

Ative o site e teste a configuração:
```bash
sudo ln -s /etc/nginx/sites-available/speedtest.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 5. Instalação do LibreSpeed
```bash
sudo mkdir -p /var/www/speedtest
cd /var/www/speedtest
sudo git clone https://github.com/librespeed/speedtest.git .
```

### 6. Configuração de Permissões
```bash
sudo chown -R www-data:www-data /var/www/speedtest
sudo chmod -R 755 /var/www/speedtest
```

### 7. Configuração do Backend (Opcional)
Edite as configurações avançadas:
```bash
sudo nano /var/www/speedtest/backend/settings.php
```

Ajuste estes parâmetros para melhor precisão:
```php
<?php
define('TEST_DURATION', 15);      // Duração do teste em segundos
define('STREAM_COUNT', 8);        // Conexões paralelas (aumente para >500Mbps)
define('BUFFER_SIZE', 1048576);   // 1MB buffer size
define('USE_IP_FOR_GEO', true);   // Usar IP para geolocalização
```

### 8. Configurar Certificado SSL (Recomendado)
Instale o Certbot:
```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d speedtest.seudominio.com
```

## Opção 2: Usando aaPanel (Mais Fácil)

### 1. Instalação do aaPanel
```bash
wget -O install.sh http://www.aapanel.com/script/install-ubuntu_6.0_en.sh && sudo bash install.sh
```

Após instalação, acesse:
`http://seu-ip:7800` e complete o setup inicial.

### 2. Criar Site no aaPanel
1. Acesse o painel
2. Vá em "Website" > "Add Site"
3. Preencha:
   - Domain: speedtest.seudominio.com
   - PHP Version: Seleciona a mais recente
   - Create database: Não necessário
4. Clique em "Submit"

### 3. Instalar o LibreSpeed via SSH
```bash
cd /www/wwwroot/speedtest.seudominio.com
git clone https://github.com/librespeed/speedtest.git .
mv speedtest/* .
rm -rf speedtest .git
```

### 4. Configurar Permissões no aaPanel
1. Vá em "Files" > selecione seu domínio
2. Marque todos arquivos
3. Clique em "Permission"
4. Defina:
   - Owner: www
   - Group: www
   - Permission: 755
   - Marque "Replace all files"

### 5. Configuração PHP no aaPanel
1. Vá em "Website" > "PHP Settings"
2. Selecione sua versão do PHP
3. Em "Disable Functions" remova `shell_exec` e `exec` da lista
4. Ajuste estes parâmetros:
   - max_execution_time = 300
   - memory_limit = 512M
   - upload_max_filesize = 100M
   - post_max_size = 100M

### 6. Configurar SSL
1. Vá em "Website" > "SSL"
2. Selecione seu domínio
3. Clique em "Let's Encrypt"
4. Marque "HTTP" e clique em "Apply"

## Configurações Avançadas para Alta Performance

### Otimização do Nginx (para ambas instalações)
```bash
sudo nano /etc/nginx/nginx.conf
```

Adicione dentro do bloco `http`:
```nginx
server_tokens off;
client_max_body_size 100M;
keepalive_timeout 30;
sendfile on;
tcp_nopush on;
gzip on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
```

Reinicie o Nginx:
```bash
sudo systemctl restart nginx
```

### Otimização do PHP-FPM
```bash
sudo nano /etc/php/8.1/fpm/php.ini
```

Ajuste estes valores (ou versão correspondente do seu PHP):
```ini
max_execution_time = 300
memory_limit = 512M
upload_max_filesize = 100M
post_max_size = 100M
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60
```

Reinicie o PHP-FPM:
```bash
sudo systemctl restart php-fpm
```

## Verificação Final

Acesse seu domínio no navegador:
`https://speedtest.seudominio.com`

Para testar a velocidade do servidor (verifique se está adequado):
```bash
wget -O /dev/null http://cachefly.cachefly.net/100mb.test
```

## Solução de Problemas Comuns

### 1. Testes muito lentos
```bash
# Verifique a carga do servidor
htop

# Verifique conexões
sudo netstat -tulnp
```

### 2. Erros 502 Bad Gateway
```bash
# Verifique o PHP-FPM
sudo systemctl status php-fpm
sudo tail -n 50 /var/log/php-fpm.log

# Corrija as permissões
sudo chown -R www-data:www-data /var/www/speedtest
```

### 3. Problemas com WebSockets
```nginx
# Adicione ao seu server block no Nginx
location /ws {
    proxy_pass http://127.0.0.1;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
    proxy_set_header Host $host;
}
```

Esta instalação completa oferece um speedtest profissional com:
- Alta precisão mesmo para conexões de 1Gbps+
- Interface responsiva e moderna
- Configuração otimizada para performance
- Suporte a múltiplos testes simultâneos
- Histórico de resultados (se ativado)

Recomendo especialmente a versão com aaPanel para quem prefere uma interface gráfica para gerenciamento.

![LibreSpeed Logo](https://github.com/librespeed/speedtest/blob/master/.logo/logo3.png?raw=true)

# LibreSpeed

No Flash, No Java, No Websocket, No Bullshit.

This is a very lightweight speed test implemented in Javascript, using XMLHttpRequest and Web Workers.

## Try it

[Take a speed test](https://librespeed.org)

## Compatibility

All modern browsers are supported: IE11, latest Edge, latest Chrome, latest Firefox, latest Safari.
Works with mobile versions too.

## Features

* Download
* Upload
* Ping
* Jitter
* IP Address, ISP, distance from server (optional)
* Telemetry (optional)
* Results sharing (optional)
* Multiple Points of Test (optional)

![Screenrecording of a running Speedtest](https://speedtest.fdossena.com/mpot_v6.gif)

## Server requirements

* A reasonably fast web server with Apache 2 (nginx, IIS also supported)
* PHP 5.4 or newer (other backends also available)
* MariaDB or MySQL database to store test results (optional, Microsoft SQL Server, PostgreSQL and SQLite also supported)
* A fast! internet connection

## Installation

Assuming you have PHP and a web server installed, the installation steps are quite simple.

1. Download the source code and extract it
1. Copy the following files to your web server's shared folder (ie. /var/www/html/speedtest for Apache): index.html, speedtest.js, speedtest_worker.js, favicon.ico and the backend folder
1. Optionally, copy the results folder too, and set up the database using the config file in it.
1. Be sure your permissions allow execute (755).
1. Visit YOURSITE/speedtest/index.html and voila!

### Installation Video

This video shows the installation process of a standalone LibreSpeed server: [Quick start installation guide for Debian 12](https://fdossena.com/?p=speedtest/quickstart_deb12.frag)

More videos will be added later.

## Android app

A template to build an Android client for your LibreSpeed installation is available [here](https://github.com/librespeed/speedtest-android).

## CLI client

A command line client is available [here](https://github.com/librespeed/speedtest-cli).

## Docker

A docker image is available on [GitHub](https://github.com/librespeed/speedtest/pkgs/container/speedtest), check our [docker documentation](doc_docker.md) for more info about it.
The image is built every week to include an updated version of the ipinfo-DB used for ISP detection. Also this ensures, that the latest security patches in PHP are installed. Therefore we recommend to use the `latest` image.

## Go backend

A Go implementation is available in the [`speedtest-go`](https://github.com/librespeed/speedtest-go) repo, maintained by [Maddie Zhan](https://github.com/maddie).

## Rust backend

A Rust implementation is available in the [`speedtest-rust`](https://github.com/librespeed/speedtest-rust) repo, maintained by [Sudo Dios](https://github.com/sudodios).

## Node.js backend

A partial Node.js implementation is available in the `node` branch, developed by [dunklesToast](https://github.com/dunklesToast). It's not recommended to use at the moment.

## Donate

[![Donate with Liberapay](https://liberapay.com/assets/widgets/donate.svg)](https://liberapay.com/fdossena/donate)
[Donate with PayPal](https://www.paypal.me/sineisochronic)

## License

Copyright (C) 2016-2024 Federico Dossena

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/lgpl>.
