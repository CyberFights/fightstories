import { copyFile, mkdir } from 'node:fs/promises';
import { resolve, join } from 'node:path';

const root = resolve(import.meta.dirname, '..');
const assets = join(root, 'wordpress-theme', 'pin-and-plow', 'assets');
await mkdir(join(assets, 'fonts'), { recursive: true });
await mkdir(join(assets, 'licenses'), { recursive: true });

// Keep the WordPress theme self-contained while sharing the visual CSS with
// the standalone Vite site. Run this whenever src/style.css changes.
await copyFile(join(root, 'src', 'style.css'), join(assets, 'site.css'));
await copyFile(join(root, 'public', 'press-badge.png'), join(assets, 'press-badge.png'));

for (const [family, names] of [
  ['anton', ['anton-latin-400-normal.woff2']],
  ['dm-sans', ['dm-sans-latin-400-normal.woff2', 'dm-sans-latin-500-normal.woff2', 'dm-sans-latin-600-normal.woff2']],
  ['ibm-plex-mono', ['ibm-plex-mono-latin-400-normal.woff2']],
]) {
  const source = join(root, 'node_modules', '@fontsource', family);
  for (const name of names) await copyFile(join(source, 'files', name), join(assets, 'fonts', name));
  await copyFile(join(source, 'LICENSE'), join(assets, 'licenses', `${family}-LICENSE`));
}
console.log('WordPress theme assets updated in wordpress-theme/pin-and-plow');
