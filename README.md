## Configuración  

.env:
- Cambiar el nombre del proyecto
- Cambiar la base de datos a mysql y ponerle un nombre

DEEPL_KEY=''

GOOGLE_PLACES_API_KEY=

GOOGLE_PLACES_ID=

Configurar base de datos en el .env para poder almacenar las reviews y las sessions de usuarios.

## Configuración de emails

- php artisan make:mail Contacto --markdown=mail.contacto
- php artisan vendor:publish --tag=laravel-mail
- php artisan make:controller ContactoController

.env:
- Añadir:

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=info@metahorus.es
MAIL_PASSWORD=Choscar-2341
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@metahorus.es"
MAIL_FROM_NAME="${APP_NAME}"
USER_EMAIL="info@metahorus.es"

## Configuración de banner de cookies

- php artisan make:livewire cookie-banner   



