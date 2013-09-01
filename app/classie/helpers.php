<?php

function nullOrEmpty($question)
{
    return (is_null($question) || trim($question) === '');
}

function fallback($value, $default)
{
	return (nullOrEmpty($value)) ? $default : $value;
}