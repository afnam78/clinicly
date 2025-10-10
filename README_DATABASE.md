# 🧱 Documentación Técnica — Estructura de Base de Datos

## 📘 Contexto General

El sistema es un **SaaS de gestión de clínicas** diseñado con arquitectura **multi-tenant**.  
Cada clínica gestiona sus propios usuarios, servicios y citas, todos aislados por el campo `clinic_id`.

Los pacientes también se gestionan dentro de la tabla `users`, diferenciados por el campo `role = 'patient'`.  
Esto simplifica la autenticación y las relaciones entre empleados y clientes.

---

## 🧩 Diagrama conceptual

```
Clinic (1) ────< (N) Users
  │
  ├───< (N) Services
  │
  └───< (N) Appointments >───(N) Users (patient, specialist)
```

---

## 🏥 Tabla: clinics

Contiene la información principal de cada clínica.

| Campo | Tipo | Descripción |
|--------|------|-------------|
| `id` | bigint | Identificador único |
| `name` | string | Nombre de la clínica |
| `email` | string, nullable | Email de contacto |
| `phone` | string, nullable | Teléfono principal |
| `address` | string, nullable | Dirección |
| `city` | string, nullable | Ciudad |
| `country` | string, nullable | País |
| `logo_path` | string, nullable | Ruta del logo |
| `plan` | enum(`free`, `pro`) | Tipo de plan |
| `active` | boolean | Indica si está activa |
| `created_at`, `updated_at` | timestamps | Fechas de control |

**Relaciones**
- `hasMany(User::class)`
- `hasMany(Service::class)`
- `hasMany(Appointment::class)`

---

## 👥 Tabla: users

Tabla central para empleados, administradores, especialistas, recepcionistas y pacientes.

| Campo | Tipo | Descripción |
|--------|------|-------------|
| `id` | bigint | Identificador |
| `clinic_id` | FK → `clinics.id` | Clínica a la que pertenece |
| `name` | string | Nombre |
| `last_name` | string, nullable | Apellidos |
| `email` | string | Email del usuario |
| `phone` | string, nullable | Teléfono |
| `nif` | string, nullable | Documento de identidad |
| `birth_date` | date, nullable | Fecha de nacimiento |
| `gender` | enum(`male`, `female`, `other`) | Género |
| `role` | enum(`super_admin`, `admin`, `specialist`, `receptionist`, `patient`) | Rol del usuario |
| `password` | string | Hash de la contraseña |
| `notes` | text, nullable | Notas internas |
| `active` | boolean | Usuario activo o no |
| `created_at`, `updated_at` | timestamps | Fechas de control |

**Restricciones**
- `unique(['email', 'clinic_id'])`
- `foreignId('clinic_id')->nullable()->constrained()->nullOnDelete()`

**Roles disponibles**
| Rol | Descripción |
|------|--------------|
| `super_admin` | Usuario global del SaaS (sin clínica) |
| `admin` | Admin de una clínica |
| `specialist` | Profesional sanitario |
| `receptionist` | Personal administrativo |
| `patient` | Paciente o cliente |

**Relaciones**
- `belongsTo(Clinic::class)`
- `hasMany(Appointment::class, 'patient_id')`
- `hasMany(Appointment::class, 'specialist_id')`

---

## 💈 Tabla: services

Define los servicios que ofrece cada clínica.

| Campo | Tipo | Descripción |
|--------|------|-------------|
| `id` | bigint | Identificador |
| `clinic_id` | FK → `clinics.id` | Clínica propietaria |
| `name` | string | Nombre del servicio |
| `description` | text, nullable | Descripción |
| `price` | decimal | Precio |
| `duration` | integer | Duración en minutos |
| `active` | boolean | Si está disponible |
| `created_at`, `updated_at` | timestamps | Fechas de control |

**Relaciones**
- `belongsTo(Clinic::class)`
- `hasMany(Appointment::class)`

---

## 📅 Tabla: appointments

Contiene todas las citas del sistema.

| Campo | Tipo | Descripción |
|--------|------|-------------|
| `id` | bigint | Identificador |
| `clinic_id` | FK → `clinics.id` | Clínica asociada |
| `patient_id` | FK → `users.id` | Paciente |
| `service_id` | FK → `services.id` | Servicio |
| `specialist_id` | FK → `users.id` | Especialista |
| `start_at` | datetime | Inicio |
| `end_at` | datetime, nullable | Fin |
| `duration` | integer, nullable | Duración en minutos |
| `status` | enum(`scheduled`, `completed`, `cancelled`) | Estado |
| `notes` | text, nullable | Notas internas |
| `notified` | boolean | Si se notificó al paciente |
| `created_at`, `updated_at` | timestamps | Fechas de control |

**Relaciones**
- `belongsTo(Clinic::class)`
- `belongsTo(Service::class)`
- `belongsTo(User::class, 'patient_id')`
- `belongsTo(User::class, 'specialist_id')`

**Índices recomendados**
```php
$table->index(['clinic_id', 'start_at']);
$table->index(['patient_id']);
$table->index(['specialist_id']);
```

---

## ⚙️ Relaciones entre entidades

| Relación | Tipo | Descripción |
|-----------|------|-------------|
| `Clinic` → `User` | 1:N | Una clínica tiene muchos usuarios |
| `Clinic` → `Service` | 1:N | Una clínica ofrece varios servicios |
| `Clinic` → `Appointment` | 1:N | Una clínica tiene muchas citas |
| `User` → `Appointment (patient_id)` | 1:N | Un paciente puede tener varias citas |
| `User` → `Appointment (specialist_id)` | 1:N | Un especialista atiende varias citas |
| `Service` → `Appointment` | 1:N | Un servicio puede usarse en varias citas |

---

## 🧠 Consideraciones de diseño

- **Multi-tenancy simple:** todos los datos se agrupan por `clinic_id`.
- **Roles en `users`:** evita duplicar tablas (ej. `patients`).
- **Integridad referencial:** claves foráneas con `cascadeOnDelete()` o `nullOnDelete()`.
- **Escalabilidad:** lista para módulos futuros (`payments`, `invoices`, `subscriptions`).
- **Compatibilidad con Laravel:** Breeze, Jetstream, Cashier, Filament y Nova.

---

## 🔐 Ejemplos de consultas Eloquent

```php
// Citas de una clínica
$appointments = Clinic::find(1)->appointments;

// Especialista de una cita
$specialist = $appointment->specialist;

// Citas futuras de un paciente
$future = $user->appointmentsAsPatient()->where('start_at', '>', now())->get();
```

---

## 🧾 Conclusión

La base de datos sigue una arquitectura **modular, relacional y multi-tenant**,  
ideal para escalar a un SaaS completo con control de roles y permisos.

El diseño es:
- **seguro** (integridad referencial),
- **flexible** (rol único para todos los usuarios),
- **extensible** (servicios, citas y futuras integraciones).
