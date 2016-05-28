'use strict'
const BASIC_URL =  '/basic/update'
let $basicInfo = $('.basic-info')
let $basicModify = $('.basic-modify')

$basicInfo.on('click', function(e) {
	$('#basic-info-modal').modal('show')
})
const sync = (sel, data, tpl) => {
	sel.text(tpl)
}
$basicModify.on('click', function() {
	let basic = _.indexBy($('#basicForm').serializeArray(), 'name')
	$.post(BASIC_URL, $('#basicForm').serialize(), function() {
		let tpl = `${basic.gender.value} • ${basic.city.value} • ${basic.birth_year.value}`
		sync($('.basic-info .info-content'), basic, tpl)
		$('#basic-info-modal').modal('hide')
	})
})
