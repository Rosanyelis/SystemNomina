# Backlog Ágil + Plan de Sprints

## Sistema de Nómina Venezuela SaaS — LOTTT

**Versión:** 1.1  
**Fecha:** 22 de junio de 2026  
**Fuente:** `.docs/ERS.md` v1.1 / `.docs/pdr.md` v1.1  
**Alcance:** Planificación de producto — sin implementación técnica  
**Modelo operativo:** Solo usuarios de plataforma (Super Admin, RRHH, Contador). Sin portal empleado ni acceso de empresas clientes.

---

# 1. Product Backlog General


| ID    | Nombre                                   | Descripción breve                                                 | Módulo                     | Dependencias        | Prioridad |
| ----- | ---------------------------------------- | ----------------------------------------------------------------- | -------------------------- | ------------------- | --------- |
| PB-01 | Autenticación email/contraseña           | Login, logout, recuperación de sesión                             | SaaS Tenant Layer          | —                   | P0        |
| PB-02 | Roles y permisos                         | Asignación Spatie: Super Admin, RRHH, Contador                    | SaaS Tenant Layer          | PB-01               | P0        |
| PB-03 | Aislamiento multi-tenant                 | Filtrado estricto por `empresa_id` en todas las operaciones       | SaaS Tenant Layer          | PB-01, PB-02        | P0        |
| PB-04 | CRUD empresas clientes                   | Alta de empresas clientes con RIF, razón social, contacto         | SaaS Tenant Layer          | PB-02               | P0        |
| PB-05 | Activar/desactivar empresa cliente       | Control operativo sobre empresa cliente                           | SaaS Tenant Layer          | PB-04               | P0        |
| PB-06 | CRUD usuarios de plataforma              | Gestión de operadores y asignación de roles Spatie                | SaaS Tenant Layer          | PB-04, PB-02        | P0        |
| PB-07 | Super Admin global                       | Usuario sin `empresa_id` con acceso a plataforma                  | SaaS Tenant Layer          | PB-02               | P0        |
| PB-08 | Bitácora básica                          | Registro de acciones críticas con usuario y timestamp             | Auditoría                  | PB-01               | P0        |
| PB-09 | Bitácora con contexto tenant             | Incluir `empresa_id` y entidad afectada en auditoría              | Auditoría                  | PB-08, PB-03        | P1        |
| PB-10 | CRUD departamentos                       | Unidades organizativas por empresa                                | Employee Management        | PB-04               | P0        |
| PB-11 | CRUD cargos                              | Puestos de trabajo por empresa                                    | Employee Management        | PB-04               | P0        |
| PB-12 | Parámetros legales                       | Salario mínimo, IVSS, FAOV, RPE, UT con vigencia                  | Legal Configuration Engine | PB-04               | P0        |
| PB-13 | Resolución parámetros vigentes           | Obtener parámetros aplicables a una fecha de nómina               | Legal Configuration Engine | PB-12               | P0        |
| PB-14 | CRUD empleados                           | Registro demográfico y laboral con estados                        | Employee Management        | PB-10, PB-11        | P0        |
| PB-15 | Unicidad cédula por tenant               | Validación de cédula única dentro de la empresa                   | Employee Management        | PB-14               | P0        |
| PB-16 | Contrato laboral                         | Registro de relación laboral con fechas inicio/fin                | Employee Management        | PB-14               | P0        |
| PB-17 | Histórico salarial                       | Trazabilidad de cambios salariales por contrato                   | Employee Management        | PB-16               | P0        |
| PB-18 | Ciclos de pago                           | Configuración semanal/quincenal/mensual por empresa               | Core Payroll Engine        | PB-04               | P0        |
| PB-19 | Catálogo conceptos nómina                | Asignaciones y deducciones con fórmulas                           | Core Payroll Engine        | PB-12               | P0        |
| PB-20 | Generación nómina borrador               | Crear corrida regular por ciclo y periodo                         | Core Payroll Engine        | PB-14, PB-18, PB-19 | P0        |
| PB-21 | Cálculo asignaciones                     | Salario base y conceptos de asignación por empleado               | Core Payroll Engine        | PB-20, PB-17        | P0        |
| PB-22 | Deducciones IVSS/FAOV/RPE                | Cálculo automático según parámetros vigentes                      | Legal Configuration Engine | PB-13, PB-20        | P0        |
| PB-23 | Desglose por concepto                    | DetalleConcepto por empleado en nómina                            | Core Payroll Engine        | PB-20               | P0        |
| PB-24 | Cierre nómina (inmutabilidad)            | Transición borrador → cerrada sin recálculo                       | Core Payroll Engine        | PB-20               | P0        |
| PB-25 | Marcar nómina pagada                     | Transición cerrada → pagada                                       | Core Payroll Engine        | PB-24               | P0        |
| PB-26 | Recibo PDF básico                        | Comprobante de pago individual por empleado                       | Reporting Engine           | PB-24               | P1        |
| PB-27 | Acumulación prestaciones                 | Cálculo trimestral de prestaciones sociales                       | Benefits                   | PB-14, PB-13        | P1        |
| PB-28 | Intereses prestaciones                   | Cálculo periódico sobre acumulado                                 | Benefits                   | PB-27               | P1        |
| PB-29 | Historial movimientos prestaciones       | Consulta de movimientos acumulación/pago                          | Benefits                   | PB-27               | P1        |
| PB-30 | Cálculo días vacacionales                | Días según antigüedad LOTTT                                       | Time Off                   | PB-14, PB-13        | P1        |
| PB-31 | Solicitud vacaciones                     | Registro con validación de saldo disponible                       | Time Off                   | PB-30               | P1        |
| PB-32 | Bono vacacional                          | Nómina tipo vacaciones con bono calculado                         | Time Off                   | PB-31, PB-20        | P1        |
| PB-33 | Permisos laborales (ausencias)           | Registro de ausencias autorizadas                                 | Time Off                   | PB-14               | P1        |
| PB-34 | CRUD préstamos                           | Registro de monto y saldo pendiente                               | Préstamos                  | PB-14               | P1        |
| PB-35 | Deducción préstamos en nómina            | Descuento automático en corrida regular                           | Préstamos                  | PB-34, PB-20        | P1        |
| PB-36 | Configuración utilidades                 | Parámetros anuales de distribución                                | Profit Sharing             | PB-04, PB-13        | P1        |
| PB-37 | Nómina tipo utilidades                   | Distribución proporcional entre empleados activos                 | Profit Sharing             | PB-36, PB-20        | P1        |
| PB-38 | Wizard liquidación                       | Flujo renuncia/despido con cálculo integral                       | Settlement                 | PB-27, PB-30, PB-20 | P1        |
| PB-39 | Nómina tipo liquidación                  | Generación con desglose completo                                  | Settlement                 | PB-38               | P1        |
| PB-40 | Egreso automático empleado               | Estado egresado + fecha retiro post-liquidación                   | Settlement                 | PB-38               | P1        |
| PB-41 | Reporte nómina consolidado               | Totales por periodo en PDF/Excel                                  | Reporting Engine           | PB-24               | P1        |
| PB-42 | Reporte deducciones legales              | IVSS, FAOV, RPE por periodo exportable                            | Reporting Engine           | PB-22, PB-24        | P1        |
| PB-43 | Reporte prestaciones                     | Exportación acumulados por empresa                                | Reporting Engine           | PB-27               | P2        |
| PB-44 | Dashboard KPIs nómina                    | Headcount, costo laboral, totales                                 | Reporting Engine           | PB-24               | P2        |
| PB-45 | Consulta bitácora avanzada               | Filtros por usuario, fecha, empresa, acción                       | Auditoría                  | PB-09               | P1        |
| PB-49 | Planes SaaS / suscripciones              | Límites por empresa cliente, onboarding comercial                 | Optimización SaaS          | PB-04               | P2        |
| PB-50 | Colas async nómina/PDF                   | Generación masiva sin bloqueo                                     | Optimización SaaS          | PB-20, PB-26        | P2        |
| PB-51 | Notificaciones email                     | Alertas a operadores (nómina, vacaciones)                         | Optimización SaaS          | PB-26, PB-31        | P2        |
| PB-52 | Onboarding guiado empresa cliente        | Wizard configuración inicial por Super Admin                      | Optimización SaaS          | PB-04, PB-12, PB-18 | P2        |


