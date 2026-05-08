# Admin Login + Panel Redesign — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Redesign the admin login page and update the admin layout with the real logo, Figtree font, and design-system token alignment (naranja hover, topbar border, badge colors).

**Architecture:** Targeted edits to two Blade view files — `resources/views/admin/login.blade.php` (full visual redesign) and `resources/views/layouts/admin.blade.php` (logo, font, token tweaks). No PHP files touched, no routes, no new files.

**Tech Stack:** Laravel Blade, CSS (inline `<style>` blocks), Google Fonts (Figtree + Inter)

---

## Task 1: Redesign admin login page

**Files:**
- Modify: `resources/views/admin/login.blade.php`

- [ ] **Step 1: Update Google Fonts to include Figtree**

  In `login.blade.php` line 9, replace:
  ```html
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  ```
  with:
  ```html
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  ```

- [ ] **Step 2: Change body background to dark with dot texture**

  Replace the `body` CSS rule (currently has `background: #EBF1FA`) with:
  ```css
  body {
      font-family: 'Inter', system-ui, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #0f172a;
      background-image: radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
      background-size: 32px 32px;
      -webkit-font-smoothing: antialiased;
      padding: 1.5rem;
  }
  ```

- [ ] **Step 3: Update card shadow for dark background**

  Replace the `.card` CSS rule:
  ```css
  .card {
      width: 100%;
      max-width: 400px;
      background: white;
      border-radius: 1.25rem;
      box-shadow: 0 25px 50px rgba(0,0,0,.4), 0 8px 16px rgba(0,0,0,.3);
      overflow: hidden;
  }
  ```

- [ ] **Step 4: Change card-top to flat dark**

  Replace `.card-top` CSS (currently has the blue gradient):
  ```css
  .card-top {
      background: #0f172a;
      padding: 2rem 2rem 1.75rem;
      text-align: center;
  }
  ```

- [ ] **Step 5: Remove .logo-mark CSS, add .brand CSS, update .logo-name**

  Remove the entire `.logo-mark { ... }` block (the "IG" placeholder square).

  Add in its place:
  ```css
  .brand {
      display: inline-flex;
      align-items: center;
      gap: 0.625rem;
      margin-bottom: 0.5rem;
  }
  ```

  Replace the `.logo-name` CSS rule with:
  ```css
  .logo-name {
      font-family: 'Figtree', system-ui, sans-serif;
      font-size: 1.5rem;
      font-weight: 900;
      color: white;
      letter-spacing: -0.04em;
      line-height: 1;
  }
  ```

- [ ] **Step 6: Add Figtree to submit button and change hover to naranja**

  Replace `.btn-submit` CSS rule:
  ```css
  .btn-submit {
      width: 100%;
      padding: 0.8rem;
      background: #1E4D8C;
      color: white;
      font-size: 0.9rem;
      font-weight: 700;
      font-family: 'Figtree', system-ui, sans-serif;
      border: none;
      border-radius: 0.625rem;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      margin-top: 0.5rem;
      letter-spacing: 0.01em;
  }
  ```

  Replace `.btn-submit:hover` CSS rule:
  ```css
  .btn-submit:hover {
      background: #F97316;
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(249,115,22,.3);
  }
  ```

- [ ] **Step 7: Replace the card-top HTML block**

  In the HTML body, replace:
  ```html
  <div class="card-top">
      <div class="logo-mark">IG</div>
      <div class="logo-name">IGETIS</div>
      <div class="logo-sub">Panel de administración</div>
  </div>
  ```
  with:
  ```html
  <div class="card-top">
      <div class="brand">
          <img src="{{ asset('img/logos/Version en blanconegativo para el navbar oscuro .png') }}" alt="" style="height:36px; width:auto;">
          <span class="logo-name">IGE<span style="color:#F97316">TIS</span></span>
      </div>
      <div class="logo-sub">Panel de administración</div>
  </div>
  ```

- [ ] **Step 8: Verify visually**

  Open `http://localhost/admin/login` (or whichever local URL the project uses). Confirm:
  - Dark background with subtle dot grid
  - White card with dark top band
  - Logo image + "IGE**TIS**" with orange "TIS" visible
  - Form fields focus with blue ring
  - "Ingresar al panel" button turns orange on hover

- [ ] **Step 9: Commit**

  ```bash
  git add resources/views/admin/login.blade.php
  git commit -m "feat: redesign admin login page with dark background and real logo"
  ```

---

## Task 2: Admin sidebar — logo replacement + Figtree

**Files:**
- Modify: `resources/views/layouts/admin.blade.php`

- [ ] **Step 1: Add Figtree to Google Fonts**

  In `admin.blade.php` line 9, replace:
  ```html
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  ```
  with:
  ```html
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  ```

