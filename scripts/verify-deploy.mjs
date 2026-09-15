/**
 * Deploy verification: does the live site actually serve the current build?
 *
 * The pod runs opcache with validate_timestamps=0, and deploy.sh reports
 * success even when its Apache reload fails. Both of those mean "the deploy
 * command ran" is not evidence that anything shipped. This checks the rendered
 * pages instead.
 *
 *   node scripts/verify-deploy.mjs                     # check production
 *   node scripts/verify-deploy.mjs http://127.0.0.1:8000
 */
import { chromium } from 'playwright';

const BASE = (process.argv[2] || 'https://shifttechgs.com').replace(/\/$/, '');

// Markers that only exist in the design-system build.
const PAGES = [
    { path: '/',        expect: ['.say-hello__cta', '.cta-reassure'] },
    { path: '/work',    expect: ['.is-work .hero-head', '.work-hero-stats'] },
    { path: '/contact', expect: ['.is-contact', '.cta-reassure--hero'] },
    { path: '/agency',  expect: ['.is-agency .hero-head'] },
    { path: '/blog',    expect: ['.is-blog'] },
    { path: '/services/custom-software-development', expect: ['.is-service .hero-head'] },
    { path: '/work/payhouse-finance-platform',       expect: ['.cs-hero', '.cs-facts'] },
];

const browser = await chromium.launch();
const page = await browser.newPage({ viewport: { width: 1440, height: 900 } });

let failures = 0;
console.log(`\nVerifying ${BASE}\n${'='.repeat(60)}`);

for (const { path, expect } of PAGES) {
    const res = await page.goto(BASE + path, { waitUntil: 'domcontentloaded', timeout: 30000 });
    const missing = [];
    for (const sel of expect) {
        if (await page.locator(sel).count() === 0) missing.push(sel);
    }
    // An old build still ships the retired CTA label.
    const oldLabel = await page.locator('text=Book a Free Discovery Call').count();

    const ok = missing.length === 0 && oldLabel === 0;
    if (!ok) failures++;
    console.log(
        `${ok ? 'PASS' : 'FAIL'}  ${String(res.status()).padEnd(4)} ${path}` +
        (missing.length ? `\n        missing: ${missing.join(', ')}` : '') +
        (oldLabel ? `\n        still shows the old "Book a Free Discovery Call" label (x${oldLabel})` : '')
    );
}

// The stylesheet is served straight from disk, so a stale one here means the
// files never landed — which is a different failure from a missed opcache
// reload, where the CSS would be current but the PHP output stale.
const css = await (await fetch(`${BASE}/assets/css/shifttech.min.css`)).text();
const cssCurrent = css.includes('.is-service') && css.includes('.cs-hero');
console.log(`\n${cssCurrent ? 'PASS' : 'FAIL'}  stylesheet on disk is ${cssCurrent ? 'current' : 'STALE'}`);

console.log('='.repeat(60));
if (failures || !cssCurrent) {
    console.log(
        !cssCurrent
            ? 'Files never reached the pod: the deploy did not run.\n'
            : 'Files are on the pod but pages are stale: Apache was not reloaded.\n'
    );
} else {
    console.log('Live site is serving the current build.\n');
}

await browser.close();
process.exit(failures || !cssCurrent ? 1 : 0);
