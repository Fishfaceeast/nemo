import Validator from '../module/validator.js'

const MATCH_URL = '/match/search'
var $board = $('.board')
var $baseForm = $('#base-form')

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
			makeCard(res.data)
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
