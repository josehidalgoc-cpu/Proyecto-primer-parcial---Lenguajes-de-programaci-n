# KeyVault

Una bóveda digital para guardar credenciales. La idea era resolver algo que todos hacemos mal: tener contraseñas, tarjetas y datos personales repartidos entre notas del celular, papeles y la memoria. KeyVault los centraliza en un solo lugar, detrás de una cuenta con autenticación, y los deja organizados por carpetas.

Es un proyecto en equipo. Lo desarrollamos entre **Jose Hidalgo** y yo, repartiéndonos los módulos del sistema.

---

## Qué hace

Cada usuario tiene su propia bóveda privada, y dentro puede guardar cuatro tipos de elementos:

- **Logins** — sitios web con su usuario y contraseña
- **Tarjetas** — datos de tarjetas de crédito y débito
- **Notas seguras** — texto libre que quieras mantener protegido
- **Identidades** — datos personales como nombre completo, cédula, dirección y teléfono

Todo se puede agrupar en **carpetas** para no terminar con una lista interminable. Además hay una sección **Premium** que plantea el modelo de suscripción del producto.

El acceso está protegido con registro e inicio de sesión, y cada usuario solo ve lo que le pertenece.

---

## Operaciones del sistema

| Código | Operación |
|---|---|
| OP-01 | Registro de usuario |
| OP-02 | Inicio y cierre de sesión |
| OP-03 | Crear, editar y eliminar logins |
| OP-04 | Crear, editar y eliminar tarjetas |
| OP-05 | Crear, editar y eliminar notas seguras |
| OP-06 | Crear, editar y eliminar identidades |
| OP-07 | Crear carpetas y asignarles elementos |
| OP-08 | Consultar el panel general de la bóveda |
| OP-09 | Acceder a la sección Premium |

---

## Cómo está construido

El sistema está organizado por módulos de dominio. Cada uno tiene su modelo, su controlador y sus vistas, y todos comparten la misma autenticación y el mismo esquema de carpetas.

```
app/
├── Models/          Eloquent: User, Login, Card, Note, Identity, Folder
├── Http/
│   └── Controllers/ Un controlador por módulo
database/
└── migrations/      Esquema de la base de datos
resources/
└── views/           Vistas Blade con Tailwind
```

La base de datos es MySQL y se accede con **Eloquent ORM**. La autenticación se montó sobre **Laravel Breeze**, lo que dejó resuelto el registro, el login y la protección de rutas desde el arranque.

---

## Reparto del trabajo

| Módulo | Responsable |
|---|---|
| Identidades | **Eddy Lima** |
| Notas Seguras | **Eddy Lima** |
| Carpetas | **Eddy Lima** |
| Logins | Jose Hidalgo |
| Tarjetas | Jose Hidalgo |
| Premium | Jose Hidalgo |

Mi parte incluyó el modelo y las migraciones de esos tres módulos, sus controladores con el CRUD completo, las vistas Blade correspondientes y la relación entre carpetas y elementos, que es la que permite que un mismo contenedor agrupe distintos tipos de registros.

---

## Tecnologías

| Herramienta | Para qué |
|---|---|
| Laravel | Framework principal |
| PHP | Lenguaje del backend |
| Eloquent ORM | Acceso a datos y relaciones entre modelos |
| Laravel Breeze | Registro, login y protección de rutas |
| Blade | Plantillas de las vistas |
| Tailwind CSS | Estilos de la interfaz |
| MySQL | Base de datos |

---

## Cómo ejecutarlo

Necesitas PHP, Composer, Node.js y un servidor MySQL corriendo.

```bash
git clone https://github.com/josehidalgoc-cpu/Proyecto-primer-parcial---Lenguajes-de-programaci-n.git
cd Proyecto-primer-parcial---Lenguajes-de-programaci-n
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

Antes de continuar, edita el archivo `.env` con los datos de tu base de datos:

```
DB_DATABASE=keyvault
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

Luego crea las tablas y levanta el servidor:

```bash
php artisan migrate
php artisan serve
```

Abre `http://localhost:8000`, regístrate y ya puedes empezar a guardar elementos.

---

## Reflexión

Este fue mi primer proyecto trabajando en equipo sobre el mismo repositorio, y ahí aprendí cosas que no se aprenden programando solo. Al principio nos pisábamos los archivos: los dos tocábamos las mismas vistas compartidas y las mismas migraciones, y resolver conflictos se volvió parte del día. Lo que nos ordenó fue repartirnos módulos completos en lugar de tareas sueltas —cada uno dueño de su dominio de punta a punta— y acordar antes de escribir código cómo se iban a llamar las tablas y las relaciones.

En lo técnico, lo más difícil fue el módulo de carpetas. No es un CRUD más: una carpeta tiene que poder contener logins, tarjetas, notas e identidades al mismo tiempo, y eso obliga a pensar bien las relaciones en Eloquent en vez de improvisar una llave foránea por cada tipo. Entender cómo modelar esa relación fue el punto donde más me tocó parar a diseñar antes de escribir.

---

## Autores

**Eddy Lima** — Ingeniería en Sistemas, Universidad Espíritu Santo
[github.com/elima-hub](https://github.com/elima-hub) · [elima-hub.github.io](https://elima-hub.github.io/)

**Jose Hidalgo** — [github.com/josehidalgoc-cpu](https://github.com/josehidalgoc-cpu)