**Leyenda de prioridad:** P0 = bloqueante para MVP | P1 = core LOTTT | P2 = valor agregado / comercial

---

# 2. Epics del Sistema

## Epic 1: SaaS Tenant & Seguridad

**Objetivo:** Establecer la plataforma multi-tenant con autenticación, autorización Spatie y operación centralizada por usuarios de plataforma.

**Alcance funcional:**

- Autenticación email/contraseña (solo usuarios de plataforma)
- Roles: Super Admin, RRHH, Contador (Spatie Permission)
- CRUD empresas clientes (Super Admin)
- CRUD usuarios de plataforma y asignación de roles/permisos
- Contexto de empresa cliente en operaciones
- Bitácora básica de operaciones críticas

**Entidades involucradas:** Empresa, Usuario, Rol, Bitacora

**Dependencias:** Ninguna (Epic base)

**PBs relacionados:** PB-01 a PB-09

---

## Epic 2: Configuración Legal & Organización

**Objetivo:** Permitir que el Super Admin u operadores autorizados configuren la estructura organizativa y parámetros legales LOTTT de cada empresa cliente.

**Alcance funcional:**

- CRUD departamentos y cargos
- Parámetros legales con vigencia (salario mínimo, IVSS, FAOV, RPE, UT)
- Resolución de parámetros vigentes por fecha
- Ciclos de pago configurables

**Entidades involucradas:** Departamento, Cargo, ParametroEmpresa, CicloPago

**Dependencias:** Epic 1

**PBs relacionados:** PB-10 a PB-13, PB-18

---

## Epic 3: Gestión de Empleados

**Objetivo:** Gestionar el ciclo de vida completo del empleado como núcleo del dominio de nómina.

**Alcance funcional:**

- CRUD empleados con estados (activo, suspendido, egresado)
- Contrato laboral
- Histórico salarial
- Unicidad de cédula por tenant
- Asignación a departamento y cargo

**Entidades involucradas:** Empleado, Contrato, HistoricoSalario

**Dependencias:** Epic 1, Epic 2

**PBs relacionados:** PB-14 a PB-17

---

## Epic 4: Motor de Nómina

**Objetivo:** Implementar el Core Payroll Engine capaz de generar, calcular, revisar y cerrar nóminas regulares con desglose por conceptos.

**Alcance funcional:**

- Catálogo de conceptos (asignación/deducción) con fórmulas
- Generación de nómina borrador por ciclo y periodo
- Cálculo de asignaciones, deducciones y neto por empleado
- Flujo de estados: borrador → cerrada → pagada
- Inmutabilidad post-cierre
- Tipos de nómina: regular (base), vacaciones, utilidades, liquidación

**Entidades involucradas:** Nomina, NominaDetalle, DetalleConcepto, ConceptoNomina, CicloPago

**Dependencias:** Epic 1, Epic 2, Epic 3

**PBs relacionados:** PB-19 a PB-25

---

## Epic 5: Deducciones Legales (Legal Engine)

**Objetivo:** Automatizar el cálculo de deducciones obligatorias venezolanas integradas al motor de nómina.

**Alcance funcional:**

- Cálculo IVSS sobre base imponible
- Cálculo FAOV sobre base imponible
- Cálculo RPE sobre base imponible
- Integración con parámetros vigentes por fecha
- Conceptos legales predefinidos en catálogo

**Entidades involucradas:** ParametroEmpresa, ConceptoNomina, DetalleConcepto

**Dependencias:** Epic 2, Epic 4

**PBs relacionados:** PB-22 (extensión de PB-12, PB-13)

---

## Epic 6: Prestaciones Sociales

**Objetivo:** Acumular y gestionar prestaciones sociales conforme a LOTTT con historial consultable.

**Alcance funcional:**

- Acumulación trimestral por empleado
- Cálculo de intereses sobre acumulado
- Historial de movimientos (acumulación, pago, ajuste)
- Consulta de saldo por RRHH y empleado

**Entidades involucradas:** Prestacion (+ movimientos)

**Dependencias:** Epic 3, Epic 5

**PBs relacionados:** PB-27 a PB-29

---

## Epic 7: Vacaciones y Permisos

**Objetivo:** Gestionar tiempo libre remunerado y ausencias autorizadas con impacto en nómina.

**Alcance funcional:**

- Cálculo automático de días según antigüedad
- Registro de vacaciones por operador RRHH
- Bono vacacional vía nómina tipo vacaciones
- Registro de permisos laborales (ausencias)
- Validación de saldo de días

**Entidades involucradas:** Vacacion, Permiso (ausencias laborales)

**Dependencias:** Epic 3, Epic 4, Epic 5

**PBs relacionados:** PB-30 a PB-33

---

## Epic 8: Préstamos y Utilidades

**Objetivo:** Gestionar anticipos al empleado y distribución anual de utilidades.

**Alcance funcional:**

- Registro de préstamos con saldo
- Deducción automática en nómina regular
- Configuración anual de utilidades
- Nómina tipo utilidades con distribución proporcional
- Historial por ejercicio fiscal

**Entidades involucradas:** Prestamo, ConfiguracionUtilidades (a definir), Nomina

**Dependencias:** Epic 3, Epic 4

**PBs relacionados:** PB-34 a PB-37

---

## Epic 9: Liquidaciones

**Objetivo:** Procesar el cierre integral de la relación laboral con cálculo automático de todos los conceptos pendientes.

**Alcance funcional:**

- Wizard de liquidación (renuncia/despido)
- Cálculo: salarios pendientes + vacaciones + prestaciones + indemnizaciones
- Nómina tipo liquidación
- Registro en entidad Liquidacion
- Egreso automático del empleado

**Entidades involucradas:** Liquidacion, Nomina, Empleado

**Dependencias:** Epic 4, Epic 6, Epic 7

**PBs relacionados:** PB-38 a PB-40

---

## Epic 10: Reportes y Auditoría

**Objetivo:** Satisfacer necesidades de consulta, cumplimiento legal y trazabilidad para Contador y Super Admin.

**Alcance funcional:**

- Recibos PDF individuales
- Reporte consolidado de nómina
- Exportación Excel deducciones legales
- Reporte prestaciones acumuladas
- Dashboard KPIs
- Bitácora consultable con filtros avanzados

**Entidades involucradas:** Nomina, Prestacion, Liquidacion, Bitacora

**Dependencias:** Epic 4, Epic 6, Epic 9

**PBs relacionados:** PB-26, PB-41 a PB-45

---

## Epic 11: Optimización SaaS

**Objetivo:** Preparar el producto para escala comercial y operación eficiente de múltiples empresas clientes.

**Alcance funcional:**

- Planes/suscripciones SaaS con límites por empresa cliente
- Colas async para nómina y PDFs
- Notificaciones email a operadores
- Onboarding guiado para configuración de empresa cliente
- Cache de parámetros legales

**Entidades involucradas:** Empresa, Usuario, Nomina

**Dependencias:** Epic 1, Epic 10

**PBs relacionados:** PB-49 a PB-52

---

# 3. User Stories Detalladas

## Epic 1: SaaS Tenant & Seguridad

---

**US-01**  
Como **Super Admin**  
Quiero **iniciar sesión en la plataforma como operador global**  
Para **administrar empresas clientes y usuarios de plataforma**

