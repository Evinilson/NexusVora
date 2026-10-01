import { createRequire } from 'node:module';
import { spawn } from 'node:child_process';
import { pathToFileURL } from 'node:url';
import { fileURLToPath } from 'node:url';
import path from 'node:path';

const require = createRequire(import.meta.url);
const { chromium } = require('/Users/evinilson/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const here = path.dirname(fileURLToPath(import.meta.url));
const input = path.join(here, 'story-nexusvora-original.html');
const output = path.join(here, 'nexusvora-story-original-15s.mp4');
const browser = await chromium.launch({ executablePath: '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome', headless: true, args: ['--no-sandbox'] });
const page = await browser.newPage({ viewport: { width: 540, height: 960 }, deviceScaleFactor: 1 });
await page.goto(pathToFileURL(input).href + '?export');
const ff = spawn('ffmpeg', ['-y', '-hide_banner', '-loglevel', 'error', '-f', 'image2pipe', '-framerate', '30', '-vcodec', 'png', '-i', 'pipe:0', '-vf', 'scale=1080:1920:flags=lanczos', '-c:v', 'libx264', '-preset', 'medium', '-crf', '18', '-pix_fmt', 'yuv420p', '-movflags', '+faststart', output]);
ff.stderr.on('data', chunk => process.stderr.write(chunk));
for (let frame = 0; frame < 450; frame++) {
  const bytes = await page.evaluate(t => {
    window.renderAt(t);
    return document.querySelector('canvas').toDataURL('image/png').split(',')[1];
  }, frame / 30);
  const buffer = Buffer.from(bytes, 'base64');
  if (!ff.stdin.write(buffer)) await new Promise(resolve => ff.stdin.once('drain', resolve));
  if (frame % 90 === 0) process.stdout.write(`${frame / 30}s rendered\n`);
}
ff.stdin.end();
await new Promise((resolve, reject) => ff.on('close', code => code === 0 ? resolve() : reject(new Error(`ffmpeg exited ${code}`))));
await browser.close();
console.log(output);
