import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';

const jsPath = path.resolve(__dirname, 'resources/js');
const stylePath = path.resolve(__dirname, 'resources/css');

function getAllFiles(dir, files = []) {
    fs.readdirSync(dir).forEach(file => {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            getAllFiles(fullPath, files);
        } else if (file.endsWith('.js') || file.endsWith('.css')) {
            files.push(`resources/js/${path.relative(jsPath, fullPath)}`);
        }
    });
    return files;
}

const jsFiles = getAllFiles(jsPath);
const styleFiles = getAllFiles(stylePath);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...styleFiles,
                ...jsFiles
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: ['bootstrap'],
    },
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
});
