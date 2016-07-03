import Validator from '../module/validator.js'
import GrooveSlider from '../module/groove-slider.js'

const MATCH_URL = '/match/search'

var $board = $('.board')
var $panel = $('.adv-feature')
var $cover = $('#cover')

var baseData = {}
var advanceData = {}
var advKey = []

$('.pop-over').on('click', function(e) {
	e.stopPropagation()
})
$('.pop-switch').on('click', function(e) {
	e.stopPropagation()
	let $parent = $(this).parent()
	$parent.toggleClass('open').siblings().removeClass('open')
	$('body').addClass('pop-open')
})
$('body').on('click', function(e) {
	if($(this).hasClass('pop-open')) {
		$.post(MATCH_URL, baseData, function(res) {
			if(res.data) {
				makeCard(res.data)
			}
		})
		$('.pop-switch').parent().removeClass('open')
		$(this).removeClass('pop-open')
	}
})

const makeCard = (items) => {
	let str = ''
	let d = new Date();
	let y = d.getFullYear();
	$.each(items, function(id, obj) {
		let age = y - parseInt(obj.birth_year)
		str += `<div class="card"><img src="/img/avatar.png"><h4 class="name">${obj.name}</h4><p><span>${age}</span><span>·</span><span>${obj.city}</span></p></div>`
	})
	$board.html(str)
}

const makePanel = (arr) => {
	let str = ''
	$.each(arr, function(key, value) {
		str += `<strong>${value}<span class="clearIt" data-key="${value}"> &times; </span></strong>`
	})
	$panel.html(str)
}

$('.base-choice').on('click', function(e) {
	let $target = $(e.target)
	let key = $target.parent().data('key')
	let val = $target.data('value')


	if(!$target.hasClass('active')) {
		baseData[key] = val
		$target.siblings().removeClass('active')
	}
	$target.toggleClass('active')

})
$('#base-form input').on('change', function(e) {
	let key = $(this).parent().data('key')
	let val = $(this).val()

	if(val) {
		baseData[key] = val
	} else {
		delete baseData[key]
	}
})

$('.adv-choice').on('click', function(e) {
	let $target = $(e.target)
	let val = $target.data('value')
	let k = $target.parent().data('key')

	if($target.hasClass('active')) {
		advKey = _.without(advKey,k)
		delete advanceData[k]
	} else {
		advKey.push(k)
		advanceData[k] = val
	}
	$target.toggleClass('active')

})

$('.advanced-search select').on('change', function() {
	let key = $(this).parent().data('key')
	let val = $(this).val()

	if(val) {
		advanceData[key] = val
		advKey.push(key)
	} else {
		advKey = _.without(advKey,key)
		delete advanceData[key]
	}
})

$('.btn-search').on('click', function(e) {
	if(advKey.length > 0) {
		let data = $.extend(true, advanceData, baseData)
		$.post(MATCH_URL, data, function(res) {
			if(res.data){
				makeCard(res.data)
			}
		})
		makePanel(advKey)
	}
	$('.advanced-search').hide()
	$cover.hide()
	$('.fa-sliders').show()
})

$('.btn-cancel').on('click', function() {
	$('.advanced-search').hide()
})

$('.fa-sliders').on('click', function() {
	$('.advanced-search').show()
	$(this).hide()
	$cover.show()
})

$('.close-cover').on('click', function() {
	$cover.hide()
	$('.fa-sliders').show()
	$('.advanced-search').hide()
})

$('.adv-feature').on('click', '.clearIt', function(e) {
	let key = $(e.target).data('key')
	init(key)
	delete advanceData[key]
	advKey = _.without(advKey,key)
	let data = $.extend(true, advanceData, baseData)
	$.post(MATCH_URL, data, function(res) {
		if(res.data){
			makeCard(res.data)
		}
	})
	makePanel(advKey)
})

var init = function(key) {
	let $sel = $('.tab-pane > div').filter(function() {
		return $(this).data('key') == key;
	})
	let type = $sel.data('type')

	switch (type) {
		case 'select':
			$sel.find('option:nth-child(1)').attr('selected', 'selected')
			break;
		case 'checkbox':
			console.log('checkbox coming soon')
			break;
		default:
			$sel.find('.choice-block').removeClass('active')
	}

}

var smokeSlider = new GrooveSlider('.smoke-slider', 0, {unitLength: 87})

