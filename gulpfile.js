const localDomain = 'https://busybee.onebig.pro/';
const pathToTheme = '/wp-content/themes/busybee/';

//NPM-MODULES
const gulp = require('gulp');
const babel = require('gulp-babel');
const plumber = require('gulp-plumber');
const rename = require("gulp-rename");
const browsersync = require("browser-sync").create();
const imagemin = require('gulp-imagemin');
const less = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');
const critical = require('critical');
const include = require('gulp-include');
const util = require('gulp-util');
const merge = require('merge-stream');
const eslint = require('gulp-eslint');
const gulpIf = require('gulp-if');
const lesshint = require('gulp-lesshint');
const del = require('del');

//prod mode flag
const isProd = util.env.production;

//reporter for lesshint, dont edit!!!

const _lesshintReporter = {
    name: 'lesshint-reporter',
    report: function (errors) {
        const errorsWithoutWarnings = errors.filter((error) => (error.severity === 'error'));
        errorsWithoutWarnings.forEach((result) => {
            let output = '';
            output += '\x1b[31m' + '!!! Error: ' + '\x1b[0m';
            output += `${result.file}: `;
            if (result.line) {
                output += '\x1b[32m' + 'line ' + '\x1b[0m' + ` ${result.line}, `;
            }

            if (result.column) {
                output += '\x1b[36m' + 'col' + '\x1b[0m' + ` ${result.column}, `;
            }

            output += '\x1b[33m' + `${result.linter}: ` + '\x1b[0m';
            output += result.message;

            console.log('\x1b[33m%s', output, "\x1b[0m");
        });
    }
};

function img() {
    return gulp.src(['./images/**/**'])
        .pipe(plumber())
        .pipe(imagemin({progressive: true}))
        .pipe(gulp.dest("./images"));
}

function lessLint() {
    return gulp.src(['./less/**/*.less', '!./less/libs/**.less', '!./less/crm-widgets/**.less', '!./less/style.less'])
        .pipe(lesshint())
        .pipe(lesshint.reporter(_lesshintReporter))
        .pipe(lesshint.failOnError());
}

function lessBuild() {
    return gulp.src([
        './less/style.less',
        './less/pages/page-*.less',
    ])
        .pipe(plumber())
        .pipe(!isProd ? sourcemaps.init() : util.noop())
        .pipe(less())
        .pipe(rename(function (path) {
            path.dirname += "/css";
            path.extname = ".min.css";
        }))
        .pipe(autoprefixer({browsers: ['last 5 versions']}))
        .pipe(cleanCSS({compatibility: 'ie10', keepSpecialComments: 1}))
        // .pipe(!isProd ? sourcemaps.write() : util.noop())
        .pipe(!isProd ? sourcemaps.write('/css/map',{addComment: false}) : util.noop())

        .pipe(gulp.dest('./'))
        .pipe(browsersync.stream());
}

const isFixed = (file) => (file.eslint != null && file.eslint.fixed);

function jsLint() {
    const lintType = !isProd ? 1 : 2;
    return gulp.src(['./js/**/**.js', '!./js/min/**.js', '!./js/plugins/**js'], {since: gulp.lastRun(jsLint)})
        .pipe(eslint({
            parserOptions: {
                "ecmaVersion": 6,
                "sourceType": "module",
            },
            fix: true,
            rules: {
                'quotes': [1, 'single'],
                'semi': [1, 'always'],
                'no-console': [lintType, {allow: ['error']}],
                'no-empty': [lintType, {'allowEmptyCatch': true}],
                'no-debugger': [lintType],
                'no-alert': [lintType],
                'camelcase': [1, {properties: "never"}],
                'indent': [
                    1,
                    4,
                    {'SwitchCase': 1}
                ],
                'no-multiple-empty-lines': [1, {max: 2, maxBOF: 1}],
                'lines-around-comment': [1, {'beforeBlockComment': true}]
            },
        }))
        .pipe(eslint.format())
        .pipe(gulpIf(isFixed, gulp.dest('./js')))
        .pipe(eslint.failAfterError())
}

function jsBuild() {
    return gulp.src([
        './js/main.js',
        './js/pages/page-*.js',
    ])
        .pipe(plumber())
        .pipe(include())
        .pipe(!isProd ? sourcemaps.init() : util.noop())
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(rename(function (path) {
            path.dirname += "/js/min";
            path.extname = ".min.js";
        }))
        .pipe(uglify())
        // .pipe(!isProd ? sourcemaps.write() : util.noop())
        .pipe(!isProd ? sourcemaps.write('/js/map',{addComment: false}) : util.noop())
        .pipe(gulp.dest('./'))
        .pipe(browsersync.stream());
}

function browserSync(done) {
    const files = [
        './!**!/!*.css',
        './js/!**!/!*.js',
        './!**!/!*.php'
    ];

    //initialize browsersync
    browsersync.init(files, {
        proxy: localDomain,
        port: util.env.port || 8080,
        logLevel: 'info', // 'debug', 'info', 'silent', 'warn'
        logConnections: false,
        logFileChanges: true,
        notify: false,
        ghostMode: false,
        online: Boolean(util.env.tunnel),
        tunnel: util.env.tunnel || null
    });
    done();
}

// BrowserSync Reload
function browserSyncReload(done) {
    browsersync.reload();
    done();
}

function criticalDel(done) {
    del(['css/critical.css.php']);
    done();
}

function criticalBuild(done) {
    critical.generate({
        src: localDomain,
        dest: 'css/critical.css.php',
        minify: true,
        pathPrefix: pathToTheme,
        ignore: ['@font-face', '@import', 'background-image']
    });
    done();
}

function watchFiles() {
    gulp.watch(['./less/**/*.less'], gulp.series(css, browserSyncReload));
    gulp.watch(['./js/**/*.js', '!./js/main.min.js', '!./js/min/*.js'], gulp.series(js, browserSyncReload));
}

const js = gulp.series(jsLint, jsBuild);
const css = gulp.series(lessLint, lessBuild);
const criticalCss = gulp.series(criticalDel, criticalBuild);
const build = gulp.parallel(img, js, gulp.series(css, criticalCss));
const watch = gulp.parallel(watchFiles, browserSync);
const dev = gulp.series(js, css, watch);

exports.img = img;
exports.critical = criticalCss;
exports.less = css;
exports.js = js;
exports.watch = watch;
exports.default = !isProd ? dev : build;


