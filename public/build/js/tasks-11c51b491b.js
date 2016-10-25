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
eval("'use strict';\n\nvar dialog = document.querySelector('dialog');\nvar button = document.querySelector('#task__add');\n\nif (!dialog.showModal) {\n\tdialogPolyfill.registerDialog(dialog);\n}\n\nbutton.addEventListener('click', function () {\n\tdialog.showModal();\n});\n\ndialog.querySelector('.close').addEventListener('click', function () {\n\tdialog.close();\n});\n\ndialog.querySelector('.add').addEventListener('click', function () {\n\tvar requiredFields = dialog.querySelectorAll(\"input[required]:not(:disabled):not([readonly]):not([type=hidden])\" + \",select[required]:not(:disabled):not([readonly])\" + \",textarea[required]:not(:disabled):not([readonly])\");\n\n\tfor (var i = 0; i < requiredFields.length; i++) {\n\t\tif (requiredFields[i].checkValidity() == false) {\n\t\t\treturn;\n\t\t}\n\t}\n\tdialog.querySelector('#task-form__add').submit();\n});\n\nvar sortable = document.querySelectorAll('th.sortable');\nsortable.forEach(function (entry) {\n\tvar asc = entry.outerHTML.indexOf('sorted-asc');\n\tvar desc = entry.outerHTML.indexOf('sorted-desc');\n\n\tentry.addEventListener('click', function () {\n\t\tlocation.href = '/tasks?orderBy=' + this.getAttribute('data-orderby') + '&orderDir=' + this.getAttribute('data-orderdir');\n\t});\n\n\tentry.addEventListener('mouseover', function () {\n\t\tif (asc == -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t\tif (asc == -1 && desc != -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-ascending';\n\t\t}\n\t\tif (asc != -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t});\n\n\tentry.addEventListener('mouseout', function () {\n\t\tif (asc == -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t}\n\t\tif (asc == -1 && desc != -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-ascending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-descending';\n\t\t}\n\t\tif (asc != -1 && desc == -1) {\n\t\t\tthis.className = this.className.replace(' mdl-data-table__header--sorted-descending', '');\n\t\t\tthis.className += ' mdl-data-table__header--sorted-ascending';\n\t\t}\n\t});\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Rhc2tzLmpzPzQwYzMiXSwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xuXG52YXIgZGlhbG9nID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignZGlhbG9nJyk7XG52YXIgYnV0dG9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3Rhc2tfX2FkZCcpO1xuXG5pZiAoIWRpYWxvZy5zaG93TW9kYWwpIHtcblx0ZGlhbG9nUG9seWZpbGwucmVnaXN0ZXJEaWFsb2coZGlhbG9nKTtcbn1cblxuYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXHRkaWFsb2cuc2hvd01vZGFsKCk7XG59KTtcblxuZGlhbG9nLnF1ZXJ5U2VsZWN0b3IoJy5jbG9zZScpLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXHRkaWFsb2cuY2xvc2UoKTtcbn0pO1xuXG5kaWFsb2cucXVlcnlTZWxlY3RvcignLmFkZCcpLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXHR2YXIgcmVxdWlyZWRGaWVsZHMgPSBkaWFsb2cucXVlcnlTZWxlY3RvckFsbChcImlucHV0W3JlcXVpcmVkXTpub3QoOmRpc2FibGVkKTpub3QoW3JlYWRvbmx5XSk6bm90KFt0eXBlPWhpZGRlbl0pXCIgKyBcIixzZWxlY3RbcmVxdWlyZWRdOm5vdCg6ZGlzYWJsZWQpOm5vdChbcmVhZG9ubHldKVwiICsgXCIsdGV4dGFyZWFbcmVxdWlyZWRdOm5vdCg6ZGlzYWJsZWQpOm5vdChbcmVhZG9ubHldKVwiKTtcblxuXHRmb3IgKHZhciBpID0gMDsgaSA8IHJlcXVpcmVkRmllbGRzLmxlbmd0aDsgaSsrKSB7XG5cdFx0aWYgKHJlcXVpcmVkRmllbGRzW2ldLmNoZWNrVmFsaWRpdHkoKSA9PSBmYWxzZSkge1xuXHRcdFx0cmV0dXJuO1xuXHRcdH1cblx0fVxuXHRkaWFsb2cucXVlcnlTZWxlY3RvcignI3Rhc2stZm9ybV9fYWRkJykuc3VibWl0KCk7XG59KTtcblxudmFyIHNvcnRhYmxlID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgndGguc29ydGFibGUnKTtcbnNvcnRhYmxlLmZvckVhY2goZnVuY3Rpb24gKGVudHJ5KSB7XG5cdHZhciBhc2MgPSBlbnRyeS5vdXRlckhUTUwuaW5kZXhPZignc29ydGVkLWFzYycpO1xuXHR2YXIgZGVzYyA9IGVudHJ5Lm91dGVySFRNTC5pbmRleE9mKCdzb3J0ZWQtZGVzYycpO1xuXG5cdGVudHJ5LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXHRcdGxvY2F0aW9uLmhyZWYgPSAnL3Rhc2tzP29yZGVyQnk9JyArIHRoaXMuZ2V0QXR0cmlidXRlKCdkYXRhLW9yZGVyYnknKSArICcmb3JkZXJEaXI9JyArIHRoaXMuZ2V0QXR0cmlidXRlKCdkYXRhLW9yZGVyZGlyJyk7XG5cdH0pO1xuXG5cdGVudHJ5LmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlb3ZlcicsIGZ1bmN0aW9uICgpIHtcblx0XHRpZiAoYXNjID09IC0xICYmIGRlc2MgPT0gLTEpIHtcblx0XHRcdHRoaXMuY2xhc3NOYW1lID0gdGhpcy5jbGFzc05hbWUucmVwbGFjZSgnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1kZXNjZW5kaW5nJywgJycpO1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgKz0gJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtZGVzY2VuZGluZyc7XG5cdFx0fVxuXHRcdGlmIChhc2MgPT0gLTEgJiYgZGVzYyAhPSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnLCAnJyk7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSArPSAnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1hc2NlbmRpbmcnO1xuXHRcdH1cblx0XHRpZiAoYXNjICE9IC0xICYmIGRlc2MgPT0gLTEpIHtcblx0XHRcdHRoaXMuY2xhc3NOYW1lID0gdGhpcy5jbGFzc05hbWUucmVwbGFjZSgnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1hc2NlbmRpbmcnLCAnJyk7XG5cdFx0XHR0aGlzLmNsYXNzTmFtZSArPSAnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1kZXNjZW5kaW5nJztcblx0XHR9XG5cdH0pO1xuXG5cdGVudHJ5LmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlb3V0JywgZnVuY3Rpb24gKCkge1xuXHRcdGlmIChhc2MgPT0gLTEgJiYgZGVzYyA9PSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnLCAnJyk7XG5cdFx0fVxuXHRcdGlmIChhc2MgPT0gLTEgJiYgZGVzYyAhPSAtMSkge1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgPSB0aGlzLmNsYXNzTmFtZS5yZXBsYWNlKCcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWFzY2VuZGluZycsICcnKTtcblx0XHRcdHRoaXMuY2xhc3NOYW1lICs9ICcgbWRsLWRhdGEtdGFibGVfX2hlYWRlci0tc29ydGVkLWRlc2NlbmRpbmcnO1xuXHRcdH1cblx0XHRpZiAoYXNjICE9IC0xICYmIGRlc2MgPT0gLTEpIHtcblx0XHRcdHRoaXMuY2xhc3NOYW1lID0gdGhpcy5jbGFzc05hbWUucmVwbGFjZSgnIG1kbC1kYXRhLXRhYmxlX19oZWFkZXItLXNvcnRlZC1kZXNjZW5kaW5nJywgJycpO1xuXHRcdFx0dGhpcy5jbGFzc05hbWUgKz0gJyBtZGwtZGF0YS10YWJsZV9faGVhZGVyLS1zb3J0ZWQtYXNjZW5kaW5nJztcblx0XHR9XG5cdH0pO1xufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvdGFza3MuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);