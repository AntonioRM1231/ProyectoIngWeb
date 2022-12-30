const{src, dest, watch} = require("gulp");
const sass=require("gulp-sass")(require('sass'));
const plumber = require('gulp-plumber');
function css(done){
    src("src/scss/**/*.scss")//Identificar el archivo SASS
        .pipe(plumber())
        .pipe(sass())//Compilarlo
        .pipe(dest("build/css"));//Almacenar en el disco duro
    done();//Callback que avisa a gulp cuando lleegamos al final 
}
function javascript(done){
    src("src/js/**/*.js")
        .pipe(dest("build/js"));
    done();
}
function dev(done){
    watch('src/scss/**/*.scss',css);
    watch('src/js/**/*.js', javascript);
    done();
}
exports.css=css;
exports.js = javascript;
exports.dev= dev;