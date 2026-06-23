# PRD — Sistema de Nómina Venezuela SaaS (Laravel 13)

## 1. Descripción del producto

Sistema SaaS multiempresa para gestión integral de nómina en Venezuela bajo la LOTTT, desarrollado en Laravel 13 + Breeze + Blade + TailwindCSS.

La plataforma es operada **exclusivamente por el equipo administrador (Super Admin)**. Las empresas clientes son registros de negocio dentro del sistema; **no tienen acceso administrativo** ni usuarios propios para gestionar su nómina.

Permite al operador de plataforma gestionar empleados, ciclos de pago (semanal, quincenal, mensual), prestaciones sociales, vacaciones, utilidades y liquidaciones de cada empresa cliente.

---

## 2. Objetivos del sistema

| Objetivo | Resultado esperado |
|----------|------------------|
| Soportar múltiples frecuencias de pago | Semanal, quincenal, mensual |
| Centralizar nómina multiempresa | Aislamiento por empresa; gestión centralizada por Super Admin |
| Automatizar cálculos LOTTT | Prestaciones, deducciones, utilidades |
| Generar reportes legales | PDF/Excel |
| Escalar como SaaS | Arquitectura modular |
| Control operativo centralizado | Una sola capa de administración para todas las empresas clientes |

---

## 3. Arquitectura

- Laravel 13
- PHP 8.4+
- MySQL 8+
- Blade + TailwindCSS + Alpine.js
- Laravel Breeze
- Spatie Permission
- DomPDF + Laravel Excel

Arquitectura:
- Modular Monolith
- Multi-tenant por empresa_id (empresas como clientes/tenants de datos)
- Motor de nómina desacoplado (Nomina Engine)
- Operación centralizada: usuarios autenticados son operadores de plataforma, no de empresas clientes

---

## 4. Roles y permisos

El acceso al sistema administrativo lo tienen **únicamente usuarios de la plataforma**. Las empresas clientes **no inician sesión** ni administran su información.

| Rol | Descripción |
|-----|-------------|
| Super Admin | Control total del SaaS: empresas clientes, empleados, nómina, configuración, usuarios y permisos |
| RRHH | Operador de plataforma con permisos de nómina y empleados (según asignación Spatie) |
| Contador | Operador de plataforma con permisos de reportes y consulta (según asignación Spatie) |

### Gestión de roles y permisos

- **Spatie Permission** define permisos granulares por módulo y acción (crear, editar, cerrar nómina, exportar reportes, etc.).
- El **Super Admin** crea usuarios de plataforma y les asigna roles/permisos.
- Los roles RRHH y Contador son **roles operativos de la plataforma**, no roles de la empresa cliente.
- No existe rol **Admin Empresa** ni usuarios administrativos por empresa cliente.
- Los **empleados** son registros laborales de nómina; **no son usuarios del sistema** y no tienen acceso de login.
- **No existe portal del empleado** ni autoservicio para trabajadores.

---

## 5. Módulos

> Todos los módulos administrativos son gestionados por **Super Admin** o por operadores de plataforma con los permisos correspondientes. Las empresas clientes no acceden a estos módulos.

### 5.1 Seguridad
- Auth Breeze (solo usuarios de plataforma)
- Roles y permisos (Spatie)
- Bitácora de operaciones

---

### 5.2 Empresas (clientes)
- Alta y mantenimiento de empresas clientes (datos fiscales)
- Configuración de nómina por empresa
- Parámetros legales por empresa
- Activación / desactivación de empresa cliente

---

### 5.3 Empleados
- Datos personales por empresa cliente
- Cargo / departamento
- Estado laboral
- Contrato e histórico salarial

---

### 5.4 Ciclos de pago (NUEVO CORE)
- Semanal (7 días)
- Quincenal (15 días)
- Mensual (30 días)
- Configurable por empresa cliente (operado por Super Admin)

---

### 5.5 Nómina
- Generación por ciclo y empresa cliente
- Asignaciones
- Deducciones:
  - IVSS
  - FAOV
  - RPE

---

### 5.6 Prestaciones (LOTTT)
- Acumulación trimestral
- Intereses
- Historial

---

### 5.7 Vacaciones
- Cálculo automático
- Bono vacacional

---

### 5.8 Utilidades
- Configuración por empresa cliente
- Distribución anual

---

### 5.9 Liquidaciones
- Renuncia / despido
- Cálculo completo automático

---

### 5.10 Reportes
- Recibos PDF
- Reportes legales
- Exportación Excel

---

## 6. Reglas de negocio

- Todo dato operativo depende de `empresa_id` (empresa cliente)
- Las **empresas clientes no tienen acceso administrativo** al sistema
- Solo **usuarios de plataforma** (Super Admin y roles autorizados) gestionan empresas, empleados y nómina
- Los empleados **no acceden al sistema**; recibos y reportes se generan y entregan por los operadores
- Ciclos de pago configurables por empresa cliente
- Nómina inmutable una vez cerrada
- Auditoría obligatoria de acciones críticas
- Parámetros legales dinámicos con vigencia
- Permisos definidos vía Spatie; el Super Admin administra roles y asignaciones

---

## 7. Modelo SaaS

- **Multiempresa:** múltiples empresas clientes como tenants de datos
- **Operación centralizada:** el Super Admin (y operadores autorizados) gestiona todas las empresas y su operación
- **Sin usuarios administrativos por empresa cliente:** las empresas no cuentan con login ni panel de gestión propio
- **Usuarios de plataforma:** autenticados con roles y permisos Spatie
- **Super Admin global:** crea empresas, usuarios, roles y controla toda la operación
- **Sin portal del empleado:** no hay acceso ni autoservicio para trabajadores de empresas clientes
- **Escalable a planes:** límites por empresa cliente (empleados, módulos), administrados por Super Admin
