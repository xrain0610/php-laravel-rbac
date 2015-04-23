<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines - cn
	|--------------------------------------------------------------------------
	| 验证器中文语言文件
	| By DongShuai
	*/

	"accepted"             => "必须同意 :attribute 才能继续",
	"active_url"           => ":attribute 不是有效的URL",
	"after"                => ":attribute 必须晚于 :date.",
	"alpha"                => ":attribute 必须全部是字母.",
	"alpha_dash"           => ":attribute 只能包含字母,数字,下划线(_)",
	"alpha_num"            => ":attribute 只能包含字母,数字",
	"array"                => ":attribute 必须是数组",
	"before"               => ":attribute 需要早于 :date.",
	"between"              => [
		"numeric" => ":attribute 需大于 :min 且小于 :max.",
		"file"    => ":attribute 文件大小必须介于 :min ~ :max KB.",
		"string"  => ":attribute 长度需大于 :min 且小于 :max .",
		"array"   => ":attribute 必须包含 :min ~ :max 个元素.",
	],
	"boolean"              => ":attribute 必须为 true 或 false",
	"confirmed"            => ":attribute 不匹配",
	"date"                 => ":attribute 不是有效的日期.",
	"date_format"          => ":attribute 格式必须为 :format.",
	"different"            => ":attribute and :other must be different.",
	"digits"               => ":attribute 必须为 :digits 位.",
	"digits_between"       => ":attribute must be between :min and :max digits.",
	"email"                => ":attribute 无效.",
	"filled"               => ":attribute field is required.",
	"exists"               => ":attribute 已经存在.",
	"image"                => ":attribute 必须是图片文件.",
	"in"                   => "selected :attribute is invalid.",
	"integer"              => ":attribute must be an integer.",
	"ip"                   => ":attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => ":attribute may not be greater than :max.",
		"file"    => ":attribute 不能超过 :max KB.",
		"string"  => ":attribute may not be greater than :max characters.",
		"array"   => ":attribute may not have more than :max items.",
	],
	"mimes"                => ":attribute 必须是 :values 文件.",
	"min"                  => [
		"numeric" => ":attribute must be at least :min.",
		"file"    => ":attribute must be at least :min kilobytes.",
		"string"  => ":attribute 至少 :min 个字符.",
		"array"   => ":attribute must have at least :min items.",
	],
	"not_in"               => "selected :attribute is invalid.",
	"numeric"              => ":attribute 必须为纯数字.",
	"regex"                => ":attribute 规则不匹配.",
	"required"             => ":attribute 不能为空.",
	"required_if"          => ":attribute field is required when :other is :value.",
	"required_with"        => ":attribute field is required when :values is present.",
	"required_with_all"    => ":attribute field is required when :values is present.",
	"required_without"     => ":attribute field is required when :values is not present.",
	"required_without_all" => ":attribute field is required when none of :values are present.",
	"same"                 => ":attribute 和 :other 不相同.",
	"size"                 => [
		"numeric" => ":attribute 至少 :size 位.",
		"file"    => ":attribute must be :size kilobytes.",
		"string"  => ":attribute 至少 :size 位.",
		"array"   => ":attribute must contain :size items.",
	],
	"unique"               => ":attribute 已经存在.",
	"url"                  => ":attribute format is invalid.",
	"timezone"             => ":attribute must be a valid zone.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		'username' => '用户名',
		'name' => '名称',
		'password' => '密码',
		'email' => 'Email',
		'cell' => '手机',
		'desc' => '描述',
		'oldpass' => '当前密码',
		'newpass' => '新密码',
		'conpass' => '确认密码',
		'photo' => '照片文件',
		'title' => '标题',
		'author' => '作者',
		'text' => '文本',
		'audio' => '音频',
		'video' => '视频',
		'img' => '图片',
		'start' => '发布日期',
	],

];
