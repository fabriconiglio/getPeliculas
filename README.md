# Guía para Probar el Sistema

Esta guía te proporcionará los pasos necesarios para probar nuestro sistema en tu entorno local. Asegúrate de seguir cada uno de los pasos con cuidado para garantizar una configuración exitosa.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu sistema:

- [Git](https://git-scm.com/) - Para clonar el repositorio.
- Un editor de texto para modificar archivos.
- Acceso a una base de datos.

## Pasos

1. **Clonar el Repositorio**

   Abre una terminal y ejecuta el siguiente comando para clonar el repositorio en tu sistema:

   ```bash
     git clone https://github.com/fabriconiglio/getPeliculas.git

2.Ve al directorio raíz del proyecto clonado y duplica el archivo .env.example en donde el archivo duplicado en vez de ser .env.example sea .env

3.Abre el archivo .env en tu editor de texto y configura las variables de la base de datos según tus necesidades. Asegúrate de proporcionar la información correcta, como el nombre de la base de datos, el usuario y la contraseña
Ej:

    
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=peliculas
            DB_USERNAME=root
            DB_PASSWORD=


4. Ir a la pagina https://www.themoviedb.org/ y registrarse para usar el acceso token para obtener los datos de la api. Una vez obtenido agregarla al .env TMDB_TOKEN='aca va tu acceso token'

5.Ejecuta el siguiente comando para instalar las dependencias PHP del proyecto utilizando Composer:

        
            composer install

6. Generar una clave de aplicación:

Laravel utiliza una clave de aplicación para cifrar cookies y otros datos sensibles. Genera una nueva clave de aplicación usando el siguiente comando:

    
       php artisan key:generate
       
7.Migraciones y base de datos:

Si vas a utilizar una base de datos, crea las migraciones y aplica las migraciones para crear las tablas necesarias en la base de datos:

     `
       php artisan migrate

8.Iniciar el Servidor de Desarrollo

    
        php artisan serve

9. Por ultimo nos dirigimos al http://127.0.0.1:8000/fetch-movies para obtener las pelis

10. Nos vamos http://127.0.0.1:8000 y ya podemos hacer el CRUD de los datos



