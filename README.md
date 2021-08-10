# WP Plugin Setup

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


### Files and folders ignored
- vendor/
- dist/
- node_modules/

## File Tree
```
'
'  |-- app/                                     # MVC Directory
'  |   |-- Controllers/                         # All plugin controllers
'  |   |   |-- InterfaceController.php          # Controller Interface
'  |   |   |-- Menus.php
'  |   |   |-- RenderHtml.php                   # Create the method that renders views
'  |   |   |-- Menus
'  |   |   |   |-- About.php
'  |   |-- Helpers/                             # All plugin classes and helper files
'  |   |   |-- Config.php                       # Page controller settings
'  |   |   |-- Hooks.php                        # Plugin actions and filters
'  |   |   |-- Utils.php                        # Statics methods and function 
'  |   |-- Model/
'  |   |   |-- index.php
'  |   |-- Views/                               # All the plugin pages
'  |   |   |-- about.php
'  |   |   |-- index.php
'  |   |   |-- template-parts                   # Templates parts
'  |   |   |   |-- header.php
'  |   |-- index.php                            # Plugin Index
'  |-- resources/                               # Plugin resources
'  |   |-- images/
'  |   |   |-- index.php
'  |   |-- scripts/
'  |   |   |-- admin/
'  |   |   |   |-- index.js
'  |   |   |-- theme/
'  |   |   |   |-- index.js
'  |   |-- styles/
'  |   |   |-- admin/
'  |   |   |   |-- _variaveis.scss
'  |   |   |   |-- index.scss
'  |   |   |-- theme/
'  |   |   |   |-- _variaveis.scss
'  |   |   |   |-- index.scss
'  |-- .gitignore
'  |-- LICENSE                                  # GPL-3 Licensce
'  |-- README.md
'  |-- composer.json
'  |-- package.json
'  |-- readme.txt
'  |-- wp-plugin-setup.php
''

```