**Criterios de aceptación:**

- **Given** un usuario con rol Super Admin  
- **When** ingresa credenciales válidas  
- **Then** accede al panel global con control total de la plataforma

**Dependencias conceptuales:** Sistema de autenticación base  
**Prioridad:** P0

---

**US-02**  
Como **Super Admin**  
Quiero **crear empresas con RIF único y datos fiscales**  
Para **onboardear nuevos clientes SaaS**

**Criterios de aceptación:**

- **Given** que estoy autenticado como Super Admin  
- **When** registro una empresa con RIF, razón social, email y dirección  
- **Then** la empresa queda activa y el RIF no puede duplicarse en la plataforma

**Dependencias conceptuales:** US-01  
**Prioridad:** P0

---

**US-03**  
Como **Super Admin**  
Quiero **activar o desactivar una empresa cliente**  
Para **suspender operaciones sobre ese cliente sin eliminar sus datos**

**Criterios de aceptación:**

- **Given** una empresa cliente existente  
- **When** cambio su estado a inactiva  
- **Then** los operadores no pueden ejecutar nómina ni modificar datos de esa empresa

**Dependencias conceptuales:** US-02  
**Prioridad:** P0

---

**US-04**  
Como **Super Admin**  
Quiero **crear usuarios de plataforma y asignarles roles (RRHH, Contador) con permisos Spatie**  
Para **delegar operaciones de nómina sin acceso de empresas clientes**

**Criterios de aceptación:**

- **Given** que soy Super Admin  
- **When** creo un usuario operador con email y rol RRHH  
- **Then** el operador accede según permisos asignados sobre empresas clientes autorizadas

**Dependencias conceptuales:** US-02, US-05  
**Prioridad:** P0

---

**US-05**  
Como **sistema**  
Quiero **restringir cada operación según permisos Spatie y empresa cliente en contexto**  
Para **garantizar aislamiento de datos entre empresas clientes (RN-01)**

**Criterios de aceptación:**

- **Given** un operador RRHH trabajando sobre empresa cliente A  
- **When** intenta acceder a datos de empresa cliente B sin permiso  
- **Then** el sistema deniega el acceso sin exponer datos

**Dependencias conceptuales:** US-04  
**Prioridad:** P0

---

**US-06**  
Como **Super Admin**  
Quiero **que las acciones críticas queden registradas en bitácora**  
Para **auditar quién hizo qué y cuándo (RN-04)**

**Criterios de aceptación:**

- **Given** un Super Admin que crea una empresa cliente  
- **When** la operación se completa  
- **Then** la bitácora registra usuario, acción, timestamp y `empresa_id` si aplica

**Dependencias conceptuales:** US-04  
**Prioridad:** P0

---

## Epic 2: Configuración Legal & Organización

---

**US-07**  
Como **Super Admin u operador autorizado**  
Quiero **gestionar departamentos y cargos de mi empresa**  
Para **organizar la estructura antes de registrar empleados**

**Criterios de aceptación:**

- **Given** una empresa activa  
- **When** creo departamento "Contabilidad" y cargo "Analista"  
- **Then** ambos quedan scoped a mi empresa y disponibles en formulario de empleado

**Dependencias conceptuales:** US-02  
**Prioridad:** P0

---

**US-08**  
Como **Super Admin u operador autorizado**  
Quiero **configurar parámetros legales con fecha de vigencia**  
Para **aplicar tasas IVSS, FAOV, RPE y salario mínimo correctos (RN-05)**

**Criterios de aceptación:**

- **Given** parámetros con vigencia desde 01/01/2026  
- **When** genero nómina con periodo enero 2026  
- **Then** el sistema usa esos parámetros y no los de vigencias anteriores

**Dependencias conceptuales:** US-02  
**Prioridad:** P0

---

**US-09**  
Como **Super Admin u operador autorizado**  
Quiero **definir ciclos de pago (semanal, quincenal, mensual)**  
Para **adaptar la nómina a la frecuencia de mi empresa (RN-02)**

**Criterios de aceptación:**

- **Given** que configuro ciclo quincenal de 15 días  
- **When** genero nómina seleccionando ese ciclo  
- **Then** el rango de fechas se calcula acorde al ciclo configurado

**Dependencias conceptuales:** US-02  
**Prioridad:** P0

---

## Epic 3: Gestión de Empleados

---

**US-10**  
Como **RRHH**  
Quiero **registrar un empleado con cédula, datos personales y fecha de ingreso**  
Para **incorporarlo al sistema de nómina**

**Criterios de aceptación:**

- **Given** departamento y cargo existentes  
- **When** registro empleado con cédula V-12345678  
- **Then** queda en estado activo y asociado a mi empresa

**Dependencias conceptuales:** US-07  
**Prioridad:** P0

---

**US-11**  
Como **RRHH**  
Quiero **que la cédula sea única dentro de mi empresa**  
Para **evitar duplicados (RN-12, RF-19)**

**Criterios de aceptación:**

- **Given** un empleado con cédula V-12345678 en mi empresa  
- **When** intento registrar otro con la misma cédula  
- **Then** el sistema rechaza la operación con mensaje claro

**Dependencias conceptuales:** US-10  
**Prioridad:** P0

---

**US-12**  
Como **RRHH**  
Quiero **registrar el contrato laboral y el salario inicial**  
Para **tener base legal y salarial para cálculos (RF-17, RF-18)**

**Criterios de aceptación:**

- **Given** un empleado recién creado  
- **When** registro contrato con inicio 01/03/2026 y salario 1.500,00  
- **Then** se crea registro de contrato e histórico salarial vinculado

**Dependencias conceptuales:** US-10  
**Prioridad:** P0

---

**US-13**  
Como **RRHH**  
Quiero **registrar cambios de salario con fecha efectiva**  
Para **que la nómina use el salario correcto según el periodo**

**Criterios de aceptación:**

- **Given** empleado con salario 1.500 desde 01/03/2026  
- **When** registro aumento a 1.800 efectivo 01/06/2026  
- **Then** nómina de mayo usa 1.500 y nómina de junio usa 1.800

**Dependencias conceptuales:** US-12  
**Prioridad:** P0

---

**US-14**  
Como **RRHH**  
Quiero **cambiar el estado de un empleado (activo, suspendido, egresado)**  
Para **controlar su elegibilidad en nómina (RN-08)**

**Criterios de aceptación:**

- **Given** empleado activo  
- **When** lo marco como suspendido  
- **Then** no aparece en nómina regular hasta reactivación

**Dependencias conceptuales:** US-10  
**Prioridad:** P0

---

## Epic 4: Motor de Nómina

---

**US-15**  
Como **Super Admin o operador autorizado**  
Quiero **mantener un catálogo de conceptos de nómina con fórmulas**  
Para **configurar asignaciones y deducciones sin redeploy (RF-23, RF-24)**

**Criterios de aceptación:**

- **Given** concepto "Bono transporte" tipo asignación con fórmula definida  
- **When** se genera nómina  
- **Then** el concepto se evalúa y aparece en el desglose del empleado

**Dependencias conceptuales:** US-08  
**Prioridad:** P0

---

**US-16**  
Como **RRHH**  
Quiero **generar una nómina regular en estado borrador**  
Para **revisar cálculos antes de cerrarla (RF-25, RF-29)**

**Criterios de aceptación:**

- **Given** empleados activos, ciclo quincenal y periodo definido  
- **When** inicio generación de nómina tipo regular  
- **Then** se crea nómina borrador con detalle por cada empleado elegible

**Dependencias conceptuales:** US-09, US-10, US-15  
**Prioridad:** P0

---

**US-17**  
Como **RRHH**  
Quiero **ver el desglose de asignaciones, deducciones y neto por empleado**  
Para **validar montos antes del cierre (RF-26, RF-27)**

