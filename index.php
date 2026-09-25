<?php
// ── booqi — landing page ─────────────────────────────────
// Where the buttons go. APP_URL is the web app (BotCommand.html beside
// this file); DESKTOP_URL is the desktop app download — leave it '' to
// hide that button until you have a download link.
$APP_URL     = 'BotCommand.html';
$DESKTOP_URL = '';
// Signed in already (the app's session cookie): "Open app" instead of "Start".
$signedIn = isset($_COOKIE['bc_sess']);
$cta = $signedIn ? 'Open app' : 'Get started';
$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
// Languages shown in the language band (native names). Agents reply in
// whatever language the customer writes; these are examples.
$langs = ['English','Español','Português','Français','Deutsch','Italiano','Nederlands','Polski','Türkçe','Русский','Українська',
          'العربية','עברית','فارسی','हिन्दी','বাংলা','中文','日本語','한국어','Tiếng Việt','ไทย','Bahasa Indonesia','Svenska',
          'Norsk','Dansk','Suomi','Ελληνικά','Čeština','Română','Magyar','Български','Kiswahili','Filipino','Bahasa Melayu'];
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>booqi — AI agents for Telegram and Discord</title>
<meta name="description" content="AI agents for Telegram, Discord and direct chats. Customer replies, crypto payments and licence delivery, fully automated.">
<meta name="theme-color" content="#020b10">
<meta property="og:title" content="booqi — AI agents for Telegram and Discord">
<meta property="og:description" content="AI agents that handle customer conversations on Telegram and Discord.">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' x2='1'%3E%3Cstop stop-color='%2314b8a6'/%3E%3Cstop offset='1' stop-color='%233b82f6'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='32' height='32' rx='9' fill='%23061831'/%3E%3Cpath d='M9 11h14a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3h-7l-5 4v-4H9a3 3 0 0 1-3-3v-5a3 3 0 0 1 3-3z' fill='url(%23g)'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Fredoka:wght@400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
:root {
  --fx1: #14b8a6; --fx2: #06b6d4; --fx3: #3b82f6;
  --b1: #020b10; --b2: #042029; --b3: #061831;
  --t1: #eef0f6; --t2: #9aa3b8; --t3: #66718a;
  --ln: rgba(255,255,255,.065); --ln2: rgba(255,255,255,.11);
  --glass: rgba(13,19,31,.66); --glass2: rgba(18,26,40,.74);
  --ok: #30d158; --warn: #f5a524;
  --font: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
  --mono: 'JetBrains Mono', ui-monospace, monospace;
  --w: 1080px; --r: 14px; --navh: 76px;
}
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; scroll-padding-top: 0; -webkit-text-size-adjust: 100%; background: var(--b1); }
body { margin: 0; -webkit-user-select: none; user-select: none; -webkit-tap-highlight-color: transparent; color: var(--t1); font: 400 14.5px/1.55 var(--font); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
a { color: inherit; text-decoration: none; }
svg { display: block; }
.wrap { width: min(var(--w), 100% - 40px); margin-inline: auto; }

/* Ambient light: the app's background, calmer */
.fx { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden;
  background: linear-gradient(125deg, var(--b1) 0%, var(--b2) 38%, var(--b3) 70%, var(--b1) 100%); }
.fx i { position: absolute; border-radius: 50%; filter: blur(90px); opacity: .5; }
.fx i:nth-child(1) { width: 44vw; height: 44vw; left: -12vw; top: -14vw; background: color-mix(in srgb, var(--fx1) 24%, transparent); animation: drift 26s ease-in-out infinite alternate; }
.fx i:nth-child(2) { width: 38vw; height: 38vw; right: -10vw; top: 12vh; background: color-mix(in srgb, var(--fx3) 22%, transparent); animation: drift 32s ease-in-out infinite alternate-reverse; }
.fx i:nth-child(3) { width: 34vw; height: 34vw; left: 32vw; bottom: -18vw; background: color-mix(in srgb, var(--fx2) 14%, transparent); animation: drift 38s ease-in-out infinite alternate; }
.fx::after { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 110% 90% at 50% 40%, transparent 35%, rgba(0,0,0,.5) 100%); }
@keyframes drift { to { transform: translate(6vw, 4vh) scale(1.08); } }

/* Wordmark */
.word, .brandname { font-family: 'Fredoka', var(--font); font-style: normal; font-weight: 400; letter-spacing: -.01em; }
.word { font-size: 24px; line-height: 1; padding-bottom: 2px;
  background: linear-gradient(90deg, var(--fx1) 0%, var(--fx2) 28%, var(--fx3) 56%, #dfe6f0 72%, var(--fx1) 100%);
  background-size: 260% 100%; -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;
  animation: flow 9s ease-in-out infinite alternate; filter: drop-shadow(0 0 14px color-mix(in srgb, var(--fx1) 16%, transparent)); }
@keyframes flow { from { background-position: 0% 50%; } to { background-position: 100% 50%; } }

/* Header: a floating glass bar. Mark + wordmark, section links in a
   pill that follows the section in view, and the app button. */
.nav { position: fixed; top: 0; left: 0; right: 0; z-index: 30; padding: 12px 0; pointer-events: none; }
.nav .wrap { pointer-events: auto; position: relative; display: flex; align-items: center; gap: 16px; height: 52px; padding: 0 8px 0 12px;
  border-radius: 16px; background: rgba(7,13,21,.62); border: 1px solid rgba(255,255,255,.08);
  backdrop-filter: blur(20px) saturate(170%); -webkit-backdrop-filter: blur(20px) saturate(170%);
  box-shadow: 0 12px 34px -16px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.06);
  transition: background-color .3s ease, box-shadow .3s ease; }
.nav.scrolled .wrap { background: rgba(7,13,21,.82); }
.nav .wrap::before { content: ''; position: absolute; left: 18%; right: 18%; top: -1px; height: 1px; pointer-events: none;
  background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--fx2) 60%, transparent), transparent); opacity: .7; }
.brand { display: inline-flex; align-items: center; gap: 10px; }
.mark { width: 30px; height: 30px; flex: none; border-radius: 9px; display: grid; place-items: center;
  background: linear-gradient(145deg, #0d2a33, #0b1a31); box-shadow: inset 0 0 0 1px rgba(255,255,255,.1), 0 6px 16px -8px color-mix(in srgb, var(--fx2) 70%, transparent); }
.mark svg { width: 17px; height: 17px; }
.links { display: flex; gap: 2px; margin-left: auto; padding: 3px; border-radius: 11px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.05); }
.links a { position: relative; height: 30px; padding: 0 12px; display: inline-flex; align-items: center; border-radius: 8px; font-size: 12.5px; color: var(--t2);
  transition: color .15s ease, background-color .15s ease; }
.links a:hover { color: var(--t1); background: rgba(255,255,255,.04); }
.links a[aria-current="true"] { color: var(--t1); background: rgba(255,255,255,.075); box-shadow: inset 0 0 0 1px rgba(255,255,255,.06); }
.nav .btn-s { margin-left: 4px; }

/* Buttons */
.btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; height: 38px; padding: 0 16px; border-radius: 10px;
  font: 600 13px/1 var(--font); letter-spacing: -.005em; white-space: nowrap; cursor: pointer;
  transition: transform .15s, background-color .15s, box-shadow .2s, border-color .15s; }
.btn:active { transform: translateY(1px); }
.btn svg { width: 14px; height: 14px; }
.btn-p { color: #04151a; background: linear-gradient(135deg, #5eead4, #38bdf8 55%, #818cf8);
  box-shadow: 0 8px 24px -10px color-mix(in srgb, var(--fx2) 70%, transparent), inset 0 1px 0 rgba(255,255,255,.35); }
