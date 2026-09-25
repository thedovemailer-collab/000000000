<?php
// ── BotCommand — landing page ─────────────────────────────────
// Where the buttons go. APP_URL is the web app (BotCommand.html beside
// this file); DESKTOP_URL is the desktop app download — leave it '' to
// hide that button until you have a download link.
$APP_URL     = 'BotCommand.html';
$DESKTOP_URL = '';
// Signed in already (the app's session cookie): "Open app" instead of "Start".
$signedIn = isset($_COOKIE['bc_sess']);
$cta = $signedIn ? 'Open app' : 'Start free';
$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>BotCommand — AI agents that sell for you</title>
<meta name="description" content="AI sales agents for Telegram, Discord and private chats. They answer, invoice in crypto and deliver your product — even while you're away.">
<meta name="theme-color" content="#020b10">
<meta property="og:title" content="BotCommand — AI agents that sell for you">
<meta property="og:description" content="Answer, invoice and deliver on Telegram, Discord and private chats. Around the clock.">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' x2='1'%3E%3Cstop stop-color='%2314b8a6'/%3E%3Cstop offset='1' stop-color='%233b82f6'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='32' height='32' rx='9' fill='%23061831'/%3E%3Cpath d='M9 11h14a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3h-7l-5 4v-4H9a3 3 0 0 1-3-3v-5a3 3 0 0 1 3-3z' fill='url(%23g)'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
<style>
:root {
  --fx1: #14b8a6; --fx2: #06b6d4; --fx3: #3b82f6; --fx4: #2dd4bf;
  --b1: #020b10; --b2: #042029; --b3: #061831;
  --t1: #eef0f6; --t2: #9aa3b8; --t3: #5f6a82;
  --ln: rgba(255,255,255,.07); --ln2: rgba(255,255,255,.11);
  --glass: rgba(14,20,32,.62);
  --ok: #30d158;
  --r: 16px;
  --font: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
  --w: 1120px;
}
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; background: var(--b1); }
body {
  margin: 0; min-height: 100vh; color: var(--t1); font: 400 15px/1.6 var(--font);
  background: transparent;
  -webkit-font-smoothing: antialiased; overflow-x: hidden;
}
a { color: inherit; text-decoration: none; }
svg { display: block; }
.wrap { width: min(var(--w), 100% - 40px); margin-inline: auto; }

/* ── Ambient light (the app's background, calmer) ── */
.fx { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden;
  background: linear-gradient(125deg, var(--b1) 0%, var(--b2) 38%, var(--b3) 70%, var(--b1) 100%); }
.fx i { position: absolute; border-radius: 50%; filter: blur(90px); opacity: .5; will-change: transform; }
.fx i:nth-child(1) { width: 46vw; height: 46vw; left: -12vw; top: -14vw; background: color-mix(in srgb, var(--fx1) 26%, transparent); animation: drift 26s ease-in-out infinite alternate; }
.fx i:nth-child(2) { width: 40vw; height: 40vw; right: -10vw; top: 10vh; background: color-mix(in srgb, var(--fx3) 24%, transparent); animation: drift 32s ease-in-out infinite alternate-reverse; }
.fx i:nth-child(3) { width: 36vw; height: 36vw; left: 30vw; bottom: -18vw; background: color-mix(in srgb, var(--fx2) 16%, transparent); animation: drift 38s ease-in-out infinite alternate; }
.fx::after { content: ''; position: absolute; inset: 0;
  background: radial-gradient(ellipse 110% 90% at 50% 40%, transparent 35%, rgba(0,0,0,.5) 100%); }
@keyframes drift { to { transform: translate(6vw, 4vh) scale(1.08); } }

