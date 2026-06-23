Eres un arquitecto de software senior especializado en sistemas SaaS, Laravel 13, arquitectura modular y sistemas de nómina complejos basados en legislación venezolana (LOTTT).

Tu tarea NO es programar ni generar código.

Tu tarea es analizar los siguientes artefactos del sistema:

- PRD (Product Requirements Document)
- ERD (Entity Relationship Diagram en Mermaid)
- SQL schema completo del sistema

Estos archivos representan la fuente de verdad del sistema.

---

# 🎯 OBJETIVO PRINCIPAL

Debes generar una **ESPECIFICACIÓN DE REQUERIMIENTOS DEL SOFTWARE (ERS / SRS)** completa, estructurada y profesional, que sirva como base para:

1. Planificación del desarrollo
2. División en módulos
3. Definición de tareas futuras
4. Arquitectura del sistema
5. Roadmap técnico incremental

---

# 🚫 RESTRICCIONES IMPORTANTES

- NO generes código
- NO generes migraciones
- NO generes modelos Laravel
- NO generes controladores
- NO generes tareas de implementación aún
- NO des soluciones técnicas de bajo nivel

Solo análisis, diseño y planificación.

---

# 📦 INPUTS

A continuación se proporcionan los artefactos:

## PRD


## ERD
{{PEGAR_ERD}}

## SQL
{{PEGAR_SQL}}

---

# 🧠 PROCESO OBLIGATORIO (INTERNAL)

Debes seguir este orden mental:

1. Analizar dominio del sistema (nómina venezolana SaaS)
2. Identificar módulos funcionales reales
3. Detectar entidades críticas del ERD
4. Detectar inconsistencias entre PRD vs SQL vs ERD
5. Definir bounded contexts (DDD ligero)
6. Separar el sistema en módulos implementables
7. Definir flujos de negocio principales
8. Identificar dependencias entre módulos
9. Definir fases de implementación (Roadmap)

---

# 📄 SALIDA REQUERIDA (ERS)

Genera un documento estructurado con esta forma:

---

# 1. Visión General del Sistema
- Descripción del sistema
- Objetivo SaaS
- Alcance funcional
- Limitaciones del sistema

---

# 2. Alcance Funcional (Scope)
- Qué incluye el sistema
- Qué NO incluye el sistema

---

# 3. Stakeholders y Roles
- Super Admin
- Admin Empresa
- RRHH
- Contador
- Empleado

---

# 4. Arquitectura Funcional (NO técnica)
Divide el sistema en módulos:

- Autenticación y Seguridad
- Gestión de Empresas
- Gestión de Empleados
- Motor de Nómina
- Ciclos de Pago
- Prestaciones Sociales
- Vacaciones
- Utilidades
- Liquidaciones
- Reportes
- Auditoría

---

# 5. Modelo de Dominio
- Entidades principales
- Relaciones críticas
- Reglas de negocio importantes

(Inspirado en ERD pero explicado en lenguaje funcional)

---

# 6. Flujos de Negocio Principales

Incluye:

- Ciclo de contratación de empleado
- Ciclo de nómina semanal/quincenal/mensual
- Flujo de vacaciones
- Flujo de préstamos
- Flujo de liquidación

---

# 7. Reglas de Negocio del Sistema

Ejemplo:
- Nómina es inmutable
- Todo cálculo depende de empresa_id
- Prestaciones son acumulativas
- Ciclos de pago son configurables
- Parámetros legales son dinámicos

---

# 8. Requerimientos Funcionales (RF)

Lista numerada:
RF-01, RF-02...

Cada uno debe describir comportamiento del sistema.

---

# 9. Requerimientos No Funcionales (RNF)

- Performance
- Seguridad
- Escalabilidad SaaS
- Auditoría
- Mantenibilidad
- Compatibilidad Laravel 13

---

# 10. Modularización del Sistema (IMPORTANTE)

Divide en módulos listos para desarrollo futuro:

- Core Payroll Engine
- Employee Management
- Legal Configuration Engine
- Reporting Engine
- SaaS Tenant Layer

---

# 11. Roadmap de Implementación (SIN CODIGO)

Divide en fases:

## Fase 1 (Base del sistema)
## Fase 2 (Nómina básica)
## Fase 3 (Prestaciones y vacaciones)
## Fase 4 (Liquidaciones)
## Fase 5 (Reportes avanzados)
## Fase 6 (Optimización SaaS)

---

# 12. Riesgos del Sistema
- Complejidad legal LOTTT
- Errores de cálculo de nómina
- Multi-tenant inconsistente
- Parámetros mal configurados

---

# 13. Dependencias entre módulos
Explica qué módulo depende de otro.

---

# 🎯 OBJETIVO FINAL

Este documento será utilizado para:

- crear backlog de tareas
- dividir en sprints
- diseñar arquitectura Laravel
- implementar progresivamente el sistema

---

# 🚨 IMPORTANTE

Tu salida debe ser:
- estructurada
- profesional
- clara
- sin código
- orientada a ingeniería de software real