- [ ] **Step 2: Remove .sidebar-logo-icon CSS**

  Delete the entire `.sidebar-logo-icon { ... }` block:
  ```css
  .sidebar-logo-icon {
      width: 38px; height: 38px; border-radius: 0.625rem;
      background: linear-gradient(135deg, #1E4D8C, #2E6DB4);
      display: flex; align-items: center; justify-content: center;
      font-weight: 900; font-size: 0.875rem; color: white; flex-shrink: 0;
  }
  ```

- [ ] **Step 3: Add Figtree to sidebar h1 and topbar-title**

  Replace `.sidebar-logo-text h1` CSS:
  ```css
  .sidebar-logo-text h1 { color: white; font-size: 1rem; font-weight: 800; letter-spacing: -0.02em; font-family: 'Figtree', system-ui, sans-serif; }
  ```

  Replace `.topbar-title` CSS:
  ```css
  .topbar-title { font-family: 'Figtree', system-ui, sans-serif; font-size: 0.95rem; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  ```

  Replace `.stat-number` CSS:
  ```css
  .stat-number { font-family: 'Figtree', system-ui, sans-serif; font-size: 2rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.375rem; }
  ```

- [ ] **Step 4: Replace sidebar logo HTML**

  Replace:
  ```html
  <div class="sidebar-logo-icon">IG</div>
  <div class="sidebar-logo-text">
      <h1>IGETIS</h1>
      <p>Panel de gestión</p>
  </div>
  ```
  with:
  ```html
  <img src="{{ asset('img/logos/Version en blanconegativo para el navbar oscuro .png') }}" alt="" style="height:28px; width:auto; flex-shrink:0;">
  <div class="sidebar-logo-text">
      <h1>IGE<span style="color:#F97316">TIS</span></h1>
      <p>Panel de gestión</p>
  </div>
  ```

- [ ] **Step 5: Change active nav border to naranja**

  In `.nav-item.active`, change `border-left: 3px solid #2E6DB4` to `border-left: 3px solid #F97316`:
  ```css
  .nav-item.active {
      background: rgba(30,77,140,.35);
      color: white; font-weight: 600;
      border-left: 3px solid #F97316;
      padding-left: calc(0.875rem - 3px);
  }
  ```

- [ ] **Step 6: Verify visually**

  Log in and open any admin page. Confirm:
  - Sidebar shows logo image + "IGE**TIS**" with orange "TIS"
  - Active nav item has an orange left border
  - Page title in topbar uses Figtree (bolder, tighter)

- [ ] **Step 7: Commit**

  ```bash
  git add resources/views/layouts/admin.blade.php
  git commit -m "feat: replace sidebar logo placeholder with real logo and add Figtree"
  ```

---

## Task 3: Design token alignment

**Files:**
- Modify: `resources/views/layouts/admin.blade.php`

- [ ] **Step 1: Update .btn-primary hover to naranja**

  Replace `.btn-primary:hover` CSS:
  ```css
  .btn-primary:hover   { background: #F97316; }
  ```

  Replace `.topbar-btn-primary:hover` CSS:
  ```css
  .topbar-btn-primary:hover { background: #F97316; }
  ```

- [ ] **Step 2: Add brand border to topbar**

  Replace the `border-bottom` line inside `.topbar`:
  ```css
  .topbar {
      background: white; height: 60px;
      border-bottom: 2px solid #1E4D8C;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 1.5rem; position: sticky; top: 0; z-index: 100;
      gap: 0.75rem;
  }
  ```

- [ ] **Step 3: Align badge colors to brand tokens**

  Replace `.badge-blue` and `.badge-green` CSS:
  ```css
  .badge-blue    { background: #dbeafe; color: #1E4D8C; }
  .badge-green   { background: #d1fae5; color: #065f46; }
  ```

- [ ] **Step 4: Update stat-icon background in dashboard view**

  Run this grep to find all inline stat-icon backgrounds in admin views:
  ```bash
  grep -rn "EFF6FF\|eff6ff" resources/views/admin/
  ```

  For each match, change `background:#EFF6FF` (or `background: #EFF6FF`) to `background:rgba(30,77,140,.08)`.

  The typical pattern in dashboard views looks like:
  ```html
  <div class="stat-icon" style="background:#EFF6FF;">
  ```
  Change to:
  ```html
  <div class="stat-icon" style="background:rgba(30,77,140,.08);">
  ```

- [ ] **Step 5: Verify visually**

  Check the admin dashboard and any page with buttons. Confirm:
  - Primary buttons (`btn-primary`) hover to orange
  - Topbar has a visible blue bottom border
  - Blue badges show `#1E4D8C` text
  - Stat icon containers have a soft blue tint instead of flat light blue

- [ ] **Step 6: Commit**

  Stage `admin.blade.php` plus any admin view files modified in Step 4:
  ```bash
  git add resources/views/layouts/admin.blade.php
  git add resources/views/admin/          # stages only modified files within admin/
  git commit -m "feat: align admin panel design tokens to brand colors"
  ```
