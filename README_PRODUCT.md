# 🩺 Documentación de Producto — Clinicly
*Gestor simple para clínicas pequeñas (SaaS)*

---

## 1. 📘 Resumen del proyecto

**Nombre provisional:** Clinicly  
**Tipo de producto:** SaaS (Software como Servicio)  
**Versión inicial:** MVP v1.0  

### 🎯 Objetivo
Simplificar la gestión diaria de clínicas pequeñas (1–5 profesionales) mediante una plataforma web intuitiva que centraliza citas, pacientes y facturación.

### 🌍 Visión
Ser la herramienta más simple, accesible y confiable para que clínicas pequeñas en España gestionen su día sin estrés, sin depender de hojas de cálculo o sistemas costosos.

### 🧭 Misión
Digitalizar la gestión de miles de clínicas pequeñas mediante una plataforma moderna, económica y en español, ayudándolas a ahorrar tiempo y ofrecer una mejor experiencia al paciente.

---

## 2. 🎯 Problema

Las clínicas pequeñas enfrentan varios problemas:

- Uso de métodos manuales (Excel, papel, WhatsApp) para citas y pacientes.
- Falta de recordatorios automáticos → ausencias y pérdida de ingresos.
- Desorganización en pagos y facturas.
- Dificultad para ver estadísticas o métricas clave.
- Soluciones actuales demasiado complejas o caras.

> 💬 *Ejemplo:* una clínica con tres fisioterapeutas puede perder más de 10 h semanales coordinando citas y cobros manualmente.

---

## 3. 💡 Solución

**Clinicly** ofrece una aplicación web todo en uno para clínicas pequeñas:

- 📅 **Agenda interactiva** — vista semanal o diaria para crear y mover citas fácilmente.  
- 🧑‍⚕️ **Gestión de pacientes** — ficha con datos, historial y notas.  
- 🔔 **Recordatorios automáticos** — email o WhatsApp antes de la cita.  
- 💶 **Pagos y facturación** — registro de pagos, facturas PDF automáticas.  
- 📊 **Dashboard** — resumen de citas, ingresos y rendimiento.  
- ⚙️ **Configuración simple** — horarios, servicios, permisos.

---

## 4. 👥 Público objetivo

**Segmento principal:**  
- Clínicas de fisioterapia, estética, psicología, nutrición, podología.  
- De 1 a 5 profesionales.  
- Ubicadas en España (inicio: Barcelona).  
- Nivel medio-bajo de digitalización.

**Buyer Persona:**  
> *Laura, fisioterapeuta autónoma de 34 años, dirige una clínica con dos colegas. Usa Google Calendar y Excel, pero pierde tiempo cada semana cuadrando citas, enviando recordatorios y haciendo facturas. Quiere una solución en español, simple y sin complicaciones técnicas.*

---

## 5. 💰 Modelo de negocio

**Tipo:** Suscripción mensual (SaaS B2B)

| Plan | Precio | Características |
|------|---------|----------------|
| **Free** | 0 €/mes | 1 profesional, 10 pacientes, sin facturas PDF |
| **Basic** | 19 €/mes | Hasta 3 profesionales, recordatorios y facturas básicas |
| **Pro** | 39 €/mes | Multiusuario, estadísticas, integraciones (Stripe, GCal) |

**Extras futuros:**
- Add-ons (reservas online, app móvil, recordatorios SMS)
- Planes anuales con descuento
- Marketplace de profesionales

**Pasarela de pago:** Stripe (Laravel Cashier)  
**Trial:** 14 días gratis sin tarjeta  

---

## 6. ⚙️ Tecnologías principales

