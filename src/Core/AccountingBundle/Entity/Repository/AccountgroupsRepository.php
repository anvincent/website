<?php

namespace Core\AccountingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AccountgroupsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccountgroupsRepository extends EntityRepository
{
	public function getParentGroups()
	{
		$sql = "('')
				UNION
				(SELECT t.groupname AS parentgroupname FROM CoreAccountingBundle:Accountgroups t)";
		return $this->getEntityManager()
			->createQuery($sql)
			->getResult();
	}
}
