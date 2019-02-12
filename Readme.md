## Initials
- Theme Name: The solar Bvillages
- Theme URI: [The Solar Village](http://github.com/kshitijbhatt/solarvillage)
- Author: Auroville Consulting
- Author URI: http://www.github.com/kshitijbhatt
- GitHub Theme URI: kshitijbhatt/solarvillage
- Description: A custom WordPress theme build for solar village search engine
- Version: 1.0.7

- This theme, like WordPress, is licensed under the GPL.

## Changelog
            > We will be updating changelog every monday for the team to work on together

## Basic Features


## Starter Theme + HTML Framework = WordPress Theme Framework


## Confused by All the CSS and Sass Files?

Some basics about the Sass and CSS files that come with UnderStrap:
- The theme itself uses the `/style.css`file just to identify the theme inside of WordPress. The file is not loaded by the theme and does not include any styles.
- The `/css/theme.css` and it´s minified little brother `/css/theme.min.css` file(s) provides all styles. It is composed of five different SCSS sets and one variable file at `/sass/theme.scss`:

                  - 1 "src/theme/theme_variables";  // <--------- Add your variables into this file. Also add variables to overwrite Bootstrap or UnderStrap variables here
                  - 2 "src/bootstrap-sass/bootstrap";  // <--------- All the Bootstrap stuff - Don´t edit this!
                  - 3 "src/combiner"; // <--------- Some basic WordPress stylings and needed styles to combine Boostrap and Solar Village
                  - 4 "/src/fontawesome/scss/font-awesome"; // <--------- Font Awesome Icon styles

                  // Any additional imported files //
                  - 5 "src/theme/theme";  // <--------- Add your styles into this file

- Don’t edit the files if you do not understand the structure

- Your design goes into: `src/theme`. Add your styles to the `/theme/theme/_theme.scss` file and your variables to the `src/theme/_theme_variables.scss`. Or add other .scss files into it and `@import` it into `/src/theme/_theme.scss`.

## Installation

- Download the folder from GitHub
- Upload it into your WordPress installation subfolder here: `/wp-content/themes/`
- Login to your WordPress backend
- Go to Appearance → Themes
- Activate the UnderStrap theme

## Developing With npm, Gulp and SASS and [Browser Sync][1]

### Installing Dependencies
- Make sure you have installed Node.js and Browser-Sync* (* optional, if you wanna use it) on your computer globally
- Then open your terminal and browse to the location of your theme
- Run: `$ npm install` and then: `$ gulp copy-assets`

### Running
To work and compile your Sass files on the fly start:

- `$ gulp watch`
