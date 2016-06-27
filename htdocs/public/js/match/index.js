import Validator from '../module/validator.js'

const MATCH_URL = '/match/search'
var $board = $('.board')
var $baseForm = $('#base-form')
var $panel = $('.adv-feature')

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
		let data = $baseForm.serialize()
		$.post(MATCH_URL, data, function(res) {
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
	console.log(items)
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
		str += `<strong>${value}</strong>`
	})
	$panel.html(str)
}

$('.choice-block').on('click', function(e) {
	let $target = $(e.target)
	let val = $target.data('value')
	$target.toggleClass('active')
	$target.siblings('input').data('value', val)
})

$('.btn-search').on('click', function(e) {
	let $target = $(e.target)
	let $inputs = $target.siblings('div').children('input')
	let advancedData = {}

	$inputs.each(function(index) {
		let k = $(this).data('key')
		let v = $(this).data('value')
		if(v) {
			advancedData[k] = v
		}
	})

	let keys = _.keys(advancedData)
	if(keys.length > 0) {
		let baseData = $baseForm.serialize()
		console.log(baseData)
		console.log(advancedData)
		//let data = $.extend(true, advancedData, baseData)
		$.post(MATCH_URL, advancedData, function(res) {
			if(res.data){
				makeCard(res.data)
			}
		})
		makePanel(keys)
	} else {
		$('.advanced-search').hide()
	}
})

$('.btn-cancel').on('click', function() {
	$('.advanced-search').hide()
})


