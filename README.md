# HASBLI (MARKET PLACE)
## Install

1. git clone https://github.com/ahanbdrt/hasbli-api-laravelv8.git
2. composer install
3. copy .env.example to .env
4. php artsan key:generate
5. php artsan serve
6. dump hasblidb.sql

git checkout -b nama_branch

## modul
* project/login -> jun
* project/jenis_member -> ahan
* project/member -> wibi
* project/tenant -> hasbi
* project/daftar_jenis_barang_tenant -> pandega
* project/daftar_barang tenant -> dimas
* barang jual tenan
* member beli

## Membuat Model

php artisan make:model nama_model -m
example
php artisan make:model tenant_model -r 

## Membuat Resource

php artisan make:resource nama_resource
example :
php artisan make:resource TenantResource

## Membuat Controller
php artisan make:controller Api\TenantController -r 

## Check Route
php artisan route:list

