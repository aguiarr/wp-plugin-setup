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
'  |   |   |-- Actions/
'  |   |   |   |-- index.php
'  |   |   |-- InterfaceController.php          # Controller Interface
'  |   |   |-- Menus.php
'  |   |   |-- Menus/
'  |   |   |   |-- About.php
'  |   |   |-- Pages/
'  |   |   |   |-- index.php
'  |   |   |-- RenderHtml.php                   # Create the method that renders views
'  |   |-- Helpers/                             # All plugin classes and helper files
'  |   |   |-- Config.php                       # Page controller settings
'  |   |   |-- Functions.php                    
'  |   |   |-- Hooks.php                        # Plugin actions and filters
'  |   |   |-- Utils.php                        # Statics methods and function 
'  |   |-- Model/
'  |   |   |-- index.php
'  |   |-- Views/                               # All the plugin pages
'  |   |   |-- Admin/
'  |   |   |   |-- template-parts/
'  |   |   |   |  |-- header.php
'  |   |   |   |-- index.php
'  |   |   |   |-- about.php
'  |   |   |-- Pages/
'  |   |   |   |-- template-parts/
'  |   |   |   |  |-- header.php
'  |   |   |-- index.php
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
'  |   |   |   |-- index.scss
'  |   |   |-- theme/
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