.btn-p:hover { box-shadow: 0 12px 30px -10px color-mix(in srgb, var(--fx2) 90%, transparent), inset 0 1px 0 rgba(255,255,255,.4); }
.btn-g { color: var(--t1); background: rgba(255,255,255,.045); border: 1px solid var(--ln2); }
.btn-g:hover { background: rgba(255,255,255,.08); }
.btn-s { height: 32px; padding: 0 13px; font-size: 12.5px; border-radius: 9px; }

/* Type */
.eyebrow { display: inline-flex; align-items: center; gap: 7px; font-size: 11px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--fx1); }
.eyebrow::before { content: ''; width: 14px; height: 1px; background: currentColor; opacity: .6; }
h1 { margin: 16px 0 12px; font-size: clamp(30px, 4vw, 48px); line-height: 1.04; letter-spacing: -.035em; font-weight: 700; }
h1, h2, .sub, .lead { text-wrap: balance; }
h1, h2 { background: linear-gradient(180deg, #fff 30%, #aab4c8); -webkit-background-clip: text; background-clip: text; color: transparent; }
@media (min-width: 981px) { h1 em { white-space: nowrap; } }
.hero .wrap > * { min-width: 0; }
h1 em, h2 em { font-style: normal; background: linear-gradient(90deg, #5eead4, #7dd3fc 50%, #a5b4fc); -webkit-background-clip: text; background-clip: text; color: transparent; }
h2 { margin: 8px 0 8px; font-size: clamp(24px, 3vw, 34px); line-height: 1.12; letter-spacing: -.028em; font-weight: 650; }
h3 { margin: 0 0 4px; font-size: 14px; font-weight: 600; letter-spacing: -.01em; }
.sub { margin: 0; color: var(--t2); max-width: 34em; }
.hd { margin-bottom: 24px; }
.hd.c { text-align: center; } .hd.c .sub { margin-inline: auto; }

/* Each part of the page is its own screen: the next one only appears as
   you scroll (content centred in the space, a hairline between them). */
.panel { position: relative; min-height: 100svh; display: flex; flex-direction: column; justify-content: center;
  padding: calc(var(--navh) + 16px) 0 clamp(40px, 5vw, 64px); }
.panel + .panel::before { content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: min(var(--w), 100% - 40px); height: 1px;
  background: linear-gradient(90deg, transparent, var(--ln2), transparent); }
.panel-hero { padding: var(--navh) 0 0; }
.panel-hero .hero { flex: 1; display: flex; align-items: center; }
.panel-end { min-height: calc(100svh - 132px); }
/* Scrolling moves one section at a time: with a mouse or trackpad the
   script below glides to the next section; on touch screens the page
   settles on the nearest one. */
@media (pointer: coarse) {
  html { scroll-snap-type: y proximity; }
  .panel { scroll-snap-align: start; }
  footer { scroll-snap-align: end; }
}

/* ── Hero ── */
.hero { position: relative; padding: clamp(44px, 7vw, 80px) 0 clamp(36px, 5vw, 56px); }
/* A faint grid behind the hero, fading out from the centre. */
.hero::before { content: ''; position: absolute; inset: -56px 0 0; z-index: -1; pointer-events: none;
  background-image: linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 44px 44px;
  -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 20%, transparent 75%); mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 20%, transparent 75%); }
.hero .wrap { display: grid; grid-template-columns: 1.2fr .8fr; gap: clamp(28px, 4vw, 52px); align-items: center; }
.pill { display: inline-flex; align-items: center; gap: 8px; height: 26px; padding: 0 11px 0 9px; border-radius: 99px;
  font-size: 11.5px; color: var(--t2); background: rgba(255,255,255,.04); border: 1px solid var(--ln2); }
.pill b { width: 6px; height: 6px; border-radius: 50%; background: var(--ok); animation: pulse 2.4s ease-in-out infinite; }
@keyframes pulse { 0%,100% { box-shadow: 0 0 0 0 rgba(48,209,88,.35); } 50% { box-shadow: 0 0 0 5px rgba(48,209,88,0); } }
.lead { margin: 0; max-width: 31em; font-size: clamp(14.5px, 1.4vw, 16px); color: var(--t2); }
.cta { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; }
.meta { display: flex; flex-wrap: wrap; gap: 6px 16px; margin-top: 20px; font-size: 12px; color: var(--t3); }
.meta span { display: inline-flex; align-items: center; gap: 6px; }
.meta svg { width: 13px; height: 13px; color: var(--fx1); }

/* Demo chat */
.demo { position: relative; isolation: isolate; border-radius: 18px; padding: 1px; background: linear-gradient(160deg, rgba(255,255,255,.16), rgba(255,255,255,.03) 40%, color-mix(in srgb, var(--fx3) 30%, transparent)); }
.demo::before { content: ''; position: absolute; inset: 14% 6% -8%; z-index: -1; border-radius: 40px; filter: blur(46px); opacity: .55;
  background: radial-gradient(closest-side, color-mix(in srgb, var(--fx2) 55%, transparent), color-mix(in srgb, var(--fx3) 25%, transparent), transparent); }
.demo-in { border-radius: 17px; background: rgba(9,14,24,.84); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); overflow: hidden; box-shadow: 0 36px 80px -40px rgba(0,0,0,.9); }
.demo-hd { display: flex; align-items: center; gap: 10px; padding: 12px 14px; border-bottom: 1px solid var(--ln); }
.ava { width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; font-size: 11.5px; font-weight: 600; color: #cfe9ff;
  background: linear-gradient(145deg, #1d3b5a, #16263d); box-shadow: inset 0 0 0 1px rgba(255,255,255,.1); }
.demo-hd .n { font-size: 13px; font-weight: 600; }
.demo-hd .s { font-size: 10.5px; color: var(--t3); display: flex; align-items: center; gap: 5px; }
.demo-hd .s svg { width: 10px; height: 10px; color: #37aee2; }
.demo-hd .ag { margin-left: auto; font-size: 10.5px; color: var(--t2); padding: 3px 9px; border-radius: 99px; background: rgba(255,255,255,.05); border: 1px solid var(--ln); display: flex; gap: 6px; align-items: center; }
.demo-hd .ag i { width: 6px; height: 6px; border-radius: 50%; background: var(--ok); }
.thread { height: 330px; padding: 14px; display: flex; flex-direction: column; justify-content: flex-end; gap: 6px; overflow: hidden; }
.b { display: none; max-width: 80%; padding: 7px 11px; border-radius: 14px; font-size: 12.5px; line-height: 1.45; flex: none; }
.b.on { display: block; animation: pop .45s cubic-bezier(.16,1,.3,1) both; }
@keyframes pop { from { opacity: 0; transform: translateY(8px) scale(.97); } to { opacity: 1; transform: none; } }
.b.in { align-self: flex-start; background: rgba(255,255,255,.07); border-bottom-left-radius: 4px; }
.b.out { align-self: flex-end; background: linear-gradient(135deg, rgba(20,184,166,.28), rgba(59,130,246,.26)); border: 1px solid rgba(125,211,252,.16); border-bottom-right-radius: 4px; }
.b small { display: block; font-size: 9.5px; color: rgba(210,230,255,.55); margin-bottom: 1px; }
.inv { align-self: flex-end; width: 226px; max-width: 82%; padding: 11px 12px; border-radius: 13px; background: rgba(255,255,255,.05); border: 1px solid var(--ln2); font-size: 11.5px; }
.inv .r { display: flex; justify-content: space-between; color: var(--t2); }
.inv .r b { color: var(--t1); }
.inv code { display: block; margin-top: 7px; padding: 5px 8px; border-radius: 7px; background: rgba(0,0,0,.3); font: 10.5px/1.3 var(--mono); color: #9fd8ff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.inv .st { display: flex; align-items: center; gap: 6px; margin-top: 8px; font-size: 10.5px; color: var(--t3); }
.inv .st i { width: 7px; height: 7px; border-radius: 50%; background: var(--warn); transition: background .3s; }
.inv.paid .st { color: #7ee2a0; } .inv.paid .st i { background: var(--ok); }
.typing { align-self: flex-end; display: none; gap: 3px; padding: 10px 12px; border-radius: 14px; background: rgba(255,255,255,.05); flex: none; }
.typing.on { display: inline-flex; animation: pop .3s ease both; }
.typing i { width: 5px; height: 5px; border-radius: 50%; background: var(--t2); animation: dot 1.1s infinite ease-in-out; }
.typing i:nth-child(2) { animation-delay: .15s; } .typing i:nth-child(3) { animation-delay: .3s; }
@keyframes dot { 0%, 60%, 100% { opacity: .3; transform: none; } 30% { opacity: 1; transform: translateY(-2px); } }
.key { font: 11.5px var(--mono); color: #a7f3d0; letter-spacing: .04em; }

/* ── Logos band ── */
.band { border-block: 1px solid var(--ln); background: rgba(255,255,255,.015); }
.band .wrap { display: grid; grid-template-columns: auto 1fr auto 1fr; align-items: center; gap: 14px 22px; padding: 16px 0; }
.band .lbl { font-size: 10.5px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--t3); white-space: nowrap; }
.logos { display: flex; flex-wrap: wrap; gap: 8px 20px; align-items: center; }
.logo { display: inline-flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: var(--t2); }
.logo svg { width: 18px; height: 18px; }

/* ── Features: bento ── */
.bento { display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; }
.tile { position: relative; grid-column: span 2; padding: 18px; border-radius: var(--r);
  background: radial-gradient(360px circle at var(--mx, -40%) var(--my, -40%), rgba(125,211,252,.075), transparent 45%), var(--glass); border: 1px solid var(--ln);
  backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); overflow: hidden; transition: border-color .2s, background-color .2s, transform .25s cubic-bezier(.16,1,.3,1); }
.tile::before { content: ''; position: absolute; inset: 0 0 auto; height: 1px; background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--fx2) 45%, transparent), transparent); opacity: 0; transition: opacity .25s; }
.tile:hover { border-color: var(--ln2); transform: translateY(-2px); }
.tile:hover::before { opacity: 1; }
.tile.w3 { grid-column: span 3; } .tile.w4 { grid-column: span 4; }
.tile p { margin: 0; font-size: 12.5px; line-height: 1.5; color: var(--t2); }
.ic { width: 32px; height: 32px; border-radius: 9px; display: grid; place-items: center; margin-bottom: 12px; color: #aee9f5;
  background: linear-gradient(145deg, color-mix(in srgb, var(--fx1) 22%, transparent), color-mix(in srgb, var(--fx3) 16%, transparent)); box-shadow: inset 0 0 0 1px rgba(255,255,255,.1); }
.ic svg { width: 16px; height: 16px; }
.viz { margin-top: 14px; display: flex; flex-wrap: wrap; gap: 6px; }
.tag { display: inline-flex; align-items: center; gap: 6px; height: 24px; padding: 0 9px; border-radius: 7px; font-size: 11px; color: var(--t2);
  background: rgba(255,255,255,.04); border: 1px solid var(--ln); }
.tag i { width: 6px; height: 6px; border-radius: 50%; background: var(--fx1); }
.tag.ok i { background: var(--ok); }
.tag svg { color: var(--fx1); }
.coins { display: flex; gap: 6px; margin-top: 14px; }
.coin { width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; font: 600 13px var(--font); color: #d7f4ff;
  background: rgba(255,255,255,.05); border: 1px solid var(--ln2); }
/* Ghost assistant: a question typed in, the ghost's answer below it. */
.gh { margin-top: 14px; display: grid; gap: 6px; min-height: 76px; align-content: start; }
.gh-q { justify-self: end; display: inline-flex; align-items: center; gap: 1px; max-width: 92%; min-height: 30px; padding: 6px 11px;
  border-radius: 12px 12px 4px 12px; background: rgba(255,255,255,.07); font-size: 12px; color: var(--t1); }
.gh-q .caret { width: 1px; height: 13px; margin-left: 1px; background: var(--t2); animation: blink 1s steps(1) infinite; }
.gh-a { display: flex; align-items: flex-end; gap: 7px; opacity: 0; transform: translateY(4px); transition: opacity .3s ease, transform .4s cubic-bezier(.16,1,.3,1); }
.gh-a.on { opacity: 1; transform: none; }
.gh-av { width: 22px; height: 22px; flex: none; border-radius: 50%; display: grid; place-items: center; color: #d6f1ff;
  background: linear-gradient(145deg, color-mix(in srgb, var(--fx1) 35%, transparent), color-mix(in srgb, var(--fx3) 28%, transparent)); box-shadow: inset 0 0 0 1px rgba(255,255,255,.12); }
.gh-av svg { width: 13px; height: 13px; }
.gh-t { padding: 6px 11px; border-radius: 12px 12px 12px 4px; font-size: 12px; color: var(--t1);
  background: linear-gradient(135deg, rgba(20,184,166,.2), rgba(59,130,246,.18)); border: 1px solid rgba(125,211,252,.14); }
@keyframes blink { 50% { opacity: 0; } }
.more { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; margin-top: 16px; }

/* ── Split sections ── */
.split { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(24px, 4vw, 48px); align-items: center; }
.list { list-style: none; margin: 18px 0 0; padding: 0; display: grid; gap: 10px; }
.list li { display: flex; gap: 11px; align-items: flex-start; font-size: 13.5px; color: var(--t2); }
.list li b { color: var(--t1); font-weight: 600; }
.list svg { flex: none; width: 17px; height: 17px; margin-top: 1px; color: var(--fx1); }

/* Licence card */
.lic { border-radius: 16px; padding: 1px; background: linear-gradient(160deg, rgba(255,255,255,.14), rgba(255,255,255,.03) 45%, color-mix(in srgb, var(--fx1) 28%, transparent)); }
.lic-in { border-radius: 15px; padding: 18px; background: rgba(9,14,24,.84); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); }
.lic-top { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
.lic-top .p { font-size: 13px; font-weight: 600; }
.lic-top .p span { display: block; font-size: 11px; font-weight: 400; color: var(--t3); }
.badge { display: inline-flex; align-items: center; gap: 6px; height: 22px; padding: 0 9px; border-radius: 99px; font-size: 10.5px; font-weight: 600; color: #86efac; background: rgba(48,209,88,.1); border: 1px solid rgba(48,209,88,.22); }
.badge i { width: 6px; height: 6px; border-radius: 50%; background: var(--ok); }
.serial { margin: 14px 0 12px; padding: 11px 12px; border-radius: 10px; background: rgba(0,0,0,.3); border: 1px dashed rgba(167,243,208,.25);
  font: 500 14px var(--mono); letter-spacing: .08em; color: #a7f3d0; text-align: center; }
.lic-rows { display: grid; gap: 6px; font-size: 12px; }
.lic-rows div { display: flex; justify-content: space-between; color: var(--t3); }
.lic-rows b { color: var(--t1); font-weight: 500; }
.exp b { transition: color .4s; } .exp.bump b { color: #86efac; }
.lic-log { margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--ln); display: grid; gap: 7px; }
.lic-log div { display: flex; align-items: center; gap: 8px; font-size: 11.5px; color: var(--t2); }
.lic-log svg { width: 14px; height: 14px; color: var(--ok); flex: none; }
.fee { display: inline-flex; align-items: center; gap: 10px; margin-top: 22px; padding: 7px 8px 7px 7px; border: 1px solid var(--ln); border-radius: 999px; background: rgba(255,255,255,.025); font-size: 12px; color: var(--t3); }
.fee b { color: var(--t2); font-weight: 600; }
.fee-ic { display: grid; place-items: center; width: 24px; height: 24px; border-radius: 50%; background: color-mix(in srgb, var(--fx1) 14%, transparent); color: var(--fx1); flex: none; }
.fee-ic svg { width: 13px; height: 13px; }
.fee-pct { padding: 3px 9px; border-radius: 999px; background: rgba(255,255,255,.05); border: 1px solid var(--ln); color: var(--t2); font-size: 11px; font-weight: 600; }
.lic-log time { margin-left: auto; color: var(--t3); font-size: 10.5px; }

/* Payment flow */
.flow { display: grid; }
.step { display: flex; align-items: center; gap: 12px; padding: 11px 13px; border-radius: 12px; border: 1px solid var(--ln);
  background: radial-gradient(260px circle at var(--mx, -40%) var(--my, -40%), rgba(125,211,252,.07), transparent 45%), var(--glass); }
.step .ic { margin: 0; flex: none; }
.step b { display: block; font-size: 13px; font-weight: 600; }
.step span { font-size: 12px; color: var(--t3); }
.step .ck { margin-left: auto; width: 18px; height: 18px; color: var(--ok); }
.join { height: 10px; width: 1px; margin-left: 29px; background: linear-gradient(var(--ln2), transparent); }

/* Languages */
.langs { position: relative; overflow: hidden;
  -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
.lane { display: flex; gap: 8px; width: max-content; animation: slide 60s linear infinite; }
.lane.r { animation-direction: reverse; animation-duration: 70s; margin-top: 8px; }
.lane span { height: 32px; padding: 0 14px; border-radius: 99px; display: inline-flex; align-items: center; font-size: 13px; color: var(--t2);
  background: rgba(255,255,255,.035); border: 1px solid var(--ln); white-space: nowrap; }
@keyframes slide { to { transform: translateX(-50%); } }
.lang-notes { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; margin-top: 16px; }

/* AI providers */
.ai3 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 18px; }
.prov-in { border-color: color-mix(in srgb, var(--fx2) 30%, transparent); }
.prov-in .mark { width: 24px; height: 24px; border-radius: 7px; } .prov-in .mark svg { width: 14px; height: 14px; }
.prov { display: flex; align-items: center; gap: 11px; padding: 13px 14px; border-radius: 12px; border: 1px solid var(--ln);
  background: radial-gradient(200px circle at var(--mx, -40%) var(--my, -40%), rgba(125,211,252,.08), transparent 50%), var(--glass); }
.prov svg { width: 24px; height: 24px; flex: none; }
.prov b { display: block; font-size: 13px; font-weight: 600; }
.prov span { font-size: 11.5px; color: var(--t3); }

/* How it works */
.steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; counter-reset: s; }
.steps .tile { grid-column: auto; }
.steps .tile::after { counter-increment: s; content: '0' counter(s); position: absolute; top: 16px; right: 18px; font: 700 11px var(--mono); letter-spacing: .08em; color: rgba(255,255,255,.16); }

/* Closing card: a lit panel with a gradient edge and a faint grid. */
.finale { position: relative; border-radius: 24px; padding: 1px; overflow: hidden;
  background: linear-gradient(160deg, rgba(255,255,255,.2), rgba(255,255,255,.04) 38%, rgba(255,255,255,.03) 62%, color-mix(in srgb, var(--fx2) 45%, transparent)); }
.finale-in { position: relative; overflow: hidden; border-radius: 23px; text-align: center; padding: clamp(40px, 6vw, 68px) 24px clamp(34px, 5vw, 52px);
  background: radial-gradient(ellipse 55% 70% at 50% -10%, color-mix(in srgb, var(--fx2) 22%, transparent), transparent 70%),
              radial-gradient(ellipse 40% 60% at 85% 120%, color-mix(in srgb, var(--fx3) 18%, transparent), transparent 70%), rgba(8,13,22,.92); }
.finale-in::before { content: ''; position: absolute; inset: 0; pointer-events: none;
  background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
  background-size: 36px 36px; -webkit-mask-image: radial-gradient(ellipse 60% 70% at 50% 30%, #000, transparent 75%); mask-image: radial-gradient(ellipse 60% 70% at 50% 30%, #000, transparent 75%); }
.finale-in > * { position: relative; }
.mark-lg { width: 46px; height: 46px; border-radius: 14px; margin: 0 auto 18px;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.12), 0 0 0 6px rgba(255,255,255,.025), 0 14px 34px -10px color-mix(in srgb, var(--fx2) 80%, transparent); }
.mark-lg svg { width: 24px; height: 24px; }
.finale h2 { margin: 0 0 8px; font-size: clamp(26px, 3.4vw, 38px); }
.finale .sub { margin-inline: auto; }
.finale .cta { justify-content: center; margin-top: 22px; }
.points { list-style: none; margin: 26px 0 0; padding: 0; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 22px; font-size: 12.5px; color: var(--t2); }
.points li { display: inline-flex; align-items: center; gap: 7px; }
.points svg { width: 15px; height: 15px; color: var(--fx1); }
@media (max-width: 640px) { .points { flex-direction: column; align-items: flex-start; width: max-content; margin-left: auto; margin-right: auto; gap: 9px; } }

/* Footer: links and the platforms on one line, the fine print below. */
footer { position: relative; padding: 26px 0 28px; }
footer::before { content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: min(var(--w), 100% - 40px); height: 1px;
  background: linear-gradient(90deg, transparent, var(--ln2), transparent); }
.f-top { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px; }
.f-links { display: flex; flex-wrap: wrap; gap: 2px; margin-left: -10px; }
.f-links a { padding: 6px 10px; border-radius: 8px; font-size: 12.5px; color: var(--t2); transition: color .15s, background-color .15s; }
.f-links a:hover { color: var(--t1); background: rgba(255,255,255,.04); }
.f-plat { display: flex; align-items: center; gap: 12px; color: var(--t3); }
.f-plat svg { width: 16px; height: 16px; }
.f-plat .sep { width: 1px; height: 14px; background: var(--ln2); }
.f-bot { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 6px 20px; margin-top: 16px; padding-top: 16px;
  border-top: 1px solid var(--ln); font-size: 11.5px; color: var(--t3); }

/* Reveal */
.rv { opacity: 0; transform: translateY(12px); transition: opacity .6s ease, transform .7s cubic-bezier(.16,1,.3,1); }
.rv.in { opacity: 1; transform: none; }

/* ── Responsive ── */
@media (max-width: 980px) {
  .split > .flow { order: 2; }
  .hero .wrap, .split { grid-template-columns: 1fr; }
  .demo { max-width: 440px; }
  .bento { grid-template-columns: repeat(2, 1fr); }
  .tile, .tile.w3 { grid-column: span 1; } .tile.w4 { grid-column: span 2; }
  .band .wrap { grid-template-columns: auto 1fr; }
  .lic, .flow { max-width: 460px; }
}
@media (max-width: 640px) {
  .links { display: none; }
  .nav .btn-s { margin-left: auto; }
  .nav .wrap { height: 48px; padding: 0 6px 0 10px; }
  .f-top, .f-bot { justify-content: center; text-align: center; }
  .f-links { margin-left: 0; justify-content: center; }
  .bento { gap: 8px; }
  .tile { padding: 15px 14px; }
  .tile.w3 { grid-column: span 2; }
  .steps { grid-template-columns: 1fr; }
  .ai3 { gap: 8px; }
  .prov { flex-direction: column; align-items: flex-start; gap: 8px; padding: 12px; }
  .band .wrap { grid-template-columns: 1fr; gap: 8px; }
  .cta .btn { flex: 1 1 auto; }
  .thread { height: 300px; }
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

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <linearGradient id="gem" x1="0" y1="0" x2="24" y2="24" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4285F4"/><stop offset=".5" stop-color="#9B72F2"/><stop offset="1" stop-color="#F94E7E"/></linearGradient>
    <symbol id="l-gemini" viewBox="0 0 24 24"><path d="M12 1c.4 5.6 4.4 9.6 10 10-5.6.4-9.6 4.4-10 10-.4-5.6-4.4-9.6-10-10C7.6 10.6 11.6 6.6 12 1z" fill="url(#gem)"/></symbol>
    <symbol id="l-openai" viewBox="0 0 24 24"><path fill="currentColor" d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91 6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9 6.046 6.046 0 0 0 .743 7.097 5.98 5.98 0 0 0 .51 4.911 6.051 6.051 0 0 0 6.515 2.9A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206 5.99 5.99 0 0 0 3.997-2.9 6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081 4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.47 4.47 0 0 1-.535-3.014l.142.085 4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 7.896a4.485 4.485 0 0 1 2.366-1.973V11.6a.766.766 0 0 0 .388.676l5.815 3.355-2.02 1.168a.076.076 0 0 1-.071 0l-4.83-2.786A4.504 4.504 0 0 1 2.34 7.872zm16.597 3.855-5.833-3.387L15.119 7.2a.076.076 0 0 1 .071 0l4.83 2.791a4.494 4.494 0 0 1-.676 8.105v-5.678a.79.79 0 0 0-.407-.667zm2.01-3.023-.141-.085-4.774-2.782a.776.776 0 0 0-.785 0L9.409 9.23V6.897a.066.066 0 0 1 .028-.061l4.83-2.787a4.5 4.5 0 0 1 6.68 4.66zm-12.64 4.135-2.02-1.164a.08.08 0 0 1-.038-.057V6.075a4.5 4.5 0 0 1 7.375-3.453l-.142.08-4.778 2.758a.795.795 0 0 0-.393.681zm1.097-2.365 2.602-1.5 2.607 1.5v3l-2.597 1.5-2.607-1.5z"/></symbol>
    <symbol id="l-anthropic" viewBox="0 0 24 24"><path fill="#D97757" d="M14.504 3h-3.04L17.21 21h3.04L14.504 3zM7.473 3 1.728 21h3.1l1.176-3.788h6.013L13.193 21h3.1L10.548 3H7.473zm-.518 11.426 2.013-6.508 2.013 6.508H6.955z"/></symbol>
    <symbol id="i-tg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.9 4.4l-3.1 14.7c-.2 1-.9 1.3-1.7.8l-4.8-3.5-2.3 2.2c-.3.3-.5.5-1 .5l.3-4.9 8.9-8c.4-.3-.1-.5-.6-.2l-11 6.9-4.7-1.5c-1-.3-1-1 .2-1.5L20.6 3c.8-.3 1.6.2 1.3 1.4z"/></symbol>
    <symbol id="i-dc" viewBox="0 0 24 24" fill="currentColor"><path d="M19.3 5.3A16.5 16.5 0 0 0 15.2 4l-.5 1a15.3 15.3 0 0 0-5.4 0L8.8 4a16.4 16.4 0 0 0-4.1 1.3C2.1 9.2 1.4 13 1.7 16.7a16.6 16.6 0 0 0 5 2.5l1.1-1.7a10.8 10.8 0 0 1-1.7-.8l.4-.3a11.8 11.8 0 0 0 11 0l.4.3c-.5.3-1.1.6-1.7.8l1.1 1.7a16.5 16.5 0 0 0 5-2.5c.4-4.3-.7-8.1-3-11.4zM8.7 14.5c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2zm6.6 0c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2z"/></symbol>
    <symbol id="i-spark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/><circle cx="12" cy="12" r="3"/></symbol>
    <symbol id="i-coin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9.5 8.5h4a2 2 0 0 1 0 4h-4m0 0h4.5a2 2 0 0 1 0 4H9.5m0-8v8M11 7v1.5M11 15.5V17"/></symbol>
    <symbol id="i-box" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/></symbol>
    <symbol id="i-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></symbol>
    <symbol id="i-lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2.5"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></symbol>
    <symbol id="i-hand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="4"/><path d="M2 21v-1a7 7 0 0 1 11-5.7"/><path d="M16 17l2 2 4-4"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/></symbol>
    <symbol id="i-phone" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2.5" width="12" height="19" rx="3"/><path d="M11 18.5h2"/></symbol>
    <symbol id="i-chart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.7 2.7L16 10"/></symbol>
    <symbol id="i-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="i-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v11M7 11l5 5 5-5M4 20h16"/></symbol>
    <symbol id="i-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-12.2 7.5L3 21l2-5.3A8.4 8.4 0 1 1 21 11.5z"/></symbol>
    <symbol id="i-monitor" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="4" width="19" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></symbol>
    <symbol id="i-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></symbol>
    <symbol id="i-bolt" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z"/></symbol>
    <linearGradient id="mkg" x1="3" y1="4" x2="21" y2="20" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#5eead4"/><stop offset=".55" stop-color="#38bdf8"/><stop offset="1" stop-color="#818cf8"/></linearGradient>
    <symbol id="i-mark" viewBox="0 0 24 24"><path d="M6.5 5h11A3.5 3.5 0 0 1 21 8.5v6a3.5 3.5 0 0 1-3.5 3.5H12l-4.6 3.4c-.5.4-1.2 0-1.2-.6V18A3.5 3.5 0 0 1 3 14.5v-6A3.5 3.5 0 0 1 6.5 5z" fill="url(#mkg)"/><circle cx="9" cy="11.5" r="1.3" fill="#061831"/><circle cx="15" cy="11.5" r="1.3" fill="#061831"/></symbol>
    <symbol id="i-ghost" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a7 7 0 0 0-7 7v10.5l2.33-1.75L9.67 20.5 12 18.75l2.33 1.75 2.34-1.75L19 20.5V10a7 7 0 0 0-7-7z"/><circle cx="9.5" cy="10.5" r=".9" fill="currentColor"/><circle cx="14.5" cy="10.5" r=".9" fill="currentColor"/></symbol>
    <symbol id="i-term" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 17l6-5-6-5M12 19h8"/></symbol>
    <symbol id="i-refresh" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-2.6-6.4M21 4v5h-5"/></symbol>
    <symbol id="i-user" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></symbol>
    <symbol id="i-lang" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h8M8 3v2M5.5 5c.8 3.3 3 6 6 7.5M10.5 5c-.8 3.8-3.3 6.8-6.5 8.5"/><path d="M13 21l4-9 4 9M14.5 18h5"/></symbol>
  </defs>
</svg>

<header class="nav">
  <div class="wrap">
    <a href="#top" class="brand" aria-label="booqi">
      <span class="mark"><svg><use href="#i-mark"/></svg></span>
      <span class="word">booqi</span>
    </a>
    <nav class="links" aria-label="Sections">
      <a href="#features">Features</a>
      <a href="#licensing">Licensing</a>
      <a href="#payments">Payments</a>
      <a href="#languages">Languages</a>
      <a href="#ai">AI</a>
    </nav>
    <a class="btn btn-g btn-s" href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
  </div>
</header>

<main id="top">
  <!-- ── HERO (with the logo band, one screen) ── -->
  <div class="panel panel-hero">
  <div class="hero">
    <div class="wrap">
      <div>
        <span class="pill rv"><b></b> Telegram · Discord · Direct chats</span>
        <h1 class="rv">AI customer agents<br><em>for Telegram &amp; Discord.</em></h1>
        <p class="lead rv">Answer customers, accept crypto payments and deliver orders automatically, even while you're away.</p>
        <div class="cta rv">
          <a class="btn btn-p" href="<?= $h($APP_URL) ?>"><?= $h($cta) ?> <svg><use href="#i-arrow"/></svg></a>
          <?php if ($DESKTOP_URL !== ''): ?>
          <a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Desktop app</a>
          <?php else: ?>
          <a class="btn btn-g" href="#features">See features</a>
          <?php endif; ?>
        </div>
        <div class="meta rv">
          <span><svg><use href="#i-globe"/></svg> Browser</span>
          <span><svg><use href="#i-monitor"/></svg> Desktop</span>
          <span><svg><use href="#i-phone"/></svg> Mobile</span>
          <span><svg><use href="#i-lang"/></svg> 40+ languages</span>
        </div>
      </div>

      <div class="demo rv" aria-label="Example conversation with an agent">
        <div class="demo-in">
          <div class="demo-hd">
            <div class="ava">MJ</div>
            <div><div class="n">Maya J.</div><div class="s"><svg><use href="#i-tg"/></svg> Telegram</div></div>
            <div class="ag"><i></i> AI agent</div>
          </div>
          <div class="thread" id="thread">
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
  </div>

  <!-- ── LOGOS ── -->
  <div class="band">
    <div class="wrap">
      <span class="lbl">Works with</span>
      <div class="logos">
        <span class="logo"><svg style="color:#37aee2"><use href="#i-tg"/></svg> Telegram</span>
        <span class="logo"><svg style="color:#7c8cff"><use href="#i-dc"/></svg> Discord</span>
        <span class="logo"><svg style="color:var(--fx1)"><use href="#i-lock"/></svg> Direct chats</span>
      </div>
      <span class="lbl">Your AI</span>
      <div class="logos">
        <span class="logo"><svg><use href="#i-mark"/></svg> Built-in</span>
        <span class="logo"><svg><use href="#l-gemini"/></svg> Gemini</span>
        <span class="logo"><svg style="color:#e7eaf0"><use href="#l-openai"/></svg> OpenAI</span>
        <span class="logo"><svg><use href="#l-anthropic"/></svg> Claude</span>
      </div>
    </div>
  </div>
  </div>

  <!-- ── FEATURES ── -->
  <section id="features" class="panel">
    <div class="wrap">
      <div class="hd c rv">
        <span class="eyebrow">Features</span>
        <h2>Everything you need, <em>in one place.</em></h2>
      </div>
      <div class="bento">
        <div class="tile w4 rv">
          <div class="ic"><svg><use href="#i-spark"/></svg></div>
          <h3>Custom agents</h3>
          <p>Set the tone, products and hours. Every customer is remembered.</p>
          <div class="viz">
            <span class="tag"><i></i>Personality</span><span class="tag"><i></i>Memory</span>
            <span class="tag"><i></i>Reply hours</span><span class="tag"><i></i>Human-like typing</span>
          </div>
        </div>
        <div class="tile rv">
          <div class="ic"><svg><use href="#i-moon"/></svg></div>
          <h3>Always on</h3>
          <p>Replies continue while the app is closed.</p>
          <div class="viz"><span class="tag ok"><i></i>Online · app closed</span></div>
        </div>
        <div class="tile rv">
          <div class="ic"><svg><use href="#i-coin"/></svg></div>
          <h3>Crypto payments</h3>
          <p>Invoices sent in chat and confirmed automatically.</p>
          <div class="coins"><span class="coin">₿</span><span class="coin">Ξ</span><span class="coin">₮</span><span class="coin">Ł</span><span class="coin">Ð</span></div>
        </div>
        <div class="tile rv">
          <div class="ic"><svg><use href="#i-bolt"/></svg></div>
          <h3>Instant delivery</h3>
          <p>Keys and files delivered as soon as payment clears.</p>
        </div>
        <div class="tile rv">
          <div class="ic"><svg><use href="#i-hand"/></svg></div>
          <h3>Human handover</h3>
          <p>Refunds and complex requests are passed to you.</p>
        </div>
        <div class="tile w3 rv">
          <div class="ic"><svg><use href="#i-ghost"/></svg></div>
          <h3>Ghost assistant</h3>
          <p>Ask about your store, or have it send messages, reminders, invoices and reports.</p>
          <div class="gh" aria-hidden="true">
            <div class="gh-q"><span id="ghq"></span><span class="caret"></span></div>
            <div class="gh-a" id="gha"><span class="gh-av"><svg><use href="#i-ghost"/></svg></span><span class="gh-t" id="ght"></span></div>
          </div>
        </div>
        <div class="tile w3 rv">
          <div class="ic"><svg><use href="#i-chart"/></svg></div>
          <h3>Overview</h3>
          <p>Customers, orders, licences and activity at a glance.</p>
          <div class="viz"><span class="tag"><i></i>Needs you</span><span class="tag ok"><i></i>Customers</span><span class="tag"><i></i>Activity</span><span class="tag"><i></i>Reports</span></div>
        </div>
      </div>
      <div class="more rv">
        <span class="tag"><svg width="12" height="12"><use href="#i-clock"/></svg>Follow-ups</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-shield"/></svg>Spam protection</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-user"/></svg>Filters &amp; blocking</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-chat"/></svg>Reply, edit &amp; delete</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-box"/></svg>Photos &amp; files</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-refresh"/></svg>Multiple accounts</span>
        <span class="tag"><svg width="12" height="12"><use href="#i-spark"/></svg>Themes</span>
      </div>
    </div>
  </section>

  <!-- ── LICENSING ── -->
  <section id="licensing" class="panel">
    <div class="wrap split">
      <div class="rv">
        <span class="eyebrow">Licensing</span>
        <h2>Licensing, <em>fully automated.</em></h2>
        <p class="sub">Issued, renewed and validated without manual work.</p>
        <ul class="list">
          <li><svg><use href="#i-check"/></svg><span><b>Instant issue.</b> Customers receive their licence the moment they pay.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Renewals.</b> Processed automatically, even while you're offline.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Customer details.</b> Collect any required information after purchase.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Validation.</b> Verify licences directly from your software.</span></li>
        </ul>
      </div>
      <div class="lic rv" aria-label="Example licence">
        <div class="lic-in">
          <div class="lic-top">
            <div class="p">Licence<span>Customer · Telegram</span></div>
            <span class="badge"><i></i>Active</span>
          </div>
          <div class="serial">XXXX-XXXX-XXXX-XXXX</div>
          <div class="lic-rows">
            <div><span>Plan</span><b>Monthly</b></div>
            <div class="exp" id="exp"><span>Valid until</span><b id="expv">12 Oct 2026</b></div>
            <div><span>Renewal</span><b>Automatic</b></div>
          </div>
          <div class="lic-log">
            <div><svg><use href="#i-check"/></svg> Issued after payment<time>Sep 12</time></div>
            <div><svg><use href="#i-check"/></svg> Renewed automatically<time>just now</time></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── PAYMENTS ── -->
  <section id="payments" class="panel">
    <div class="wrap split">
      <div class="flow rv" aria-label="Payment flow">
        <div class="step"><div class="ic"><svg><use href="#i-chat"/></svg></div><div><b>Customer asks</b><span>Agent quotes a price</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-coin"/></svg></div><div><b>Invoice sent</b><span>BTC, ETH, USDT and more</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-shield"/></svg></div><div><b>Payment confirmed</b><span>Checked automatically</span></div><svg class="ck"><use href="#i-check"/></svg></div>
        <div class="join"></div>
        <div class="step"><div class="ic"><svg><use href="#i-box"/></svg></div><div><b>Order delivered</b><span>Key and files sent</span></div><svg class="ck"><use href="#i-check"/></svg></div>
      </div>
      <div class="rv">
        <span class="eyebrow">Payments</span>
        <h2>Crypto payments, <em>built in.</em></h2>
        <ul class="list">
          <li><svg><use href="#i-check"/></svg><span><b>Direct to your wallet.</b> Funds go to addresses you control.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Live pricing.</b> Converted at the current market rate.</span></li>
          <li><svg><use href="#i-check"/></svg><span><b>Late payments.</b> Detected and delivered automatically.</span></li>
        </ul>
        <div class="fee"><span class="fee-ic"><svg><use href="#i-shield"/></svg></span><span>Processed securely by <b>CryptAPI</b></span><span class="fee-pct">1% fee</span></div>
      </div>
    </div>
  </section>

  <!-- ── LANGUAGES ── -->
  <section id="languages" class="panel">
    <div class="wrap">
      <div class="hd c rv">
        <span class="eyebrow">Languages</span>
        <h2>Speaks your <em>customers' language.</em></h2>
        <p class="sub">Replies in 40+ languages, matched to each customer.</p>
      </div>
    </div>
    <div class="langs rv" aria-label="Examples of supported languages">
      <?php $half = (int)ceil(count($langs) / 2); $la = array_slice($langs, 0, $half); $lb = array_slice($langs, $half); ?>
      <div class="lane"><?php foreach (array_merge($la, $la) as $l): ?><span><?= $h($l) ?></span><?php endforeach; ?></div>
      <div class="lane r"><?php foreach (array_merge($lb, $lb) as $l): ?><span><?= $h($l) ?></span><?php endforeach; ?></div>
    </div>
    <div class="wrap lang-notes rv">
      <span class="tag"><i></i>Right-to-left scripts</span><span class="tag"><i></i>Switches language mid-chat</span>
    </div>
  </section>

  <!-- ── AI + PRIVACY ── -->
  <section id="ai" class="panel">
    <div class="wrap split">
      <div class="rv">
        <span class="eyebrow">AI</span>
        <h2>Your choice of <em>AI.</em></h2>
        <p class="sub">Use the built-in AI with no setup, or connect your own Gemini, OpenAI or Claude account.</p>
        <div class="ai3">
          <div class="prov prov-in"><span class="mark"><svg><use href="#i-mark"/></svg></span><div><b>Built-in</b><span>Ready to use</span></div></div>
          <div class="prov"><svg><use href="#l-gemini"/></svg><div><b>Gemini</b><span>Google</span></div></div>
          <div class="prov"><svg style="color:#e7eaf0"><use href="#l-openai"/></svg><div><b>GPT</b><span>OpenAI</span></div></div>
          <div class="prov"><svg><use href="#l-anthropic"/></svg><div><b>Claude</b><span>Anthropic</span></div></div>
        </div>
      </div>
      <div class="tile rv" style="grid-column:auto;padding:20px">
        <div class="ic"><svg><use href="#i-lock"/></svg></div>
        <h3>Privacy</h3>
        <p>Direct chats are end-to-end encrypted. Contacts can be deleted at any time.</p>
        <div class="viz"><span class="tag"><i></i>Encrypted</span><span class="tag"><i></i>Your wallets</span><span class="tag"><i></i>Contact page</span></div>
      </div>
    </div>
  </section>

  <!-- ── HOW IT WORKS ── -->
  <section id="how" class="panel">
    <div class="wrap">
      <div class="hd c rv">
        <span class="eyebrow">How it works</span>
        <h2>Set up <em>in minutes.</em></h2>
      </div>
      <div class="steps">
        <div class="tile rv"><div class="ic"><svg><use href="#i-tg"/></svg></div><h3>Connect</h3><p>Link a bot or share your contact page.</p></div>
        <div class="tile rv"><div class="ic"><svg><use href="#i-spark"/></svg></div><h3>Configure</h3><p>Add your products, wallet and your agent's tone.</p></div>
        <div class="tile rv"><div class="ic"><svg><use href="#i-moon"/></svg></div><h3>Launch</h3><p>Your agent handles the rest.</p></div>
      </div>
    </div>
  </section>

  <!-- ── CLOSING ── -->
  <section id="start" class="panel panel-end">
  <div class="wrap">
    <div class="finale rv">
      <div class="finale-in">
        <span class="mark mark-lg"><svg><use href="#i-mark"/></svg></span>
        <h2>Get started with <em class="brandname">booqi.</em></h2>
        <p class="sub">Create your first agent in minutes.</p>
        <div class="cta">
          <a class="btn btn-p" href="<?= $h($APP_URL) ?>"><?= $h($cta) ?> <svg><use href="#i-arrow"/></svg></a>
          <?php if ($DESKTOP_URL !== ''): ?>
          <a class="btn btn-g" href="<?= $h($DESKTOP_URL) ?>"><svg><use href="#i-down"/></svg> Desktop app</a>
          <?php else: ?>
          <a class="btn btn-g" href="#features">View features</a>
          <?php endif; ?>
        </div>
        <ul class="points">
          <li><svg><use href="#i-check"/></svg>Browser, desktop and mobile</li>
          <li><svg><use href="#i-check"/></svg>Built-in or your own AI</li>
          <li><svg><use href="#i-check"/></svg>Payments to your own wallet</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
</main>

<footer>
  <div class="wrap">
    <div class="f-top">
      <nav class="f-links" aria-label="Footer">
        <a href="#features">Features</a>
        <a href="#licensing">Licensing</a>
        <a href="#payments">Payments</a>
        <a href="#languages">Languages</a>
        <a href="<?= $h($APP_URL) ?>"><?= $signedIn ? 'Open app' : 'Sign in' ?></a>
      </nav>
      <div class="f-plat" aria-label="Works with Telegram, Discord and direct chats">
        <svg><use href="#i-tg"/></svg><svg><use href="#i-dc"/></svg><svg><use href="#i-lock"/></svg>
        <span class="sep"></span>
        <svg><use href="#l-gemini"/></svg><svg style="color:#c9ced8"><use href="#l-openai"/></svg><svg><use href="#l-anthropic"/></svg>
      </div>
    </div>
    <div class="f-bot">
      <span>© <?= date('Y') ?> booqi. All rights reserved.</span>
      <span>Crypto payments are processed by CryptAPI (1% per transaction).</span>
    </div>
  </div>
</footer>

<script>
// Reveal on scroll.
(function () {
  var els = document.querySelectorAll('.rv');
  if (!('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('in'); }); return; }
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { rootMargin: '0px 0px -6% 0px', threshold: .06 });
  els.forEach(function (e, i) { e.style.transitionDelay = (Math.min(i % 4, 3) * 50) + 'ms'; io.observe(e); });
})();
var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

// Section-by-section scrolling (mouse, trackpad and keyboard).
// One gesture moves one section, however long a trackpad keeps sending
// momentum. A section taller than the window scrolls normally until its
// edge, then the next gesture moves on.
(function () {
  if (!matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  var panels = Array.prototype.slice.call(document.querySelectorAll('.panel')), NAV = 0;
  var busy = false, last = 0;
  function tops() { return panels.map(function (p) { return p.offsetTop - NAV; }); }
  function current() {
    var y = scrollY + 4, T = tops(), i = 0;
    for (var k = 0; k < T.length; k++) if (T[k] <= y) i = k;
    return i;
  }
  function go(i) {
    var T = tops();
    i = Math.max(0, Math.min(T.length - 1, i));
    var y = i === T.length - 1 ? document.documentElement.scrollHeight - innerHeight : T[i];
    busy = true;
    window.scrollTo({ top: y, behavior: reduce ? 'auto' : 'smooth' });
    setTimeout(function () { busy = false; }, 800);
  }
  function edgeFree(dir) {
    var r = panels[current()].getBoundingClientRect();
    // A section only slightly taller than the window (its own padding) still
    // counts as fitting, as does the footer's height under the last one.
    var slack = Math.min(96, innerHeight * .11);
    return dir > 0 ? r.bottom <= innerHeight + slack : r.top >= NAV - slack;
  }
  // Each gesture (a flick of the wheel, one trackpad swipe with its
  // momentum) is decided once, when it starts: move to the next section,
  // or, inside a section with more to show, scroll it normally.
  var mode = 'native', jumped = false;
  addEventListener('wheel', function (e) {
    if (e.ctrlKey || Math.abs(e.deltaY) < Math.abs(e.deltaX)) return;
    var dir = e.deltaY > 0 ? 1 : -1;
    var now = Date.now(), gap = now - last; last = now;
    if (gap > 160) { mode = busy ? 'hold' : (edgeFree(dir) ? 'jump' : 'native'); jumped = false; }
    if (mode === 'native') return;
    e.preventDefault();
    var atEnd = dir > 0 && scrollY + innerHeight >= document.documentElement.scrollHeight - 2;
    if (mode === 'jump' && !jumped && !busy && !atEnd) { jumped = true; go(current() + dir); }
  }, { passive: false });
  addEventListener('keydown', function (e) {
    if (e.target && /input|textarea|select/i.test(e.target.tagName)) return;
    var k = e.key, dir = (k === 'PageDown' || k === 'ArrowDown' || (k === ' ' && !e.shiftKey)) ? 1
                      : (k === 'PageUp' || k === 'ArrowUp' || (k === ' ' && e.shiftKey)) ? -1 : 0;
    if (k === 'Home') { e.preventDefault(); return go(0); }
    if (k === 'End') { e.preventDefault(); return go(panels.length - 1); }
    if (!dir || !edgeFree(dir)) return;
    e.preventDefault(); if (!busy) go(current() + dir);
  });
})();

// Header: solid once the page moves, and the link of the section in view lit.
(function () {
  var nav = document.querySelector('.nav');
  var onScroll = function () { nav.classList.toggle('scrolled', scrollY > 8); };
  addEventListener('scroll', onScroll, { passive: true }); onScroll();
  var links = {};
  document.querySelectorAll('.links a').forEach(function (a) { links[a.getAttribute('href').slice(1)] = a; });
  if (!('IntersectionObserver' in window)) return;
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) {
      if (!e.isIntersecting) return;
      Object.keys(links).forEach(function (k) { links[k].removeAttribute('aria-current'); });
      if (links[e.target.id]) links[e.target.id].setAttribute('aria-current', 'true');
    });
  }, { rootMargin: '-45% 0px -45% 0px' });
  document.querySelectorAll('.panel').forEach(function (s) { io.observe(s); });
})();

// Cards: a soft light that follows the pointer.
(function () {
  if (reduce || !matchMedia('(hover: hover)').matches) return;
  document.querySelectorAll('.tile, .step, .prov').forEach(function (el) {
    el.addEventListener('pointermove', function (e) {
      var r = el.getBoundingClientRect();
      el.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      el.style.setProperty('--my', (e.clientY - r.top) + 'px');
    });
    el.addEventListener('pointerleave', function () { el.style.removeProperty('--mx'); el.style.removeProperty('--my'); });
  });
})();

// Demo chat, on a loop.
(function () {
  var items = Array.prototype.slice.call(document.querySelectorAll('#thread [data-t]'));
  var typing = document.getElementById('typing'), inv = document.getElementById('inv'), st = document.getElementById('invst');
  if (reduce) { items.forEach(function (b) { b.classList.add('on'); }); inv.classList.add('paid'); st.textContent = 'Paid · confirmed'; return; }
  var steps = [[0, 700], ['typing', 1300], [1, 900], [2, 1500], ['typing', 1200], [3, 500], [4, 2200], ['paid', 1300], ['typing', 1200], [5, 4200], ['reset', 600]];
  var i = 0;
  (function run() {
    var s = steps[i], w = s[0];
    typing.classList.remove('on');
    if (w === 'typing') { typing.parentNode.appendChild(typing); typing.classList.add('on'); }
    else if (w === 'paid') { inv.classList.add('paid'); st.textContent = 'Paid · confirmed'; }
    else if (w === 'reset') { items.forEach(function (b) { b.classList.remove('on'); }); inv.classList.remove('paid'); st.textContent = 'Waiting for payment'; }
    else items[w].classList.add('on');
    i = (i + 1) % steps.length;
    setTimeout(run, s[1]);
  })();
})();

// Ghost assistant: a question is typed, the ghost answers, next one.
(function () {
  var q = document.getElementById('ghq'), a = document.getElementById('gha'), at = document.getElementById('ght');
  var pairs = [
    ['who still owes me?', 'Two open invoices: Maya ($49) and Ken ($19).'],
    ['remind Ken about his renewal tomorrow', 'Scheduled. I\'ll message him at 10:00.'],
    ['how was this week?', 'Busier than last week. Want the full report?'],
    ['take the agent off Maya\'s chat', 'Done. That chat is yours now.'],
  ];
  if (reduce) { q.textContent = pairs[0][0]; at.textContent = pairs[0][1]; a.classList.add('on'); return; }
  var i = 0;
  (function next() {
    var p = pairs[i], c = 0;
    a.classList.remove('on'); q.textContent = '';
    (function type() {
      q.textContent = p[0].slice(0, ++c);
      if (c < p[0].length) return setTimeout(type, 42);
      setTimeout(function () { at.textContent = p[1]; a.classList.add('on'); }, 700);
      setTimeout(function () { i = (i + 1) % pairs.length; next(); }, 4200);
    })();
  })();
})();

// Licence card: the renewal lands (same key, later date).
(function () {
  var exp = document.getElementById('exp'), v = document.getElementById('expv');
  if (reduce) { v.textContent = '11 Nov 2026'; return; }
  var on = false;
  setInterval(function () { on = !on; v.textContent = on ? '11 Nov 2026' : '12 Oct 2026'; exp.classList.toggle('bump', on); }, 3200);
})();
</script>
</body>
</html>
