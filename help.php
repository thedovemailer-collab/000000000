<?php
// ── booqi — help and setup guides ────────────────────────────
// Same look as index.php. APP_URL / DESKTOP_URL match index.php: set
// DESKTOP_URL to the desktop app download to show the download buttons.
$APP_URL     = 'BotCommand.html';
$DESKTOP_URL = '';
$signedIn = isset($_COOKIE['bc_sess']);
$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
// Tick / cross / text cells for the comparison table.
$Y = '<span class="y" aria-label="Yes"><svg><use href="#i-yes"/></svg></span>';
$N = '<span class="n" aria-label="No"><svg><use href="#i-no"/></svg></span>';
$T = fn($s) => '<span class="t">' . $s . '</span>';
// Comparison table: [what, [Telegram bot, Telegram account, Discord bot, Contact page]].
$COLS = ['Telegram bot', 'Telegram account', 'Discord bot', 'Contact page'];
$CMP = [
  ['Set up from the website',             [$Y, $N, $Y, $Y]],
  ["Keeps replying while you're offline", [$Y, $T('While the app is open'), $Y, $Y]],
  ['AI replies, payments and licences',   [$Y, $Y, $Y, $Y]],
  ['Photos and files',                    [$Y, $Y, $Y, $Y]],
  ['Shows “typing…” to customers',        [$Y, $Y, $Y, $Y]],
  ['See when a customer is typing',       [$N, $Y, $T('Desktop app'), $Y]],
  ['Read receipts (“seen”)',              [$N, $Y, $N, $Y]],
  ['Replies come from your own account',  [$N, $Y, $N, $Y]],
  ['Message a customer first',            [$N, $Y, $N, $N]],
];
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Help — Booqi</title>
<meta name="description" content="Step-by-step guides for connecting booqi to a Telegram bot, your own Telegram account, a Discord bot or your contact page.">
<meta name="theme-color" content="#020b10">
<meta name="apple-mobile-web-app-title" content="booqi">
<meta property="og:title" content="Help — Booqi">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%232dd4bf'/%3E%3Cstop offset='.55' stop-color='%230ea5e9'/%3E%3Cstop offset='1' stop-color='%234f46e5'/%3E%3C/linearGradient%3E%3CradialGradient id='h' cx='.3' cy='.22' r='.8'%3E%3Cstop offset='0' stop-color='%23fff' stop-opacity='.35'/%3E%3Cstop offset='.5' stop-color='%23fff' stop-opacity='0'/%3E%3C/radialGradient%3E%3C/defs%3E%3Ccircle cx='32' cy='32' r='31' fill='url(%23g)'/%3E%3Ccircle cx='32' cy='32' r='31' fill='url(%23h)'/%3E%3Ccircle cx='32' cy='32' r='30' fill='none' stroke='%23fff' stroke-opacity='.25' stroke-width='1.5'/%3E%3Cpath d='M22.5 15v27' stroke='%23fff' stroke-width='6' stroke-linecap='round'/%3E%3Ccircle cx='32' cy='37' r='9.5' fill='none' stroke='%23fff' stroke-width='6'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Fredoka:wght@400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
:root {
  --fx1: #14b8a6; --fx2: #06b6d4; --fx3: #3b82f6;
  --b1: #020b10; --b2: #042029; --b3: #061831;
  --t1: #eef0f6; --t2: #9aa3b8; --t3: #66718a;
  --ln: rgba(255,255,255,.065); --ln2: rgba(255,255,255,.11);
  --card: rgba(12,18,29,.72);
  --ok: #30d158; --warn: #f5a524;
  --font: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
  --mono: 'JetBrains Mono', ui-monospace, monospace;
  --w: 1080px; --navh: 76px;
}
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; scroll-padding-top: calc(var(--navh) + 16px); -webkit-text-size-adjust: 100%; background: var(--b1); }
@media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } }
body { margin: 0; -webkit-tap-highlight-color: transparent; color: var(--t1); font: 400 14.5px/1.6 var(--font); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
a { color: inherit; text-decoration: none; }
svg { display: block; }
.wrap { width: min(var(--w), 100% - 40px); margin-inline: auto; }
/* Chrome (header, cards, buttons) is not selectable; the guide text is,
   so tokens, commands and links can be copied. */
.nav, .btn, .pick, .toc, footer, summary { -webkit-user-select: none; user-select: none; }

/* Ambient background (as index.php) */
.fx { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden;
  background: linear-gradient(125deg, var(--b1) 0%, var(--b2) 38%, var(--b3) 70%, var(--b1) 100%); }
.fx i { position: absolute; border-radius: 50%; filter: blur(90px); opacity: .45; }
.fx i:nth-child(1) { width: 44vw; height: 44vw; left: -12vw; top: -14vw; background: color-mix(in srgb, var(--fx1) 24%, transparent); }
.fx i:nth-child(2) { width: 38vw; height: 38vw; right: -10vw; top: 12vh; background: color-mix(in srgb, var(--fx3) 22%, transparent); }
.fx::after { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 110% 90% at 50% 40%, transparent 35%, rgba(0,0,0,.5) 100%); }