| Área | Herramientas |
|------|---------------|
| **Backend** | Laravel 11 |
| **Frontend** | Blade + Alpine.js / Livewire |
| **Base de datos** | MySQL / PostgreSQL |
| **Estilos** | Tailwind CSS |
| **Autenticación** | Laravel Breeze / Fortify |
| **Roles y permisos** | Spatie Laravel Permission |
| **Notificaciones** | Mailgun / Twilio |
| **Facturación PDF** | DomPDF / Laravel Snappy |
| **Infraestructura** | Laravel Forge + DigitalOcean |

---

## 7. 🧱 Módulos funcionales del MVP

| Módulo | Descripción | Prioridad |
|--------|--------------|-----------|
| **Usuarios** | Registro, login, roles (admin/profesional) | Alta |
| **Pacientes** | CRUD, historial, notas, contacto | Alta |
| **Citas** | Agenda visual, recordatorios, filtros por profesional | Alta |
| **Pagos / Facturas** | Registro de pagos, facturas PDF, exportación CSV | Media |
| **Dashboard** | Citas, ingresos y métricas semanales | Media |
| **Configuración** | Horarios, servicios, festivos | Media |
| **Notificaciones** | Emails y WhatsApp automáticos | Media |

---

## 8. 🧭 Roadmap inicial (MVP)

| Fase | Duración | Objetivo |
|------|-----------|----------|
| **1. Planificación y diseño UI** | Semana 1 | Definir base de datos y mockups |
| **2. Backend base** | Semanas 2–4 | Usuarios, pacientes, citas |
| **3. Integraciones y recordatorios** | Semanas 5–6 | Stripe, Mailgun, Twilio |
| **4. Dashboard y pulido UX** | Semana 7 | Gráficos y diseño |
| **5. Beta cerrada** | Semanas 8–9 | Feedback de 5–10 clínicas |
| **6. Lanzamiento público** | Semana 10 | Marketing y soporte |

---

## 9. 📢 Estrategia de lanzamiento

### 🧪 Fase 1 — Validación temprana
Landing page con lista de espera → captar 50 interesados reales.

### 🧰 Fase 2 — Beta cerrada
Invitar 5–10 clínicas de Barcelona a probar el producto.  
Recolectar feedback y testimonios.

### 🚀 Fase 3 — Lanzamiento público
- Publicar en ProductHunt, IndieHackers, LinkedIn.  
- Publicidad local (Facebook / Google Ads segmentado).  
- Ofrecer prueba gratuita de 14 días.

### 📈 Fase 4 — Crecimiento
- SEO + blog con artículos tipo “Cómo ahorrar 5h/semana en tu clínica”.  
- Programa de referidos (“invita una clínica y gana 1 mes gratis”).  
- Automatización de email marketing.

---

## 10. 📊 Métricas clave

| Métrica | Objetivo inicial |
|----------|-----------------|
| **Usuarios registrados** | 100 en 3 meses |
| **Conversión prueba → pago** | 10 % |
| **Churn (cancelaciones)** | < 5 % mensual |
| **MRR (ingresos recurrentes)** | 500 €/mes al 3er mes |
| **NPS (satisfacción)** | > 8/10 |

---

## 11. 🔒 Privacidad y cumplimiento

- Cumplimiento total con **RGPD (UE)**.  
- Datos alojados en servidores de la Unión Europea.  
- Consentimiento explícito para uso de datos de pacientes.  
- Encriptación de datos sensibles (Laravel Encryption).  
- Política de privacidad y Términos del servicio accesibles en la web.

---

## 12. 🌱 Futuras evoluciones

- Portal de pacientes con acceso a citas e historial.  
- Widget de reservas online integrable.  
- App móvil para profesionales (Flutter / Inertia).  
- Facturación electrónica (Facturae / TicketBAI).  
- Reportes avanzados por servicio o profesional.  

---

## 13. 🧩 Propuesta de valor resumida

> “Clinicly te ayuda a ahorrar horas cada semana y a evitar errores,  
> gestionando tus citas, pacientes y pagos en un solo lugar —  
> sin hojas de cálculo, sin estrés y sin pagar de más.”

---
