const { src, dest, parallel } = require('gulp');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const concat = require('gulp-concat');

function css(){
  return src('./assets/sass/**/*.scss')
  .pipe(sass())
  .pipe(minifyCSS())
  .pipe(concat('./style.min.css'))
  .pipe(dest('./assets/css/'));
}

function js() {
  return src('./assets/js/*.js', { sourcemaps: true })
    .pipe(concat('./app.min.js'))
    .pipe(dest('./assets/js', { sourcemaps: true }))
}

 
exports.js = js;
exports.css = css;
exports.default = parallel(css, js);