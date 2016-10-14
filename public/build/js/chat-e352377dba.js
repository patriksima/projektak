/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("throw new Error(\"Module build failed: SyntaxError: Unexpected token (29:20)\\n\\n\\u001b[0m \\u001b[90m 27 | \\u001b[39m\\n \\u001b[90m 28 | \\u001b[39m\\u001b[33mVue\\u001b[39m\\u001b[33m.\\u001b[39mhttp\\u001b[33m.\\u001b[39minterceptors\\u001b[33m.\\u001b[39mpush((request\\u001b[33m,\\u001b[39m next) \\u001b[33m=>\\u001b[39m {\\n\\u001b[31m\\u001b[1m>\\u001b[22m\\u001b[39m\\u001b[90m 29 | \\u001b[39m    request\\u001b[33m.\\u001b[39mheaders\\u001b[33m.\\u001b[39m[\\u001b[32m'Authorization'\\u001b[39m\\u001b[33m,\\u001b[39m \\u001b[32m'Bearer '\\u001b[39m \\u001b[33m+\\u001b[39m \\u001b[33mLaravel\\u001b[39m\\u001b[33m.\\u001b[39mapiToken]\\u001b[33m;\\u001b[39m\\n \\u001b[90m    | \\u001b[39m                    \\u001b[31m\\u001b[1m^\\u001b[22m\\u001b[39m\\n \\u001b[90m 30 | \\u001b[39m    request\\u001b[33m.\\u001b[39mheaders\\u001b[33m.\\u001b[39m[\\u001b[32m'X-CSRF-TOKEN'\\u001b[39m\\u001b[33m,\\u001b[39m \\u001b[33mLaravel\\u001b[39m\\u001b[33m.\\u001b[39mcsrfToken]\\u001b[33m;\\u001b[39m\\n \\u001b[90m 31 | \\u001b[39m\\n \\u001b[90m 32 | \\u001b[39m    next()\\u001b[33m;\\u001b[39m\\u001b[0m\\n\");//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

eval("var __vue_script__, __vue_template__\nvar __vue_styles__ = {}\n__vue_script__ = __webpack_require__(2)\nif (__vue_script__ &&\n    __vue_script__.__esModule &&\n    Object.keys(__vue_script__).length > 1) {\n  console.warn(\"[vue-loader] resources/assets/js/components/Chat.vue: named exports in *.vue files are ignored.\")}\n__vue_template__ = __webpack_require__(3)\nmodule.exports = __vue_script__ || {}\nif (module.exports.__esModule) module.exports = module.exports.default\nvar __vue_options__ = typeof module.exports === \"function\" ? (module.exports.options || (module.exports.options = {})) : module.exports\nif (__vue_template__) {\n__vue_options__.template = __vue_template__\n}\nif (!__vue_options__.computed) __vue_options__.computed = {}\nObject.keys(__vue_styles__).forEach(function (key) {\nvar module = __vue_styles__[key]\n__vue_options__.computed[key] = function () { return module }\n})\nif (false) {(function () {  module.hot.accept()\n  var hotAPI = require(\"vue-hot-reload-api\")\n  hotAPI.install(require(\"vue\"), false)\n  if (!hotAPI.compatible) return\n  var id = \"_v-85b2425e/Chat.vue\"\n  if (!module.hot.data) {\n    hotAPI.createRecord(id, module.exports)\n  } else {\n    hotAPI.update(id, module.exports, __vue_template__)\n  }\n})()}//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9DaGF0LnZ1ZT85ZjExIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBfX3Z1ZV9zY3JpcHRfXywgX192dWVfdGVtcGxhdGVfX1xudmFyIF9fdnVlX3N0eWxlc19fID0ge31cbl9fdnVlX3NjcmlwdF9fID0gcmVxdWlyZShcIiEhYmFiZWwtbG9hZGVyIS4vLi4vLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL3NlbGVjdG9yLmpzP3R5cGU9c2NyaXB0JmluZGV4PTAhLi9DaGF0LnZ1ZVwiKVxuaWYgKF9fdnVlX3NjcmlwdF9fICYmXG4gICAgX192dWVfc2NyaXB0X18uX19lc01vZHVsZSAmJlxuICAgIE9iamVjdC5rZXlzKF9fdnVlX3NjcmlwdF9fKS5sZW5ndGggPiAxKSB7XG4gIGNvbnNvbGUud2FybihcIlt2dWUtbG9hZGVyXSByZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvQ2hhdC52dWU6IG5hbWVkIGV4cG9ydHMgaW4gKi52dWUgZmlsZXMgYXJlIGlnbm9yZWQuXCIpfVxuX192dWVfdGVtcGxhdGVfXyA9IHJlcXVpcmUoXCIhIXZ1ZS1odG1sLWxvYWRlciEuLy4uLy4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9zZWxlY3Rvci5qcz90eXBlPXRlbXBsYXRlJmluZGV4PTAhLi9DaGF0LnZ1ZVwiKVxubW9kdWxlLmV4cG9ydHMgPSBfX3Z1ZV9zY3JpcHRfXyB8fCB7fVxuaWYgKG1vZHVsZS5leHBvcnRzLl9fZXNNb2R1bGUpIG1vZHVsZS5leHBvcnRzID0gbW9kdWxlLmV4cG9ydHMuZGVmYXVsdFxudmFyIF9fdnVlX29wdGlvbnNfXyA9IHR5cGVvZiBtb2R1bGUuZXhwb3J0cyA9PT0gXCJmdW5jdGlvblwiID8gKG1vZHVsZS5leHBvcnRzLm9wdGlvbnMgfHwgKG1vZHVsZS5leHBvcnRzLm9wdGlvbnMgPSB7fSkpIDogbW9kdWxlLmV4cG9ydHNcbmlmIChfX3Z1ZV90ZW1wbGF0ZV9fKSB7XG5fX3Z1ZV9vcHRpb25zX18udGVtcGxhdGUgPSBfX3Z1ZV90ZW1wbGF0ZV9fXG59XG5pZiAoIV9fdnVlX29wdGlvbnNfXy5jb21wdXRlZCkgX192dWVfb3B0aW9uc19fLmNvbXB1dGVkID0ge31cbk9iamVjdC5rZXlzKF9fdnVlX3N0eWxlc19fKS5mb3JFYWNoKGZ1bmN0aW9uIChrZXkpIHtcbnZhciBtb2R1bGUgPSBfX3Z1ZV9zdHlsZXNfX1trZXldXG5fX3Z1ZV9vcHRpb25zX18uY29tcHV0ZWRba2V5XSA9IGZ1bmN0aW9uICgpIHsgcmV0dXJuIG1vZHVsZSB9XG59KVxuaWYgKG1vZHVsZS5ob3QpIHsoZnVuY3Rpb24gKCkgeyAgbW9kdWxlLmhvdC5hY2NlcHQoKVxuICB2YXIgaG90QVBJID0gcmVxdWlyZShcInZ1ZS1ob3QtcmVsb2FkLWFwaVwiKVxuICBob3RBUEkuaW5zdGFsbChyZXF1aXJlKFwidnVlXCIpLCBmYWxzZSlcbiAgaWYgKCFob3RBUEkuY29tcGF0aWJsZSkgcmV0dXJuXG4gIHZhciBpZCA9IFwiX3YtODViMjQyNWUvQ2hhdC52dWVcIlxuICBpZiAoIW1vZHVsZS5ob3QuZGF0YSkge1xuICAgIGhvdEFQSS5jcmVhdGVSZWNvcmQoaWQsIG1vZHVsZS5leHBvcnRzKVxuICB9IGVsc2Uge1xuICAgIGhvdEFQSS51cGRhdGUoaWQsIG1vZHVsZS5leHBvcnRzLCBfX3Z1ZV90ZW1wbGF0ZV9fKVxuICB9XG59KSgpfVxuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL0NoYXQudnVlXG4vLyBtb2R1bGUgaWQgPSAxXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9");

/***/ },
/* 2 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\n\nObject.defineProperty(exports, \"__esModule\", {\n    value: true\n});\n// <template>\n//     <div class=\"chat mdl-card mdl-shadow--2dp\">\n//       <div class=\"chat-title mdl-card__title\">\n//         <h2 class=\"mdl-card__title-text\">Chat</h2>\n//       </div>\n//\n//       <div class=\"mdl-card__supporting-text mdl-card--expand\">\n//             <span class=\"mdl-chip chat-message\" v-for=\"sentMessage in messages\">\n//                 <span class=\"mdl-chip__text\">{{ sentMessage.body }}</span>\n//             </span>\n//       </div>\n//\n//       <div class=\"mdl-card__actions mdl-card--border\">\n//         <form action=\"#\" @submit.prevent=\"sendMessage()\">\n//           <div class=\"mdl-textfield mdl-js-textfield\">\n//             <input class=\"mdl-textfield__input\" type=\"text\" placeholder=\"Type your message\" v-model=\"message\">\n//             <label class=\"mdl-textfield__label\" for=\"sample1\">Text...</label>\n//           </div>\n//         </form>\n//       </div>\n//     </div>\n// </template>\n//\n// <script>\nexports.default = {\n    props: ['channel'],\n\n    data: function data() {\n        return {\n            message: '',\n            messages: []\n        };\n    },\n    ready: function ready() {\n        console.log(this.channel);\n    },\n\n\n    methods: {\n        sendMessage: function sendMessage() {\n            this.$http.post('api/chat', {\n                channel: this.channel\n            });\n            this.messages.push({ body: this.message });\n            this.message = '';\n        }\n    }\n};\n// </script>\n\n/* generated by vue-loader */\n\nmodule.exports = exports['default'];//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9DaGF0LnZ1ZT85MjA0Il0sInNvdXJjZXNDb250ZW50IjpbIjx0ZW1wbGF0ZT5cbiAgICA8ZGl2IGNsYXNzPVwiY2hhdCBtZGwtY2FyZCBtZGwtc2hhZG93LS0yZHBcIj5cbiAgICAgIDxkaXYgY2xhc3M9XCJjaGF0LXRpdGxlIG1kbC1jYXJkX190aXRsZVwiPlxuICAgICAgICA8aDIgY2xhc3M9XCJtZGwtY2FyZF9fdGl0bGUtdGV4dFwiPkNoYXQ8L2gyPlxuICAgICAgPC9kaXY+XG5cbiAgICAgIDxkaXYgY2xhc3M9XCJtZGwtY2FyZF9fc3VwcG9ydGluZy10ZXh0IG1kbC1jYXJkLS1leHBhbmRcIj5cbiAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwibWRsLWNoaXAgY2hhdC1tZXNzYWdlXCIgdi1mb3I9XCJzZW50TWVzc2FnZSBpbiBtZXNzYWdlc1wiPlxuICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwibWRsLWNoaXBfX3RleHRcIj57eyBzZW50TWVzc2FnZS5ib2R5IH19PC9zcGFuPlxuICAgICAgICAgICAgPC9zcGFuPlxuICAgICAgPC9kaXY+XG5cbiAgICAgIDxkaXYgY2xhc3M9XCJtZGwtY2FyZF9fYWN0aW9ucyBtZGwtY2FyZC0tYm9yZGVyXCI+XG4gICAgICAgIDxmb3JtIGFjdGlvbj1cIiNcIiBAc3VibWl0LnByZXZlbnQ9XCJzZW5kTWVzc2FnZSgpXCI+XG4gICAgICAgICAgPGRpdiBjbGFzcz1cIm1kbC10ZXh0ZmllbGQgbWRsLWpzLXRleHRmaWVsZFwiPlxuICAgICAgICAgICAgPGlucHV0IGNsYXNzPVwibWRsLXRleHRmaWVsZF9faW5wdXRcIiB0eXBlPVwidGV4dFwiIHBsYWNlaG9sZGVyPVwiVHlwZSB5b3VyIG1lc3NhZ2VcIiB2LW1vZGVsPVwibWVzc2FnZVwiPlxuICAgICAgICAgICAgPGxhYmVsIGNsYXNzPVwibWRsLXRleHRmaWVsZF9fbGFiZWxcIiBmb3I9XCJzYW1wbGUxXCI+VGV4dC4uLjwvbGFiZWw+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvZm9ybT5cbiAgICAgIDwvZGl2PlxuICAgIDwvZGl2PlxuPC90ZW1wbGF0ZT5cblxuPHNjcmlwdD5cbmV4cG9ydCBkZWZhdWx0IHtcbiAgICBwcm9wczogWydjaGFubmVsJ10sXG5cbiAgICBkYXRhKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgbWVzc2FnZTogJycsXG4gICAgICAgICAgICBtZXNzYWdlczogW11cbiAgICAgICAgfTtcbiAgICB9LFxuXG4gICAgcmVhZHkoKSB7XG4gICAgICAgIGNvbnNvbGUubG9nKHRoaXMuY2hhbm5lbCk7XG4gICAgfSxcblxuICAgIG1ldGhvZHM6IHtcbiAgICAgICAgc2VuZE1lc3NhZ2UoKSB7XG4gICAgICAgICAgICB0aGlzLiRodHRwLnBvc3QoJ2FwaS9jaGF0Jywge1xuICAgICAgICAgICAgICAgIGNoYW5uZWw6IHRoaXMuY2hhbm5lbFxuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIHRoaXMubWVzc2FnZXMucHVzaCh7IGJvZHk6IHRoaXMubWVzc2FnZSB9KTtcbiAgICAgICAgICAgIHRoaXMubWVzc2FnZSA9ICcnO1xuICAgICAgICB9XG4gICAgfVxufTtcbjwvc2NyaXB0PlxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIENoYXQudnVlPzVkYmE0ZTliIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBd0JBOztBQUdBO0FBQ0E7QUFBQTs7QUFFQTtBQUNBO0FBRkE7QUFLQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7O0FBQUE7O0FBRUE7QUFEQTtBQUdBO0FBQ0E7QUFDQTtBQVBBO0FBZEE7Ozs7OyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ },
/* 3 */
/***/ function(module, exports) {

eval("module.exports = \"\\n<div class=\\\"chat mdl-card mdl-shadow--2dp\\\">\\n  <div class=\\\"chat-title mdl-card__title\\\">\\n    <h2 class=\\\"mdl-card__title-text\\\">Chat</h2>\\n  </div>\\n\\n  <div class=\\\"mdl-card__supporting-text mdl-card--expand\\\">\\n        <span class=\\\"mdl-chip chat-message\\\" v-for=\\\"sentMessage in messages\\\">\\n            <span class=\\\"mdl-chip__text\\\">{{ sentMessage.body }}</span>\\n        </span>\\n  </div>\\n\\n  <div class=\\\"mdl-card__actions mdl-card--border\\\">\\n    <form action=\\\"#\\\" @submit.prevent=\\\"sendMessage()\\\">\\n      <div class=\\\"mdl-textfield mdl-js-textfield\\\">\\n        <input class=\\\"mdl-textfield__input\\\" type=\\\"text\\\" placeholder=\\\"Type your message\\\" v-model=\\\"message\\\">\\n        <label class=\\\"mdl-textfield__label\\\" for=\\\"sample1\\\">Text...</label>\\n      </div>\\n    </form>\\n  </div>\\n</div>\\n\";//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9DaGF0LnZ1ZT82MjlhIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0gXCJcXG48ZGl2IGNsYXNzPVxcXCJjaGF0IG1kbC1jYXJkIG1kbC1zaGFkb3ctLTJkcFxcXCI+XFxuICA8ZGl2IGNsYXNzPVxcXCJjaGF0LXRpdGxlIG1kbC1jYXJkX190aXRsZVxcXCI+XFxuICAgIDxoMiBjbGFzcz1cXFwibWRsLWNhcmRfX3RpdGxlLXRleHRcXFwiPkNoYXQ8L2gyPlxcbiAgPC9kaXY+XFxuXFxuICA8ZGl2IGNsYXNzPVxcXCJtZGwtY2FyZF9fc3VwcG9ydGluZy10ZXh0IG1kbC1jYXJkLS1leHBhbmRcXFwiPlxcbiAgICAgICAgPHNwYW4gY2xhc3M9XFxcIm1kbC1jaGlwIGNoYXQtbWVzc2FnZVxcXCIgdi1mb3I9XFxcInNlbnRNZXNzYWdlIGluIG1lc3NhZ2VzXFxcIj5cXG4gICAgICAgICAgICA8c3BhbiBjbGFzcz1cXFwibWRsLWNoaXBfX3RleHRcXFwiPnt7IHNlbnRNZXNzYWdlLmJvZHkgfX08L3NwYW4+XFxuICAgICAgICA8L3NwYW4+XFxuICA8L2Rpdj5cXG5cXG4gIDxkaXYgY2xhc3M9XFxcIm1kbC1jYXJkX19hY3Rpb25zIG1kbC1jYXJkLS1ib3JkZXJcXFwiPlxcbiAgICA8Zm9ybSBhY3Rpb249XFxcIiNcXFwiIEBzdWJtaXQucHJldmVudD1cXFwic2VuZE1lc3NhZ2UoKVxcXCI+XFxuICAgICAgPGRpdiBjbGFzcz1cXFwibWRsLXRleHRmaWVsZCBtZGwtanMtdGV4dGZpZWxkXFxcIj5cXG4gICAgICAgIDxpbnB1dCBjbGFzcz1cXFwibWRsLXRleHRmaWVsZF9faW5wdXRcXFwiIHR5cGU9XFxcInRleHRcXFwiIHBsYWNlaG9sZGVyPVxcXCJUeXBlIHlvdXIgbWVzc2FnZVxcXCIgdi1tb2RlbD1cXFwibWVzc2FnZVxcXCI+XFxuICAgICAgICA8bGFiZWwgY2xhc3M9XFxcIm1kbC10ZXh0ZmllbGRfX2xhYmVsXFxcIiBmb3I9XFxcInNhbXBsZTFcXFwiPlRleHQuLi48L2xhYmVsPlxcbiAgICAgIDwvZGl2PlxcbiAgICA8L2Zvcm0+XFxuICA8L2Rpdj5cXG48L2Rpdj5cXG5cIjtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL34vdnVlLWh0bWwtbG9hZGVyIS4vfi92dWUtbG9hZGVyL2xpYi9zZWxlY3Rvci5qcz90eXBlPXRlbXBsYXRlJmluZGV4PTAhLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvQ2hhdC52dWVcbi8vIG1vZHVsZSBpZCA9IDNcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
eval("'use strict';\n\n/**\n * First we will load all of this project's JavaScript dependencies which\n * include Vue and Vue Resource. This gives a great starting point for\n * building robust, powerful web applications using Vue and Laravel.\n */\n\n__webpack_require__(0);\n\n/**\n * Next, we will create a fresh Vue application instance and attach it to\n * the body of the page. From here, you may begin adding components to\n * the application, or feel free to tweak this setup for your needs.\n */\n\nVue.component('chat', __webpack_require__(1));\n\nvar app = new Vue({\n  el: 'div.demo-content'\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiNC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2NoYXQuanM/Nzc1MyJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbi8qKlxuICogRmlyc3Qgd2Ugd2lsbCBsb2FkIGFsbCBvZiB0aGlzIHByb2plY3QncyBKYXZhU2NyaXB0IGRlcGVuZGVuY2llcyB3aGljaFxuICogaW5jbHVkZSBWdWUgYW5kIFZ1ZSBSZXNvdXJjZS4gVGhpcyBnaXZlcyBhIGdyZWF0IHN0YXJ0aW5nIHBvaW50IGZvclxuICogYnVpbGRpbmcgcm9idXN0LCBwb3dlcmZ1bCB3ZWIgYXBwbGljYXRpb25zIHVzaW5nIFZ1ZSBhbmQgTGFyYXZlbC5cbiAqL1xuXG5yZXF1aXJlKCcuL2Jvb3RzdHJhcCcpO1xuXG4vKipcbiAqIE5leHQsIHdlIHdpbGwgY3JlYXRlIGEgZnJlc2ggVnVlIGFwcGxpY2F0aW9uIGluc3RhbmNlIGFuZCBhdHRhY2ggaXQgdG9cbiAqIHRoZSBib2R5IG9mIHRoZSBwYWdlLiBGcm9tIGhlcmUsIHlvdSBtYXkgYmVnaW4gYWRkaW5nIGNvbXBvbmVudHMgdG9cbiAqIHRoZSBhcHBsaWNhdGlvbiwgb3IgZmVlbCBmcmVlIHRvIHR3ZWFrIHRoaXMgc2V0dXAgZm9yIHlvdXIgbmVlZHMuXG4gKi9cblxuVnVlLmNvbXBvbmVudCgnY2hhdCcsIHJlcXVpcmUoJy4vY29tcG9uZW50cy9DaGF0LnZ1ZScpKTtcblxudmFyIGFwcCA9IG5ldyBWdWUoe1xuICBlbDogJ2Rpdi5kZW1vLWNvbnRlbnQnXG59KTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9jaGF0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBOzs7Ozs7O0FBT0E7QUFDQTs7Ozs7OztBQU9BO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);