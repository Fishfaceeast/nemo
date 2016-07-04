/**
 * Created by yuqian on 16/7/2.
 */
const _template = `
	<div class="groove-bar clearfix">
		<strong class="meter"></strong>
		<span class="groove" data-value="1"></span>
		<span class="groove" data-value="2"></span>
		<span class="groove" data-value="3"></span>
	</div>
	<div class="leftHandle"></div>
	<div class="rightHandle "></div>
	<p class="reset">重置</p>
	`
const UNITTIME = 300

export default class GrooveSlider {
	constructor(publicVehicle, target, prop, config) {
		this.publicVehicle = publicVehicle
		this.privateVehicle = $({})
		this.$wrapper = $('<div class="groove-slider"></div>')
		this.state = prop
		this.unit = config.unitLength
		this.fieldKey = config.fieldKey
		this._init(target)
		this.$meter = this.$wrapper.find('.meter')
		this.$leftHandle = this.$wrapper.find('.leftHandle')
		this.$rightHandle = this.$wrapper.find('.rightHandle')
	}
	_init(target) {
		this._creatAction()
		this._handleAction()
		$(target).append(this._render().$wrapper)
	}
	_render() {
		this.$wrapper.html(_template)
		return this
	}
	_creatAction() {
		let self = this
		self.$wrapper.on('click', '.groove', function(e) {
			let $target = $(e.target)
			let val = parseInt($target.data('value'))
			if (val != self.state) {
				self.privateVehicle.trigger('action::select', val)
			}
		})
		self.$wrapper.on('click', '.reset', function(e) {
			self.privateVehicle.trigger('action::reset')
		})
	}
	_handleAction() {
		let self = this
		self.privateVehicle.on('action::select', function(e, val) {
			let delta = val - self.state
			let deltaL = delta * self.unit

			if(self.state == 0) {
				let q = {
					left: "+=" + (deltaL - self.unit) + "px"
				}
				let time = Math.abs(UNITTIME * (delta - 1))
				self.$meter.animate({
					width: "85px"
				}, UNITTIME, function() {
					self.$leftHandle.animate(q, time)
				}).animate(q, time)
				self.$rightHandle.animate({
					left: "+=" + self.unit + "px"
				}, UNITTIME).animate(q, time)
			} else {
				let p = {
					left: "+=" + deltaL + "px"
				}
				let time = Math.abs(UNITTIME * delta)
				self.$meter.animate(p, time )
				self.$leftHandle.animate(p, time )
				self.$rightHandle.animate(p, time )
			}

			self.state = val
			self.publicVehicle.trigger('grooveSlider::select', [self.state, self.fieldKey])
		})
		self.privateVehicle.on('action::reset', function() {
			self.reset()
			self.publicVehicle.trigger('grooveSlider::reset', [self.state, self.fieldKey])
		})
	}

	reset() {
		this.state = 0
		this._render()
		// after render, these three elements should be passed again
		this.$meter = this.$wrapper.find('.meter')
		this.$leftHandle = this.$wrapper.find('.leftHandle')
		this.$rightHandle = this.$wrapper.find('.rightHandle')

		return this
	}

}

