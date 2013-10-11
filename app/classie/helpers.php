<?php

function nullOrEmpty($question)
{
    return (is_null($question) || trim($question) === '');
}

function addDays(\DateTime &$now, $days)
{
	return $now->add(\DateInterval::createFromDateString($days . ' days'));
}