**Criterios de aceptación:**

- **Given** nómina borrador generada  
- **When** consulto detalle de un empleado  
- **Then** veo cada concepto con monto, totales y neto calculado

**Dependencias conceptuales:** US-16  
**Prioridad:** P0

---

**US-18**  
Como **RRHH**  
Quiero **cerrar una nómina borrador**  
Para **inmutabilizar el cálculo (RN-03, RF-30)**

**Criterios de aceptación:**

- **Given** nómina en borrador revisada  
- **When** confirmo cierre  
- **Then** estado pasa a cerrada y no se permiten modificaciones al cálculo

**Dependencias conceptuales:** US-17  
**Prioridad:** P0

---

**US-19**  
Como **RRHH**  
Quiero **marcar una nómina cerrada como pagada**  
Para **registrar que el desembolso fue ejecutado (RF-31)**

**Criterios de aceptación:**

- **Given** nómina cerrada  
- **When** confirmo pago  
- **Then** estado pasa a pagada con timestamp de confirmación

**Dependencias conceptuales:** US-18  
**Prioridad:** P0

---

## Epic 5: Deducciones Legales

---

**US-20**  
Como **sistema (motor de nómina)**  
Quiero **calcular IVSS, FAOV y RPE automáticamente**  
Para **cumplir deducciones legales venezolanas (RN-07, RF-28)**

**Criterios de aceptación:**

- **Given** empleado con salario 1.500 y parámetros IVSS 4%, FAOV 1%, RPE 0.5% vigentes  
- **When** se genera nómina  
- **Then** las deducciones se calculan sobre base imponible y aparecen en detalle

**Dependencias conceptuales:** US-08, US-16  
**Prioridad:** P0

---

**US-21**  
Como **Super Admin u operador autorizado**  
Quiero **recibir alerta cuando los parámetros legales estén por vencer**  
Para **evitar cálculos con tasas desactualizadas (R-04)**

**Criterios de aceptación:**

- **Given** parámetros con vigencia hasta 31/03/2026  
- **When** genero nómina en abril 2026 sin nuevos parámetros  
- **Then** el sistema advierte que no hay parámetros vigentes para esa fecha

**Dependencias conceptuales:** US-08  
**Prioridad:** P1

---

## Epic 6: Prestaciones Sociales

---

**US-22**  
Como **sistema**  
Quiero **acumular prestaciones sociales trimestralmente por empleado**  
Para **cumplir LOTTT (RN-06, RF-33)**

**Criterios de aceptación:**

- **Given** empleado activo con 3 meses de antigüedad  
- **When** cierra el trimestre  
- **Then** se registra movimiento de acumulación con monto calculado

**Dependencias conceptuales:** US-12, US-20  
**Prioridad:** P1

---

**US-23**  
Como **sistema**  
Quiero **calcular intereses sobre prestaciones acumuladas**  
Para **reflejar el beneficio legal completo (RF-34)**

**Criterios de aceptación:**

- **Given** empleado con acumulado de 500,00 al cierre trimestral  
- **When** se procesa cálculo de intereses  
- **Then** se registra movimiento de intereses con monto calculado

**Dependencias conceptuales:** US-22  
**Prioridad:** P1

---

**US-24**  
Como **RRHH**  
Quiero **consultar historial y saldo de prestaciones de un empleado**  
Para **responder consultas y preparar liquidaciones (RF-35, RF-36)**

**Criterios de aceptación:**

- **Given** empleado con movimientos de acumulación e intereses  
- **When** consulto su prestación  
- **Then** veo saldo actual e historial cronológico de movimientos

**Dependencias conceptuales:** US-22, US-23  
**Prioridad:** P1

---

## Epic 7: Vacaciones y Permisos

---

**US-25**  
Como **sistema**  
Quiero **calcular días de vacaciones según antigüedad LOTTT**  
Para **determinar saldo disponible (RF-37)**

**Criterios de aceptación:**

- **Given** empleado con 2 años de antigüedad  
- **When** consulto saldo vacacional  
- **Then** el sistema muestra días correspondientes según tabla LOTTT parametrizada

**Dependencias conceptuales:** US-10, US-08  
**Prioridad:** P1

---

**US-26**  
Como **RRHH (operador de plataforma)**  
Quiero **registrar vacaciones de un empleado con fechas inicio/fin**  
Para **planificar descanso remunerado (RF-38)**

**Criterios de aceptación:**

- **Given** empleado con 15 días disponibles  
- **When** el operador RRHH registra 10 días del 01/07 al 10/07  
- **Then** el periodo queda registrado y validado contra el saldo

**Dependencias conceptuales:** US-25  
**Prioridad:** P1

---

**US-27**  
Como **RRHH**  
Quiero **que el sistema rechace vacaciones que excedan el saldo**  
Para **evitar sobregiros (RF-39)**

**Criterios de aceptación:**

- **Given** empleado con 5 días disponibles  
- **When** solicita 10 días  
- **Then** el sistema rechaza con mensaje indicando saldo insuficiente

**Dependencias conceptuales:** US-26  
**Prioridad:** P1

---

**US-28**  
Como **RRHH (operador de plataforma)**  
Quiero **registrar vacaciones y generar bono vacacional en nómina**  
Para **pagar el beneficio legal (RF-40)**

**Criterios de aceptación:**

- **Given** periodo de vacaciones registrado con saldo válido  
- **When** confirmo el registro  
- **Then** se genera nómina tipo vacaciones con bono calculado y se descuentan días del saldo

**Dependencias conceptuales:** US-26, US-16  
**Prioridad:** P1

---

**US-29**  
Como **RRHH**  
Quiero **registrar permisos laborales (ausencias) con fecha y tipo**  
Para **documentar inasistencias autorizadas (RF-41)**

**Criterios de aceptación:**

- **Given** empleado activo  
- **When** registro permiso por enfermedad el 15/05/2026  
- **Then** queda registrado y visible en historial del empleado

**Dependencias conceptuales:** US-10  
**Prioridad:** P1

---

## Epic 8: Préstamos y Utilidades

---

**US-30**  
Como **RRHH**  
Quiero **registrar un préstamo con monto y saldo inicial**  
Para **controlar anticipos al empleado (RF-42)**

**Criterios de aceptación:**

- **Given** empleado activo  
- **When** registro préstamo de 300,00  
- **Then** saldo inicial es 300,00 y queda visible en ficha del empleado

**Dependencias conceptuales:** US-10  
**Prioridad:** P1

---

**US-31**  
Como **sistema (motor de nómina)**  
Quiero **deducir cuota de préstamo en cada nómina regular**  
Para **amortizar el saldo automáticamente (RF-43, RN-14)**

**Criterios de aceptación:**

- **Given** préstamo con saldo 300,00 y cuota configurada 100,00  
- **When** se procesa nómina regular  
- **Then** se deduce 100,00 y saldo queda en 200,00

**Dependencias conceptuales:** US-30, US-16  
**Prioridad:** P1

---

**US-32**  
Como **Super Admin u operador autorizado**  
Quiero **configurar parámetros de utilidades anuales**  
Para **definir base y criterio de distribución (RF-46)**

**Criterios de aceptación:**

- **Given** ejercicio fiscal 2026  
- **When** configuro monto total utilidades y criterio proporcional por días trabajados  
- **Then** la configuración queda guardada para generación de nómina utilidades

**Dependencias conceptuales:** US-08  
**Prioridad:** P1

---

**US-33**  
Como **RRHH**  
Quiero **generar nómina tipo utilidades con distribución por empleado**  
Para **pagar participación en utilidades anuales (RF-47, RF-48)**

**Criterios de aceptación:**

- **Given** configuración utilidades 2026 y empleados activos  
- **When** genero nómina tipo utilidades  
- **Then** cada empleado recibe monto proporcional según criterio configurado

