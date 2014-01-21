<?php

require_once(OP_MOD . 'email/ProviderInterface.php');
require_once(OP_LIB . 'vendor/getresponse/GetResponseAPI.class.php');

/**
 * GetResponse email integration provider
 * @author Luka Peharda <luka.peharda@gmail.com>
 */
class OptimizePress_Modules_Email_Provider_GetResponse implements OptimizePress_Modules_Email_ProviderInterface
{
	const OPTION_NAME_API_KEY = 'getresponse_api_key';

	/**
	 * @var GetResponse
	 */
	protected $client = null;

	/**
	 * @var boolean
	 */
	protected $apiKey = false;

	/**
	 * Initializes client object and fetches API KEY
	 */
	public function __construct()
	{
		/*
		 * Fetching API key from the wp_options table
		 */
		$this->apiKey = op_get_option(self::OPTION_NAME_API_KEY);		
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::subscribe()
	 */
	public function getClient()
	{
		if (null === $this->client) {
			$this->client = new GetResponse($this->apiKey);
		}

		return $this->client;
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::getLists()
	 */
	public function getLists()
	{
		return $this->getClient()->getCampaigns();
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::getData()
	 */
	public function getData()
	{
		$data = array(
			'lists' => array()
		);

		$params = $this->getCustomFields();

		/*
		 * List parsing
		 */
		$lists = $this->getLists();
		if ($lists) {
			foreach ($lists as $id => $list) {
				$data['lists'][$id] = array('name' => $list->name, 'fields' => $params);
			}
		}

		return $data;
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::subscribe()
	 */
	public function subscribe($data)
	{	
		if (isset($data['list']) && isset($data['email'])) {

			$params = $this->prepareMergeVars();

			$this->getClient()->addContact($data['list'], op_post('name') !== false ? op_post('name') : '', $data['email'], 'standard', 0, $params);

			return true;
		} else {
			wp_die('Mandatory information not present [list and/or email address ].');
		}	
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::register()
	 */
	public function register($list, $email, $fname, $lname)
	{
		$this->getClient()->addContact($list, $fname . ' ' . $lname, $email, 'standard', 0, null);

		return true;
	}

	/**
	 * Searches for possible form fields from POST and adds them to the collection
	 * @return null|array     Null if no value/field found
	 */
	protected function prepareMergeVars()
	{
		$vars = array();
		$allowed = array_keys($this->getCustomFields());

		foreach ($allowed as $name) {
			if ($name !== 'name' && op_post($name) !== false) {
				$vars[$name] = op_post($name);
			}
		}

		if (count($vars) === 0) {
			$vars = null;
		}

		return $vars;
	}

	/**
	 * @see OptimizePress_Modules_Email_ProviderInterface::isEnabled()
	 */
	public function isEnabled()
	{
		return $this->apiKey === false ? false : true;
	}

	/**
	 * Returns form fields for given list
	 * @return array
	 */
	public function getCustomFields()
	{
		$fields = array('name' => __('Name', OP_SN));

		$vars = $this->getClient()->getAccountCustoms();

		foreach ($vars as $var) {
			$fields[$var->name] = $var->name;
		}

		return $fields;
	}
}