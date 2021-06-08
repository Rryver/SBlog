const {src, dest, watch, parallel, series} = require('gulp');

const less = require('gulp-less');
const path = require('path');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const del = require('del');


const F_webDir = 'web/';

const F_lessDir = F_webDir + 'less/';
const F_lessMainFile = F_lessDir + 'style.less';

const F_destCssDir = F_webDir + 'css/';
const F_destCssMinDir = F_webDir + 'css-min/';

const F_imagesDir = F_webDir + 'images/';
const F_jsDir = F_webDir + 'js/';
const F_fonts = F_webDir + 'fonts/';
const F_views = F_webDir + 'views/';

function browsersync() {
    browserSync.init({
        proxy: "localhost/SBlog/web",
        browser: 'chrome',
        // server: {
        //         //     baseDir: F_webDir
        //         // }
    });
}

function cleanDist() {
    return del('dist')
}

function images() {
    return src(F_imagesDir + '**/*')
        .pipe(imagemin(
            [
                imagemin.gifsicle({interlaced: true}),
                imagemin.mozjpeg({quality: 75, progressive: true}),
                imagemin.optipng({optimizationLevel: 5}),
                imagemin.svgo({
                    plugins: [
                        {removeViewBox: true},
                        {cleanupIDs: false}
                    ]
                })
            ]
        ))
        .pipe(dest(F_imagesDir + 'dist/images'))
}

function scripts() {
    return src([
        'node_modules/jquery/dist/jquery.js',
        F_jsDir + 'main.js',
    ])
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(dest(F_jsDir))
        .pipe(browserSync.stream())
}


function styles() {
    return src(F_lessMainFile)
        .pipe(less())
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 10 version'],
            grid: true
        }))
        .pipe(dest(F_destCssDir))
        .pipe(browserSync.stream())
}

function build() {
    return src([
        F_destCssMinDir + 'style.min.css',
        F_fonts + '**/*',
        F_jsDir + 'main.min.js',
        F_views + '**/*.php',
    ], {base: 'app'})
        .pipe(dest('dist'))
}

function watching() {
    watch([F_lessDir + '**/*.less'], styles);
    watch([F_jsDir + '**/*.js', '!' + F_jsDir + 'main.min.js'], scripts);
    watch([F_views + '**/*.php']).on('change', browserSync.reload);
}

exports.styles = styles;
exports.watching = watching;
exports.browsersync = browsersync;
exports.scripts = scripts;
exports.images = images;
exports.cleanDist = cleanDist;


exports.build = series(cleanDist, images, build);
exports.default = parallel(styles, scripts, browsersync, watching);