/* Wordmark + header (as index.php) */
.word { font: 400 24px/1 'Fredoka', var(--font); letter-spacing: -.01em; padding-bottom: 2px;
  background: linear-gradient(90deg, var(--fx1) 0%, var(--fx2) 28%, var(--fx3) 56%, #dfe6f0 72%, var(--fx1) 100%);
  background-size: 260% 100%; -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;
  animation: flow 9s ease-in-out infinite alternate; }
@keyframes flow { from { background-position: 0% 50%; } to { background-position: 100% 50%; } }
.nav { position: fixed; top: 0; left: 0; right: 0; z-index: 30; padding: 12px 0; pointer-events: none; }
.nav .wrap { pointer-events: auto; position: relative; display: flex; align-items: center; gap: 16px; height: 52px; padding: 0 8px 0 20px;
  border-radius: 16px; background: rgba(7,13,21,.72); border: 1px solid rgba(255,255,255,.08);
  backdrop-filter: blur(20px) saturate(170%); -webkit-backdrop-filter: blur(20px) saturate(170%);
  box-shadow: 0 12px 34px -16px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.06); }
.nav .wrap::before { content: ''; position: absolute; left: 18%; right: 18%; top: -1px; height: 1px; pointer-events: none;
  background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--fx2) 60%, transparent), transparent); opacity: .7; }
.brand { display: inline-flex; align-items: center; gap: 10px; }
.brand .tag { font-size: 12px; color: var(--t3); padding-left: 10px; border-left: 1px solid var(--ln2); line-height: 1; }
.links { display: flex; gap: 2px; margin-left: auto; padding: 3px; border-radius: 11px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.05); }
.links a { height: 30px; padding: 0 12px; display: inline-flex; align-items: center; border-radius: 8px; font-size: 12.5px; color: var(--t2); transition: color .15s, background-color .15s; }
.links a:hover { color: var(--t1); background: rgba(255,255,255,.04); }
.nav .btn-s { margin-left: 4px; }

/* Buttons */
.btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; height: 38px; padding: 0 16px; border-radius: 10px;
  font: 600 13px/1 var(--font); letter-spacing: -.005em; white-space: nowrap; cursor: pointer; transition: transform .15s, background-color .15s, box-shadow .2s; }