/* ── Wordmark (the app's: Orbitron, a sliding gradient) ── */
.word {
  font: 700 17px/1 'Orbitron', var(--font); letter-spacing: .08em; text-transform: uppercase;
  background: linear-gradient(90deg, var(--fx1) 0%, var(--fx2) 28%, var(--fx3) 56%, #dfe6f0 72%, var(--fx1) 100%);
  background-size: 260% 100%; -webkit-background-clip: text; background-clip: text;
  -webkit-text-fill-color: transparent; color: transparent;
  animation: flow 9s ease-in-out infinite alternate;
  filter: drop-shadow(0 0 14px color-mix(in srgb, var(--fx1) 16%, transparent));
}
@keyframes flow { from { background-position: 0% 50%; } to { background-position: 100% 50%; } }

/* ── Nav ── */
.nav { position: sticky; top: 0; z-index: 20; backdrop-filter: blur(18px) saturate(160%); -webkit-backdrop-filter: blur(18px) saturate(160%);
  background: linear-gradient(180deg, rgba(2,11,16,.72), rgba(2,11,16,.35)); border-bottom: 1px solid var(--ln); }
.nav .wrap { display: flex; align-items: center; gap: 28px; height: 62px; }
.nav nav { display: flex; gap: 24px; margin-left: auto; font-size: 13px; color: var(--t2); }
.nav nav a { transition: color .15s; }
.nav nav a:hover { color: var(--t1); }

/* ── Buttons ── */
.btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 18px;
  border-radius: 11px; font: 600 13.5px/1 var(--font); letter-spacing: -.005em; cursor: pointer; white-space: nowrap;
  transition: transform .15s ease, background-color .15s, border-color .15s, box-shadow .2s; }
.btn:active { transform: translateY(1px); }
.btn-p { color: #04151a; background: linear-gradient(135deg, #5eead4, #38bdf8 55%, #818cf8);
  box-shadow: 0 8px 26px -10px color-mix(in srgb, var(--fx2) 70%, transparent), inset 0 1px 0 rgba(255,255,255,.35); }
.btn-p:hover { box-shadow: 0 12px 34px -10px color-mix(in srgb, var(--fx2) 85%, transparent), inset 0 1px 0 rgba(255,255,255,.4); }
.btn-g { color: var(--t1); background: rgba(255,255,255,.045); border: 1px solid var(--ln2); }
.btn-g:hover { background: rgba(255,255,255,.08); }
.btn-s { height: 34px; padding: 0 14px; font-size: 12.5px; border-radius: 10px; }
.btn svg { width: 15px; height: 15px; }

/* ── Hero ── */
.hero { padding: clamp(56px, 9vw, 110px) 0 clamp(48px, 7vw, 90px); }
.hero .wrap { display: grid; grid-template-columns: 1.05fr .95fr; gap: clamp(32px, 5vw, 64px); align-items: center; }
.pill { display: inline-flex; align-items: center; gap: 8px; height: 28px; padding: 0 12px 0 10px; border-radius: 99px;
  font-size: 12px; color: var(--t2); background: rgba(255,255,255,.04); border: 1px solid var(--ln2); }
