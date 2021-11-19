<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Pengunjung</h1>
    <br>
</p>

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### clone git

~~~
https://github.com/andririzkisaputra/buku_pengunjung.git
~~~

### install vendor

~~~
composer update
~~~

### local server

~~~
http://localhost/basic/web/
~~~

DATABASE
------------

### anggota

~~~
CREATE TABLE `anggota` (
  `anggota_id` int(45) NOT NULL,
  `nomor_anggota` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 suspend\r\n1 aktif',
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
~~~

### kehadiran

~~~
CREATE TABLE `kehadiran` (
  `kehadiran_id` int(45) NOT NULL,
  `anggota_id` int(45) DEFAULT NULL,
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
~~~

### user

~~~
CREATE TABLE `user` (
  `user_id` int(45) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_secret` varchar(40) DEFAULT NULL,
  `expires_in` varchar(255) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0. Hapus\r\n1. Aktif',
  `auth_key` varchar(45) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `token_type` varchar(255) DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
~~~

API DOKUMENTASI
------------

### endpoint api anggota

URL_GET : 
~~~
<url>/buku_pengunjung/api/anggota
~~~

URL_POST : 
~~~
<url>/buku_pengunjung/api/anggotas
~~~

URL_PUT : 
~~~
<url>/buku_pengunjung/api/anggota/update?id=anggota_id
~~~

URL_DELETE : 
~~~
<url>/buku_pengunjung/api/anggota/delete?id=anggota_id
~~~

### method

~~~
POST, GET, PUT, DELETE
~~~

### auth

~~~
token_akses
~~~

### header

Content-Type :
~~~
application/json
~~~

Authorization :
~~~
Bearer
~~~

### Body POST dan DELETE Anggota

~~~
nama varchar(45)
~~~

### endpoint api kehadiran

URL_GET : 
~~~
<url>/buku_pengunjung/api/kehadiran
~~~

URL_POST : 
~~~
<url>/buku_pengunjung/api/kehadirans
~~~

### method

~~~
POST, GET
~~~

### auth

~~~
token_akses
~~~

### header

Content-Type :
~~~
application/json
~~~

Authorization :
~~~
Bearer
~~~

### Body POST kehadiran

~~~
nomor_anggota varchar(45)
~~~
