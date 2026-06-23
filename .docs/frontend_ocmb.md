# Adaptación Frontend al Design System OCMB
## SystemNomina — Laravel 13 + Breeze + Blade + TailwindCSS v3

**Versión:** 1.0  
**Fuente de verdad visual:** `.docs/system_design.md`  
**Estado Fase 1:** Implementada (tokens Tailwind + layouts base)  
**Estado Fase 2:** Implementada (componentes UI base + auth OCMB)  
**Estado Fase 3:** Implementada (sidebar, topbar, logo OCMB, auth corporativo)  
**Estado Fase 4:** Implementada (KPI cards, tablas, dashboard data-first)  
**Estado Fase 5:** Implementada (reportes, dark/light toggle, modal/dropdown OCMB)

---

# 1. DIAGNÓSTICO DEL FRONTEND ACTUAL

## Problemas visuales encontrados

- Fuente **Figtree** (Breeze) en lugar de Cinzel / Montserrat / Inter
- Paleta genérica `gray-*` e **indigo** en focus/active states
- Layout **top navigation** Breeze vs sidebar corporativo OCMB
- Botones con `uppercase tracking-widest` (estilo startup)
- Cards, inputs y sombras inconsistentes con tokens OCMB
- Logo Laravel por defecto
- Sin componentes de tabla, KPI ni layout de reportes

## Inconsistencias críticas con OCMB

| Regla OCMB | Estado previo |
|------------|---------------|
| Primary #0D1B2A | gray-800 |
| Accent #C9A24D en focus/KPIs | indigo-500 |
| Sidebar dashboard | topbar horizontal |
| Inputs 44px, focus accent | sin min-height, focus indigo |
| Cards 12px / 24px pad / shadow medium | variado |
| Dark mode OCMB | gray-900/800 |

---

# 2. MAPEO DE DESIGN TOKENS

Implementado en `tailwind.config.js`:

| Token OCMB | Clase Tailwind |
|------------|----------------|
| Primary | `primary`, `primary-hover` |
| Accent | `accent` |
| Background | `background` |
| Surface | `surface` |
| Text | `ink`, `ink-secondary` |
| Estados | `success`, `warning`, `danger`, `info` |
| Border inputs | `border-border` |
| Dark BG/Surface/Text | `dark-background`, `dark-surface`, `dark-ink` |
| Sombras | `shadow-ocmb-sm`, `shadow-ocmb-md`, `shadow-ocmb-lg` |
| Radius | `rounded-xs` … `rounded-xl` (md=8px, lg=12px) |
| Container | `max-w-container` (1280px) |
| Fuentes | `font-sans` (Montserrat), `font-heading` (Cinzel), `font-data` (Inter) |
| Escala tipo | `text-display`, `text-h1` … `text-caption` |

Fuentes cargadas vía `resources/views/layouts/partials/fonts.blade.php`.

---

# 3. COMPONENTES A REFRACTORIZAR

| Componente | Prioridad | Fase |
|------------|-----------|------|
| `primary-button`, `secondary-button`, `danger-button` | Alta | 2 |
| `text-input`, `input-label`, `input-error` | Alta | 2 |
| Card (nuevo `ui/card`) | Alta | 2 |
| `navigation` → sidebar | Alta | 3 |
| `modal`, `dropdown` | Media | 5 |
| Table (nuevo `ui/table`) | Alta | 4 |
| KPI card (nuevo) | Alta | 4 |
| `application-logo` | Media | 3 |

---

# 4. PROPUESTA DE SISTEMA DE COMPONENTES

```
resources/views/components/ui/
├── button.blade.php
├── input.blade.php
├── label.blade.php
├── card.blade.php
├── table.blade.php
├── kpi-card.blade.php
├── badge.blade.php
├── alert.blade.php
└── page-header.blade.php
```

**Reglas:** vistas de dominio usan solo `ui/*` o tokens; un accent por vista; datos en `font-data tabular-nums`.

---

# 5. LAYOUTS PRINCIPALES

## Dashboard (objetivo Fase 3–4)
- Sidebar fija `bg-primary`, nav Montserrat + iconos outline
- Topbar `bg-surface`, breadcrumb, contexto empresa cliente
- Main `bg-background`, grid KPIs, cards y tablas

## Auth (objetivo Fase 2)
- Centrado, `bg-background`, card `surface` + `shadow-ocmb-md`
- Título Cinzel, form Montserrat