.pill b { width: 6px; height: 6px; border-radius: 50%; background: var(--ok); box-shadow: 0 0 0 3px rgba(48,209,88,.15); animation: pulse 2.4s ease-in-out infinite; }
@keyframes pulse { 50% { box-shadow: 0 0 0 6px rgba(48,209,88,0); } }
h1 { margin: 20px 0 16px; font-size: clamp(36px, 5.6vw, 60px); line-height: 1.04; letter-spacing: -.035em; font-weight: 650; }
h1 em { font-style: normal; background: linear-gradient(90deg, #5eead4, #7dd3fc 50%, #a5b4fc); -webkit-background-clip: text; background-clip: text; color: transparent; }
.lead { max-width: 30em; margin: 0; font-size: clamp(15px, 1.5vw, 17px); color: var(--t2); }
.cta { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 30px; }
.meta { display: flex; flex-wrap: wrap; gap: 18px; margin-top: 26px; font-size: 12.5px; color: var(--t3); }
.meta span { display: inline-flex; align-items: center; gap: 7px; }
.meta svg { width: 14px; height: 14px; color: var(--fx1); }

/* The demo chat: a sale from question to delivered key, on a loop. */
.demo { position: relative; border-radius: 20px; padding: 1px;
  background: linear-gradient(160deg, rgba(255,255,255,.16), rgba(255,255,255,.03) 40%, color-mix(in srgb, var(--fx3) 30%, transparent)); }
.demo-in { border-radius: 19px; background: rgba(9,14,24,.82); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); overflow: hidden;
  box-shadow: 0 40px 90px -40px rgba(0,0,0,.9); }
.demo-hd { display: flex; align-items: center; gap: 11px; padding: 14px 16px; border-bottom: 1px solid var(--ln); }
.ava { width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; font-size: 12px; font-weight: 600;
  color: #cfe9ff; background: linear-gradient(145deg, #1d3b5a, #16263d); box-shadow: inset 0 0 0 1px rgba(255,255,255,.1); }
.demo-hd .n { font-size: 13.5px; font-weight: 600; }
.demo-hd .s { font-size: 11px; color: var(--t3); display: flex; align-items: center; gap: 6px; }
.demo-hd .s svg { width: 11px; height: 11px; color: #37aee2; }
.demo-hd .ag { margin-left: auto; font-size: 10.5px; color: var(--t2); padding: 4px 9px; border-radius: 99px; background: rgba(255,255,255,.05); border: 1px solid var(--ln); display: flex; gap: 6px; align-items: center; }
.demo-hd .ag i { width: 6px; height: 6px; border-radius: 50%; background: var(--ok); }
.thread { height: 344px; padding: 16px; display: flex; flex-direction: column; justify-content: flex-end; gap: 7px; overflow: hidden; }
.b { display: none; max-width: 78%; padding: 8px 12px; border-radius: 15px; font-size: 13px; line-height: 1.45; flex: none; }
.b.on { display: block; animation: pop .45s cubic-bezier(.16,1,.3,1) both; }
@keyframes pop { from { opacity: 0; transform: translateY(8px) scale(.97); } to { opacity: 1; transform: none; } }
.b.in  { align-self: flex-start; background: rgba(255,255,255,.07); border-bottom-left-radius: 5px; }
.b.out { align-self: flex-end; background: linear-gradient(135deg, rgba(20,184,166,.28), rgba(59,130,246,.26)); border: 1px solid rgba(125,211,252,.16); border-bottom-right-radius: 5px; }
.b small { display: block; font-size: 10px; color: rgba(210,230,255,.55); margin-bottom: 2px; letter-spacing: .01em; }
.inv { align-self: flex-end; width: 230px; max-width: 82%; padding: 12px 13px; border-radius: 14px; background: rgba(255,255,255,.05); border: 1px solid var(--ln2); font-size: 12px; }
.inv .r { display: flex; justify-content: space-between; color: var(--t2); }
.inv .r b { color: var(--t1); font-weight: 600; }
.inv code { display: block; margin-top: 8px; padding: 6px 8px; border-radius: 8px; background: rgba(0,0,0,.3); font: 11px/1.3 ui-monospace, 'JetBrains Mono', monospace; color: #9fd8ff; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.inv .st { display: flex; align-items: center; gap: 6px; margin-top: 9px; font-size: 11px; color: var(--t3); transition: color .3s; }
.inv .st i { width: 7px; height: 7px; border-radius: 50%; background: #f5a524; transition: background .3s; }
.inv.paid .st { color: #7ee2a0; } .inv.paid .st i { background: var(--ok); }
.typing { align-self: flex-end; display: none; gap: 3px; padding: 11px 13px; border-radius: 15px; background: rgba(255,255,255,.05); flex: none; }
.typing.on { display: inline-flex; animation: pop .3s ease both; }
.typing i { width: 5px; height: 5px; border-radius: 50%; background: var(--t2); animation: dot 1.1s infinite ease-in-out; }
.typing i:nth-child(2) { animation-delay: .15s; } .typing i:nth-child(3) { animation-delay: .3s; }
@keyframes dot { 0%, 60%, 100% { opacity: .3; transform: none; } 30% { opacity: 1; transform: translateY(-2px); } }
.key { font: 12px ui-monospace, 'JetBrains Mono', monospace; color: #a7f3d0; letter-spacing: .04em; }

/* ── Platforms strip ── */
.strip { border-block: 1px solid var(--ln); background: rgba(255,255,255,.015); }
.strip .wrap { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 14px 38px; padding: 20px 0; font-size: 13px; color: var(--t2); }
.strip span { display: inline-flex; align-items: center; gap: 9px; }
.strip svg { width: 18px; height: 18px; opacity: .85; }

/* ── Sections ── */
section { padding: clamp(64px, 9vw, 112px) 0 0; }
.hd { max-width: 560px; margin-bottom: 40px; }
.eyebrow { font-size: 11.5px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--fx1); }
h2 { margin: 10px 0 10px; font-size: clamp(26px, 3.4vw, 38px); line-height: 1.12; letter-spacing: -.028em; font-weight: 650; }
.hd p { margin: 0; color: var(--t2); }

/* Feature cards */
.grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
.card { position: relative; padding: 22px 20px 20px; border-radius: var(--r); background: var(--glass); border: 1px solid var(--ln);
  backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); overflow: hidden;
  transition: transform .25s cubic-bezier(.16,1,.3,1), border-color .2s, background-color .2s; }
.card::before { content: ''; position: absolute; inset: 0 0 auto; height: 1px;
  background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--fx2) 45%, transparent), transparent); opacity: 0; transition: opacity .25s; }
.card:hover { transform: translateY(-3px); border-color: var(--ln2); background: rgba(16,24,38,.72); }
.card:hover::before { opacity: 1; }
.ic { width: 38px; height: 38px; border-radius: 11px; display: grid; place-items: center; margin-bottom: 16px; color: #aee9f5;
  background: linear-gradient(145deg, color-mix(in srgb, var(--fx1) 22%, transparent), color-mix(in srgb, var(--fx3) 16%, transparent));
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.1); }
.ic svg { width: 18px; height: 18px; }
.card h3 { margin: 0 0 5px; font-size: 14.5px; font-weight: 600; letter-spacing: -.01em; }
.card p { margin: 0; font-size: 13px; line-height: 1.5; color: var(--t2); }
.card.wide { grid-column: span 2; }

/* Split rows: payments / privacy */
.split { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(28px, 5vw, 64px); align-items: center; }
.list { list-style: none; margin: 22px 0 0; padding: 0; display: grid; gap: 12px; }
.list li { display: flex; gap: 12px; align-items: flex-start; font-size: 14px; color: var(--t2); }
.list li b { color: var(--t1); font-weight: 600; }
.list svg { flex: none; width: 18px; height: 18px; margin-top: 2px; color: var(--fx1); }
.flow { display: grid; gap: 10px; }
.step { display: flex; align-items: center; gap: 14px; padding: 14px 16px; border-radius: 14px; background: var(--glass); border: 1px solid var(--ln); }
.step .ic { margin: 0; flex: none; }
.step b { display: block; font-size: 13.5px; font-weight: 600; }
.step span { font-size: 12.5px; color: var(--t3); }
.step .ck { margin-left: auto; width: 20px; height: 20px; color: var(--ok); opacity: .9; }
.join { height: 14px; width: 1px; margin-left: 34px; background: linear-gradient(var(--ln2), transparent); }

/* How it works */
.steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; counter-reset: s; }
.steps .card { padding-top: 24px; }
.steps .card::after { counter-increment: s; content: '0' counter(s); position: absolute; top: 18px; right: 20px;
  font: 700 12px 'Orbitron', var(--font); letter-spacing: .08em; color: rgba(255,255,255,.14); }

