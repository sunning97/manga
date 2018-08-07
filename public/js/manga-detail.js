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
/******/ 	return __webpack_require__(__webpack_require__.s = 118);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 118:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(119);


/***/ }),

/***/ 119:
/***/ (function(module, exports, __webpack_require__) {


Vue.component('comment', __webpack_require__(120));
var app = new Vue({
    el: '#app',
    data: {}
});

/***/ }),

/***/ 120:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(121)
/* template */
var __vue_template__ = __webpack_require__(131)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\MangaComments.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-96a04b2e", Component.options)
  } else {
    hotAPI.reload("data-v-96a04b2e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 121:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment__ = __webpack_require__(122);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ListComment__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination__ = __webpack_require__(125);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Pagination__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__WriteComment__ = __webpack_require__(128);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__WriteComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__WriteComment__);
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        'list-comment': __WEBPACK_IMPORTED_MODULE_0__ListComment___default.a,
        'pagination': __WEBPACK_IMPORTED_MODULE_1__Pagination___default.a,
        'write-comment': __WEBPACK_IMPORTED_MODULE_2__WriteComment___default.a
    }
});

/***/ }),

/***/ 122:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(123)
/* template */
var __vue_template__ = __webpack_require__(124)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\ListComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3dfaeb7c", Component.options)
  } else {
    hotAPI.reload("data-v-3dfaeb7c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 123:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        $('#commnent').slimScroll({
            height: '500px'
        });
    }
});

/***/ }),

