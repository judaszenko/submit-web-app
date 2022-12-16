(self["webpackChunk"] = self["webpackChunk"] || []).push([["dashboard"],{

/***/ "./assets/controllers/dashboard.js":
/*!*****************************************!*\
  !*** ./assets/controllers/dashboard.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");

__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");

__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");

__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");

__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");

__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function shrinkPosts() {
  var posts = document.getElementsByClassName("newpost_text"); // console.log(posts);

  var _iterator = _createForOfIteratorHelper(posts),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      post = _step.value;

      if (post.textContent.length >= 300) {
        var adress = "{{path('app_post {id: post.User.id}')}}";
        post.innerHTML = post.textContent.substring(0, 300) + "... [...]";
      }
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
}

shrinkPosts();
document.getElementsByClassName('');

/***/ }),

/***/ "./assets/dashboard.js":
/*!*****************************!*\
  !*** ./assets/dashboard.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_logged_dashboard_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/logged/dashboard.css */ "./assets/styles/logged/dashboard.css");
/* harmony import */ var _controllers_dashboard_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./controllers/dashboard.js */ "./assets/controllers/dashboard.js");
/* harmony import */ var _controllers_dashboard_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_controllers_dashboard_js__WEBPACK_IMPORTED_MODULE_1__);



/***/ }),

/***/ "./assets/styles/logged/dashboard.css":
/*!********************************************!*\
  !*** ./assets/styles/logged/dashboard.css ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_array_from_js-node_modules_core-js_modules_es_array_i-280a4a"], () => (__webpack_exec__("./assets/dashboard.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiZGFzaGJvYXJkLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUEsU0FBU0EsV0FBVCxHQUFzQjtFQUNsQixJQUFJQyxLQUFLLEdBQUdDLFFBQVEsQ0FBQ0Msc0JBQVQsQ0FBZ0MsY0FBaEMsQ0FBWixDQURrQixDQUV0Qjs7RUFGc0IsMkNBSU5GLEtBSk07RUFBQTs7RUFBQTtJQUlsQixvREFBa0I7TUFBZEcsSUFBYzs7TUFDZCxJQUFHQSxJQUFJLENBQUNDLFdBQUwsQ0FBaUJDLE1BQWpCLElBQTJCLEdBQTlCLEVBQWtDO1FBQzlCLElBQUlDLE1BQU0sR0FBRyx5Q0FBYjtRQUNBSCxJQUFJLENBQUNJLFNBQUwsR0FBaUJKLElBQUksQ0FBQ0MsV0FBTCxDQUFpQkksU0FBakIsQ0FBMkIsQ0FBM0IsRUFBOEIsR0FBOUIsSUFBcUMsV0FBdEQ7TUFDUDtJQUNBO0VBVGlCO0lBQUE7RUFBQTtJQUFBO0VBQUE7QUFXckI7O0FBRURULFdBQVc7QUFFWEUsUUFBUSxDQUFDQyxzQkFBVCxDQUFnQyxFQUFoQzs7Ozs7Ozs7Ozs7Ozs7O0FDZkE7Ozs7Ozs7Ozs7Ozs7QUNBQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9kYXNoYm9hcmQuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Rhc2hib2FyZC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2xvZ2dlZC9kYXNoYm9hcmQuY3NzP2Q4OTMiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gc2hyaW5rUG9zdHMoKXtcbiAgICBsZXQgcG9zdHMgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKFwibmV3cG9zdF90ZXh0XCIpO1xuLy8gY29uc29sZS5sb2cocG9zdHMpO1xuICAgICAgICBcbiAgICBmb3IocG9zdCBvZiBwb3N0cyl7XG4gICAgICAgIGlmKHBvc3QudGV4dENvbnRlbnQubGVuZ3RoID49IDMwMCl7XG4gICAgICAgICAgICBsZXQgYWRyZXNzID0gXCJ7e3BhdGgoJ2FwcF9wb3N0IHtpZDogcG9zdC5Vc2VyLmlkfScpfX1cIlxuICAgICAgICAgICAgcG9zdC5pbm5lckhUTUwgPSBwb3N0LnRleHRDb250ZW50LnN1YnN0cmluZygwLCAzMDApICsgXCIuLi4gWy4uLl1cIjtcbiAgICB9XG4gICAgfSAgICBcbiAgICBcbn1cblxuc2hyaW5rUG9zdHMoKTtcblxuZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSgnJykiLCJpbXBvcnQgJy4vc3R5bGVzL2xvZ2dlZC9kYXNoYm9hcmQuY3NzJztcbmltcG9ydCAnLi9jb250cm9sbGVycy9kYXNoYm9hcmQuanMnOyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJzaHJpbmtQb3N0cyIsInBvc3RzIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwicG9zdCIsInRleHRDb250ZW50IiwibGVuZ3RoIiwiYWRyZXNzIiwiaW5uZXJIVE1MIiwic3Vic3RyaW5nIl0sInNvdXJjZVJvb3QiOiIifQ==