**Dependencias conceptuales:** US-32, US-16  
**Prioridad:** P1

---

## Epic 9: Liquidaciones

---

**US-34**  
Como **RRHH**  
Quiero **iniciar liquidación indicando empleado, motivo y fecha**  
Para **procesar egreso por renuncia o despido (RF-50)**

**Criterios de aceptación:**

- **Given** empleado activo con prestaciones y vacaciones acumuladas  
- **When** inicio liquidación con motivo "renuncia" y fecha 30/06/2026  
- **Then** el sistema inicia wizard con pre-cálculo de conceptos pendientes

**Dependencias conceptuales:** US-24, US-25, US-16  
**Prioridad:** P1

---

**US-35**  
Como **sistema**  
Quiero **calcular liquidación integral automáticamente**  
Para **incluir salarios, vacaciones, prestaciones e indemnizaciones (RF-51)**

**Criterios de aceptación:**

- **Given** liquidación iniciada para empleado con 2 años de antigüedad  
- **When** el sistema calcula  
- **Then** incluye: salarios pendientes + vacaciones no disfrutadas + prestaciones + intereses + indemnización según motivo

**Dependencias conceptuales:** US-34  
**Prioridad:** P1

---

**US-36**  
Como **RRHH**  
Quiero **confirmar liquidación y egresar al empleado automáticamente**  
Para **cerrar la relación laboral (RF-52, RF-53, RN-15)**

**Criterios de aceptación:**

- **Given** liquidación calculada y revisada  
- **When** confirmo liquidación  
- **Then** se genera nómina tipo liquidación, registro en Liquidacion, empleado pasa a egresado con fecha_retiro

**Dependencias conceptuales:** US-35  
**Prioridad:** P1

---

## Epic 10: Reportes y Auditoría

---

**US-37**  
Como **RRHH**  
Quiero **generar recibo de pago PDF por empleado**  
Para **entregar comprobante legal de pago fuera del sistema (RF-55)**

**Criterios de aceptación:**

- **Given** nómina cerrada con detalle de empleado  
- **When** solicito recibo PDF  
- **Then** el documento incluye datos fiscales empresa, empleado, conceptos y neto

**Dependencias conceptuales:** US-18  
**Prioridad:** P1

---

**US-38**  
Como **Contador**  
Quiero **exportar reporte consolidado de nómina por periodo en Excel**  
Para **conciliación contable externa (RF-56, RF-57)**

**Criterios de aceptación:**

- **Given** nómina cerrada de enero 2026  
- **When** exporto reporte consolidado  
- **Then** Excel contiene totales por empleado, deducciones legales y neto general

**Dependencias conceptuales:** US-18, US-20  
**Prioridad:** P1

---

**US-39**  
Como **Contador**  
Quiero **exportar reporte de deducciones IVSS, FAOV, RPE por periodo**  
Para **preparar declaraciones y libros auxiliares (RF-57)**

**Criterios de aceptación:**

- **Given** nóminas cerradas del trimestre Q1  
- **When** genero reporte deducciones legales  
- **Then** veo totales por concepto y por empleado exportables

**Dependencias conceptuales:** US-20, US-38  
**Prioridad:** P1

---

**US-40**  
Como **Super Admin u operador autorizado**  
Quiero **consultar bitácora filtrada por usuario, fecha y acción**  
Para **auditar operaciones del tenant (RF-61)**

**Criterios de aceptación:**

- **Given** bitácora con registros de los últimos 30 días  
- **When** filtro por usuario RRHH y acción "nómina cerrada"  
- **Then** veo solo registros que coinciden con los filtros

**Dependencias conceptuales:** US-06  
**Prioridad:** P1

---

**US-41**  
Como **Super Admin u operador autorizado**  
Quiero **ver dashboard con KPIs de nómina**  
Para **monitorear costo laboral y headcount (PB-44)**

**Criterios de aceptación:**

- **Given** nóminas procesadas en el periodo  
- **When** accedo al dashboard  
- **Then** veo: total empleados activos, costo nómina del mes, total deducciones legales

**Dependencias conceptuales:** US-18, US-20  
**Prioridad:** P2

---

## Epic 11: Optimización SaaS

---

**US-45**  
Como **Super Admin**  
Quiero **definir planes SaaS con límites por tenant**  
Para **monetizar la plataforma (PB-49)**

**Criterios de aceptación:**

- **Given** plan "Básico" con límite 50 empleados  
- **When** empresa en ese plan intenta registrar empleado 51  
- **Then** el sistema advierte límite alcanzado

**Dependencias conceptuales:** US-02  
**Prioridad:** P2

---

**US-46**  
Como **sistema**  
Quiero **procesar generación de nómina y PDFs en cola asíncrona**  
Para **no bloquear la UI en empresas grandes (RNF-11)**

**Criterios de aceptación:**

- **Given** empresa con 300 empleados  
- **When** RRHH inicia generación de nómina  
- **Then** recibe confirmación inmediata y notificación al completar

**Dependencias conceptuales:** US-16, US-37  
**Prioridad:** P2

---

# 4. Sprint Planning (CRÍTICO)

> **Duración sugerida por sprint:** 2 semanas  
> **Capacidad orientativa:** 40-50 story points por sprint (equipo de 2-3 devs)

---

## Sprint 1 — Base SaaS

### Objetivo del Sprint

Establecer plataforma multi-tenant operativa: autenticación, roles, empresas, usuarios, organización básica y bitácora.

### User Stories incluidas

US-01, US-02, US-03, US-04, US-05, US-06, US-07

### Entregables funcionales

- Login/logout funcional para Super Admin y operadores de plataforma
- CRUD empresas clientes con RIF único y activación/desactivación
- CRUD usuarios de plataforma con asignación de roles Spatie
- Aislamiento multi-tenant verificado
- CRUD departamentos y cargos
- Bitácora básica en operaciones CRUD
- Resolución de inconsistencias I-04 (Spatie vs roles SQL), I-07 (bitácora con empresa_id), I-11 (renombrar permisos laborales)

### Riesgos del sprint


| Riesgo                                            | Mitigación                                                 |
| ------------------------------------------------- | ---------------------------------------------------------- |
| Fuga de datos multi-tenant (R-03)                 | Tests de aislamiento desde Sprint 1                        |
| Colisión Spatie Permission vs roles custom (I-04) | Decisión arquitectónica al inicio del sprint               |
| Scope creep en roles/permisos                     | Limitar a 5 roles del ERS; permisos granulares en Sprint 2 |


### Dependencias críticas

- Ninguna (sprint fundacional)
- Bloquea: todos los sprints posteriores

### Definition of Done del sprint

- [ ] Super Admin crea empresa cliente y operador RRHH con permisos
- [ ] Super Admin crea departamento y cargo en empresa cliente
- [ ] Operador RRHH opera solo sobre empresas clientes autorizadas
- [ ] Bitácora registra login y CRUD de empresa/usuario
- [ ] Tests de aislamiento tenant pasan
- [ ] Documentación de roles y permisos actualizada

---

## Sprint 2 — Gestión de Empleados

### Objetivo del Sprint

Completar configuración legal, ciclos de pago y ciclo de vida del empleado con contrato e histórico salarial.

### User Stories incluidas

US-08, US-09, US-10, US-11, US-12, US-13, US-14

### Entregables funcionales

- Parámetros legales con vigencia (ParametroEmpresa)
- Resolución de parámetros por fecha
- Ciclos de pago configurables (presets semanal/quincenal/mensual)
- CRUD empleados con estados y unicidad de cédula
- Contrato laboral + histórico salarial
- Cambio de salario con fecha efectiva
- Cierre gaps ERD/SQL: I-01, I-02, I-13

### Riesgos del sprint


