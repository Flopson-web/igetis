# Admin Login + Panel — Design Spec
**Date:** 2026-05-08
**Approach:** B — Targeted improvements + design system alignment

---

## Scope

Two files:
1. `resources/views/admin/login.blade.php` — full redesign of the login page
2. `resources/views/layouts/admin.blade.php` — logo replacement, Figtree font, design token alignment

No structural changes to sidebar navigation, routing, auth logic, or any admin content views.

---

## 1. Login Page

### Layout
- Full-viewport centered flex container (`min-height:100vh`, `display:flex`, `align-items:center`, `justify-content:center`)
- Background: `#0f172a` with radial-gradient dot texture (`rgba(255,255,255,.04)` dots, `32px 32px` spacing) — identical pattern used in public site hero sections
- Card: white, `border-radius:1rem`, `max-width:400px`, `width:100%`, shadow `0 25px 50px rgba(0,0,0,.4)`

### Card Header (dark band)
- Background: `#0f172a`
- Top border-radius matches card
- Content: logo image (`img/logos/Version en blanconegativo para el navbar oscuro .png`) at ~36px height + text `IGE<span style="color:#F97316">TIS</span>` in Figtree 800, same markup pattern as the public navbar
- Subtitle: "Panel de Administración" in small gray text

### Card Body (white)
- Fields: Email + Contraseña, each with `<label>` + `<input>` styled with `border:1.5px solid #e5e7eb`, `border-radius:0.5rem`, `padding:0.7rem 1rem`; focus state `border-color:#1E4D8C`, `outline:none`
- Password field has show/hide toggle (eye SVG icon, no external dependency)
- Submit button: full-width, `background:#1E4D8C` (`--azul`), hover `background:#F97316` (`--naranja`), transition 200ms, Figtree font, font-weight 700
- Honeypot field: preserved as-is (hidden, keeps spam protection)
- CSRF: preserved as-is

### Footer of card
- Link "← Volver al sitio" in small gray text, centered, links to `route('home')`
- No other links or text

### Fonts
- Google Fonts: Figtree (700, 800) + Inter (400, 500) via `<link>` in `<head>`
- Figtree applied to card header brand text and submit button
- Inter applied to form labels, inputs, body text

---

## 2. Admin Layout (Sidebar + Panel)

### Logo block in sidebar
- Remove the existing `<div class="sidebar-logo-icon">IG</div>` placeholder
- Replace with: `<img>` of white negative logo at ~28px height + text span `IGE<span style="color:#F97316">TIS</span>` in Figtree 800
- Same HTML/CSS pattern as public navbar brand, adapted to the existing `.sidebar-logo` container

### Typography
- Add Figtree (700, 800, 900) to the Google Fonts `@import` already present in `admin.blade.php`
- Apply Figtree to:
  - `.sidebar-logo-text` (brand name in sidebar)
  - `.topbar-title` (page title in topbar)
  - `.stat-card .stat-num` (dashboard stat numbers)
  - Card section headers / `<h2>`, `<h3>` within the layout

### Active nav item
- Add `border-left: 3px solid #F97316` to `.nav-item.active` (or equivalent active class)
- Keep existing background color on active state

### Design token alignment
- `.btn-primary`: ensure uses `#1E4D8C` background, hover `#F97316`, transition 200ms — same as login button
- Topbar: add `border-bottom: 2px solid #1E4D8C` (subtle brand separator)
- `.stat-card` icon container: change from hardcoded `#EFF6FF` to `rgba(30,77,140,.08)`
- `.badge-blue`: verify `background:#DBEAFE; color:#1E4D8C`
- `.badge-green`: verify `background:#D1FAE5; color:#065F46`

---

## Non-Goals

- No changes to sidebar structure, widths, or responsive behavior
- No changes to admin content views (cursos, mensajes, configuracion, etc.)
- No new routes, controllers, or database changes
- No changes to the honeypot or auth logic in the login form
