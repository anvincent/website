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
		$sql = "SELECT ''
				UNION
				SELECT a.groupname AS parentgroupname FROM CoreAccountingBundle:Accountgroups a";
		return $this->getEntityManager()
			->createQuery($sql)
			->getResult();
	}
}
