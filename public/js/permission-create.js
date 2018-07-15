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
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(41);


/***/ }),

/***/ 41:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        name: '',
        type: 'basic',
        checkedType: ['create', 'update', 'read', 'delete'],
        namePut: [],
        slugPut: [],
        desPut: []
    },
    watch: {
        name: function name(str) {
            this.getSlug(str);
            this.getNamePut();
            this.getSlugPut();
            this.getDesPut();
        },
        checkedType: function checkedType() {
            this.getNamePut();
            this.getSlugPut();
            this.getDesPut();
        }
    },
    methods: {
        getSlug: function getSlug(str) {
            return str_slug(str);
        },
        getUcFirst: function getUcFirst(str) {
            var arr = str.split(' ');
            var result = '';
            for (var i = 0; i < arr.length; i++) {
                result += arr[i].charAt(0).toUpperCase() + arr[i].slice(1) + ' ';
            }
            return result.trim(' ');
        },
        getNamePut: function getNamePut() {
            this.namePut = [];
            if (this.name.length > 0) {
                for (var i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.namePut[i] = 'Thêm ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.namePut[i] = 'Cập Nhật ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.namePut[i] = 'Xem ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.namePut[i] = 'Xóa ' + this.getUcFirst(this.name);
                    }
                }
            }
        },
        getSlugPut: function getSlugPut() {
            this.slugPut = [];
            if (this.name.length > 0) {
                for (var i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    }
                }
            }
        },
        getDesPut: function getDesPut() {
            this.desPut = [];
            if (this.name.length > 0) {
                for (var i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.desPut[i] = 'Cho phép người dùng thêm mới ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.desPut[i] = 'Cho phép người dùng cập nhật ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.desPut[i] = 'Cho phép người dùng xem ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.desPut[i] = 'Cho phép người dùng xóa ' + this.getUcFirst(this.name);
                    }
                }
            }
        },
        resetName: function resetName() {
            this.name = '';
        }
    }
});

/***/ })

/******/ });