## Reportes (objetivo Fase 5)
- Data-first, tablas header `primary`, Inter para montos

---

# 6. REGLAS DE UI CONSISTENTE

1. Jerarquía: dato → etiqueta → acción → decoración
2. Accent nunca dominante; solo KPIs y focus
3. Espaciado escala 8px (`gap-6`, `p-6`, `mb-8`)
4. Sin uppercase en botones de producto
5. Iconografía outline 2px (Heroicons)
6. Animaciones 150–200ms, sin bounce/scale agresivo

---

# 7. PLAN DE IMPLEMENTACIÓN

## Fase 1 — Tokens de diseño ✅
- [x] `tailwind.config.js` tokens OCMB
- [x] Fuentes Cinzel / Montserrat / Inter
- [x] Layouts `app` y `guest` con `background`, `surface`, dark tokens
- [x] `app.css` base layer
- [x] Dashboard con tokens iniciales

## Fase 2 — Componentes UI base ✅
- [x] `ui/button`, `ui/input`, `ui/label`, `ui/card`, `ui/badge`, `ui/alert`, `ui/auth-header`, `ui/link`, `ui/checkbox`
- [x] Aliases Breeze (`primary-button`, `text-input`, etc.) delegan a `ui/*`
- [x] Vistas auth con tokens OCMB (sin indigo/gray genérico)
- [x] Guest layout usa `x-ui.card` y focus ring `accent`

## Fase 3 — Layouts principales ✅
- [x] Sidebar fija `bg-primary` con nav Montserrat + iconos outline
- [x] Topbar `bg-surface` con contexto empresa y menú usuario
- [x] Shell dashboard (`layouts/app` + partials sidebar/topbar)
- [x] Logo OCMB (`application-logo` corporativo)
- [x] Auth corporativo split-panel (panel marca + formulario)
- [x] Profile y dropdown con tokens OCMB

## Fase 4 — Dashboard completo ✅
- [x] `ui/kpi-card` con valor `font-data tabular-nums` y accent en KPI principal
- [x] `ui/table`, `ui/table/row`, `ui/table/header-cell`, `ui/table/cell` (header primary, filas alternadas)
- [x] `ui/empty-state` para tablas sin datos
- [x] `DashboardController` con datos placeholder (listo para módulos de nómina)
- [x] Dashboard grid: 4 KPIs + tabla recientes + resumen legal
- [x] Tests feature `DashboardTest`

## Fase 5 — Refinamiento ✅
- [x] `darkMode: 'class'` en Tailwind + script anti-FOUC en `<head>`
- [x] `ui/theme-toggle` con Alpine store y persistencia en `localStorage`
- [x] Toggle en topbar (app) y esquina superior (guest/auth)
- [x] `modal` y `dropdown` con tokens OCMB
- [x] `ui/report-layout` + vista demo `reports/payroll-summary`
- [x] `ui/table/footer` para filas de totales en reportes
- [x] Profile partials sin gray/indigo genérico
- [x] Bordes dark unificados (`dark:border-white/10`)

## Densidad espacial (shadcn-aligned)
- [x] `ui/form-field` con `space-y-2` (label → input → error)
- [x] Button md: `h-10 px-4` (44px táctil en móvil, `md:min-h-10`)
- [x] Input md: `h-10 px-3 py-2` | sm: `h-9 px-2.5`
- [x] Formularios auth/profile: `space-y-4` entre campos
- [x] Badge: `px-2.5 py-0.5` | Checkbox: `h-4 w-4`
- [x] Tablas: `py-2.5` en celdas | KPI cards: `p-5`

---

# 8. TEMA CLARO / OSCURO

- **Claro (default):** tokens `background`, `surface`, `ink`
- **Oscuro:** clase `dark` en `<html>`, tokens `dark-background`, `dark-surface`, `dark-ink`
- **Persistencia:** `localStorage.theme` = `light` | `dark`
- **Componente:** `<x-ui.theme-toggle />` en topbar y layout guest

---

# 9. REGLA MAESTRA

Estética vs claridad → **claridad**  
Diseño vs confianza → **confianza**  
Creatividad vs orden → **orden**

> "Precisión financiera respaldada por confianza profesional."

---

*Ver también: `.docs/system_design.md`, `.docs/BACKLOG.md` (Sprint UI futuro)*
