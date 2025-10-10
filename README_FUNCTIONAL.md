# 📄 Documentación Funcional — Clinicly
*Gestor simple para clínicas pequeñas (MVP 3 meses)*

---

## 1. 🎯 Objetivo general

Desarrollar un **SaaS web** que permita a pequeñas clínicas (1–5 profesionales) gestionar:
- Sus **pacientes**,  
- Sus **citas**,  
- Sus **pagos/facturas**,  
- Y recibir **recordatorios automáticos**,  

de forma **simple, rápida y en español**, sin necesidad de conocimientos técnicos.

---

## 2. 👥 Roles de usuario

| Rol | Descripción | Permisos |
|------|--------------|-----------|
| **Administrador** | Propietario de la clínica (dueño o responsable). | Acceso completo a todas las funciones: configuración, usuarios, pacientes, citas, pagos, estadísticas. |
| **Profesional** | Fisioterapeuta, esteticista, psicólogo, etc. | Gestiona sus propias citas y pacientes. No puede modificar la configuración global ni ver ingresos totales. |
| **Recepcionista (opcional)** | Personal de atención o soporte. | Puede crear/modificar citas y pacientes, pero no acceder a la configuración o facturación. |

---

## 3. 🧱 Módulos funcionales del MVP

A continuación, se detallan las funcionalidades previstas para los primeros **3 meses de desarrollo**.

---

### 3.1 👤 Módulo de usuarios y autenticación

**Objetivo:** Permitir el registro y acceso seguro de los usuarios.

**Funcionalidades:**
- Registro con nombre, email, contraseña y nombre de la clínica.  
- Inicio de sesión y cierre de sesión.  
- Recuperación de contraseña vía email.  
- Roles y permisos gestionados con `spatie/laravel-permission`.  
- Panel de perfil para cambiar contraseña o datos personales.  

**Requisitos técnicos:**
- Laravel Breeze / Fortify.  
- Middleware de autorización (`role:admin`, `role:professional`).  

---

### 3.2 🧑‍⚕️ Módulo de pacientes

**Objetivo:** Permitir a cada profesional registrar y gestionar la información básica de sus pacientes.

**Funcionalidades:**
- Crear, editar y eliminar pacientes.  
- Campos principales:  
  - Nombre completo  
  - Teléfono  
  - Email (opcional)  
  - Fecha de nacimiento  
  - Notas / historial breve  
- Búsqueda y filtro de pacientes.  
- Relación entre paciente y profesional (solo el profesional que lo creó puede editarlo).  
- Exportación a CSV o PDF (opcional para versión Pro).  

**Requisitos técnicos:**
- Modelo `Patient` relacionado con `User`.  
- CRUD con políticas de acceso.  

---

### 3.3 📅 Módulo de citas (agenda)

**Objetivo:** Gestionar citas de manera visual y simple.

**Funcionalidades:**
- Crear cita (paciente + profesional + fecha/hora + duración + servicio).  
- Editar / eliminar citas.  
- Visualización tipo calendario (día / semana).  
- Drag & drop para mover o reprogramar citas (opcional con Livewire).  
- Estado de cita: *pendiente, completada, cancelada*.  
- Vista por profesional y vista general (admin).  
- Filtro por fecha o estado.  

**Notificaciones automáticas:**
- Recordatorio por email 24 h antes de la cita.  
- Notificación interna al profesional cuando se crea/modifica una cita.

**Requisitos técnicos:**
- Modelo `Appointment`.  
- Jobs para envíos programados de recordatorios.  
- Paquete `fullcalendar.js` o Livewire calendar.

---

### 3.4 💶 Módulo de pagos y facturación

**Objetivo:** Registrar cobros y generar facturas simples.

**Funcionalidades:**
- Asociar pago a una cita o paciente.  
- Campos: importe, método (efectivo, tarjeta, transferencia), fecha, observaciones.  
- Generar factura PDF con datos básicos de la clínica y el paciente.  
- Numeración automática de facturas.  
- Descarga PDF desde el panel.  

**Requisitos técnicos:**
- Modelo `Payment` y `Invoice`.  
- Generación con `dompdf` o `snappy`.  
- No se requiere integración directa con Hacienda en MVP.

---

### 3.5 🔔 Módulo de notificaciones

**Objetivo:** Automatizar recordatorios para reducir ausencias.

**Funcionalidades:**
- Recordatorio por email antes de la cita.  
- Envío opcional por WhatsApp (fase posterior, API Twilio).  
- Plantilla personalizable (nombre de clínica, hora, mensaje).  
- Registro de último envío (fecha/hora).  

**Requisitos técnicos:**
- Laravel Notifications.  
- Job programado (Scheduler).  
- Configuración editable por el administrador (horas antes del envío).  

---

### 3.6 📊 Dashboard y estadísticas

**Objetivo:** Mostrar información relevante al usuario.

**Métricas básicas para MVP:**
- Total de pacientes registrados.  
- Citas programadas para hoy / esta semana.  
- Ingresos totales del mes.  
- Citas completadas vs canceladas.  

**Visualización:**
- Gráficos simples (Chart.js o ApexCharts).  
- Widgets con totales y comparativas.  

---

### 3.7 ⚙️ Módulo de configuración

