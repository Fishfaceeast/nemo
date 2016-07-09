import Validator from '../module/validator.js'

const URL = {
	'refer': '/refer/update',
	'about': '/about/update'
}

var model_config = {
	basic: {
		url: '/basic/update',
		formElement: $('#basicForm'),
		modelElement: $('#basic-info-modal'),
		clickElement: $('.basic-info'),
		saveElement: $('.basic-modify'),
		contentElement: $('.basic-info .info-content'),
		validator: {},
	},
	target: {
		url: '/target/update',
		formElement: $('#targetForm'),
		modelElement: $('#target-info-modal'),
		clickElement: $('.target-info'),
		saveElement: $('.target-modify'),
		contentElement: $('.target-info .info-content'),
		validator: {},
	},
	detail: {
		url: '/detail/update',
		formElement: $('#detailForm'),
		modelElement: $('#detail-info-modal'),
		clickElement: $('.detail-info'),
		saveElement: $('.detail-modify'),
		contentElement: $('.detail-info .info-content'),
		validator: {},
	}
}

$.each(model_config, function(key, option) {
	option.validator = new Validator(option.formElement, {})
	option.clickElement.on('click', function(){
		option.modelElement.modal('show')
	})
	option.saveElement.on('click', function(){
		let indexedData = _.indexBy(option.formElement.serializeArray(), 'name')
		if(option.validator.validateForm()) {
			$.post(option.url, option.formElement.serialize(), function(res) {
				if(res == 'success') {
					sync(key, option.contentElement, indexedData)
					option.modelElement.modal('hide')
				} else {
					alert(res)
				}
			})
		}
	})
})

$('.pseudo-radio').on('click', function(e) {
	let $target = $(e.target)
	let isSelected = $target.data('select') ? 0 : 1
	if (isSelected) {
		$target.addClass('active').siblings('.pseudo-radio').removeClass('active').data('select', 0)
		$target.siblings('input').val($target.data('value'))
	} else {
		$target.removeClass('active')
		$target.siblings('input').val('')
	}
	$target.data('select', isSelected)
})
const sync = (key, sel, data) => {
	let str = ''
	if(key == 'basic') {
		let i = 0
		$.each(data, function(k, item){
			str += i ? ` • ${item.value}` : `${item.value}`
			i++
		})
		sel.text(str)
	} else {
		let txtMap = __data[key]
		$.each(data, function(k, item){
			let txt = txtMap[k].cname
			str += `<p><span>${txt}: </span>${item.value}</p>`
		})
		sel.html(str)
	}
}
$('.refer-info-wrapper .fa-pencil, .about-info-wrapper .fa-pencil').on('click', function(e) {
	let $parent = $(e.target).parent()
	$parent.siblings('p').hide().siblings('fieldset').show()
})
$('.refer-modify, .about-modify').on('click', function(e) {
	let $textarea = $(e.target).siblings('textarea')
	let $fieldset = $(e.target).parent()
	let $p = $fieldset.siblings('p')
	let val = $textarea.val()
	let key = $textarea.attr('id')
	let data = {}
	data[key] = val
	let name = $(e.target).attr('name')
	let url = URL[name]
	$.post(url, data, function(res){
		if(res == 'success') {
			$p.text(val).show()
		} else {
			alert(res)
		}
		$fieldset.hide()
	})
})
$('.refer-cancel, .about-cancel').on('click', function(e) {
	$(e.target).parent().hide().siblings('p').show()
})