| Riesgo                                        | Mitigación                                      |
| --------------------------------------------- | ----------------------------------------------- |
| Modelo contrato/salario ambiguo (I-02)        | Definir contrato como fuente de verdad salarial |
| Parámetros legales sin valores default (R-04) | Seed con tasas LOTTT vigentes documentadas      |
| Complejidad histórico salarial                | MVP: un registro activo + histórico append-only |


### Dependencias críticas

- Sprint 1 completado (tenant, roles, departamentos, cargos)
- Bloquea: Sprint 3 (nómina necesita empleados y parámetros)

### Definition of Done del sprint

- [ ] Super Admin configura parámetros legales con vigencia
- [ ] Super Admin u operador define ciclo quincenal activo
- [ ] RRHH registra empleado con contrato y salario
- [ ] Cambio salarial afecta cálculo según fecha efectiva (validado manualmente)
- [ ] Cédula duplicada rechazada en mismo tenant
- [ ] Empleado suspendido no aparece en lista de elegibles para nómina

---

## Sprint 3 — Motor de Nómina Básica

### Objetivo del Sprint

Primera corrida de nómina regular funcional: generación borrador, cálculo de asignaciones, desglose por concepto, flujo de estados.

### User Stories incluidas

US-15, US-16, US-17, US-18, US-19

### Entregables funcionales

- Catálogo conceptos nómina (asignación/deducción) con fórmulas
- Generación nómina borrador por ciclo y periodo
- Cálculo salario base desde histórico salarial vigente
- Desglose DetalleConcepto por empleado
- Flujo borrador → cerrada → pagada
- Política inmutabilidad post-cierre (I-10)
- Decisión scope conceptos: global vs tenant (I-08)

### Riesgos del sprint


| Riesgo                                    | Mitigación                                                     |
| ----------------------------------------- | -------------------------------------------------------------- |
| Complejidad motor de fórmulas (R-02)      | MVP: fórmulas simples (salario, % fijo); evaluador en Sprint 4 |
| Performance con muchos empleados (RNF-01) | Paginación en revisión; benchmark con 100 empleados            |
| Inmutabilidad vs correcciones (R-06)      | Documentar política: solo borrador editable                    |


### Dependencias críticas

- Sprint 2 completado (empleados, ciclos, parámetros)
- Bloquea: Sprint 4 (deducciones), Sprint 5+ (nóminas especiales)

### Definition of Done del sprint

- [ ] RRHH genera nómina quincenal borrador para empleados activos
- [ ] Detalle muestra asignaciones, totales y neto por empleado
- [ ] Nómina cerrada no admite recálculo
- [ ] Nómina marcada como pagada
- [ ] Bitácora registra generación y cierre
- [ ] Tests con al menos 3 escenarios salariales

---

## Sprint 4 — Deducciones Legales + Payroll Engine avanzado

### Objetivo del Sprint

Integrar Legal Configuration Engine al motor: IVSS, FAOV, RPE automáticos, alertas de vigencia y recibo PDF básico.

### User Stories incluidas

US-20, US-21, US-37

### Entregables funcionales

- Cálculo automático IVSS, FAOV, RPE en nómina
- Conceptos legales predefinidos en catálogo
- Alertas parámetros expirados o ausentes
- Recibo PDF individual por empleado
- Evaluador de fórmulas para conceptos configurables
- Tests exhaustivos motor de cálculo (objetivo RNF-19 ≥ 90%)

### Riesgos del sprint


| Riesgo                                 | Mitigación                              |
| -------------------------------------- | --------------------------------------- |
| Errores cálculo deducciones (R-02)     | Casos de prueba validados con contador  |
| Base imponible mal definida (R-01)     | Documentar reglas LOTTT por concepto    |
| Interpretación LOTTT incorrecta (R-01) | Revisión externa antes de cerrar sprint |


### Dependencias críticas

- Sprint 3 completado (motor base funcional)
- Bloquea: Sprint 5-9 (todo cálculo legal depende de esto)

### Definition of Done del sprint

- [ ] Nómina incluye deducciones IVSS, FAOV, RPE calculadas
- [ ] Alerta visible si no hay parámetros vigentes
- [ ] Recibo PDF generado para nómina cerrada
- [ ] Suite tests motor ≥ 90% cobertura en cálculos
- [ ] Validación manual con caso real de contador aprobada

**Hito:** MVP Nómina funcional alcanzado

---

## Sprint 5 — Prestaciones + Vacaciones

### Objetivo del Sprint

Implementar acumulación trimestral de prestaciones, intereses, gestión de vacaciones y bono vacacional.

### User Stories incluidas

US-22, US-23, US-24, US-25, US-26, US-27, US-28, US-29

### Entregables funcionales

- Acumulación trimestral prestaciones con movimientos
- Cálculo intereses sobre acumulado
- Consulta historial y saldo prestaciones
- Cálculo días vacacionales por antigüedad LOTTT
- Flujo de registro de vacaciones por operador RRHH
- Nómina tipo vacaciones con bono
- Registro ausencias laborales (permisos)
- Cierre gap I-05, I-06

### Riesgos del sprint


| Riesgo                                   | Mitigación                                              |
| ---------------------------------------- | ------------------------------------------------------- |
| Reglas LOTTT vacaciones complejas (R-01) | Tabla parametrizada; validación legal                   |
| Modelo prestaciones insuficiente (I-05)  | Movimientos append-only desde diseño                    |
| Dos flujos complejos en un sprint        | Priorizar prestaciones; permisos laborales como stretch |


### Dependencias críticas

- Sprint 4 completado (motor + deducciones)
- Bloquea: Sprint 7 (liquidaciones necesita prestaciones y vacaciones)

### Definition of Done del sprint

- [ ] Prestaciones acumuladas tras 3 meses simulados
- [ ] Intereses calculados al cierre trimestral
- [ ] Vacaciones registradas por operador RRHH y pagadas vía nómina tipo vacaciones
- [ ] Saldo vacacional se descuenta correctamente
- [ ] RRHH consulta historial prestaciones por empleado

---

## Sprint 6 — Préstamos + Utilidades

### Objetivo del Sprint

Gestionar préstamos con deducción en nómina y distribución anual de utilidades.

### User Stories incluidas

US-30, US-31, US-32, US-33

### Entregables funcionales

- CRUD préstamos con saldo
- Deducción automática en nómina regular
- Validación: no deducir más que saldo pendiente
- Configuración utilidades anuales
- Nómina tipo utilidades con distribución proporcional
- Historial utilidades por ejercicio
- Entidad configuración utilidades (I-03)

### Riesgos del sprint


| Riesgo                                | Mitigación                                    |
| ------------------------------------- | --------------------------------------------- |
| Cuotas préstamo no definidas en ERS   | MVP: deducción fija configurable por préstamo |
| Criterio utilidades ambiguo (R-01)    | Parametrizar: proporcional a días trabajados  |
| Integración préstamos + nómina (R-02) | Tests integración end-to-end                  |


### Dependencias críticas

- Sprint 3-4 completados (motor nómina)
- Sprint 5 parcial (no bloqueante entre sí con Sprint 6)
- Puede ejecutarse en paralelo con refinamiento Sprint 5 si hay capacidad

### Definition of Done del sprint

- [ ] Préstamo deducido en 3 nóminas consecutivas hasta saldo cero
- [ ] Utilidades 2026 distribuidas entre empleados activos
- [ ] Nómina tipo utilidades cerrada con desglose
- [ ] Operador RRHH consulta saldo préstamo en ficha del empleado

---

## Sprint 7 — Liquidaciones

### Objetivo del Sprint

Wizard de liquidación integral con cálculo automático y cierre de relación laboral.

### User Stories incluidas

US-34, US-35, US-36

### Entregables funcionales

