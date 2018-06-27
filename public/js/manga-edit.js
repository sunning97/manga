/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 54);
/******/ })
/************************************************************************/
/******/ ({

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(55);


/***/ }),

/***/ 55:
/***/ (function(module, exports) {

var id = $('.page-title').data('id');
var app = new Vue({
    el: '#app',
    data: {
        name: $('.page-title').data('name'),
        isCoverChecked: false,
        authors: [],
        genres: [],
        teams: []
    },
    watch: {
        name: function name(str) {
            this.getSlug(str);
        }
    },
    methods: {
        getSlug: function getSlug(str) {
            return str_slug(str);
        },
        getAuthors: function getAuthors() {
            var _this = this;

            axios.get('/manga/axios/authors-notin/' + id).then(function (rs) {
                _this.authors = rs.data;
            }).catch(function (e) {});
        },
        getGenres: function getGenres() {
            var _this2 = this;

            axios.get('/manga/axios/genres-notin/' + id).then(function (rs) {
                _this2.genres = rs.data;
            }).catch(function (e) {});
        },
        getTeams: function getTeams() {
            var _this3 = this;

            axios.get('/manga/axios/teams-notin/' + id).then(function (rs) {
                _this3.teams = rs.data;
            }).catch(function (e) {});
        }
    },
    mounted: function mounted() {
        this.getAuthors();
        this.getGenres();
        this.getTeams();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();
$('.summernote').summernote({
    height: 250,
    focus: false
});

/***/ })

/******/ });