.btn:active { transform: translateY(1px); }
.btn svg { width: 14px; height: 14px; }
.btn-p { color: #04151a; background: linear-gradient(135deg, #5eead4, #38bdf8 55%, #818cf8); box-shadow: 0 8px 24px -10px color-mix(in srgb, var(--fx2) 70%, transparent), inset 0 1px 0 rgba(255,255,255,.35); }
.btn-g { color: var(--t1); background: rgba(255,255,255,.045); border: 1px solid var(--ln2); }
.btn-g:hover { background: rgba(255,255,255,.08); }
.btn-s { height: 32px; padding: 0 13px; font-size: 12.5px; border-radius: 9px; }

/* Type */
.eyebrow { display: inline-flex; align-items: center; gap: 7px; font-size: 11px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--fx1); }
.eyebrow::before { content: ''; width: 14px; height: 1px; background: currentColor; opacity: .6; }
h1, h2 { background: linear-gradient(180deg, #fff 30%, #aab4c8); -webkit-background-clip: text; background-clip: text; color: transparent; text-wrap: balance; }
h1 em, h2 em { font-style: normal; background: linear-gradient(90deg, #5eead4, #7dd3fc 50%, #a5b4fc); -webkit-background-clip: text; background-clip: text; color: transparent; }
h1 { margin: 14px 0 10px; font-size: clamp(30px, 4vw, 44px); line-height: 1.06; letter-spacing: -.035em; font-weight: 700; }
h2 { margin: 6px 0 6px; font-size: clamp(22px, 2.6vw, 28px); line-height: 1.15; letter-spacing: -.026em; font-weight: 650; }
h3 { margin: 26px 0 10px; font-size: 14.5px; font-weight: 600; letter-spacing: -.01em; }
p { margin: 0 0 12px; }
.sub { margin: 0; color: var(--t2); max-width: 40em; text-wrap: pretty; }
b, strong { color: var(--t1); font-weight: 600; }
.muted { color: var(--t2); }
a.ln { color: #7dd3fc; border-bottom: 1px solid color-mix(in srgb, #7dd3fc 35%, transparent); transition: border-color .15s; }
a.ln:hover { border-color: #7dd3fc; }
code, .path { font: 500 12.5px/1.4 var(--mono); }
code { padding: 2px 6px; border-radius: 6px; background: rgba(255,255,255,.06); border: 1px solid var(--ln); color: #cfe8ff; white-space: nowrap; }
.path { display: inline-flex; flex-wrap: wrap; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 6px; background: rgba(20,184,166,.08);
  border: 1px solid rgba(20,184,166,.18); color: #99f6e4; font-family: var(--font); font-size: 12.5px; font-weight: 500; }
.path i { font-style: normal; opacity: .55; }

/* Page top */
.top { padding: calc(var(--navh) + 44px) 0 26px; }
.top .sub { font-size: 15.5px; }

/* Quick pick: four cards */
.picks { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 26px; }
.pick { position: relative; display: flex; flex-direction: column; gap: 6px; padding: 16px; border-radius: 14px; background: var(--card); border: 1px solid var(--ln);
  transition: border-color .2s, transform .2s, background-color .2s; }
.pick:hover { border-color: rgba(125,211,252,.28); transform: translateY(-2px); background: rgba(14,21,33,.8); }
.pick .ic { width: 32px; height: 32px; border-radius: 9px; display: grid; place-items: center; margin-bottom: 6px;
  background: linear-gradient(145deg, rgba(20,184,166,.16), rgba(59,130,246,.12)); border: 1px solid rgba(255,255,255,.07); color: #7dd3fc; }
.pick .ic svg { width: 16px; height: 16px; }
.pick b { font-size: 14px; }
.pick span { font-size: 12.5px; color: var(--t2); line-height: 1.5; }
.pick .where { margin-top: auto; padding-top: 8px; display: flex; gap: 6px; flex-wrap: wrap; }
.badge { display: inline-flex; align-items: center; gap: 5px; height: 22px; padding: 0 8px; border-radius: 999px; font-size: 11px; font-weight: 500;
  border: 1px solid var(--ln2); background: rgba(255,255,255,.03); color: var(--t2); white-space: nowrap; }
.badge i { width: 5px; height: 5px; border-radius: 50%; background: var(--fx1); }
.badge.desk { color: #fcd9a4; border-color: rgba(245,165,36,.28); background: rgba(245,165,36,.07); }
.badge.desk i { background: var(--warn); }

/* Docs layout: contents on the left, guides on the right */
.docs { display: grid; grid-template-columns: 200px minmax(0, 1fr); gap: 44px; padding: 26px 0 70px; align-items: start; }
.toc { position: sticky; top: calc(var(--navh) + 20px); display: flex; flex-direction: column; gap: 1px; }
.toc .lbl { font-size: 10.5px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--t3); margin: 0 0 8px 10px; }
.toc a { position: relative; padding: 6px 10px; border-radius: 8px; font-size: 13px; color: var(--t2); transition: color .15s, background-color .15s; }
.toc a:hover { color: var(--t1); background: rgba(255,255,255,.035); }
.toc a[aria-current="true"] { color: var(--t1); background: rgba(255,255,255,.06); }
.toc a[aria-current="true"]::before { content: ''; position: absolute; left: 0; top: 8px; bottom: 8px; width: 2px; border-radius: 2px; background: linear-gradient(var(--fx1), var(--fx3)); }
.sec { padding-top: 40px; margin-top: 40px; border-top: 1px solid var(--ln); }
.sec:first-child { padding-top: 0; margin-top: 0; border-top: 0; }
.sec-hd { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; margin-bottom: 14px; }
.sec-hd .where { display: flex; gap: 6px; flex-wrap: wrap; justify-content: flex-end; padding-top: 30px; }

/* Callouts */
.note { display: flex; gap: 12px; padding: 13px 15px; border-radius: 12px; margin: 14px 0; font-size: 13.5px; color: var(--t2);
  background: rgba(59,130,246,.06); border: 1px solid rgba(96,165,250,.16); }
.note svg { width: 17px; height: 17px; flex: none; margin-top: 2px; color: #7dd3fc; }
.note p { margin: 0; } .note p + p { margin-top: 6px; }
.note.warn { background: rgba(245,165,36,.06); border-color: rgba(245,165,36,.2); }
.note.warn svg { color: var(--warn); }

/* Numbered steps */
.steps { list-style: none; counter-reset: s; margin: 0; padding: 0; display: grid; gap: 2px; }
.steps > li { counter-increment: s; position: relative; padding: 11px 0 11px 44px; color: var(--t2); }
.steps > li::before { content: counter(s); position: absolute; left: 0; top: 10px; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center;
  font: 600 12px/1 var(--font); color: #cffafe; background: linear-gradient(145deg, rgba(20,184,166,.2), rgba(59,130,246,.18)); border: 1px solid rgba(125,211,252,.22); }
.steps > li:not(:last-child)::after { content: ''; position: absolute; left: 12.5px; top: 40px; bottom: -8px; width: 1px; background: linear-gradient(rgba(125,211,252,.2), transparent); }
.steps > li b { color: var(--t1); }
.steps .ex { display: block; margin-top: 6px; font-size: 12.5px; color: var(--t3); }
.part { display: flex; align-items: center; gap: 10px; margin: 22px 0 6px; font-size: 12px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--t3); }
.part::after { content: ''; flex: 1; height: 1px; background: var(--ln); }

/* Copy chip */
.cp { display: inline-flex; align-items: center; gap: 6px; padding: 2px 4px 2px 8px; border-radius: 7px; background: rgba(255,255,255,.06); border: 1px solid var(--ln2);
  font: 500 12.5px/1.4 var(--mono); color: #cfe8ff; white-space: nowrap; vertical-align: 1px; }
.cp button { all: unset; cursor: pointer; display: grid; place-items: center; width: 20px; height: 20px; border-radius: 5px; color: var(--t3); transition: color .15s, background-color .15s; }
.cp button:hover { color: var(--t1); background: rgba(255,255,255,.08); }
.cp button svg { width: 12px; height: 12px; }
.cp.done button { color: var(--ok); }

/* Comparison table */
.cmp-wrap { margin-top: 16px; border-radius: 14px; border: 1px solid var(--ln); background: var(--card); overflow-x: auto; }
.cmp { width: 100%; min-width: 640px; border-collapse: collapse; font-size: 13px; }
.cmp th, .cmp td { padding: 11px 14px; text-align: center; border-bottom: 1px solid var(--ln); }
.cmp tr:last-child td { border-bottom: 0; }
.cmp th:first-child, .cmp td:first-child { text-align: left; color: var(--t2); width: 34%; }
.cmp thead th { font-size: 12px; font-weight: 600; color: var(--t1); background: rgba(255,255,255,.02); vertical-align: bottom; }
.cmp thead th small { display: block; font-weight: 400; font-size: 11px; color: var(--t3); margin-top: 2px; }
.cmp tbody tr:hover td { background: rgba(255,255,255,.015); }
.cmp .y, .cmp .n { display: inline-grid; place-items: center; width: 22px; height: 22px; border-radius: 50%; vertical-align: middle; }
.cmp .y { color: var(--ok); background: rgba(48,209,88,.1); }
.cmp .n { color: var(--t3); background: rgba(255,255,255,.04); }
.cmp .y svg, .cmp .n svg { width: 12px; height: 12px; }
.cmp .t { font-size: 11.5px; color: #fcd9a4; }
.cmp .hl { background: rgba(245,165,36,.035); }

/* Two-column fact cards */
.duo { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 14px; }
.card { padding: 16px; border-radius: 14px; background: var(--card); border: 1px solid var(--ln); }
.card h4 { display: flex; align-items: center; gap: 8px; margin: 0 0 8px; font-size: 13.5px; font-weight: 600; }
.card h4 svg { width: 16px; height: 16px; color: #7dd3fc; }
.card ul { margin: 0; padding: 0; list-style: none; display: grid; gap: 6px; font-size: 13px; color: var(--t2); }
.card li { position: relative; padding-left: 16px; }
.card li::before { content: ''; position: absolute; left: 2px; top: .62em; width: 5px; height: 5px; border-radius: 50%; background: var(--fx1); opacity: .8; }

/* FAQ */
.faq { display: grid; gap: 8px; margin-top: 14px; }
.faq details { border-radius: 12px; background: var(--card); border: 1px solid var(--ln); transition: border-color .2s; }
.faq details[open] { border-color: var(--ln2); }
.faq summary { list-style: none; cursor: pointer; display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 14px 16px; font-size: 13.5px; font-weight: 550; }
.faq summary::-webkit-details-marker { display: none; }
.faq summary svg { width: 14px; height: 14px; flex: none; color: var(--t3); transition: transform .2s; }
.faq details[open] summary svg { transform: rotate(45deg); }
.faq .a { padding: 0 16px 14px; font-size: 13.5px; color: var(--t2); }
.faq .a p:last-child { margin: 0; }

/* Closing strip */
.cta { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 20px; border-radius: 16px; margin-top: 40px;
  background: linear-gradient(135deg, rgba(20,184,166,.08), rgba(59,130,246,.07)); border: 1px solid rgba(125,211,252,.16); }
.cta b { display: block; font-size: 15px; }
.cta span { font-size: 13px; color: var(--t2); }
.cta .btns { display: flex; gap: 8px; flex-wrap: wrap; }

/* Footer (as index.php) */
footer { position: relative; padding: 26px 0 28px; }
footer::before { content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: min(var(--w), 100% - 40px); height: 1px;
  background: linear-gradient(90deg, transparent, var(--ln2), transparent); }
.f-top { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px; }
.f-links { display: flex; flex-wrap: wrap; gap: 2px; margin-left: -10px; }
.f-links a { padding: 6px 10px; border-radius: 8px; font-size: 12.5px; color: var(--t2); transition: color .15s, background-color .15s; }
.f-links a:hover { color: var(--t1); background: rgba(255,255,255,.04); }
.f-bot { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 6px 20px; margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--ln);
  font-size: 11.5px; color: var(--t3); }

@media (max-width: 980px) {
  .picks { grid-template-columns: 1fr 1fr; }
  .docs { grid-template-columns: minmax(0, 1fr); gap: 0; }
  .toc { display: none; }
  .links { display: none; }
  .nav .btn-s { margin-left: auto; }
}
@media (max-width: 640px) {
  .wrap { width: calc(100% - 32px); }
  .nav .wrap { height: 48px; padding: 0 6px 0 16px; }
  .brand .tag { display: none; }
  .top { padding-top: calc(var(--navh) + 28px); }
  .picks, .duo { grid-template-columns: 1fr; }
  .picks { gap: 8px; }
  .pick { display: grid; grid-template-columns: 32px 1fr; column-gap: 12px; row-gap: 2px; padding: 14px; }
  .pick .ic { grid-row: 1 / span 3; margin: 0; }
  .pick .where { grid-column: 2; padding-top: 6px; }
  .sec-hd { flex-direction: column; gap: 10px; }
  /* Comparison: each row becomes a small card with labelled cells. */
  .cmp-wrap { background: none; border: 0; overflow: visible; }
  .cmp, .cmp tbody, .cmp tr, .cmp td { display: block; min-width: 0; }
  .cmp thead { display: none; }
  .cmp tbody { display: grid; gap: 8px; }
  .cmp tr { display: grid; grid-template-columns: 1fr 1fr; border-radius: 12px; background: var(--card); border: 1px solid var(--ln); overflow: hidden; }
  .cmp td { border: 0; padding: 9px 12px; text-align: left; display: flex; align-items: center; justify-content: space-between; gap: 8px; font-size: 12px; }
  .cmp td:first-child { grid-column: 1 / -1; width: auto; color: var(--t1); font-weight: 600; font-size: 13px; padding: 11px 12px 6px; }
  .cmp td[data-l]::before { content: attr(data-l); color: var(--t3); }
  .cmp .t { text-align: right; line-height: 1.35; }
  .cmp td[data-l] { border-top: 1px solid var(--ln); }
  .cmp td[data-l]:nth-child(odd) { border-left: 1px solid var(--ln); }
  .cmp .hl { background: none; }
  .cmp tbody tr:hover td { background: none; }
  .sec-hd .where { justify-content: flex-start; padding-top: 0; }
  .steps > li { padding-left: 40px; }
  .cta { flex-direction: column; align-items: flex-start; }
  .f-top, .f-bot { justify-content: center; text-align: center; }
  .f-links { margin-left: 0; justify-content: center; }
}
</style>
</head>
<body>
<div class="fx" aria-hidden="true"><i></i><i></i></div>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-tg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.9 4.4l-3.1 14.7c-.2 1-.9 1.3-1.7.8l-4.8-3.5-2.3 2.2c-.3.3-.5.5-1 .5l.3-4.9 8.9-8c.4-.3-.1-.5-.6-.2l-11 6.9-4.7-1.5c-1-.3-1-1 .2-1.5L20.6 3c.8-.3 1.6.2 1.3 1.4z"/></symbol>
  <symbol id="i-dc" viewBox="0 0 24 24" fill="currentColor"><path d="M19.3 5.3A16.5 16.5 0 0 0 15.2 4l-.5 1a15.3 15.3 0 0 0-5.4 0L8.8 4a16.4 16.4 0 0 0-4.1 1.3C2.1 9.2 1.4 13 1.7 16.7a16.6 16.6 0 0 0 5 2.5l1.1-1.7a10.8 10.8 0 0 1-1.7-.8l.4-.3a11.8 11.8 0 0 0 11 0l.4.3c-.5.3-1.1.6-1.7.8l1.1 1.7a16.5 16.5 0 0 0 5-2.5c.4-4.3-.7-8.1-3-11.4zM8.7 14.5c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2zm6.6 0c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2z"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></symbol>
  <symbol id="i-link" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/></symbol>
  <symbol id="i-spark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-monitor" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="4" width="19" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></symbol>
  <symbol id="i-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></symbol>
  <symbol id="i-info" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01"/></symbol>
  <symbol id="i-warn" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l9.5 17h-19L12 3z"/><path d="M12 10v4M12 17h.01"/></symbol>
  <symbol id="i-yes" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>
  <symbol id="i-no" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 12h12"/></symbol>
  <symbol id="i-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></symbol>
  <symbol id="i-copy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="12" height="12" rx="2.5"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></symbol>
  <symbol id="i-ok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>
  <symbol id="i-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
  <symbol id="i-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v11M7 11l5 5 5-5M4 20h16"/></symbol>
</svg>

<header class="nav">
  <div class="wrap">
    <a href="index.php" class="brand" aria-label="booqi home"><span class="word">booqi</span><span class="tag">Help</span></a>
    <nav class="links" aria-label="Guides">
      <a href="#compare">Compare</a>
      <a href="#telegram-bot">Telegram</a>
      <a href="#discord">Discord</a>
      <a href="#contact-page">Contact page</a>
      <a href="#faq">FAQ</a>
    </nav>
    <a class="btn btn-g btn-s" href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
  </div>
</header>

<main>
  <section class="top">
    <div class="wrap">
      <span class="eyebrow">Help centre</span>
      <h1>Setup <em>guide.</em></h1>
      <p class="sub">Choose how customers reach you, then follow the steps. Most setups take under ten minutes.</p>

      <div class="picks">
        <a class="pick" href="#telegram-bot">
          <span class="ic"><svg><use href="#i-tg"/></svg></span>
          <b>Telegram bot</b>
          <span>A bot created with @BotFather. The quickest way to start.</span>
          <span class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></span>
        </a>
        <a class="pick" href="#telegram-account">
          <span class="ic"><svg><use href="#i-user"/></svg></span>
          <b>Telegram account</b>
          <span>Your own Telegram account, with full control.</span>
          <span class="where"><span class="badge desk"><i></i>Desktop app</span></span>
        </a>
        <a class="pick" href="#discord">
          <span class="ic"><svg><use href="#i-dc"/></svg></span>
          <b>Discord bot</b>
          <span>A bot from the Discord Developer Portal.</span>
          <span class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></span>
        </a>
        <a class="pick" href="#contact-page">
          <span class="ic"><svg><use href="#i-link"/></svg></span>
          <b>Contact page</b>
          <span>Your own chat link. No Telegram or Discord needed.</span>
          <span class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></span>
        </a>
      </div>
    </div>
  </section>

  <div class="wrap docs">
    <nav class="toc" aria-label="On this page">
      <span class="lbl">On this page</span>
      <a href="#compare">Browser or desktop</a>
      <a href="#telegram-bot">Telegram bot</a>
      <a href="#telegram-account">Telegram account</a>
      <a href="#discord">Discord bot</a>
      <a href="#contact-page">Contact page</a>
      <a href="#ai">Your own AI</a>
      <a href="#faq">FAQ</a>
    </nav>

    <div class="content">

      <!-- ── COMPARE ── -->
      <section class="sec" id="compare">
        <span class="eyebrow">Overview</span>
        <h2>Browser or <em>desktop app?</em></h2>
        <p class="sub">The website runs Telegram bots, Discord bots and your contact page on our servers, so they keep replying when your browser is closed. Signing in with your own Telegram account needs the desktop app, because that connection runs on your computer.</p>

        <div class="cmp-wrap">
          <table class="cmp">
            <thead>
              <tr>
                <th scope="col">What you get</th>
                <th scope="col">Telegram bot<small>@BotFather</small></th>
                <th scope="col" class="hl">Telegram account<small>Desktop app</small></th>
                <th scope="col">Discord bot<small>Developer Portal</small></th>
                <th scope="col">Contact page<small>Your link</small></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($CMP as [$what, $cells]): ?>
              <tr><td><?= $what ?></td><?php foreach ($cells as $i => $c): ?><td data-l="<?= $COLS[$i] ?>"<?= $i === 1 ? ' class="hl"' : '' ?>><?= $c ?></td><?php endforeach; ?></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="duo">
          <div class="card">
            <h4><svg><use href="#i-globe"/></svg>In the browser</h4>
            <ul>
              <li>Telegram bots, Discord bots and your contact page</li>
              <li>Runs on our servers, around the clock</li>
              <li>Nothing to install</li>
            </ul>
          </div>
          <div class="card">
            <h4><svg><use href="#i-monitor"/></svg>With the desktop app</h4>
            <ul>
              <li>Everything the browser does, plus your own Telegram account</li>
              <li>Typing indicators, read receipts and your own name on replies</li>
              <li>See when Discord customers are typing</li>
            </ul>
          </div>
        </div>
        <?php if ($DESKTOP_URL !== ''): ?>
        <p style="margin-top:14px"><a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Download the desktop app</a></p>
        <?php endif; ?>
      </section>

      <!-- ── TELEGRAM BOT ── -->
      <section class="sec" id="telegram-bot">
        <div class="sec-hd">
          <div>
            <span class="eyebrow">Telegram</span>
            <h2>Telegram bot <em>with @BotFather.</em></h2>
            <p class="sub">Customers message your bot and your agent replies. About five minutes.</p>
          </div>
          <div class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></div>
        </div>

        <div class="part">Create the bot</div>
        <ol class="steps">
          <li>Open Telegram and search for <b>@BotFather</b>. Pick the one with the blue verified tick, then tap <b>Start</b>.</li>
          <li>Send <span class="cp">/newbot<button type="button" aria-label="Copy"><svg><use href="#i-copy"/></svg></button></span></li>
          <li>Send a <b>display name</b> for your bot. This is what customers see.<span class="ex">Example: My Store</span></li>
          <li>Send a <b>username</b>. It must be unique and end in <code>bot</code>.<span class="ex">Example: mystore_bot</span></li>
          <li>BotFather replies with your <b>token</b>, which looks like <code>1234567890:ABCdef…</code>. Copy all of it.</li>
        </ol>

        <div class="part">Connect it to booqi</div>
        <ol class="steps">
          <li>In booqi, open <span class="path">Settings <i>›</i> Connections <i>›</i> Telegram</span></li>
          <li>Click <b>Add Telegram account</b> and choose <b>Bot</b>.</li>
          <li>Paste the token and click <b>Save &amp; connect</b>. You'll see <b>Running on the server</b> in the browser, or <b>Connected</b> in the desktop app.</li>
          <li>Test it: open <code>t.me/your_bot_username</code> from another account and send a message.</li>
        </ol>

        <div class="note warn"><svg><use href="#i-warn"/></svg><div><p><b>Keep your token private.</b> Anyone with it can control your bot. If it leaks, send <span class="cp">/revoke<button type="button" aria-label="Copy"><svg><use href="#i-copy"/></svg></button></span> to BotFather and paste the new token into booqi.</p></div></div>

        <h3>Optional finishing touches</h3>
        <p class="muted">Send these to BotFather to make your bot look complete:</p>
        <ol class="steps">
          <li><span class="cp">/setuserpic<button type="button" aria-label="Copy"><svg><use href="#i-copy"/></svg></button></span> sets the bot's profile photo.</li>
          <li><span class="cp">/setdescription<button type="button" aria-label="Copy"><svg><use href="#i-copy"/></svg></button></span> sets the text people see before they press Start.</li>
          <li><span class="cp">/setabouttext<button type="button" aria-label="Copy"><svg><use href="#i-copy"/></svg></button></span> sets the short bio on the bot's profile.</li>
        </ol>
      </section>

      <!-- ── TELEGRAM ACCOUNT ── -->
      <section class="sec" id="telegram-account">
        <div class="sec-hd">
          <div>
            <span class="eyebrow">Telegram</span>
            <h2>Your own <em>Telegram account.</em></h2>
            <p class="sub">Your agent replies as you, from your real account. This gives you full control: typing indicators both ways, read receipts, and messaging customers first.</p>
          </div>
          <div class="where"><span class="badge desk"><i></i>Desktop app</span></div>
        </div>

        <div class="note"><svg><use href="#i-info"/></svg><div>
          <p><b>This needs the booqi desktop app.</b> Your account signs in on your own computer, not on our servers, so replies only go out while the app is open. For replies around the clock with nothing running, use a Telegram bot as well.</p>
        </div></div>

        <div class="part">Part 1 · Get your API ID and hash</div>
        <ol class="steps">
          <li>In a web browser, go to <a class="ln" href="https://my.telegram.org" target="_blank" rel="noopener">my.telegram.org</a>.</li>
          <li>Enter your phone number in international format and click <b>Next</b>.<span class="ex">Example: +44 7700 900123</span></li>
          <li>Telegram sends a code <b>to your Telegram app</b>, not by SMS. Enter it and sign in.</li>
          <li>Click <b>API development tools</b>.</li>
          <li>Fill in the form. <b>App title</b>: anything, e.g. <code>booqi</code>. <b>Short name</b>: 5–32 letters or numbers. <b>Platform</b>: Desktop. The other fields can stay empty. Click <b>Create application</b>.</li>
          <li>Copy your <b>App api_id</b> (a number) and <b>App api_hash</b> (a long code).</li>
        </ol>

        <div class="part">Part 2 · Sign in from the desktop app</div>
        <ol class="steps">
          <li>Open the booqi desktop app and go to <span class="path">Settings <i>›</i> Connections <i>›</i> Telegram</span></li>
          <li>Click <b>Add Telegram account</b> and choose <b>My account</b>.</li>
          <li>Enter your <b>API ID</b>, <b>API hash</b> and <b>phone number</b>, then click <b>Save &amp; sign in</b>.</li>
          <li>Enter the login code Telegram sends to your Telegram app.</li>
          <li>If you use two-step verification, enter your Telegram <b>cloud password</b> when asked.</li>
        </ol>

        <div class="note warn"><svg><use href="#i-warn"/></svg><div>
          <p><b>Treat your API hash like a password</b> and never share it. Your account shows as online while the app is running.</p>
          <p>Telegram may restrict accounts that send large numbers of unsolicited messages. Use it for conversations with your own customers.</p>
        </div></div>

        <h3>What you get over a bot</h3>
        <div class="duo" style="margin-top:0">
          <div class="card"><ul>
            <li>Replies come from your own name and photo</li>
            <li>See when customers are typing</li>
            <li>Read receipts, so customers see “seen”</li>
          </ul></div>
          <div class="card"><ul>
            <li>Message customers first, by username</li>
            <li>Block users on Telegram itself</li>
            <li>Missed messages are picked up when the app reopens</li>
          </ul></div>
        </div>
      </section>

      <!-- ── DISCORD ── -->
      <section class="sec" id="discord">
        <div class="sec-hd">
          <div>
            <span class="eyebrow">Discord</span>
            <h2>Discord <em>bot.</em></h2>
            <p class="sub">Customers message your bot directly and your agent replies. About ten minutes.</p>
          </div>
          <div class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></div>
        </div>

        <div class="part">Create the bot</div>
        <ol class="steps">
          <li>Go to the <a class="ln" href="https://discord.com/developers/applications" target="_blank" rel="noopener">Discord Developer Portal</a> and sign in.</li>
          <li>Click <b>New Application</b>, give it a name and click <b>Create</b>.</li>
          <li>Open the <b>Bot</b> tab. Here you can also set the bot's name and photo.</li>
          <li>Click <b>Reset Token</b>, confirm, and copy the token. Discord only shows it once.</li>
          <li>On the same page, under <b>Privileged Gateway Intents</b>, turn on <b>Message Content Intent</b> and <b>Server Members Intent</b>. Click <b>Save Changes</b>.</li>
        </ol>

        <div class="part">Add it to your server</div>
        <ol class="steps">
          <li>Open <span class="path">OAuth2 <i>›</i> URL Generator</span></li>
          <li>Under <b>Scopes</b>, tick <b>bot</b>.</li>
          <li>Under <b>Bot Permissions</b>, tick <b>View Channels</b>, <b>Send Messages</b>, <b>Read Message History</b> and <b>Attach Files</b>.</li>
          <li>Copy the generated URL, open it, choose your server and click <b>Authorize</b>.</li>
        </ol>

        <div class="part">Connect it to booqi</div>
        <ol class="steps">
          <li>In booqi, open <span class="path">Settings <i>›</i> Connections <i>›</i> Discord</span></li>
          <li>Click <b>Add Discord bot</b>, paste the token and click <b>Save &amp; connect</b>.</li>
          <li>Test it: in your server, right-click the bot, choose <b>Message</b> and say hello.</li>
        </ol>

        <div class="note"><svg><use href="#i-info"/></svg><div>
          <p>Discord only lets people message a bot they share a server with, and bots can't message people first. Share your server invite so customers can reach it.</p>
        </div></div>
      </section>

      <!-- ── CONTACT PAGE ── -->
      <section class="sec" id="contact-page">
        <div class="sec-hd">
          <div>
            <span class="eyebrow">No platform needed</span>
            <h2>Your <em>contact page.</em></h2>
            <p class="sub">A personal chat link built into booqi. Customers chat with you in their browser, with end-to-end encryption. No bot or token required.</p>
          </div>
          <div class="where"><span class="badge"><i></i>Browser</span><span class="badge"><i></i>Desktop</span></div>
        </div>
        <ol class="steps">
          <li>In booqi, click the <b>share</b> icon next to the settings gear (<b>Share your profile</b>).</li>
          <li>Add your <b>name</b> and a <b>photo</b> so customers know it's you.</li>
          <li>Copy your link and share it anywhere: your bio, website, signature or social profiles.</li>
          <li>Customers open the link, sign in or create an account, and start chatting. Your agent replies automatically.</li>
        </ol>
      </section>

      <!-- ── AI ── -->
      <section class="sec" id="ai">
        <div class="sec-hd">
          <div>
            <span class="eyebrow">Optional</span>
            <h2>Use your <em>own AI.</em></h2>
            <p class="sub">The built-in AI works straight away. To use your own Gemini, OpenAI or Claude account instead, add an API key.</p>
          </div>
        </div>
        <ol class="steps">
          <li>Create a key with your provider:
            <span class="ex"><a class="ln" href="https://aistudio.google.com/app/apikey" target="_blank" rel="noopener">Gemini: Google AI Studio</a> &nbsp;·&nbsp;
            <a class="ln" href="https://platform.openai.com/api-keys" target="_blank" rel="noopener">OpenAI: API keys</a> &nbsp;·&nbsp;
            <a class="ln" href="https://console.anthropic.com/settings/keys" target="_blank" rel="noopener">Claude: Anthropic Console</a></span></li>
          <li>In booqi, open <span class="path">Settings <i>›</i> Connections</span> and find the AI section.</li>
          <li>Choose your provider, paste the key and save. Usage is billed by your provider.</li>
        </ol>
      </section>

      <!-- ── FAQ ── -->
      <section class="sec" id="faq">
        <span class="eyebrow">FAQ</span>
        <h2>Common <em>questions.</em></h2>
        <div class="faq">
          <details>
            <summary>Do I need the desktop app?<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Only to use your own Telegram account. Telegram bots, Discord bots and your contact page all work from the website.</p></div>
          </details>
          <details>
            <summary>Will my agent reply while my computer is off?<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Yes for Telegram bots, Discord bots and your contact page, since they run on our servers. A personal Telegram account only replies while the desktop app is open.</p></div>
          </details>
          <details>
            <summary>Why can't I see when customers are typing?<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Telegram never tells bots when someone is typing. To see it on Telegram, sign in with your own account in the desktop app. For Discord bots, typing shows in the desktop app. Your contact page always shows it.</p></div>
          </details>
          <details>
            <summary>Can I use a bot and my own account together?<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Yes. You can save several accounts under <span class="path">Settings <i>›</i> Connections</span> and switch between them.</p></div>
          </details>
          <details>
            <summary>My Discord bot is online but doesn't reply.<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Check that <b>Message Content Intent</b> and <b>Server Members Intent</b> are on in the Developer Portal's Bot tab, then reconnect. Also make sure the customer shares a server with the bot.</p></div>
          </details>
          <details>
            <summary>My Telegram bot token isn't accepted.<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Copy the whole token, including the numbers before the colon, with no spaces. If you've revoked it, use the new one from BotFather.</p></div>
          </details>
          <details>
            <summary>The Telegram login code doesn't arrive.<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>It's sent inside the Telegram app, from the official “Telegram” chat, not by SMS. Check the app on your phone or computer.</p></div>
          </details>
          <details>
            <summary>my.telegram.org shows an error.<svg><use href="#i-plus"/></svg></summary>
            <div class="a"><p>Turn off any VPN or ad blocker, try another browser, and make sure the phone number includes your country code. If it still fails, wait a few hours and try again.</p></div>
          </details>
        </div>

        <div class="cta">
          <div><b>Ready to connect?</b><span>Open booqi and go to Settings › Connections.</span></div>
          <div class="btns">
            <a class="btn btn-p" href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Get started' ?> <svg><use href="#i-arrow"/></svg></a>
            <?php if ($DESKTOP_URL !== ''): ?><a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Desktop app</a><?php endif; ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>

<footer>
  <div class="wrap">
    <div class="f-top">
      <nav class="f-links" aria-label="Footer">
        <a href="index.php">Home</a>
        <a href="index.php#features">Features</a>
        <a href="#compare">Compare</a>
        <a href="#faq">FAQ</a>
        <a href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
      </nav>
    </div>
    <div class="f-bot">
      <span>© <?= date('Y') ?> booqi. All rights reserved.</span>
      <span>Crypto payments are processed by CryptAPI (1% per transaction).</span>
    </div>
  </div>
</footer>

<script>
// Copy chips: copy the command beside the button.
document.querySelectorAll('.cp button').forEach(function (b) {
  b.addEventListener('click', function () {
    var chip = b.parentElement, txt = chip.textContent.trim();
    var done = function () { chip.classList.add('done'); b.firstElementChild.firstElementChild.setAttribute('href', '#i-ok');
      setTimeout(function () { chip.classList.remove('done'); b.firstElementChild.firstElementChild.setAttribute('href', '#i-copy'); }, 1400); };
    if (navigator.clipboard) navigator.clipboard.writeText(txt).then(done, function () {});
  });
});
// Contents: light up the section in view.
(function () {
  var links = {};
  document.querySelectorAll('.toc a').forEach(function (a) { links[a.getAttribute('href').slice(1)] = a; });
  if (!('IntersectionObserver' in window)) return;
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) {
      if (!e.isIntersecting) return;
      Object.keys(links).forEach(function (k) { links[k].removeAttribute('aria-current'); });
      if (links[e.target.id]) links[e.target.id].setAttribute('aria-current', 'true');
    });
  }, { rootMargin: '-30% 0px -60% 0px' });
  document.querySelectorAll('.sec').forEach(function (s) { io.observe(s); });
})();
</script>
</body>
</html>
