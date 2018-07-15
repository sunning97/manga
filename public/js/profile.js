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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        name: name,
        isChangeInfo: false,
        isChangeAvatar: false,
        isChangeAddress: false,
        isChangePassword: false,
        isProvinceSelected: false,
        isDistrictSelected: false,
        provinceId: '',
        districtId: '',
        provinces: [],
        districts: [],
        wards: []
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
        getProvinces: function getProvinces() {
            var _this = this;

            axios.get('/manga/axios/provinces').then(function (rs) {
                _this.provinces = rs.data;
            }).catch(function (e) {});
        },
        getDistricts: function getDistricts(id) {
            var _this2 = this;

            axios.get('/manga/axios/districts/' + id).then(function (rs) {
                _this2.districts = rs.data;
                _this2.wards = [];
                _this2.isProvinceSelected = true;
            }).catch(function (e) {});
        },
        getWards: function getWards(id) {
            var _this3 = this;

            axios.get('/manga/axios/wards/' + id).then(function (rs) {
                _this3.wards = rs.data;
                _this3.isDistrictSelected = true;
            }).catch(function (e) {});
        }
    }, mounted: function mounted() {
        this.getProvinces();
    }
});

$('#passForm').validate({
    rules: {
        curr_password: {
            required: true
        },
        password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#pass"
        }
    },
    messages: {
        curr_password: {
            required: "Vui lòng nhập mật khẩu hiện tại"
        },
        password: {
            required: "Vui lòng nhập mật khẩu mới",
            minlength: "Mật khẩu phải dài ít nhất 5 kí tự"
        },
        confirm_password: {
            required: "Vui lòng nhập mật khẩu mới",
            minlength: "Mật khẩu phải dài ít nhất 5 kí tự",
            equalTo: "Mật khẩu đã nhập không khớp!"
        }
    },
    errorPlacement: function errorPlacement(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
    },
    highlight: function highlight(element, errorClass) {
        $(element).parent().addClass('has-danger');
        $(element).addClass('form-control-danger');
    }
});

jQuery('.mydatepicker').datepicker();
$('#input-file-now').dropify();

/***/ })

/******/ });