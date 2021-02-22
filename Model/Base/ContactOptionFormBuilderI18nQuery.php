<?php

namespace ContactOptionBuilder\Model\Base;

use \Exception;
use \PDO;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18n as ChildContactOptionFormBuilderI18n;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery as ChildContactOptionFormBuilderI18nQuery;
use ContactOptionBuilder\Model\Map\ContactOptionFormBuilderI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'contact_option_form_builder_i18n' table.
 *
 *
 *
 * @method     ChildContactOptionFormBuilderI18nQuery orderByIdCofb($order = Criteria::ASC) Order by the id_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildContactOptionFormBuilderI18nQuery orderBySubjectCofb($order = Criteria::ASC) Order by the subject_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery orderByMessageCofb($order = Criteria::ASC) Order by the message_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery orderByEmailToCofb($order = Criteria::ASC) Order by the email_to_cofb column
 *
 * @method     ChildContactOptionFormBuilderI18nQuery groupByIdCofb() Group by the id_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery groupByLocale() Group by the locale column
 * @method     ChildContactOptionFormBuilderI18nQuery groupBySubjectCofb() Group by the subject_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery groupByMessageCofb() Group by the message_cofb column
 * @method     ChildContactOptionFormBuilderI18nQuery groupByEmailToCofb() Group by the email_to_cofb column
 *
 * @method     ChildContactOptionFormBuilderI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactOptionFormBuilderI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactOptionFormBuilderI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactOptionFormBuilderI18nQuery leftJoinContactOptionFormBuilder($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactOptionFormBuilder relation
 * @method     ChildContactOptionFormBuilderI18nQuery rightJoinContactOptionFormBuilder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactOptionFormBuilder relation
 * @method     ChildContactOptionFormBuilderI18nQuery innerJoinContactOptionFormBuilder($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactOptionFormBuilder relation
 *
 * @method     ChildContactOptionFormBuilderI18n findOne(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuilderI18n matching the query
 * @method     ChildContactOptionFormBuilderI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuilderI18n matching the query, or a new ChildContactOptionFormBuilderI18n object populated from the query conditions when no match is found
 *
 * @method     ChildContactOptionFormBuilderI18n findOneByIdCofb(int $id_cofb) Return the first ChildContactOptionFormBuilderI18n filtered by the id_cofb column
 * @method     ChildContactOptionFormBuilderI18n findOneByLocale(string $locale) Return the first ChildContactOptionFormBuilderI18n filtered by the locale column
 * @method     ChildContactOptionFormBuilderI18n findOneBySubjectCofb(string $subject_cofb) Return the first ChildContactOptionFormBuilderI18n filtered by the subject_cofb column
 * @method     ChildContactOptionFormBuilderI18n findOneByMessageCofb(string $message_cofb) Return the first ChildContactOptionFormBuilderI18n filtered by the message_cofb column
 * @method     ChildContactOptionFormBuilderI18n findOneByEmailToCofb(string $email_to_cofb) Return the first ChildContactOptionFormBuilderI18n filtered by the email_to_cofb column
 *
 * @method     array findByIdCofb(int $id_cofb) Return ChildContactOptionFormBuilderI18n objects filtered by the id_cofb column
 * @method     array findByLocale(string $locale) Return ChildContactOptionFormBuilderI18n objects filtered by the locale column
 * @method     array findBySubjectCofb(string $subject_cofb) Return ChildContactOptionFormBuilderI18n objects filtered by the subject_cofb column
 * @method     array findByMessageCofb(string $message_cofb) Return ChildContactOptionFormBuilderI18n objects filtered by the message_cofb column
 * @method     array findByEmailToCofb(string $email_to_cofb) Return ChildContactOptionFormBuilderI18n objects filtered by the email_to_cofb column
 *
 */
abstract class ContactOptionFormBuilderI18nQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \ContactOptionBuilder\Model\Base\ContactOptionFormBuilderI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilderI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactOptionFormBuilderI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactOptionFormBuilderI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery) {
            return $criteria;
        }
        $query = new \ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id_cofb, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildContactOptionFormBuilderI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContactOptionFormBuilderI18nTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
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
     * @return   ChildContactOptionFormBuilderI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID_COFB, LOCALE, SUBJECT_COFB, MESSAGE_COFB, EMAIL_TO_COFB FROM contact_option_form_builder_i18n WHERE ID_COFB = :p0 AND LOCALE = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildContactOptionFormBuilderI18n();
            $obj->hydrate($row);
            ContactOptionFormBuilderI18nTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildContactOptionFormBuilderI18n|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ContactOptionFormBuilderI18nTableMap::ID_COFB, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ContactOptionFormBuilderI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByContactOptionFormBuilder()
     *
     * @param     mixed $idCofb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByIdCofb($idCofb = null, $comparison = null)
    {
        if (is_array($idCofb)) {
            $useMinMax = false;
            if (isset($idCofb['min'])) {
                $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $idCofb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCofb['max'])) {
                $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $idCofb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $idCofb, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the subject_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterBySubjectCofb('fooValue');   // WHERE subject_cofb = 'fooValue'
     * $query->filterBySubjectCofb('%fooValue%'); // WHERE subject_cofb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subjectCofb The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterBySubjectCofb($subjectCofb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subjectCofb)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subjectCofb)) {
                $subjectCofb = str_replace('*', '%', $subjectCofb);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::SUBJECT_COFB, $subjectCofb, $comparison);
    }

    /**
     * Filter the query on the message_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageCofb('fooValue');   // WHERE message_cofb = 'fooValue'
     * $query->filterByMessageCofb('%fooValue%'); // WHERE message_cofb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $messageCofb The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByMessageCofb($messageCofb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($messageCofb)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $messageCofb)) {
                $messageCofb = str_replace('*', '%', $messageCofb);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::MESSAGE_COFB, $messageCofb, $comparison);
    }

    /**
     * Filter the query on the email_to_cofb column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailToCofb('fooValue');   // WHERE email_to_cofb = 'fooValue'
     * $query->filterByEmailToCofb('%fooValue%'); // WHERE email_to_cofb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailToCofb The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByEmailToCofb($emailToCofb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailToCofb)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $emailToCofb)) {
                $emailToCofb = str_replace('*', '%', $emailToCofb);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuilderI18nTableMap::EMAIL_TO_COFB, $emailToCofb, $comparison);
    }

    /**
     * Filter the query by a related \ContactOptionBuilder\Model\ContactOptionFormBuilder object
     *
     * @param \ContactOptionBuilder\Model\ContactOptionFormBuilder|ObjectCollection $contactOptionFormBuilder The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function filterByContactOptionFormBuilder($contactOptionFormBuilder, $comparison = null)
    {
        if ($contactOptionFormBuilder instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilder) {
            return $this
                ->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $contactOptionFormBuilder->getIdCofb(), $comparison);
        } elseif ($contactOptionFormBuilder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContactOptionFormBuilderI18nTableMap::ID_COFB, $contactOptionFormBuilder->toKeyValue('PrimaryKey', 'IdCofb'), $comparison);
        } else {
            throw new PropelException('filterByContactOptionFormBuilder() only accepts arguments of type \ContactOptionBuilder\Model\ContactOptionFormBuilder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactOptionFormBuilder relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function joinContactOptionFormBuilder($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactOptionFormBuilder');

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
            $this->addJoinObject($join, 'ContactOptionFormBuilder');
        }

        return $this;
    }

    /**
     * Use the ContactOptionFormBuilder relation ContactOptionFormBuilder object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilderQuery A secondary query class using the current class as primary query
     */
    public function useContactOptionFormBuilderQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinContactOptionFormBuilder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactOptionFormBuilder', '\ContactOptionBuilder\Model\ContactOptionFormBuilderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContactOptionFormBuilderI18n $contactOptionFormBuilderI18n Object to remove from the list of results
     *
     * @return ChildContactOptionFormBuilderI18nQuery The current query, for fluid interface
     */
    public function prune($contactOptionFormBuilderI18n = null)
    {
        if ($contactOptionFormBuilderI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ContactOptionFormBuilderI18nTableMap::ID_COFB), $contactOptionFormBuilderI18n->getIdCofb(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ContactOptionFormBuilderI18nTableMap::LOCALE), $contactOptionFormBuilderI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the contact_option_form_builder_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
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
            ContactOptionFormBuilderI18nTableMap::clearInstancePool();
            ContactOptionFormBuilderI18nTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildContactOptionFormBuilderI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildContactOptionFormBuilderI18n object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ContactOptionFormBuilderI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactOptionFormBuilderI18nTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // ContactOptionFormBuilderI18nQuery
