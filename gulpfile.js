/**
 * Include Gulp & tools to use
 */
var gulp = require("gulp");
var sass = require("gulp-sass")(require("sass"));
var browserSync = require("browser-sync").create();

/**
 * configs
 */
var config = {
  url: "soapatricknine.local/",
  scssSrc: "./assets/scss/*.scss",
  scssDest: "./assets/css",
};

/**
 * compile sass for development
 */
gulp.task("sass", function () {
  return gulp
    .src(config.scssSrc)
    .pipe(
      sass
        .sync({ errLogToConsole: true, outputStyle: "expanded" })
        .on("error", sass.logError)
    )
    .pipe(gulp.dest(config.scssDest))
    .pipe(browserSync.stream({ match: "**/*.css" }));
});

/**
 * compile sass for deployment
 */
gulp.task("default", function () {
  return gulp
    .src(config.scssSrc)
    .pipe(sass.sync({ outputStyle: "expanded" }).on("error", sass.logError))
    .pipe(gulp.dest(config.scssDest));
});

/**
 * watch task with browser reload
 */
gulp.task("watch", function () {
  browserSync.init({
    proxy: config.url,
    injectChanges: true,
    notify: false,
  });

  gulp.watch(["./assets/scss/**/*.scss"], gulp.series("sass"));
  gulp.watch(["./assets/js/**/*.js"]).on("change", browserSync.reload);
  gulp.watch(["./**/*.php"]).on("change", browserSync.reload);
});