/* AI providers */
.ai { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 22px; }
.chip { display: inline-flex; align-items: center; gap: 8px; height: 32px; padding: 0 13px; border-radius: 99px; font-size: 12.5px; color: var(--t2);
  background: rgba(255,255,255,.04); border: 1px solid var(--ln); }
.chip svg { width: 14px; height: 14px; }

/* Closing CTA */
.end { margin-top: clamp(72px, 10vw, 120px); }
.end .box { position: relative; text-align: center; padding: clamp(40px, 6vw, 64px) 24px; border-radius: 24px; overflow: hidden;
  background: radial-gradient(ellipse 70% 120% at 50% 0%, color-mix(in srgb, var(--fx2) 18%, transparent), transparent 70%), var(--glass);
  border: 1px solid var(--ln2); }
.end h2 { margin-top: 0; }
.end p { margin: 0 auto; max-width: 30em; color: var(--t2); }
.end .cta { justify-content: center; }

footer { margin-top: 72px; border-top: 1px solid var(--ln); }
footer .wrap { display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; padding: 26px 0 34px; font-size: 12.5px; color: var(--t3); }
footer .word { font-size: 13px; }
footer nav { display: flex; gap: 20px; }
footer a:hover { color: var(--t1); }

/* Reveal on scroll */
.rv { opacity: 0; transform: translateY(14px); transition: opacity .7s ease, transform .8s cubic-bezier(.16,1,.3,1); }
.rv.in { opacity: 1; transform: none; }

