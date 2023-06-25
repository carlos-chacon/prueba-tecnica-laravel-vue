# RETO DE PROGRAMACIÓN FULLSTACK

_Construya una aplicación web con estructura monolítica con Laravel que permita la gestión de cursos, estudiantes y la asignación entre estos, teniendo en cuenta que un estudiante puede estar asociado a varios cursos_

## Información requerida para cada entidad
### Estudiante
* Nombre
* Apellido
* Edad
* Correo electrónico
* Cursos asociados

### Cursos
* Nombre
* Horario
* Fecha inicio
* Fecha Fin
* Número de estudiantes asociados

### Operaciones requeridas

* CRUD de estudiantes
* CRUD de cursos
* Asignación de estudiante a un curso especifico
* Consulta del top 3 de los cursos con más estudiantes en los últimos 6 meses
* Listado de cursos a los que se encuentra asignado un estudiante


## Pre-requisitos 📋

- [Docker (4.16.0)](https://www.docker.com/)
- [Node.js (v16.17.0)](https://nodejs.org/en/download/)

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

_Puedes empezar clonando el proyecto con el siguiente comando._

```
git clone https://github.com/carlos-chacon/prueba-tecnica-laravel-vue.git
```

```
cd prueba-tecnica-laravel-vue/
```

## Instalación 🔧

_Para la instalación del proyecto y después de haber clonado el repositorio seguiremos los siguientes pasos:_

#### Usando Contenedor Docker:

- _Nos ubicamos en el directorio principal del proyecto_

- _Creamos una copia del archivos de variables Laravel_

```sh
cp .env.example .env
```

- _Poner en marcha los contenedor docker. Se levantaran los contenedores php, nginx y el espacio de trabajo donde esta el código php_

```sh
docker-compose up -d
```

#### Instalación y configuración proyecto Laravel:

- _Estando en el directorio raíz los siguiente comandos:_

```sh
docker exec -it app_courses sh
```

- _Dentro del shell, ejecutamos los siguientes comandos:_

```sh
composer install
```

```sh
php artisan migrate:fresh --seed
```
```sh
exit
```

### Ejecutar Vue.js

_Nos ubicamos en el directorio raíz del proyecto, y ejecutamos los siguientes comandos:_

```sh
npm install
```

<!-- _Comando para ejecutar el frontend en modo desarrollo:_
```sh
npm run dev
``` -->

_comando para modo producción_
``` sh
npm run build
```

- _Después de realizar los pasos anterior los servicios quedan expuestos en **http://localhost:8080/** ._

- _Credenciales_:

    - Email: admin@ut.com
    - Password: password

## Construido con 🛠️

* [MySQL](https://www.mysql.com/) - Base de datos (v. 5.7.22)
* [Laravel (10.13.5)](https://laravel.com/) - Framework PHP(8.1.20)
* [Vue.js (3.2.41)](https://vuejs.org/) - Framework Javascript
* [Bootstrap (5.3.0)](https://getbootstrap.com/) - Framework front-end CSS
* [Inertiajs (1.0.0)](https://inertiajs.com/) - Aplicaciones web clásicas basadas en servidor
* [Docker (4.16.0)](https://www.docker.com/) - Creación, distribución y ejecución de aplicaciones en contenedores

## Autor ✒️


* **Carlos Chacón** - *Trabajo Inicial* - [carlos-chacon](https://github.com/carlos-chacon)

---

<!-- 
php artisan make:model VCourseStudent -m
php artisan make:model Course --all
php artisan migrate:fresh --seed
php artisan migrate:status
php artisan migrate:rollback 
-->