**Objetivo:** Personalizar la clínica y horarios.

**Funcionalidades:**
- Datos básicos: nombre, logo, dirección, email, teléfono.  
- Horario laboral (inicio, fin, días no laborables).  
- Servicios ofrecidos (nombre, duración, precio).  
- Configuración de recordatorios (activar/desactivar, tiempo previo).  
- Configuración de facturación (datos fiscales, número inicial de factura).  

---

### 3.8 🧾 Facturación por suscripción (SaaS)

**Objetivo:** Gestionar planes y pagos de las clínicas.

**Funcionalidades:**
- Integración con **Stripe** vía Laravel Cashier.  
- Plan gratuito limitado (Free).  
- Planes de pago (Basic y Pro) con límites de uso:  
  - Basic: hasta 3 profesionales.  
  - Pro: ilimitado, incluye estadísticas y exportación.  
- Prueba gratuita de 14 días.  
- Cancelación / renovación automática.  

**Requisitos técnicos:**
- Tabla `subscriptions` gestionada por Cashier.  
- Middleware para validar plan activo antes de acceder a ciertas funciones.  

---

### 3.9 🧾 Landing Page (marketing)

**Objetivo:** Captar usuarios y facilitar el registro.

**Funcionalidades:**
- Página pública con:
  - Descripción del producto.  
  - Capturas / beneficios.  
  - Botón “Probar gratis”.  
- Formulario de registro directo al plan Free.  
- Política de privacidad y términos de servicio.  

---

## 4. 🔒 Requisitos no funcionales

| Categoría | Descripción |
|------------|-------------|
| **Seguridad** | Encriptación de contraseñas (bcrypt), tokens CSRF, validaciones robustas. |
| **Privacidad** | Cumplimiento RGPD, datos alojados en la UE. |
| **Rendimiento** | Carga inicial < 2s en dashboards pequeños. |
| **Disponibilidad** | 99 % uptime en producción (Forge + backups). |
| **Mantenibilidad** | Código modular por dominio (DDD-light). |
| **Compatibilidad** | Navegadores modernos (Chrome, Firefox, Safari). |
| **Idiomas** | Español (v1), internacionalización prevista. |

---

## 5. 🧭 Flujos principales (user journeys)

### 5.1 Crear una cita
1. Profesional inicia sesión.  
2. Va a “Agenda” → “Nueva cita”.  
3. Selecciona paciente existente o crea uno nuevo.  
4. Define fecha, hora, servicio y duración.  
5. Guarda.  
6. Se crea automáticamente el recordatorio 24h antes de la cita.

---

### 5.2 Registrar pago y generar factura
1. Profesional abre cita completada.  
2. Marca como “Pagada”.  
3. Introduce importe y método.  
4. El sistema genera factura PDF numerada.  
5. Opción de descargar o enviar por email.  

---

### 5.3 Flujo de recordatorio automático
1. Cron diario revisa citas próximas (24h).  
2. Envía email a paciente (Plantilla: “Recordatorio de cita con Clínica X”).  
3. Marca recordatorio como enviado.  

---

### 5.4 Suscripción SaaS
1. Usuario crea cuenta → plan Free.  
2. En configuración puede “Actualizar plan”.  
3. Se abre checkout de Stripe.  
4. Tras pago, el plan se actualiza automáticamente.  
5. Al expirar o cancelar, vuelve al plan Free.  

---

## 6. 🧭 Roadmap funcional (por prioridad)

| Prioridad | Módulo | Justificación |
|------------|--------|----------------|
| 🟥 Alta | Usuarios / autenticación | Base del sistema |
| 🟥 Alta | Pacientes | Esencial para clínica |
| 🟥 Alta | Citas / Agenda | Núcleo funcional |
| 🟧 Media | Pagos / Facturas | Valor añadido inmediato |
| 🟧 Media | Notificaciones | Reduce ausencias |
| 🟨 Media | Configuración clínica | Personalización mínima |
| 🟩 Baja | Dashboard / estadísticas | Mejora visual pero no crítica |
| 🟩 Baja | Suscripciones SaaS | Puede implementarse en última etapa |

---

## 7. 📋 Limitaciones del MVP

- No incluye reservas online por pacientes.  
- Sin integración con Google Calendar.  
- Recordatorios solo por email (no SMS).  
- Sin multi-clínica (cada cuenta = una clínica).  
- No hay app móvil (solo web responsive).  

---

## 8. ✅ Criterios de éxito del MVP

- El usuario puede:
  - Crear y editar pacientes.  
  - Crear citas y recibir recordatorios automáticos.  
  - Registrar pagos y generar facturas PDF.  
  - Ver sus estadísticas básicas.  
- 10 clínicas activas utilizando el sistema dentro de los primeros 3 meses.  
- Feedback positivo (> 8/10 de satisfacción).

---

## 9. 📦 Entregables finales del MVP

- Aplicación web funcional en producción (Forge + dominio).  
- Panel de administración completo.  
- Landing pública y registro.  
- Documentación técnica y de despliegue.  
- Beta privada con clínicas reales.  

---

> ✨ *Clinicly MVP está diseñado para ser simple, útil y lanzable en 3 meses, con un enfoque claro en resolver los problemas reales de las clínicas pequeñas sin sobrecargar el desarrollo.*
