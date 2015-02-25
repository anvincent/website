<?php

namespace Core\AccountingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ChartdetailsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChartdetailsRepository extends EntityRepository
{
	public function findAllBudgets()
	{
		return $this->getEntityManager()
			->createQuery(
					'SELECT a.accountcode, a.accountname, sum(b.budget) AS sumbudget
					FROM CoreAccountingBundle:Chartmaster a
					JOIN a.chartdetails b
					GROUP BY a.accountcode, a.accountname
					ORDER BY a.accountcode ASC'
			)->getResult();
	}
	
	public function findBudgetbyid($id)
	{
		return $this->getEntityManager()
			->createQuery(
					'SELECT a.accountcode, a.accountname, sum(b.budget) AS sumbudget
					FROM CoreAccountingBundle:Chartmaster a
					JOIN a.chartdetails b
					WHERE a.accountcode = :id
					GROUP BY a.accountcode, a.accountname
					ORDER BY a.accountcode ASC'
			)->setParameter('id', $id)
			->getResult();
	}
	
	public function findBudgetbyperiod($id)
	{
		return $this->getEntityManager()
		->createQuery(
				'SELECT a.accountcode, a.accountname, sum(b.budget) AS sumbudget
				FROM CoreAccountingBundle:Chartmaster a
				JOIN a.chartdetails b
				WHERE b.period = :id
				GROUP BY a.accountcode, a.accountname
				ORDER BY a.accountcode ASC'
		)->setParameter('id', $id)
		->getResult();
	}
	
	
	
	public function findBudgetactualpriorcurrentnextbyaccount($id,$periodstart,$periodend)
	{
		return $this->getEntityManager()
		->createQuery(
				'SELECT IDENTITY(a.period) AS period, a.actual, a.budget
				FROM CoreAccountingBundle:Chartdetails a
				WHERE a.accountcode = :id
				AND a.period >= :periodstart
				AND a.period <= :periodend'
		)->setParameters(array(
				'id' => $id,
				'periodstart' => $periodstart,
				'periodend' => $periodend
				))
		->getResult();
	}
}
