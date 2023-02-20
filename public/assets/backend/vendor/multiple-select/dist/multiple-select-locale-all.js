(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (global = global || self, factory(global.jQuery));
}(this, function ($) { 'use strict';

  $ = $ && $.hasOwnProperty('default') ? $['default'] : $;

  /**
   * Multiple Select English translation
   * Author: Zhixin Wen<wenzhixin2010@gmail.com>
   */

  $.fn.multipleSelect.locales['en-US'] = {
    formatSelectAll: function formatSelectAll() {
      return '[Select all]';
    },
    formatAllSelected: function formatAllSelected() {
      return 'All selected';
    },
    formatCountSelected: function formatCountSelected(count, total) {
      return count + ' of ' + total + ' selected';
    },
    formatNoMatchesFound: function formatNoMatchesFound() {
      return 'No matches found';
    }
  };
  $.extend($.fn.multipleSelect.defaults, $.fn.multipleSelect.locales['en-US']);

  /**
   * Multiple Select English translation
   * Author: Zhixin Wen<wenzhixin2010@gmail.com>
   */

  $.fn.multipleSelect.locales['zh-CN'] = {
    formatSelectAll: function formatSelectAll() {
      return '[全选]';
    },
    formatAllSelected: function formatAllSelected() {
      return '已选择所有记录';
    },
    formatCountSelected: function formatCountSelected(count, total) {
      return '已从' + total + '条记录中选择' + count + '条';
    },
    formatNoMatchesFound: function formatNoMatchesFound() {
      return '没有找到记录';
    }
  };
  $.extend($.fn.multipleSelect.defaults, $.fn.multipleSelect.locales['zh-CN']);

  /**
   * Multiple Select English translation
   * Author: Zhixin Wen<wenzhixin2010@gmail.com>
   */

  $.fn.multipleSelect.locales['zh-TW'] = {
    formatSelectAll: function formatSelectAll() {
      return '[全選]';
    },
    formatAllSelected: function formatAllSelected() {
      return '已選擇所有記錄';
    },
    formatCountSelected: function formatCountSelected(count, total) {
      return '已從' + total + '條記錄中選擇' + count + '條';
    },
    formatNoMatchesFound: function formatNoMatchesFound() {
      return '沒有找到記錄';
    }
  };
  $.extend($.fn.multipleSelect.defaults, $.fn.multipleSelect.locales['zh-TW']);

}));