/***/ 124:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("h5", [_vm._v("3 Bình luận")]),
      _vm._v(" "),
      _c(
        "ul",
        { staticClass: "post__comments-list", attrs: { id: "commnent" } },
        [
          _c("li", { staticClass: "post__comments-item" }, [
            _c("div", { staticClass: "post__comments-item-body" }, [
              _c("div", { staticClass: "post__comments-item-avatar" }, [
                _c("img", {
                  attrs: { src: "img/comment1.jpg", alt: "Comment Author" }
                })
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "post__comments-item-right" }, [
                _c("div", { staticClass: "post__comments-item-reply" }, [
                  _c("a", { attrs: { href: "#" } }, [_vm._v("Reply")])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "post__comments-item-info" }, [
                  _c(
                    "div",
                    { staticClass: "post__comments-item-info-author" },
                    [
                      _c("span", [
                        _c("a", { attrs: { href: "#" } }, [_vm._v("Matt Kian")])
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "post__comments-item-info-date" }, [
                    _c("span", [
                      _c("a", { attrs: { href: "#" } }, [
                        _vm._v("March 30, 2017 at 2:28 pm")
                      ])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "post__comments-item-post" }, [
                  _c("p", [
                    _vm._v(
                      "Dignissim pharetra consequat condimentum scelerisque. Vestibulum sagittis scelerisque montes enim Cursus dui lectus cras mattis Laoreet aliquam varius ut adipiscing interdum lacus risus mattis urna semper cras hendrerit, morbi nonummy."
                    )
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("ul", { staticClass: "post__comments-children" }, [
              _c("li", { staticClass: "post__comments-item" }, [
                _c("div", { staticClass: "post__comments-item-body" }, [
                  _c("div", { staticClass: "post__comments-item-avatar" }, [
                    _c("img", {
                      attrs: { src: "img/comment2.jpg", alt: "Comment Author" }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "post__comments-item-right" }, [
                    _c("div", { staticClass: "post__comments-item-reply" }, [
                      _c("a", { attrs: { href: "#" } }, [_vm._v("Reply")])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "post__comments-item-info" }, [
                      _c(
                        "div",
                        { staticClass: "post__comments-item-info-author" },
                        [
                          _c("span", [
                            _c("a", { attrs: { href: "#" } }, [
                              _vm._v("Olyvia Becca")
                            ])
                          ])
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "post__comments-item-info-date" },
                        [
                          _c("span", [
                            _c("a", { attrs: { href: "#" } }, [
                              _vm._v("April 11, 2017 at 7:35 pm")
                            ])
                          ])
                        ]
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "post__comments-item-post" }, [
                      _c("p", [
                        _vm._v(
                          "Aliquet arcu cubilia dignissim natoque posuere vestibulum malesuada integer Ridiculus suscipit justo In tempus penatibus diam arcu dictumst felis scelerisque nunc blandit cubilia condimentum class justo natoque volutpat nam."
                        )
                      ])
                    ])
                  ])
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("li", { staticClass: "post__comments-item" }, [
            _c("div", { staticClass: "post__comments-item-body" }, [
              _c("div", { staticClass: "post__comments-item-avatar" }, [
                _c("img", {
                  attrs: { src: "img/comment3.jpg", alt: "Comment Author" }
                })
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "post__comments-item-right" }, [
                _c("div", { staticClass: "post__comments-item-reply" }, [
                  _c("a", { attrs: { href: "#" } }, [_vm._v("Reply")])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "post__comments-item-info" }, [
                  _c(
                    "div",
                    { staticClass: "post__comments-item-info-author" },
                    [
                      _c("span", [
                        _c("a", { attrs: { href: "#" } }, [
                          _vm._v("Jess Lavone")
                        ])
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "post__comments-item-info-date" }, [
                    _c("span", [
                      _c("a", { attrs: { href: "#" } }, [
                        _vm._v("April 15, 2017 at 8:32 pm")
                      ])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "post__comments-item-post" }, [
                  _c("p", [
                    _vm._v(
                      "Dapibus ullamcorper ullamcorper class potenti sed, rhoncus arcu. Ligula iaculis aliquet, interdum luctus porttitor lacinia eu etiam. Pede elementum nisl dui facilisis at, metus facilisi, class consectetuer. Feugiat malesuada dis."
                    )
                  ])
                ])
              ])
            ])
          ])
        ]
      )
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3dfaeb7c", module.exports)
  }
}

/***/ }),

/***/ 125:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(126)
/* template */
var __vue_template__ = __webpack_require__(127)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\Pagination.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6a16b7c9", Component.options)
  } else {
    hotAPI.reload("data-v-6a16b7c9", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 126:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({});

/***/ }),

/***/ 127:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("nav", { staticClass: "col-12 text-center" }, [
      _c("ul", { staticClass: "pagination" }, [
        _c("li", { staticClass: "page-item disabled" }, [
          _c("a", { staticClass: "page-link", attrs: { tabindex: "-1" } }, [
            _vm._v("<<")
          ])
        ]),
        _vm._v(" "),
        _c("li", { staticClass: "page-item" }, [
          _c("a", { staticClass: "page-link", attrs: { href: "#" } }, [
            _vm._v("1")
          ])
        ]),
        _vm._v(" "),
        _c("li", { staticClass: "page-item active" }, [
          _c("a", { staticClass: "page-link", attrs: { href: "#" } }, [
            _vm._v("2 "),
            _c("span", { staticClass: "sr-only" }, [_vm._v("(current)")])
          ])
        ]),
        _vm._v(" "),
        _c("li", { staticClass: "page-item" }, [
          _c("a", { staticClass: "page-link", attrs: { href: "#" } }, [
            _vm._v("3")
          ])
        ]),
        _vm._v(" "),
        _c("li", { staticClass: "page-item" }, [
          _c("a", { staticClass: "page-link", attrs: { href: "#" } }, [
            _vm._v(">>")
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6a16b7c9", module.exports)
  }
}

/***/ }),

/***/ 128:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(129)
/* template */
var __vue_template__ = __webpack_require__(130)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\WriteComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0c2b8e22", Component.options)
  } else {
    hotAPI.reload("data-v-0c2b8e22", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 129:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({});

/***/ }),

/***/ 130:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "post__comments-respond" }, [
      _c("h5", [_vm._v("Viết bình luận của bạn")]),
      _vm._v(" "),
      _c(
        "form",
        {
          attrs: {
            action: "http://feelman.info/html/leopold/post.html",
            method: "post"
          }
        },
        [
          _c("p", { staticClass: "post__comments-respond-comment" }, [
            _c("label", { attrs: { for: "comment" } }, [_vm._v("Comment")]),
            _vm._v(" "),
            _c("textarea", {
              attrs: {
                id: "comment",
                name: "comment",
                cols: "45",
                "aria-required": "true"
              }
            })
          ]),
          _vm._v(" "),
          _c("p", { staticClass: "post__comments-respond-submit" }, [
            _c("input", {
              attrs: {
                id: "submit",
                type: "submit",
                name: "submit",
                size: "30",
                value: "Đăng"
              }
            })
          ])
        ]
      )
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0c2b8e22", module.exports)
  }
}

/***/ }),

/***/ 131:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "post__comments" },
    [
      _c("list-comment"),
      _vm._v(" "),
      _c("pagination"),
      _vm._v(" "),
      _c("write-comment")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-96a04b2e", module.exports)
  }
}

/***/ })

/******/ });