- Wizard liquidación (renuncia/despido)
- Cálculo: salarios pendientes + vacaciones + prestaciones + indemnizaciones
- Nómina tipo liquidación
- Registro entidad Liquidacion
- Egreso automático empleado
- PDF documento liquidación

### Riesgos del sprint


| Riesgo                                 | Mitigación                                                 |
| -------------------------------------- | ---------------------------------------------------------- |
| Indemnizaciones LOTTT complejas (R-01) | Parametrizar por motivo; validación legal obligatoria      |
| Orquestación multi-módulo (R-02)       | Tests integración con escenarios 1, 2 y 5 años antigüedad  |
| Sprint más complejo del proyecto       | No añadir scope; renuncia primero, despido en refinamiento |


### Dependencias críticas

- Sprint 4, 5, 6 completados (payroll + prestaciones + vacaciones + préstamos)
- Bloquea: Sprint 8 (reportes de liquidación)

### Definition of Done del sprint

- [ ] Liquidación renuncia calculada correctamente para empleado 2+ años
- [ ] Nómina tipo liquidación generada y cerrada
- [ ] Empleado en estado egresado con fecha_retiro
- [ ] PDF liquidación entregable
- [ ] Validación contador en al menos 2 casos de prueba

**Hito:** Versión legal completa LOTTT alcanzada

---

## Sprint 8 — Reportes + Auditoría

### Objetivo del Sprint

Reportes legales consolidados, exportación Excel, dashboard KPIs y bitácora avanzada.

### User Stories incluidas

US-38, US-39, US-40, US-41

### Entregables funcionales

- Reporte nómina consolidado Excel
- Reporte deducciones IVSS/FAOV/RPE por periodo
- Reporte prestaciones acumuladas exportable
- Dashboard KPIs (headcount, costo laboral, deducciones)
- Bitácora con filtros avanzados (usuario, fecha, acción, empresa)
- Reporte utilidades anual

### Riesgos del sprint


| Riesgo                                | Mitigación                                         |
| ------------------------------------- | -------------------------------------------------- |
| Performance exportación masiva (R-09) | Paginación en export; límite registros por archivo |
| Reportes sin datos históricos         | Seed de datos demo para validación                 |
| Dashboard scope creep                 | MVP: 3 KPIs fijos; personalización en Sprint 9     |


### Dependencias críticas

- Sprint 4-7 completados (datos de nómina, prestaciones, liquidaciones)
- Bloquea: Sprint 9 (optimización comercial)

### Definition of Done del sprint

- [ ] Contador exporta Excel nómina y deducciones legales
- [ ] Reporte prestaciones por empresa disponible
- [ ] Dashboard muestra KPIs del periodo actual
- [ ] Bitácora filtrable por Super Admin y operadores autorizados
- [ ] Reportes incluyen datos fiscales empresa (RF-59)

---

## Sprint 9 — Optimización SaaS

### Objetivo del Sprint

Planes SaaS, colas async, notificaciones a operadores y onboarding comercial para empresas clientes.

### User Stories incluidas

US-45, US-46

### Entregables funcionales

- Planes SaaS con límites por empresa cliente
- Colas async para nómina y PDFs
- Notificaciones email a operadores (nómina generada, vacaciones registradas)
- Onboarding guiado para configuración inicial de empresa cliente
- Cache parámetros legales
- Health checks básicos

### Riesgos del sprint


| Riesgo                            | Mitigación                                |
| --------------------------------- | ----------------------------------------- |
| Scope comercial vs técnico (I-09) | MVP planes: solo límite empleados         |
| Colas async complejidad (R-09)    | Solo nómina >100 empleados y PDFs masivos |


### Dependencias críticas

- Sprint 1-8 completados
- Es sprint final de roadmap inicial

### Definition of Done del sprint

- [ ] Plan SaaS limita empleados según configuración
- [ ] Nómina 200+ empleados procesada async con notificación
- [ ] Email enviado a operador al registrar vacaciones
- [ ] Onboarding guía Super Admin en configuración inicial de empresa cliente

**Hito:** Versión comercial SaaS escalable alcanzada

---

# 5. Dependencias del Sistema

## 5.1 Mapa de bloqueo entre bloques

```
SaaS Tenant Layer
    │
    ├──► Legal Configuration Engine ──► Deducciones Legales
    │                                      │
    ├──► Employee Management ──────────────┼──► Core Payroll Engine
    │         │                            │         │
    │         ├──► Time Off (Vacaciones)   │         ├──► Préstamos (deducción)
    │         │                            │         │
    │         └──► Benefits (Prestaciones)─┘         ├──► Utilidades
    │                                                 │
    └─────────────────────────────────────────────────┴──► Settlement (Liquidaciones)
                                                              │
                                                              └──► Reporting Engine
```

## 5.2 Dependencias entre sprints


| Sprint   | Depende de     | Bloquea                |
| -------- | -------------- | ---------------------- |
| Sprint 1 | —              | 2, 3, 4, 5, 6, 7, 8, 9 |
| Sprint 2 | Sprint 1       | 3, 4, 5, 6, 7          |
| Sprint 3 | Sprint 2       | 4, 5, 6, 7, 8          |
| Sprint 4 | Sprint 3       | 5, 6, 7, 8             |
| Sprint 5 | Sprint 4       | 7, 8                   |
| Sprint 6 | Sprint 4       | 7, 8                   |
| Sprint 7 | Sprint 4, 5, 6 | 8                      |
| Sprint 8 | Sprint 4-7     | 9                      |
| Sprint 9 | Sprint 1-8     | —                      |


## 5.3 Paralelización posible


| Paralelo                          | Condición                                                                              |
| --------------------------------- | -------------------------------------------------------------------------------------- |
| Sprint 5 ∥ Sprint 6               | Tras completar Sprint 4; equipos separados en Benefits/TimeOff vs Préstamos/Utilidades |
| Reportes parciales ∥ Sprint 7     | Recibo PDF (Sprint 4) independiente de liquidaciones                                   |
| Portal empleado diseño ∥ Sprint 8 | Eliminado — no aplica en modelo operativo centralizado |
| Documentación LOTTT ∥ Sprint 3-4  | Contador valida reglas mientras se construye motor                                     |


## 5.4 Camino crítico

**Sprint 1 → Sprint 2 → Sprint 3 → Sprint 4 → Sprint 7 → Sprint 8 → Sprint 9**

Sprint 5 y 6 son críticos para Sprint 7 pero pueden solaparse entre sí.

---

# 6. Riesgos del Proyecto

## 6.1 Riesgos técnicos


| ID    | Riesgo                                            | Impacto | Prob. | Sprint afectado | Mitigación                                  |
| ----- | ------------------------------------------------- | ------- | ----- | --------------- | ------------------------------------------- |
| RT-01 | Motor de fórmulas evaluable inseguro o incorrecto | Alto    | Media | 3, 4            | Sandbox de evaluación; fórmulas whitelist   |
| RT-02 | Inconsistencia schema vs ERS (I-01 a I-14)        | Alto    | Alta  | 1, 2            | Resolver gaps en Sprint 1-2 antes de nómina |
| RT-03 | Spatie Permission vs roles custom                 | Medio   | Alta  | 1               | Decisión Sprint 1 día 1                     |
| RT-04 | Transacciones nómina no atómicas                  | Crítico | Media | 3               | Rollback completo si falla un empleado      |
| RT-05 | Colisión nombre `permisos` laborales vs RBAC      | Medio   | Alta  | 1               | Renombrar a `ausencias_laborales`           |


## 6.2 Riesgos legales (LOTTT)


