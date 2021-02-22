<?php

namespace ContactOptionBuilder\Model\Base;

use \Exception;
use \PDO;
use ContactOptionBuilder\Model\ContactOptionFormBuilder as ChildContactOptionFormBuilder;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery as ChildContactOptionFormBuilderI18nQuery;
use ContactOptionBuilder\Model\ContactOptionFormBuilderQuery as ChildContactOptionFormBuilderQuery;
use ContactOptionBuilder\Model\Map\ContactOptionFormBuilderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'contact_option_form_builder' table.
 *
 *
 *
 * @method     ChildContactOptionFormBuilderQuery orderByIdCofb($order = Criteria::ASC) Order by the id_cofb column
 * @method     ChildContactOptionFormBuilderQuery orderByTypeUserCofb($order = Criteria::ASC) Order by the type_user_cofb column
 * @method     ChildContactOptionFormBuilderQuery orderByOrderOptCofb($order = Criteria::ASC) Order by the order_opt_cofb column
 * @method     ChildContactOptionFormBuilderQuery orderByRaisonSocialeOptCofb($order = Criteria::ASC) Order by the raison_sociale_opt_cofb column
 *
 * @method     ChildContactOptionFormBuilderQuery groupByIdCofb() Group by the id_cofb column
 * @method     ChildContactOptionFormBuilderQuery groupByTypeUserCofb() Group by the type_user_cofb column
 * @method     ChildContactOptionFormBuilderQuery groupByOrderOptCofb() Group by the order_opt_cofb column
 * @method     ChildContactOptionFormBuilderQuery groupByRaisonSocialeOptCofb() Group by the raison_sociale_opt_cofb column
 *
 * @method     ChildContactOptionFormBuilderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactOptionFormBuilderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactOptionFormBuilderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactOptionFormBuilderQuery leftJoinContactOptionFormBuilderI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactOptionFormBuilderI18n relation
 * @method     ChildContactOptionFormBuilderQuery rightJoinContactOptionFormBuilderI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactOptionFormBuilderI18n relation
 * @method     ChildContactOptionFormBuilderQuery innerJoinContactOptionFormBuilderI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactOptionFormBuilderI18n relation
 *
 * @method     ChildContactOptionFormBuilder findOne(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuilder matching the query
 * @method     ChildContactOptionFormBuilder findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuilder matching the query, or a new ChildContactOptionFormBuilder object populated from the query conditions when no match is found
 *
 * @method     ChildContactOptionFormBuilder findOneByIdCofb(int $id_cofb) Return the first ChildContactOptionFormBuilder filtered by the id_cofb column
 * @method     ChildContactOptionFormBuilder findOneByTypeUserCofb(boolean $type_user_cofb) Return the first ChildContactOptionFormBuilder filtered by the type_user_cofb column
 * @method     ChildContactOptionFormBuilder findOneByOrderOptCofb(boolean $order_opt_cofb) Return the first ChildContactOptionFormBuilder filtered by the order_opt_cofb column
 * @method     ChildContactOptionFormBuilder findOneByRaisonSocialeOptCofb(boolean $raison_sociale_opt_cofb) Return the first ChildContactOptionFormBuilder filtered by the raison_sociale_opt_cofb column
 *
 * @method     array findByIdCofb(int $id_cofb) Return ChildContactOptionFormBuilder objects filtered by the id_cofb column
 * @method     array findByTypeUserCofb(boolean $type_user_cofb) Return ChildContactOptionFormBuilder objects filtered by the type_user_cofb column
 * @method     array findByOrderOptCofb(boolean $order_opt_cofb) Return ChildContactOptionFormBuilder objects filtered by the order_opt_cofb column
 * @method     array findByRaisonSocialeOptCofb(boolean $raison_sociale_opt_cofb) Return ChildContactOptionFormBuilder objects filtered by the raison_sociale_opt_cofb column
 *
 */
abstract class ContactOptionFormBuilderQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \ContactOptionBuilder\Model\Base\ContactOptionFormBuilderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilder', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactOptionFormBuilderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactOptionFormBuilderQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilderQuery) {
            return $criteria;
        }
        $query = new \ContactOptionBuilder\Model\ContactOptionFormBuilderQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildContactOptionFormBuilder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContactOptionFormBuilderTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildContactOptionFormBuilder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID_COFB, TYPE_USER_COFB, ORDER_OPT_COFB, RAISON_SOCIALE_OPT_COFB FROM contact_option_form_builder WHERE ID_COFB = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildContactOptionFormBuilder();
            $obj->hydrate($row);
            ContactOptionFormBuilderTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildContactOptionFormBuilder|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCofb(1234); // WHERE id_cofb = 1234
     * $query->filterByIdCofb(array(12, 34)); // WHERE id_cofb IN (12, 34)
     * $query->filterByIdCofb(array('min' => 12)); // WHERE id_cofb > 12
     * </code>
     *
     * @param     mixed $idCofb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByIdCofb($idCofb = null, $comparison = null)
    {
        if (is_array($idCofb)) {
            $useMinMax = false;
            if (isset($idCofb['min'])) {
                $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $idCofb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCofb['max'])) {
                $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $idCofb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $idCofb, $comparison);
    }

    /**
     * Filter the query on the type_user_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeUserCofb(true); // WHERE type_user_cofb = true
     * $query->filterByTypeUserCofb('yes'); // WHERE type_user_cofb = true
     * </code>
     *
     * @param     boolean|string $typeUserCofb The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByTypeUserCofb($typeUserCofb = null, $comparison = null)
    {
        if (is_string($typeUserCofb)) {
            $type_user_cofb = in_array(strtolower($typeUserCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::TYPE_USER_COFB, $typeUserCofb, $comparison);
    }

    /**
     * Filter the query on the order_opt_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderOptCofb(true); // WHERE order_opt_cofb = true
     * $query->filterByOrderOptCofb('yes'); // WHERE order_opt_cofb = true
     * </code>
     *
     * @param     boolean|string $orderOptCofb The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByOrderOptCofb($orderOptCofb = null, $comparison = null)
    {
        if (is_string($orderOptCofb)) {
            $order_opt_cofb = in_array(strtolower($orderOptCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::ORDER_OPT_COFB, $orderOptCofb, $comparison);
    }

    /**
     * Filter the query on the raison_sociale_opt_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByRaisonSocialeOptCofb(true); // WHERE raison_sociale_opt_cofb = true
     * $query->filterByRaisonSocialeOptCofb('yes'); // WHERE raison_sociale_opt_cofb = true
     * </code>
     *
     * @param     boolean|string $raisonSocialeOptCofb The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByRaisonSocialeOptCofb($raisonSocialeOptCofb = null, $comparison = null)
    {
        if (is_string($raisonSocialeOptCofb)) {
            $raison_sociale_opt_cofb = in_array(strtolower($raisonSocialeOptCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB, $raisonSocialeOptCofb, $comparison);
    }

    /**
     * Filter the query by a related \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n object
     *
     * @param \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n|ObjectCollection $contactOptionFormBuilderI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function filterByContactOptionFormBuilderI18n($contactOptionFormBuilderI18n, $comparison = null)
    {
        if ($contactOptionFormBuilderI18n instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n) {
            return $this
                ->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $contactOptionFormBuilderI18n->getIdCofb(), $comparison);
        } elseif ($contactOptionFormBuilderI18n instanceof ObjectCollection) {
            return $this
                ->useContactOptionFormBuilderI18nQuery()
                ->filterByPrimaryKeys($contactOptionFormBuilderI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContactOptionFormBuilderI18n() only accepts arguments of type \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactOptionFormBuilderI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function joinContactOptionFormBuilderI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactOptionFormBuilderI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ContactOptionFormBuilderI18n');
        }

        return $this;
    }

    /**
     * Use the ContactOptionFormBuilderI18n relation ContactOptionFormBuilderI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery A secondary query class using the current class as primary query
     */
    public function useContactOptionFormBuilderI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinContactOptionFormBuilderI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactOptionFormBuilderI18n', '\ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContactOptionFormBuilder $contactOptionFormBuilder Object to remove from the list of results
     *
     * @return ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function prune($contactOptionFormBuilder = null)
    {
        if ($contactOptionFormBuilder) {
            $this->addUsingAlias(ContactOptionFormBuilderTableMap::ID_COFB, $contactOptionFormBuilder->getIdCofb(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the contact_option_form_builder table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContactOptionFormBuilderTableMap::clearInstancePool();
            ContactOptionFormBuilderTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildContactOptionFormBuilder or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildContactOptionFormBuilder object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactOptionFormBuilderTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ContactOptionFormBuilderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactOptionFormBuilderTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ContactOptionFormBuilderI18n';

        return $this
            ->joinContactOptionFormBuilderI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildContactOptionFormBuilderQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ContactOptionFormBuilderI18n');
        $this->with['ContactOptionFormBuilderI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildContactOptionFormBuilderI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactOptionFormBuilderI18n', '\ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery');
    }

} // ContactOptionFormBuilderQuery
