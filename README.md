# Using The Best Reloaded Theme Package

This theme uses NPM and Grunt to run various development and build tasks. To get started you will need to install the dependencies. You may already have grunt-cli installed globally.

```
npm install grunt-cli -g
npm install
```

Then you can run the Grunt tasks. The initial build task handles copying of the Bootstrap 4 sourcefiles (they are installed during 'npm install') into the theme from the node_modules directory. It will also process them and finally it will combine & minify the Bootstrap, and the main themes, styles/scripts.

## All Available Grunt Tasks

```
# This is the initial build task. It copies source files from inside 'node_modules/' into the theme and processes all styles and scripts.
# The full build task exists primarily to deal with Bootstrap files. You must run this once to pull Bootstrap source files into the directory and process them.
# After that you will only need to run this again if Bootstrap source files change - such as if you update the version in package.json and run npm-install again
grunt build

# This processes only styles and scripts of the theme only - no Bootstrap files.
grunt theme

# The default task is configured the same as the 'grunt theme' task
grunt

# This deals with building a WPORG distributable version of the theme - it copies only the files required and no dev files or directories. The built theme will be found inside the 'dist/' folder.
grunt dist
```

## Working Directories

The styles and scripts to be modified can be found inside the `assets/src` dirctory. This is the working dirctory and are used as the sourcefiles to build the final versions used by the theme. Final versions are output to `assets/css` and `assets/js` and should not be directly modified in development.

## Build Process Overview

Grunt is used to perform many actions that automate several useful tasks for theme development. The base systems use configurations that emulate closely what BootStrap 4 uses in their build systems. That way I can ensure that the processed Bootstrap files give the same results as the ones available through their pre-built package. It's also a well tested and though through build process.

### Styles:

Both the theme styles and Bootstrap styles use SASS as the pre-processessor. They are processed into 2 seporate files - the Bootstrap stylesheet and the theme stylesheet.

Once the files are turned into CSS postcss is used to apply flex fixes for IE. Finally it uses autoprefixer to make the styles cross-browser compatable.

The autoprefixer config is as follows:

```
browsers: [
  'Chrome >= 35',
  'Firefox >= 38',
  'Edge >= 12',
  'Explorer >= 10',
  'iOS >= 8',
  'Safari >= 8',
  'Android 2.3',
  'Android >= 4',
  'Opera >= 12'
]
```
### Scripts:

Bootstrap scripts are processed with babel (for es2015-module-strip support) then they are combined and minified.

Theme scripts are combined and minified from assets/src/js directory.

## Theme Versioning:

The Version number only needs set in `package.json`. The `dist` task handles updating the version number in style.css and assets/css/style.css during it's copy process.

In development the version is set to `{{ VERSION }}`, the dist package gets updated with correct version numbers.
