<?php
// src/Core/AccountingBundle/Entity/Budget.php
//	Placeholder class to build budget forms

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class Budget
{
	// Properties

	protected $accountcode;

	protected $budgets;

	// Methods

    public function __construct()
    {
    	$this->budgets = new ArrayCollection();
    }
    
	/**
	 * Set accountcode
	 *
	 * @param integer $accountcode
	 * @return Chartdetails
	 */
	public function setAccountcode($accountcode)
	{
		$this->accountcode = $accountcode;

		return $this;
	}

	/**
	 * Get accountcode
	 *
	 * @return integer
	 */
	public function getAccountcode()
	{
		return $this->accountcode;
	}

	/**
	 * Set budgets
	 *
	 * @param float $budgets
	 * @return Chartdetails
	 */
	public function setBudgets($budgets)
	{
		$this->budgets = $budgets;

		return $this;
	}

	/**
	 * Get budgets
	 *
	 * @return float
	 */
	public function getBudgets()
	{
		return $this->budgets;
	}
}