| ID    | Riesgo                                              | Impacto | Prob. | Sprint afectado | Mitigación                           |
| ----- | --------------------------------------------------- | ------- | ----- | --------------- | ------------------------------------ |
| RL-01 | Interpretación incorrecta prestaciones trimestrales | Alto    | Alta  | 5               | Validación contador; parametrización |
| RL-02 | Base imponible IVSS/FAOV/RPE mal calculada          | Crítico | Media | 4               | Casos de prueba con valores reales   |
| RL-03 | Indemnizaciones liquidación incorrectas             | Crítico | Alta  | 7               | Tabla por motivo; revisión legal     |
| RL-04 | Días vacacionales LOTTT desactualizados             | Alto    | Media | 5               | Tabla configurable por vigencia      |
| RL-05 | Cambio legislativo mid-proyecto                     | Alto    | Media | Todos           | Legal Engine con vigencia histórica  |


## 6.3 Riesgos de datos (multi-tenant)


| ID    | Riesgo                                 | Impacto | Prob. | Sprint afectado | Mitigación                           |
| ----- | -------------------------------------- | ------- | ----- | --------------- | ------------------------------------ |
| RD-01 | Fuga datos entre empresas              | Crítico | Media | 1+              | Global scopes + tests aislamiento    |
| RD-02 | Super Admin accede datos sin auditoría | Alto    | Baja  | 1               | Bitácora obligatoria en acciones SA  |
| RD-03 | empleado_id sin validación tenant      | Crítico | Media | 2+              | Validar empleado pertenece a empresa |
| RD-04 | Bitácora sin empresa_id                | Medio   | Alta  | 1               | Resolver I-07 en Sprint 1            |


## 6.4 Riesgos de cálculo de nómina


| ID    | Riesgo                                    | Impacto | Prob. | Sprint afectado | Mitigación                              |
| ----- | ----------------------------------------- | ------- | ----- | --------------- | --------------------------------------- |
| RC-01 | Neto negativo no detectado                | Alto    | Media | 3               | Validación pre-cierre; alerta RRHH      |
| RC-02 | Salario histórico incorrecto para periodo | Alto    | Media | 2, 3            | Tests fecha efectiva                    |
| RC-03 | Doble deducción préstamo                  | Alto    | Baja  | 6               | Idempotencia en procesamiento           |
| RC-04 | Nómina cerrada con errores                | Crítico | Media | 3, 4            | Borrador obligatorio; revisión Contador |
| RC-05 | Corrección post-cierre sin política       | Medio   | Alta  | 3               | Nómina complementaria documentada       |


## 6.5 Riesgos de escalabilidad


| ID    | Riesgo                                 | Impacto | Prob. | Sprint afectado | Mitigación                               |
| ----- | -------------------------------------- | ------- | ----- | --------------- | ---------------------------------------- |
| RE-01 | Generación nómina >500 empleados lenta | Medio   | Media | 3, 9            | Colas async Sprint 9; benchmark Sprint 3 |
| RE-02 | PDF masivo bloquea servidor            | Medio   | Media | 4, 9            | Colas + generación bajo demanda          |
| RE-03 | Sin modelo planes SaaS                 | Bajo    | Alta  | 9               | MVP límite empleados                     |
| RE-04 | Cache parámetros legales ausente       | Bajo    | Media | 9               | Cache con invalidación por vigencia      |


---

# 7. Definition of Done Global

## 7.1 Feature completada

Una feature (PB/US) se considera **completada** cuando:

- [ ] Criterios de aceptación Given/When/Then verificados
- [ ] Aislamiento multi-tenant validado (si aplica)
- [ ] Reglas de negocio del ERS respetadas (RN-XX referenciadas)
- [ ] Bitácora registra operaciones críticas (si aplica)
- [ ] Tests automatizados cubren happy path y al menos un edge case
- [ ] Validación manual por rol correspondiente (Super Admin, RRHH, Contador)
- [ ] Sin regresiones en tests existentes del módulo
- [ ] Documentación funcional mínima actualizada (si cambia flujo)

## 7.2 Sprint completado

Un sprint se considera **completado** cuando:

- [ ] Todas las User Stories comprometidas cumplen DoD de feature
- [ ] Entregables funcionales del sprint demostrables en review
- [ ] Definition of Done específica del sprint (sección 4) cumplida
- [ ] Riesgos del sprint mitigados o aceptados documentados
- [ ] Deuda técnica identificada registrada en backlog (no oculta)
- [ ] Demo funcional al Product Owner / stakeholder
- [ ] Retrospectiva realizada con acciones concretas

## 7.3 Sistema listo para producción MVP

El sistema se considera **MVP producción** cuando:

- [ ] **Sprint 1-4 completados** (MVP Nómina funcional)
- [ ] Super Admin gestiona empresas clientes y operadores de plataforma
- [ ] Operador RRHH registra empleados y genera nómina quincenal con IVSS/FAOV/RPE
- [ ] Nómina pasa por borrador → cerrada → pagada con inmutabilidad
- [ ] Recibo PDF generado por empleado
- [ ] Aislamiento multi-tenant verificado con tests de penetración básicos
- [ ] Bitácora operativa en acciones críticas
- [ ] Backups configurados y restauración probada (RNF-26)
- [ ] Parámetros legales con vigencia y alertas de expiración
- [ ] Validación contador en escenario real completo aprobada

**MVP extendido (producción completa):** Sprint 1-9 completados.

---

# 8. Roadmap Final (visión ejecutiva)

## Fase A — MVP SaaS (Sprints 1-2 | ~4 semanas)

**Entrega:** Plataforma multi-tenant con empresas, usuarios, roles, empleados, parámetros legales y ciclos de pago.

**Valor:** Cliente (empresa registrada) listo para nómina; operado 100% por la plataforma.

**Hito:** Empresa cliente operativa con plantilla registrada.

---

## Fase B — MVP Nómina funcional (Sprints 3-4 | ~4 semanas)

**Entrega:** Motor de nómina regular con deducciones legales, flujo de estados, recibo PDF.

**Valor:** Cliente procesa su primera nómina quincenal real con IVSS, FAOV, RPE.

**Hito:** Producto usable para operación básica de nómina.

---

## Fase C — Versión legal completa LOTTT (Sprints 5-7 | ~6 semanas)

**Entrega:** Prestaciones, vacaciones, préstamos, utilidades y liquidaciones integradas.

**Valor:** Cumplimiento LOTTT integral; ciclo laboral completo desde contratación hasta egreso.

**Hito:** Producto competitivo para oficinas contables venezolanas.

---

## Fase D — Versión comercial SaaS escalable (Sprints 8-9 | ~4 semanas)

**Entrega:** Reportes avanzados, dashboard, planes SaaS, colas async, onboarding.

**Valor:** Producto comercializable y escalable para operación centralizada.

**Hito:** Lanzamiento comercial SaaS.

---

## Timeline ejecutivo


| Fase           | Sprints | Duración | Acumulado               |
| -------------- | ------- | -------- | ----------------------- |
| MVP SaaS       | 1-2     | 4 sem    | 4 sem                   |
| MVP Nómina     | 3-4     | 4 sem    | 8 sem                   |
| LOTTT completo | 5-7     | 6 sem    | 14 sem                  |
| Comercial      | 8-9     | 4 sem    | **18 sem (~4.5 meses)** |


---

## Métricas de éxito por fase


| Fase           | Métrica clave                                                   |
| -------------- | --------------------------------------------------------------- |
| MVP SaaS       | 1 empresa cliente configurada por Super Admin en < 30 min         |
| MVP Nómina     | Nómina 50 empleados generada en < 30 seg                        |
| LOTTT completo | Liquidación 2 años antigüedad calculada sin intervención manual |
| Comercial      | 3 empresas clientes activas operadas centralmente por la plataforma |


---

*Documento derivado de `.docs/ERS.md` v1.1 y `.docs/pdr.md` v1.1 — listo para importar a Jira, Linear o GitHub Projects.*

---

El backlog incluye **49 ítems de producto**, **11 epics**, **43 user stories** y **9 sprints** con dependencias, riesgos y Definition of Done.