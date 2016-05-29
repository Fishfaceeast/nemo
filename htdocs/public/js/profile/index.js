'use strict'
const BASIC_URL =  '/basic/update'
const TARGET_URL =  '/target/update'
let $basicInfo = $('.basic-info')
let $targetInfo = $('.target-info')
let $basicModify = $('.basic-modify')
let $targetModify = $('.target-modify')

$basicInfo.on('click', function(e) {
	$('#basic-info-modal').modal('show')
})
$targetInfo.on('click', function(e) {
	$('#target-info-modal').modal('show')
})
const sync = (sel, data) => {
	console.log(data)
	var str = ''
	$.each(data, function(key, item){
		str += `<p><span>${key}: </span>${item.value}</p>`
	})
	sel.html(str)
}
$basicModify.on('click', function() {
	let basic = _.indexBy($('#basicForm').serializeArray(), 'name')
	$.post(BASIC_URL, $('#basicForm').serialize(), function(res) {
		if(res == 'success') {
			sync($('.basic-info .info-content'), basic)
			$('#basic-info-modal').modal('hide')
		} else {
			alert(res)
		}
	})
})
$targetModify.on('click', function() {
	let target = _.indexBy($('#targetForm').serializeArray(), 'name')
	$.post(TARGET_URL, $('#targetForm').serialize(), function(res) {
		if(res == 'success') {
			sync($('.target-info .info-content'), target)
			$('#target-info-modal').modal('hide')
		} else {
			alert(res)
		}
	})
})