/* ── Responsive ── */
@media (max-width: 980px) {
  .grid { grid-template-columns: repeat(2, 1fr); }
  .hero .wrap, .split { grid-template-columns: 1fr; }
  .demo { max-width: 460px; }
}
@media (max-width: 640px) {
  .nav nav { display: none; }
  .nav .wrap { gap: 12px; }
  .nav .btn-s { margin-left: auto; }
  .steps { grid-template-columns: 1fr; }
  .grid { grid-template-columns: 1fr 1fr; gap: 10px; }
  .grid .card { padding: 16px 14px 15px; }
  .grid .card .ic { width: 34px; height: 34px; margin-bottom: 12px; }
  .grid .card h3 { font-size: 13.5px; }
  .grid .card p { font-size: 12.5px; }
  .thread { height: 316px; }
  .cta .btn { flex: 1 1 auto; }
  footer .wrap { justify-content: center; text-align: center; }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation: none !important; transition: none !important; }
  .rv { opacity: 1; transform: none; }
}
</style>
</head>
<body>
<div class="fx" aria-hidden="true"><i></i><i></i><i></i></div>

<!-- SVG icons, defined once -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-spark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/><circle cx="12" cy="12" r="3"/></symbol>
    <symbol id="i-coin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9.5 8.5h4a2 2 0 0 1 0 4h-4m0 0h4.5a2 2 0 0 1 0 4H9.5m0-8v8M11 7v1.5M11 15.5V17"/></symbol>
    <symbol id="i-box" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/></symbol>
    <symbol id="i-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></symbol>
    <symbol id="i-lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2.5"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></symbol>
    <symbol id="i-hand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="4"/><path d="M2 21v-1a7 7 0 0 1 11-5.7"/><path d="M16 17l2 2 4-4"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="i-key" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="7.5" cy="15.5" r="4.5"/><path d="M10.7 12.3L21 2M16 7l3 3M14 9l2 2"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/></symbol>
    <symbol id="i-brain" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a3 3 0 0 0-3 3 3 3 0 0 0-2 5 3 3 0 0 0 2 5 3 3 0 0 0 6 1V5a2 2 0 0 0-3-1zM15 4a3 3 0 0 1 3 3 3 3 0 0 1 2 5 3 3 0 0 1-2 5 3 3 0 0 1-6 1"/></symbol>
    <symbol id="i-phone" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2.5" width="12" height="19" rx="3"/><path d="M11 18.5h2"/></symbol>
    <symbol id="i-chart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.7 2.7L16 10"/></symbol>
    <symbol id="i-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="i-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v11M7 11l5 5 5-5M4 20h16"/></symbol>
    <symbol id="i-tg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.9 4.4l-3.1 14.7c-.2 1-.9 1.3-1.7.8l-4.8-3.5-2.3 2.2c-.3.3-.5.5-1 .5l.3-4.9 8.9-8c.4-.3-.1-.5-.6-.2l-11 6.9-4.7-1.5c-1-.3-1-1 .2-1.5L20.6 3c.8-.3 1.6.2 1.3 1.4z"/></symbol>
    <symbol id="i-dc" viewBox="0 0 24 24" fill="currentColor"><path d="M19.3 5.3A16.5 16.5 0 0 0 15.2 4l-.5 1a15.3 15.3 0 0 0-5.4 0L8.8 4a16.4 16.4 0 0 0-4.1 1.3C2.1 9.2 1.4 13 1.7 16.7a16.6 16.6 0 0 0 5 2.5l1.1-1.7a10.8 10.8 0 0 1-1.7-.8l.4-.3a11.8 11.8 0 0 0 11 0l.4.3c-.5.3-1.1.6-1.7.8l1.1 1.7a16.5 16.5 0 0 0 5-2.5c.4-4.3-.7-8.1-3-11.4zM8.7 14.5c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2zm6.6 0c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2z"/></symbol>
    <symbol id="i-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-12.2 7.5L3 21l2-5.3A8.4 8.4 0 1 1 21 11.5z"/></symbol>
    <symbol id="i-monitor" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="4" width="19" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></symbol>
    <symbol id="i-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></symbol>
    <symbol id="i-bolt" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z"/></symbol>
    <symbol id="i-filter" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5h18l-7 8v6l-4 2v-8L3 5z"/></symbol>
  </defs>
