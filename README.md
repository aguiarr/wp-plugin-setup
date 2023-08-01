# WordPress Plugin Template

**Description:** Template for WordPress plugins

## Anchors
- [Developer notes](#notes)
- [Install dependencies](#install)
- [Build dependencies](#build)
- [Ignored folders and files](#ignore)
- [File Tree](#tree)



<h2 id="notes">Developer notes</h1>

This is a template developed to facilitate the creation of plugins for the WordPress platform. It uses an adapted MVC pattern for a better development experience within the WordPress environment.

The plugin uses Typescript to develop features for Javascript. This is also optional and if necessary the files can be exchanged for Javascript files.
</br>
**Author:** [Matheus Aguiar](https://github.com/devaguia)
</br>

<h2 id="install">Installing the dependencies</h1>

**Install the plugin autoload and dependencies with the composer**
``` 
composer install
```

**Install the node dependencies with the yarn or npm**
``` 
yarn install
npm install
```

<h2 id="build">Build dependencies</h2>

**Build production and watch the resource page changes**
```
yarn watch
```

**Build production assets**
```
yarn build
```

<h2 id="ignore">Ignored folders and files</h2>

**Folders**
- vendor/
- dist/
- node_modules/
- .cache/

**Files**
- *.lock


<h2 id="tree">File Tree</h2>

```
.
├── app
│   ├── Controllers
│   │   ├── Entities
│   │   ├── Menus
│   │   │   └── About.php
│   │   ├── Menus.php
│   │   ├── Pages
│   │   ├── Render
│   │   │   ├── InterfaceRender.php
│   │   │   └── Render.php
│   │   └── WordPress
│   │       ├── Option.php
│   │       └── PostMeta.php
│   ├── Helpers
│   │   ├── Config.php
│   │   ├── Uninstall.php
│   │   └── Utils.php
│   ├── Hooks
│   │   ├── Functions.php
│   │   └── Hooks.php
│   ├── index.php
│   ├── Model
│   │   ├── Database
│   │   │   ├── Bootstrap.php
│   │   │   └── Tables
│   │   │       └── Example.php
│   │   └── Example.php
│   ├── Services
│   └── Views
│       ├── Admin
│       │   ├── about.php
│       │   └── template-parts
│       │       ├── footer.php
│       │       └── header.php
│       └── Pages
│           └── template-parts
│               ├── footer.php
│               └── header.php
├── composer.json
├── LICENSE
├── package.json
├── README.md
├── readme.txt
├── resources
│   ├── admin.ts
│   ├── global.ts
│   ├── images
│   │   └── cb-icon.png
│   ├── scripts
│   │   ├── admin
│   │   │   ├── components
│   │   │   │   └── Notification
│   │   │   │       └── index.ts
│   │   │   ├── index.ts
│   │   │   └── pages
│   │   │       └── About
│   │   │           └── index.ts
│   │   ├── global
│   │   │   ├── components
│   │   │   │   └── index.ts
│   │   │   └── index.ts
│   │   └── theme
│   │       ├── components
│   │       │   └── index.ts
│   │       ├── index.ts
│   │       └── pages
│   │           └── index.ts
│   ├── styles
│   │   ├── admin
│   │   │   ├── base
│   │   │   │   ├── index.scss
│   │   │   │   └── _vars.scss
│   │   │   ├── components
│   │   │   │   ├── _container.scss
│   │   │   │   ├── index.scss
│   │   │   │   ├── _notification.scss
│   │   │   │   └── _title.scss
│   │   │   └── index.scss
│   │   ├── global
│   │   │   ├── base
│   │   │   │   ├── index.scss
│   │   │   │   └── _vars.scss
│   │   │   ├── components
│   │   │   │   └── index.scss
│   │   │   └── index.scss
│   │   └── theme
│   │       ├── base
│   │       │   ├── index.scss
│   │       │   └── _vars.scss
│   │       ├── components
│   │       │   └── index.scss
│   │       └── index.scss
│   └── theme.ts
├── tsconfig.json
└── wp-plugin-template.php

```

