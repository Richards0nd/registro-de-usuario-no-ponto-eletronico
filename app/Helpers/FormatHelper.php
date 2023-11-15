<?php

namespace App\Helpers;

class FormatHelper
{
	public static function formatCpf($cpf)
	{
		return substr($cpf, 0, 3) .
			'.' .
			substr($cpf, 3, 3) .
			'.' .
			substr($cpf, 6, 3) .
			'-' .
			substr($cpf, 9, 2);
	}

	public static function formatPhone($phone)
	{
		return '(' . substr($phone, 0, 2) .
			') ' .
			substr($phone, 2, 5) .
			'-' .
			substr($phone, 7, 4);
	}
}
