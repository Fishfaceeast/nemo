/**
 * Created by yuqian on 16/6/3.
 */

~function($) {
	'use strict'

	function Validator(form, option) {
		this.$form = $(form)
		this.option = option || {}
		this.patterns = {
			number: /^\-?(?:[1-9]\d*|0)(?:[.]\d)?$/
		}
		this.after = option.after || function() {
			return true;
		}
		this.$items = this.captureItem()
		this.bindEvents()
	}
	Validator.prototype = {
		bindEvents: function() {
			var self = this
			this.$form.on('submit', function() {
				self.validateForm()
			})
			this.$form.on('after', function() {
				self.after()
			})
			this.$items.on('blur', function() {
				self.validate($(this))
			})
			this.$items.on('focusin', function(e) {
				$(e.target).parent().removeClass('empty error')
			})
		},
		captureItem: function() {
			return this.$form.find('input, textarea, checkbox').filter(function(){
					return $(this).data('required') == '1'
				})
		},
		validate: function(item) {
			var pattern = this.patterns[$(item).data('pattern')]
			var $parent = $(item).parent()
			var text = $(item).val()
			if(!text) {
				$parent.addClass('empty')
				return false
			}
			if(pattern) {
				if(!pattern.test(text)) {
					$parent.addClass('error')
					return false
				}
			}
			return true
		},
		validateForm: function(){
			var self = this
			var unvalidFields = []
			this.$items.each(function() {
				if(!self.validate($(this))) {
					unvalidFields.push($(this))
				}
			})
			if(!unvalidFields.length) {
				this.$form.trigger('after')
			}
			return !unvalidFields.length
		}

	}
	$.fn.validator = function(option) {
		return new Validator(this, option)
	}
}(jQuery)