</svg>

<header class="nav">
  <div class="wrap">
    <a href="#top" class="word" aria-label="BotCommand">BotCommand</a>
    <nav aria-label="Sections">
      <a href="#features">Features</a>
      <a href="#payments">Payments</a>
      <a href="#privacy">Privacy</a>
      <a href="#how">How it works</a>
    </nav>
    <a class="btn btn-g btn-s" href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
  </div>
</header>

<main id="top">
  <!-- ── HERO ── -->
  <section class="hero" style="padding-top:0">
    <div class="wrap" style="padding-top:clamp(56px, 9vw, 110px)">
      <div>
        <span class="pill rv"><b></b> Your agents are online, even when you're not</span>
        <h1 class="rv">Your store,<br><em>answering itself.</em></h1>
        <p class="lead rv">AI agents that chat, sell and deliver on Telegram, Discord and private chats. Around the clock.</p>
        <div class="cta rv">
          <a class="btn btn-p" href="<?= $h($APP_URL) ?>"><?= $h($cta) ?> <svg><use href="#i-arrow"/></svg></a>
          <?php if ($DESKTOP_URL !== ''): ?>
          <a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Desktop app</a>
          <?php else: ?>
          <a class="btn btn-g" href="#features">See what it does</a>
          <?php endif; ?>
        </div>
        <div class="meta rv">
          <span><svg><use href="#i-globe"/></svg> Runs in your browser</span>
          <span><svg><use href="#i-monitor"/></svg> Desktop app</span>
          <span><svg><use href="#i-phone"/></svg> Phone ready</span>
        </div>
      </div>

      <div class="demo rv" aria-label="Example: an agent selling a licence key">
        <div class="demo-in">
          <div class="demo-hd">
            <div class="ava">MJ</div>
            <div>
              <div class="n">Maya J.</div>
              <div class="s"><svg><use href="#i-tg"/></svg> Telegram</div>
            </div>
            <div class="ag"><i></i> Sales agent</div>
          </div>
          <div class="thread" id="thread" aria-live="off">
            <div class="b in"  data-t="0">hey, is the pro licence still available?</div>
            <div class="b out" data-t="1"><small>Agent</small>yes! one device or two?</div>
            <div class="b in"  data-t="2">two please, can I pay in USDT?</div>
            <div class="b out" data-t="3"><small>Agent</small>of course, here you go</div>
            <div class="inv b" data-t="4" id="inv">
              <div class="r"><span>Pro · 2 devices</span><b>$49.00</b></div>
              <code>TRx9f2…c41K · 49.00 USDT</code>
              <div class="st"><i></i><span id="invst">Waiting for payment</span></div>
            </div>
            <div class="b out" data-t="5"><small>Agent</small>payment's in, thank you 🙌<br><span class="key">PRO-8F3K-Q2LM-7XWA</span></div>
            <div class="typing" id="typing"><i></i><i></i><i></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── PLATFORMS ── -->
  <div class="strip">
    <div class="wrap">
      <span><svg style="color:#37aee2"><use href="#i-tg"/></svg> Telegram bots &amp; accounts</span>
      <span><svg style="color:#7c8cff"><use href="#i-dc"/></svg> Discord</span>
      <span><svg><use href="#i-lock"/></svg> Encrypted direct chats</span>
      <span><svg><use href="#i-coin"/></svg> Crypto payments</span>
      <span><svg><use href="#i-brain"/></svg> Gemini · OpenAI · Claude</span>
    </div>
  </div>

  <!-- ── FEATURES ── -->
  <section id="features">
    <div class="wrap">
      <div class="hd rv">
        <div class="eyebrow">Features</div>
        <h2>Everything a sale needs.<br>Nothing you have to watch.</h2>
      </div>
      <div class="grid">
        <div class="card wide rv"><div class="ic"><svg><use href="#i-spark"/></svg></div>
          <h3>Agents that sound like you</h3>
          <p>Your persona, your tone, your catalogue. Human timing, typing and memory of every customer.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-coin"/></svg></div>
          <h3>Crypto checkout</h3><p>Invoices in chat, payments tracked on-chain.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-bolt"/></svg></div>
          <h3>Instant delivery</h3><p>Keys, files and setup sent the moment it's paid.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-moon"/></svg></div>
          <h3>Always on</h3><p>Replies and deliveries continue with the app closed.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-hand"/></svg></div>
          <h3>Hands over to you</h3><p>Escalates when a real person is needed.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-clock"/></svg></div>
          <h3>Follow-ups</h3><p>Checks back in when customers ask it to.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-key"/></svg></div>
          <h3>Licences &amp; catalogue</h3><p>Products, bundles, renewals and serial keys.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-filter"/></svg></div>
          <h3>Spam &amp; reply hours</h3><p>Cooldowns for spam, quiet outside your hours.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-chart"/></svg></div>
          <h3>Customers at a glance</h3><p>Profiles, purchases and earnings in one place.</p></div>
        <div class="card wide rv"><div class="ic"><svg><use href="#i-phone"/></svg></div>
          <h3>Anywhere you are</h3>
          <p>Desktop, browser and phone, with themes to make it yours. Reply by hand any time, and your agent steps aside.</p></div>
      </div>
    </div>
  </section>

  <!-- ── PAYMENTS ── -->
  <section id="payments">
    <div class="wrap split">
      <div class="rv">
        <div class="eyebrow">Payments</div>
        <h2>From “how much?” to delivered, on its own.</h2>
        <ul class="list">
          <li><svg><use href="#i-check"/></svg><span><b>Your wallets.</b> Paid straight to addresses you own.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Live pricing.</b> Converted at the current rate.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Nothing missed.</b> Late and replaced invoices still delivered.</span></li>
        </ul>
      </div>
      <div class="flow rv" aria-label="Payment flow">
        <div class="step"><div class="ic"><svg><use href="#i-chat"/></svg></div><div><b>Customer asks</b><span>Agent recommends and quotes</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-coin"/></svg></div><div><b>Invoice sent</b><span>BTC, ETH, USDT and more</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-shield"/></svg></div><div><b>Payment confirmed</b><span>Watched on-chain</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-box"/></svg></div><div><b>Order delivered</b><span>Key, files and thank-you</span></div><svg class="ck"><use href="#i-check"/></svg></div>
      </div>
    </div>
  </section>

  <!-- ── PRIVACY ── -->
  <section id="privacy">
    <div class="wrap split">
      <div class="flow rv" aria-hidden="true">
        <div class="card" style="padding:26px">
          <div class="ic"><svg><use href="#i-lock"/></svg></div>
          <h3>End-to-end encrypted</h3>
          <p>Direct chats are sealed on your device. Only you, and an agent you approve, can read them.</p>
          <div class="ai">
            <span class="chip"><svg><use href="#i-shield"/></svg> Your keys</span>
            <span class="chip"><svg><use href="#i-globe"/></svg> Shareable contact page</span>
          </div>
        </div>
      </div>
      <div class="rv">
        <div class="eyebrow">Privacy</div>
        <h2>Private where it matters.</h2>
        <p style="color:var(--t2);margin:0">Your own direct chats, your own AI keys, your own wallets. Delete or wipe any contact whenever you like.</p>
        <div class="ai">
          <span class="chip"><svg><use href="#i-brain"/></svg> Gemini</span>
          <span class="chip"><svg><use href="#i-brain"/></svg> OpenAI</span>
          <span class="chip"><svg><use href="#i-brain"/></svg> Claude</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ── HOW IT WORKS ── -->
  <section id="how">
    <div class="wrap">
      <div class="hd rv">
        <div class="eyebrow">How it works</div>
        <h2>Live in minutes.</h2>
      </div>
      <div class="steps">
        <div class="card rv"><div class="ic"><svg><use href="#i-tg"/></svg></div>
          <h3>Connect</h3><p>Add a Telegram or Discord bot, or share your direct-chat link.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-spark"/></svg></div>
          <h3>Set up your agent</h3><p>Give it a persona, your products and your wallets.</p></div>
        <div class="card rv"><div class="ic"><svg><use href="#i-moon"/></svg></div>
          <h3>Step away</h3><p>It answers, sells and delivers. You see everything.</p></div>
      </div>
    </div>
  </section>

  <!-- ── CLOSING ── -->
  <div class="wrap end">
    <div class="box rv">
      <h2>Let your agents take the night shift.</h2>
      <p>Set up takes minutes. Your first agent is waiting.</p>
      <div class="cta">
        <a class="btn btn-p" href="<?= $h($APP_URL) ?>"><?= $h($cta) ?> <svg><use href="#i-arrow"/></svg></a>
        <?php if ($DESKTOP_URL !== ''): ?>
        <a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Desktop app</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<footer>
  <div class="wrap">
    <span class="word">BotCommand</span>
    <nav aria-label="Footer">
      <a href="#features">Features</a>
      <a href="#payments">Payments</a>
      <a href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
    </nav>
    <span>© <?= date('Y') ?> BotCommand</span>
  </div>
