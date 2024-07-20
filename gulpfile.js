// Node.js: 20.12.2

/* Imports */
// Plugins
import gulp from "gulp";
import browsersync from "browser-sync";
import plumber from "gulp-plumber";
import notify from "gulp-notify";
import rename from "gulp-rename";

// Reset
import { deleteAsync } from "del";

// SCSS
import * as dartSass from "sass";
import gulpSass from "gulp-sass";
import cssmin from "gulp-clean-css";
import autoprefixer from "gulp-autoprefixer";
import media from "gulp-group-css-media-queries";

// JS
import webpack from "webpack-stream";
import named from "vinyl-named-with-path";

/* Constants */
const domain = "http://localhost:8888/test-work.loc/";
const abspath = "./";
const paths = {
  assets: {
    base: abspath + "assets/",
    libs: abspath + "assets/libs/",
    fonts: abspath + "assets/fonts/",
    img: abspath + "assets/img/",
    css: abspath + "assets/css/",
    js: abspath + "assets/js/",
  },
  sources: {
    base: abspath + "sources/",
    libs: abspath + "sources/libs/",
    fonts: abspath + "sources/fonts/",
    img: abspath + "sources/img/",
    scss: abspath + "sources/scss/",
    js: abspath + "sources/js/",
  },
};

/* Tasks */
const reset = () => {
  return deleteAsync(paths.assets.base);
};
const php = (done) => {
  browsersync.reload();
  done();
};
const libs = () => {
  return gulp
    .src(paths.sources.libs + "**/*.*", { encoding: false })
    .pipe(
      plumber(
        notify.onError({
          title: "LIBS",
          message: "Error: <%= error.message %>",
        })
      )
    )
    .pipe(gulp.dest(paths.assets.libs))
    .pipe(browsersync.stream());
};
const fonts = () => {
  return gulp
    .src(paths.sources.fonts + "**/*.*", { encoding: false })
    .pipe(
      plumber(
        notify.onError({
          title: "FONTS",
          message: "Error: <%= error.message %>",
        })
      )
    )
    .pipe(gulp.dest(paths.assets.fonts))
    .pipe(browsersync.stream());
};
const img = () => {
  return gulp
    .src(paths.sources.img + "**/*.*", { encoding: false })
    .pipe(
      plumber(
        notify.onError({
          title: "IMG",
          message: "Error: <%= error.message %>",
        })
      )
    )
    .pipe(gulp.dest(paths.assets.img))
    .pipe(browsersync.stream());
};
const scss = () => {
  const sass = gulpSass(dartSass);

  return gulp
    .src(
      [
        paths.sources.scss + "mainstyle.scss",
        paths.sources.scss + "singles/**/*.scss",
      ],
      {
        sourcemaps: true,
      }
    )
    .pipe(
      plumber(
        notify.onError({
          title: "SCSS",
          message: "Error: <%= error.message %>",
        })
      )
    )
    .pipe(
      sass({
        outputStyle: "expanded",
      })
    )
    .pipe(media())
    .pipe(
      autoprefixer({
        grid: true,
        overrideBrowserList: ["last 3 versions"],
        cascade: true,
      })
    )
    .pipe(gulp.dest(paths.assets.css)) // save normal css
    .pipe(cssmin({ level: 0 }))
    .pipe(
      rename({
        extname: ".min.css",
      })
    )
    .pipe(gulp.dest(paths.assets.css)) // save min css
    .pipe(browsersync.stream());
};
const js = () => {
  return (
    gulp
      .src(
        [
          paths.sources.js + "mainscript.js",
          paths.sources.js + "singles/**/*.js",
        ],
        { sourcemaps: true }
      )
      .pipe(
        plumber(
          notify.onError({
            title: "JS",
            message: "Error: <%= error.message %>",
          })
        )
      )

      //   Save original js
      .pipe(named())
      .pipe(
        webpack({
          mode: "production",
          optimization: {
            minimize: false,
          },
        })
      )
      .pipe(gulp.dest(paths.assets.js))

      // Production js
      .pipe(named())
      .pipe(
        webpack({
          mode: "production",
        })
      )
      .pipe(
        rename({
          extname: ".min.js",
        })
      )
      .pipe(gulp.dest(paths.assets.js))
      .pipe(browsersync.stream())
  );
};
const watcher = () => {
  gulp.watch(abspath + "**/*.php", php);
  gulp.watch(paths.sources.base + "**/*.scss", scss);
  gulp.watch(paths.sources.base + "**/*.js", js);
};
const server = (done) => {
  browsersync.init({
    proxy: domain,
    notify: true,
    open: false,
  });
};

/* Commands */
gulp.task(
  "dev",
  gulp.series(reset, libs, fonts, img, scss, js, gulp.parallel(watcher, server))
);
gulp.task("build", gulp.series(reset, libs, fonts, img, scss, js));
