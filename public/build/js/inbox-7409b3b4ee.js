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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\n\nvar dialog = document.querySelector('dialog');\nvar button = document.querySelector('#inbox__add');\n\nif (!dialog.showModal) {\n\tdialogPolyfill.registerDialog(dialog);\n}\n\nbutton.addEventListener('click', function () {\n\tdialog.showModal();\n});\n\ndialog.querySelector('.close').addEventListener('click', function () {\n\tdialog.close();\n});\n\ndialog.querySelector('.add').addEventListener('click', function () {\n\tvar requiredFields = dialog.querySelectorAll(\"input[required]:not(:disabled):not([readonly]):not([type=hidden])\" + \",select[required]:not(:disabled):not([readonly])\" + \",textarea[required]:not(:disabled):not([readonly])\");\n\n\tfor (var i = 0; i < requiredFields.length; i++) {\n\t\tif (requiredFields[i].checkValidity() == false) {\n\t\t\treturn;\n\t\t}\n\t}\n\tdialog.querySelector('#inbox-form__add').submit();\n});\n\nvar sortable = document.querySelectorAll('th.sortable');\nsortable.forEach(function (entry) {\n\tvar asc = entry.outerHTML.indexOf('sorted-asc');\n\tvar desc = entry.outerHTML.indexOf('sorted-desc');\n\n\tentry.addEventListener('click', function () {\n\t\tlocation.href = '/inbox?orderBy=' + this.getAttribute('data-orderby') + '&orderDir=' + this.getAttribute('data-orderdir');\n\t});\n\n\tentry.addEventListener('mouseover', function () {\n\t\tif (asc == -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t\tif (asc == -1 && desc != -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-ascending';\n\t\t}\n\t\tif (asc != -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t});\n\n\tentry.addEventListener('mouseout', function () {\n\t\tif (asc == -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t}\n\t\tif (asc == -1 && desc != -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t\tif (asc != -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-ascending';\n\t\t}\n\t});\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2luYm94LmpzPzQ3ZDYiXSwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xuXG52YXIgZGlhbG9nID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignZGlhbG9nJyk7XG52YXIgYnV0dG9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2luYm94X19hZGQnKTtcblxuaWYgKCFkaWFsb2cuc2hvd01vZGFsKSB7XG5cdGRpYWxvZ1BvbHlmaWxsLnJlZ2lzdGVyRGlhbG9nKGRpYWxvZyk7XG59XG5cbmJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0ZGlhbG9nLnNob3dNb2RhbCgpO1xufSk7XG5cbmRpYWxvZy5xdWVyeVNlbGVjdG9yKCcuY2xvc2UnKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0ZGlhbG9nLmNsb3NlKCk7XG59KTtcblxuZGlhbG9nLnF1ZXJ5U2VsZWN0b3IoJy5hZGQnKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0dmFyIHJlcXVpcmVkRmllbGRzID0gZGlhbG9nLnF1ZXJ5U2VsZWN0b3JBbGwoXCJpbnB1dFtyZXF1aXJlZF06bm90KDpkaXNhYmxlZCk6bm90KFtyZWFkb25seV0pOm5vdChbdHlwZT1oaWRkZW5dKVwiICsgXCIsc2VsZWN0W3JlcXVpcmVkXTpub3QoOmRpc2FibGVkKTpub3QoW3JlYWRvbmx5XSlcIiArIFwiLHRleHRhcmVhW3JlcXVpcmVkXTpub3QoOmRpc2FibGVkKTpub3QoW3JlYWRvbmx5XSlcIik7XG5cblx0Zm9yICh2YXIgaSA9IDA7IGkgPCByZXF1aXJlZEZpZWxkcy5sZW5ndGg7IGkrKykge1xuXHRcdGlmIChyZXF1aXJlZEZpZWxkc1tpXS5jaGVja1ZhbGlkaXR5KCkgPT0gZmFsc2UpIHtcblx0XHRcdHJldHVybjtcblx0XHR9XG5cdH1cblx0ZGlhbG9nLnF1ZXJ5U2VsZWN0b3IoJyNpbmJveC1mb3JtX19hZGQnKS5zdWJtaXQoKTtcbn0pO1xuXG52YXIgc29ydGFibGUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCd0aC5zb3J0YWJsZScpO1xuc29ydGFibGUuZm9yRWFjaChmdW5jdGlvbiAoZW50cnkpIHtcblx0dmFyIGFzYyA9IGVudHJ5Lm91dGVySFRNTC5pbmRleE9mKCdzb3J0ZWQtYXNjJyk7XG5cdHZhciBkZXNjID0gZW50cnkub3V0ZXJIVE1MLmluZGV4T2YoJ3NvcnRlZC1kZXNjJyk7XG5cblx0ZW50cnkuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG5cdFx0bG9jYXRpb24uaHJlZiA9ICcvaW5ib3g/b3JkZXJCeT0nICsgdGhpcy5nZXRBdHRyaWJ1dGUoJ2RhdGEtb3JkZXJieScpICsgJyZvcmRlckRpcj0nICsgdGhpcy5nZXRBdHRyaWJ1dGUoJ2RhdGEtb3JkZXJkaXInKTtcblx0fSk7XG5cblx0ZW50cnkuYWRkRXZlbnRMaXN0ZW5lcignbW91c2VvdmVyJywgZnVuY3Rpb24gKCkge1xuXHRcdGlmIChhc2MgPT0gLTEgJiYgZGVzYyA9PSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnLCAnJyk7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSArPSAnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1kZXNjZW5kaW5nJztcblx0XHR9XG5cdFx0aWYgKGFzYyA9PSAtMSAmJiBkZXNjICE9IC0xKSB7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSA9IHRoaXMuY2xhc3NOYW1lLnJlcGxhY2UoJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtZGVzY2VuZGluZycsICcnKTtcblx0XHRcdHRoaXMuY2xhc3NOYW1lICs9ICcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWFzY2VuZGluZyc7XG5cdFx0fVxuXHRcdGlmIChhc2MgIT0gLTEgJiYgZGVzYyA9PSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWFzY2VuZGluZycsICcnKTtcblx0XHRcdHRoaXMuY2xhc3NOYW1lICs9ICcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnO1xuXHRcdH1cblx0fSk7XG5cblx0ZW50cnkuYWRkRXZlbnRMaXN0ZW5lcignbW91c2VvdXQnLCBmdW5jdGlvbiAoKSB7XG5cdFx0aWYgKGFzYyA9PSAtMSAmJiBkZXNjID09IC0xKSB7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSA9IHRoaXMuY2xhc3NOYW1lLnJlcGxhY2UoJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtZGVzY2VuZGluZycsICcnKTtcblx0XHR9XG5cdFx0aWYgKGFzYyA9PSAtMSAmJiBkZXNjICE9IC0xKSB7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSA9IHRoaXMuY2xhc3NOYW1lLnJlcGxhY2UoJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtYXNjZW5kaW5nJywgJycpO1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgKz0gJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtZGVzY2VuZGluZyc7XG5cdFx0fVxuXHRcdGlmIChhc2MgIT0gLTEgJiYgZGVzYyA9PSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnLCAnJyk7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSArPSAnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1hc2NlbmRpbmcnO1xuXHRcdH1cblx0fSk7XG59KTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9pbmJveC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);