</footer>

<script>
// Reveal on scroll.
(function () {
  var els = document.querySelectorAll('.rv');
  if (!('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('in'); }); return; }
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { rootMargin: '0px 0px -8% 0px', threshold: .08 });
  els.forEach(function (e, i) { e.style.transitionDelay = (Math.min(i % 5, 4) * 60) + 'ms'; io.observe(e); });
})();

// The demo chat: plays the sale, holds, then starts again.
(function () {
  var items = Array.prototype.slice.call(document.querySelectorAll('#thread [data-t]'));
  var typing = document.getElementById('typing'), inv = document.getElementById('inv'), st = document.getElementById('invst');
  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce) { items.forEach(function (b) { b.classList.add('on'); }); inv.classList.add('paid'); st.textContent = 'Paid · confirmed'; return; }
  var steps = [
    [0, 700], ['typing', 1300], [1, 900], [2, 1500], ['typing', 1200], [3, 500], [4, 2200],
    ['paid', 1300], ['typing', 1200], [5, 4200], ['reset', 600]
  ];
  var i = 0;
  function run() {
    var s = steps[i], what = s[0];
    typing.classList.remove('on');
    if (what === 'typing') { typing.parentNode.appendChild(typing); typing.classList.add('on'); }
    else if (what === 'paid') { inv.classList.add('paid'); st.textContent = 'Paid · confirmed'; }
    else if (what === 'reset') { items.forEach(function (b) { b.classList.remove('on'); }); inv.classList.remove('paid'); st.textContent = 'Waiting for payment'; }
    else { items[what].classList.add('on'); }
    i = (i + 1) % steps.length;
    setTimeout(run, s[1]);
  }
  setTimeout(run, 900);
})();
</script>
</body>
</html>
