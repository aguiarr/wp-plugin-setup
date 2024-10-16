const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const fs = require('fs');

const blocksDir = path.resolve(__dirname, 'assets/react/pages');

const getDirectories = source =>
    fs.readdirSync(source, { withFileTypes: true })
      .filter(dirent => dirent.isDirectory())
      .map(dirent => dirent.name);

const entries = getDirectories(blocksDir).reduce((acc, folder) => {
    const blockPath = path.resolve(blocksDir, folder, 'index.tsx');
    acc[`${folder}`] = blockPath;
    return acc;
}, {});

module.exports = {
    ...defaultConfig,
    entry: entries,
    output: {
        path: path.resolve(__dirname, 'dist/react/pages/'),
        filename: ({ chunk }) => {
            const folderName = chunk.name;
            return `${folderName}/index.js`;
        },
    },
};
