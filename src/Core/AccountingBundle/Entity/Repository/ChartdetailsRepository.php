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
					'SELECT a, b
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
					'SELECT a, b
					FROM CoreAccountingBundle:Chartmaster a
					JOIN a.chartdetails b
					WHERE a.accountcode = :id
					GROUP BY a.accountcode, a.accountname
					ORDER BY a.accountcode ASC'
			)->setParameter('id', $id)
			->getResult();
	}
}
