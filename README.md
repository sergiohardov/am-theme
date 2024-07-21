# Test work for Already Media

## Requirements

**Wordpress**: *6.6*  
**PHP**: *8.2.0*  
**Node.js**: *20.12.2*  
**Composer**: *2.7.2*  

## Expand Project
1) Install node modules

```bash
npm i
```
2) Install composer
```bash
composer i
```

3) Run dev mode
```bash
npm run dev
```

4) To build assets
```bash
npm run build
```

## Structure Description

**assets** - Generated automatically in dev/build mode. Contains compiled styles/scripts/fonts, etc.  
**data/acf-json** - Contains JSON data of ACF objects created from the admin panel. [Documentation](https://www.advancedcustomfields.com/resources/local-json/ "Documentation").   
**includes** - Contains the main logic and functionality. An autoloader is connected to the folder.  
**languages** - WP Codex.  
**node_modules** - NPM packages.  
**plugins** - Contains zip archives of plugins that are required to be installed. To add a plugin to the installation list, you need to add it in the `muplugins` method of the `Setup` file.  
**sources** - Folder processed by Gulp. For SCSS and JS, files whose names start with `_` will not be compiled as standalone files. These files need to be imported.  
**vendor** - Composer packages.  
**views** - The folder contains Twig templates.  

