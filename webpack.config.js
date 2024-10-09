const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const WooCommerceDependencyExtractionWebpackPlugin = require('@woocommerce/dependency-extraction-webpack-plugin');
const path = require('path');

const wcDepMap = {
    '@woocommerce/blocks-registry': ['wc', 'wcBlocksRegistry'],
    '@woocommerce/settings'       : ['wc', 'wcSettings']
};

const wcHandleMap = {
    '@woocommerce/blocks-registry': 'wc-blocks-registry',
    '@woocommerce/settings'       : 'wc-settings'
};

const requestToExternal = (request) => {
    if (wcDepMap[request]) {
        return wcDepMap[request];
    }
};

const requestToHandle = (request) => {
    if (wcHandleMap[request]) {
        return wcHandleMap[request];
    }
};

// Export configuration.
module.exports = {
    ...defaultConfig,
    entry: {
        'pix': '/assets/blocks/gateways/pix/index.jsx',
        'credit': '/assets/blocks/gateways/credit/index.jsx',
        'billet': '/assets/blocks/gateways/billet/index.jsx',
        'bolepix': '/assets/blocks/gateways/bolepix/index.jsx',
        'transfer': '/assets/blocks/gateways/transfer/index.jsx',
        'person-type': '/assets/blocks/components/PersonType/index.jsx',
    },
    output: {
        path: path.resolve( __dirname, 'dist/blocks' ),
        filename: '[name]/index.js',
    },
    plugins: [
        ...defaultConfig.plugins.filter(
            (plugin) =>
                plugin.constructor.name !== 'DependencyExtractionWebpackPlugin'
        ),
        new WooCommerceDependencyExtractionWebpackPlugin({
            requestToExternal,
            requestToHandle
        })
    ]
};
