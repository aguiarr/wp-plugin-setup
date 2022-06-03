# WordPress Plugin Template
### Version: 1.0.0

## Installing the dependencies
**Install the plugin autoload and dependencies with the composer**
``` 
composer install
```

**Install the node dependencies with the yarn or npm**
``` 
yarn install
npm install
```


### Ignored folders
- vendor/
- dist/
- node_modules/
- .cache/

### Ignored files
- *.lock


## File Tree
```
.
├── app
│   ├── Controllers
│   │   ├── Actions
│   │   │   └── index.php
│   │   ├── InterfaceController.php
│   │   ├── Menus
│   │   │   └── About.php
│   │   ├── Menus.php
│   │   ├── Pages
│   │   │   └── index.php
│   │   └── RenderHtml.php
│   ├── Helpers
│   │   ├── Config.php
│   │   ├── Functions.php
│   │   ├── Hooks.php
│   │   └── Utils.php
│   ├── index.php
│   ├── Model
│   │   ├── index.php
│   │   ├── Infrastructure
│   │   │   └── Tables.php
│   │   └── Options.php
│   ├── Services
│   │   └── index.php
│   └── Views
│       ├── Admin
│       │   ├── about.php
│       │   ├── index.php
│       │   └── template-parts
│       │       └── header.php
│       └── Pages
│           ├── index.php
│           └── template-parts
│               └── header.php
├── composer.json
├── LICENSE
├── package.json
├── README.md
├── readme.txt
├── resources
│   ├── admin.js
│   ├── images
│   │   └── index.php
│   ├── scripts
│   │   ├── admin
│   │   │   └── index.js
│   │   └── theme
│   │       └── index.js
│   ├── styles
│   │   ├── admin
│   │   │   ├── index.scss
│   │   │   └── _variaveis.scss
│   │   └── theme
│   │       ├── index.scss
│   │       └── _variaveis.scss
│   └── theme.js
└── wp-plugin-template.php


```
