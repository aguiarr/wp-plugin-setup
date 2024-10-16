import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';

document.addEventListener('DOMContentLoaded', () => {
    const rootElement = document.getElementById('wpt-menu-settings');

    if (rootElement) {
        const root = ReactDOM.createRoot(rootElement as HTMLElement);
        root.render(<App />);
    }
});
