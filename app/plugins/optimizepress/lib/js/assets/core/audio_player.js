;var op_asset_settings = {
		help_vids: {
			step_1: {
				url: 'http://op2-inapp.s3.amazonaws.com/elements-audioPlayer.mp4',
				width: '600',
				height: '341'
			},
			step_2: {
				url: 'http://op2-inapp.s3.amazonaws.com/elements-audioPlayer.mp4',
				width: '600',
				height: '341'
			}
		},
	attributes: {
		step_1: {
			style: {
				type: 'style-selector',
				folder: 'previews',
				addClass: 'op-disable-selected'
			}
		},
		step_2: {
			url: {
				title: 'URL',
				type: 'text'
			},
			auto_play: {
				title: 'auto_play',
				type: 'checkbox'
			}
		}
	},
	insert_steps: {2:true}
};