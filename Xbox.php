<?php

class Xbox extends OpenXBL
{
	public function __construct($apiKey)
	{
		parent::__construct($apiKey);
	}

	/*
		A few examples of how to use the API. The key
		gets passed to the parent class OpenXBL which 
		makes the call to the service.

		Abuse is handled on a per-user basis. If you
		troll the system we will terminate your access.
	*/
	public function getAccount()
	{
		return parent::call('GET', '/account');
	}

	public function getFriends()
	{
		return parent::call('GET', '/friends');
	}
	
	public function getConversations()
	{
		return parent::call('GET', '/conversations');
	}
} 