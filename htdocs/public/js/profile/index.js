'use strict'
var model_config = {
	basic: {
		url: '/basic/update',
		formElement: $('#basicForm'),
		modelElement: $('#basic-info-modal'),
		clickElement: $('.basic-info'),
		saveElement: $('.basic-modify'),
		contentElement: $('.basic-info .info-content')
	},
	target: {
		url: '/target/update',
		formElement: $('#targetForm'),
		modelElement: $('#target-info-modal'),
		clickElement: $('.target-info'),
		saveElement: $('.target-modify'),
		contentElement: $('.target-info .info-content')
	},
	detail: {
		url: '/detail/update',
		formElement: $('#detailForm'),
		modelElement: $('#detail-info-modal'),
		clickElement: $('.detail-info'),
		saveElement: $('.detail-modify'),
		contentElement: $('.detail-info .info-content')
	}
}
$.each(model_config, function(key, option) {
	option.clickElement.on('click', function(){
		option.modelElement.modal('show')
	})
	option.saveElement.on('click', function(){
		let indexedData = _.indexBy(option.formElement.serializeArray(), 'name')
		$.post(option.url, option.formElement.serialize(), function(res) {
			if(res == 'success') {
				sync(key, option.contentElement, indexedData)
				option.modelElement.modal('hide')
			} else {
				alert(res)
			}
		})
	})
})
$('.pseudo-checkbox').on('click', function(e) {
	let isSelected = $(e.target).data('select') ? 0 : 1
	$(e.target).toggleClass('active').data('select', isSelected)
	let str = ''
	$('.pseudo-checkbox').each(function(){
		if($(this).data('select')) {
			str += $(this).data('value') + " "
		}
	})
	$('.pseudo-checkbox-container').children('input').val(str)
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
