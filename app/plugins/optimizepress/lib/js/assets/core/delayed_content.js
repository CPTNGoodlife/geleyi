var op_asset_settings = {
	attributes: {
		step_1: {
			style: {
				type: 'style-selector',
				folder: '',
				addClass: 'op-disable-selected'
			}
		},
		step_2: {
			timer: {
				title: 'timer',
				default_value: '1',
				help: 'dynamic_delay_timer',
				suffix: ''
			},
			content: {
				title: 'content',
				type: 'wysiwyg'
			}
		}
	},
	insert_steps: {2:true}
};