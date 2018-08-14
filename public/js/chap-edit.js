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
/******/ 	return __webpack_require__(__webpack_require__.s = 75);
/******/ })
/************************************************************************/
/******/ ({

/***/ 75:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(76);


/***/ }),

/***/ 76:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        name: $('.page-title').data('name'),
        mangas: [],
        chapImage: [],
        imageEdit: null,
        noInputImage: false
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
        getMangas: function getMangas() {
            var _this = this;

            axios.get('/admin/axios/mangas').then(function (rs) {
                _this.mangas = rs.data;
            }).catch(function (e) {});
        },
        getChapImages: function getChapImages() {
            var _this2 = this;

            axios.get('/admin/axios/chap-images/' + $('.page-title').data('id')).then(function (rs) {
                _this2.chapImage = rs.data;
            }).catch(function (e) {});
        },
        showDelete: function showDelete(index, chapImage) {
            var app = this;
            var id = app.chapImage[index].id;
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "bạn sẽ không thể phục hồi lại ảnh này",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: true
            }, function () {
                axios.get('/admin/axios/delete-chap-image/' + id).then(function (rs) {
                    app.getChapImages();
                    swal("Thành công!", "Đã xóa " + rs.data, "success");
                }).catch(function (e) {});
            });
        },
        showEdit: function showEdit(index) {
            this.imageEdit = this.chapImage[index];
        },
        editImage: function editImage(event) {
            var el = $(event.path[0]).parent().prev().children().children().children().children('.form-group').children().children('input');
            if (!el.val()) {
                this.noInputImage = true;
                return false;
            }
            var formData = new FormData();
            this.noInputImage = false;
            formData.append("image", el[0].files[0]);
            formData.append("id", this.imageEdit.id);

            axios.post('/admin/axios/chap-image-edit', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (rs) {
                app.getChapImages();
                swal("Thành công!", "Cập nhật thành công", "success");
                el.val('');
            }).catch(function (e) {});
        }
    },
    mounted: function mounted() {
        this.getChapImages();
        this.getMangas();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();

/***/ })

/******/ });