module.exports = {
	env: {
		browser: true,
		es2021: true,
		node: true,
		php: true
	},
	extends: ['eslint:recommended'],
	parserOptions: {
		ecmaVersion: 'latest',
		sourceType: 'module'
	},
	rules: {
		quotes: ['error', 'single'],
		indent: ['error', 'tab'],
		'comma-spacing': [
			'error',
			{
				before: false,
				after: true
			}
		],
		'prettier/prettier': 'error',
		'arrow-body-style': 'off',
		'prefer-arrow-callback': 'off'
	},
	plugins: ['prettier', '@prettier/plugin-php']
}