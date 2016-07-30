import Validator from '../module/validator.js'
import GrooveSlider from '../module/groove-slider.js'

const MATCH_URL = '/match/search'
const sliderDataMap = {
	'smoking': {
		'0': '',
		'1': '否',
		'2': '有时',
		'3': '是',
	},
	'drinking': {
		'0': '',
		'1': '否',
		'2': '社交场合',
		'3': '是',
	}
}

var baseTemplate = data => `
	<strong>
		搜一下：
		<i class="pop-switch">
			${data["gender"]}，
		</i>
		<span class="arrow-box pop-over">
			<div data-key="gender">
				<span class="choice-block base-choice ${isChoiceActive('gender', '男')}" data-value="男">男</span>
				<span class="choice-block base-choice ${isChoiceActive('gender', '女')}" data-value="女">女</span>
			</div>
		</span>
	</strong>
	<strong>
		年龄
		<i class="pop-switch">
			${data["latestBirth"]}-${data["earliestBirth"]}
		</i>
		，
		<span class="arrow-box pop-over arrow-box-range">
			<label data-key="latestBirth">
				<input type="text" value="${data["latestBirth"]}"/>
			</label>
			<span> - </span>
			<label data-key="earliestBirth">
				<input type="text" value="${data["earliestBirth"]}"/>
			</label>
		</span>
	</strong>
	<strong>
		对
		<i class="pop-switch">
			${data["target_gender"]}性
		</i>
		感兴趣，
		<span class="arrow-box pop-over arrow-box-target-gender">
			<div data-key="target_gender">
				<span class="choice-block base-choice ${isChoiceActive('target_gender', '男')}" data-value="男">男</span>
				<span class="choice-block base-choice ${isChoiceActive('target_gender', '女')}" data-value="女">女</span>
			</div>
		</span>
	</strong>
	<strong>
		城市
		<i class="pop-switch">
			${data["city"]}
		</i>
		。
		<span class="arrow-box pop-over">
			<div data-key="city">
				<input id="city" type="text" value="${data['city']}"/>
			</div>
		</span>
	</strong>
	`

function isChoiceActive(key, value) {
	return value == baseData[key] ? 'active' : ''
}

var baseData = {}
const initBaseData = () => {
	let dic = {
		ageMin : 'latestBirth',
		ageMax: 'earliestBirth',
		target_gender: 'gender',
		gender: 'target_gender',
		city: 'city'
	}
	_.each(dic, function(neoKey, rawKey) {
		baseData[neoKey] = __data.defaultBase[rawKey] ? __data.defaultBase[rawKey].value : '';
	})
}
initBaseData()

var $baseForm = $('#base-form')
var $board = $('.board')
var $panel = $('.adv-feature')
var $cover = $('#cover')

var advanceData = {}
var advKey = []

var vehicle = $({})

function renderSentence(data) {
	$baseForm.html(baseTemplate(data))
}

const sendQuery = (req) => {
	$.post(MATCH_URL, req, (res) => {
		if(res.data){
			makeCard(res.data)
		}
	})
}

$baseForm.on('click', '.pop-over', function(e) {
	e.stopPropagation()
})
$baseForm.on('click', '.pop-switch', function(e) {
	e.stopPropagation()
	let $parent = $(this).parent()
	$parent.toggleClass('open').siblings().removeClass('open')
	$('body').addClass('pop-open')
})
$baseForm.on('click', '.base-choice', function(e) {
	let $target = $(e.target)
	let key = $target.parent().data('key')
	let val = $target.data('value')

	if($target.hasClass('active')) {
		delete baseData[key]
	} else {
		baseData[key] = val
		$target.siblings().removeClass('active')
	}
	$target.toggleClass('active')

})
$baseForm.on('change', 'input', function() {
	let key = $(this).parent().data('key')
	let val = $(this).val()

	if(val) {
		baseData[key] = val
	} else {
		delete baseData[key]
	}
})
$('body').on('click', function(e) {
	if($(this).hasClass('pop-open')) {
		renderSentence(baseData)
		sendQuery(baseData)
		$('.pop-switch').parent().removeClass('open')
		$(this).removeClass('pop-open')
	}
})

const makeCard = (items) => {
	let str = ''
	let d = new Date()
	let y = d.getFullYear()
	$.each(items, function(id, obj) {
		let age = y - parseInt(obj.birth_year)
		let url = '/u/' + obj.user_id
		str += `<a class="card" href="${url}" target="_blank"><img src="/img/avatar.png"><h4 class="name">${obj.name}</h4><p><span>${age}</span><span>·</span><span>${obj.city}</span></p></a>`
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

$('.adv-choice').on('click', function(e) {
	let $target = $(e.target)
	let val = $target.data('value')
	let k = $target.parent().data('key')

	if($target.hasClass('active')) {
		advKey = _.without(advKey,k)
		delete advanceData[k]
	} else {
		if(_.indexOf(advKey, k) == -1 ) {
			advKey.push(k)
		}
		advanceData[k] = val
		$target.siblings('.adv-choice').removeClass('active')
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
	let data = $.extend(true, advanceData, baseData)
	sendQuery(data)
	makePanel(advKey)
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

$panel.on('click', '.clearIt', function(e) {
	let key = $(e.target).data('key')
	init(key)
	delete advanceData[key]
	advKey = _.without(advKey,key)
	let data = $.extend(true, advanceData, baseData)
	sendQuery(data)
	makePanel(advKey)
})

var init = function(key) {
	let $sel = $('.tab-pane > div').filter(function() {
		return $(this).data('key') == key
	})
	let type = $sel.data('type')

	switch (type) {
		case 'select':
			$sel.find('option:nth-child(1)').attr('selected', 'selected')
			break
		case 'checkbox':
			console.log('checkbox coming soon')
			break
		case 'smokingSlider':
			smokingSlider.reset()
			vehicle.trigger('grooveSlider::reset', [0, key])
			break
		case 'drikingSlider':
			drikingSlider.reset()
			vehicle.trigger('grooveSlider::reset', [0, key])
			break
		default:
			$sel.find('.choice-block').removeClass('active')
	}

}

var smokingSlider = new GrooveSlider(vehicle, '.smoke-slider', 0, {
	unitLength: 85,
	fieldKey: 'smoking'
})

var drinkingSlider = new GrooveSlider(vehicle, '.drink-slider', 0, {
	unitLength: 85,
	fieldKey: 'drinking'
})

vehicle.on('grooveSlider::select', function(e, state, k) {
	advanceData[k] = sliderDataMap[k][state]
	advKey.push(k)
})

vehicle.on('grooveSlider::reset', function(e, state, k) {
	delete advanceData[k]
	advKey = _.without(advKey,k)
})

renderSentence(baseData)
sendQuery(baseData)
