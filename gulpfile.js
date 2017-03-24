var gulp = require('gulp');
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var cleanCss = require('gulp-clean-css');


gulp.task('pack-js',  function () {  
  return gulp.src(['public/js/*.js', 'public/plugins/*.js'])
    .pipe(concat('bundle.js'))
    .pipe(minify({
        ext:{
            min:'.js'
        },
        noSource: true
    }))    
    .pipe(gulp.dest('public/build/js'))
    
});

gulp.task('pack-css', function () {  
  return gulp.src(['public/css/*.css', 'public/plugins/*.css'])
    .pipe(concat('stylesheet.css'))
    .pipe(cleanCss())    
    .pipe(gulp.dest('public/build/css'))
    
});


gulp.task('default', ['pack-js', 'pack-css']);