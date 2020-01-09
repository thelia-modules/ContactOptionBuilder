<?php

namespace ContactOptionBuilder\Model\Base;

use \Exception;
use \PDO;
use ContactOptionBuilder\Model\ContactOptionFormBuider as ChildContactOptionFormBuider;
use ContactOptionBuilder\Model\ContactOptionFormBuiderQuery as ChildContactOptionFormBuiderQuery;
use ContactOptionBuilder\Model\Map\ContactOptionFormBuiderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'contact_option_form_buider' table.
 *
 *
 *
 * @method     ChildContactOptionFormBuiderQuery orderByIdCofb($order = Criteria::ASC) Order by the id_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderBySubjectCofb($order = Criteria::ASC) Order by the subject_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderByTypeUserCofb($order = Criteria::ASC) Order by the type_user_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderByOrderOptCofb($order = Criteria::ASC) Order by the order_opt_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderByRaisonSocialeOptCofb($order = Criteria::ASC) Order by the raison_sociale_opt_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderByMessageCofb($order = Criteria::ASC) Order by the message_cofb column
 * @method     ChildContactOptionFormBuiderQuery orderByEmailToCofb($order = Criteria::ASC) Order by the email_to_cofb column
 *
 * @method     ChildContactOptionFormBuiderQuery groupByIdCofb() Group by the id_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupBySubjectCofb() Group by the subject_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupByTypeUserCofb() Group by the type_user_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupByOrderOptCofb() Group by the order_opt_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupByRaisonSocialeOptCofb() Group by the raison_sociale_opt_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupByMessageCofb() Group by the message_cofb column
 * @method     ChildContactOptionFormBuiderQuery groupByEmailToCofb() Group by the email_to_cofb column
 *
 * @method     ChildContactOptionFormBuiderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactOptionFormBuiderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactOptionFormBuiderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactOptionFormBuider findOne(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuider matching the query
 * @method     ChildContactOptionFormBuider findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContactOptionFormBuider matching the query, or a new ChildContactOptionFormBuider object populated from the query conditions when no match is found
 *
 * @method     ChildContactOptionFormBuider findOneByIdCofb(int $id_cofb) Return the first ChildContactOptionFormBuider filtered by the id_cofb column
 * @method     ChildContactOptionFormBuider findOneBySubjectCofb(string $subject_cofb) Return the first ChildContactOptionFormBuider filtered by the subject_cofb column
 * @method     ChildContactOptionFormBuider findOneByTypeUserCofb(boolean $type_user_cofb) Return the first ChildContactOptionFormBuider filtered by the type_user_cofb column
 * @method     ChildContactOptionFormBuider findOneByOrderOptCofb(boolean $order_opt_cofb) Return the first ChildContactOptionFormBuider filtered by the order_opt_cofb column
 * @method     ChildContactOptionFormBuider findOneByRaisonSocialeOptCofb(boolean $raison_sociale_opt_cofb) Return the first ChildContactOptionFormBuider filtered by the raison_sociale_opt_cofb column
 * @method     ChildContactOptionFormBuider findOneByMessageCofb(string $message_cofb) Return the first ChildContactOptionFormBuider filtered by the message_cofb column
 * @method     ChildContactOptionFormBuider findOneByEmailToCofb(string $email_to_cofb) Return the first ChildContactOptionFormBuider filtered by the email_to_cofb column
 *
 * @method     array findByIdCofb(int $id_cofb) Return ChildContactOptionFormBuider objects filtered by the id_cofb column
 * @method     array findBySubjectCofb(string $subject_cofb) Return ChildContactOptionFormBuider objects filtered by the subject_cofb column
 * @method     array findByTypeUserCofb(boolean $type_user_cofb) Return ChildContactOptionFormBuider objects filtered by the type_user_cofb column
 * @method     array findByOrderOptCofb(boolean $order_opt_cofb) Return ChildContactOptionFormBuider objects filtered by the order_opt_cofb column
 * @method     array findByRaisonSocialeOptCofb(boolean $raison_sociale_opt_cofb) Return ChildContactOptionFormBuider objects filtered by the raison_sociale_opt_cofb column
 * @method     array findByMessageCofb(string $message_cofb) Return ChildContactOptionFormBuider objects filtered by the message_cofb column
 * @method     array findByEmailToCofb(string $email_to_cofb) Return ChildContactOptionFormBuider objects filtered by the email_to_cofb column
 *
 */
abstract class ContactOptionFormBuiderQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \ContactOptionBuilder\Model\Base\ContactOptionFormBuiderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\ContactOptionBuilder\\Model\\ContactOptionFormBuider', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactOptionFormBuiderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactOptionFormBuiderQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \ContactOptionBuilder\Model\ContactOptionFormBuiderQuery) {
            return $criteria;
        }
        $query = new \ContactOptionBuilder\Model\ContactOptionFormBuiderQuery();
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
     * @return ChildContactOptionFormBuider|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContactOptionFormBuiderTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactOptionFormBuiderTableMap::DATABASE_NAME);
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
     * @return   ChildContactOptionFormBuider A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID_COFB, SUBJECT_COFB, TYPE_USER_COFB, ORDER_OPT_COFB, RAISON_SOCIALE_OPT_COFB, MESSAGE_COFB, EMAIL_TO_COFB FROM contact_option_form_buider WHERE ID_COFB = :p0';
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
            $obj = new ChildContactOptionFormBuider();
            $obj->hydrate($row);
            ContactOptionFormBuiderTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildContactOptionFormBuider|array|mixed the result, formatted by the current formatter
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $keys, Criteria::IN);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByIdCofb($idCofb = null, $comparison = null)
    {
        if (is_array($idCofb)) {
            $useMinMax = false;
            if (isset($idCofb['min'])) {
                $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $idCofb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCofb['max'])) {
                $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $idCofb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $idCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::SUBJECT_COFB, $subjectCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByTypeUserCofb($typeUserCofb = null, $comparison = null)
    {
        if (is_string($typeUserCofb)) {
            $type_user_cofb = in_array(strtolower($typeUserCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::TYPE_USER_COFB, $typeUserCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByOrderOptCofb($orderOptCofb = null, $comparison = null)
    {
        if (is_string($orderOptCofb)) {
            $order_opt_cofb = in_array(strtolower($orderOptCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::ORDER_OPT_COFB, $orderOptCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function filterByRaisonSocialeOptCofb($raisonSocialeOptCofb = null, $comparison = null)
    {
        if (is_string($raisonSocialeOptCofb)) {
            $raison_sociale_opt_cofb = in_array(strtolower($raisonSocialeOptCofb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::RAISON_SOCIALE_OPT_COFB, $raisonSocialeOptCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::MESSAGE_COFB, $messageCofb, $comparison);
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
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ContactOptionFormBuiderTableMap::EMAIL_TO_COFB, $emailToCofb, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContactOptionFormBuider $contactOptionFormBuider Object to remove from the list of results
     *
     * @return ChildContactOptionFormBuiderQuery The current query, for fluid interface
     */
    public function prune($contactOptionFormBuider = null)
    {
        if ($contactOptionFormBuider) {
            $this->addUsingAlias(ContactOptionFormBuiderTableMap::ID_COFB, $contactOptionFormBuider->getIdCofb(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the contact_option_form_buider table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuiderTableMap::DATABASE_NAME);
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
            ContactOptionFormBuiderTableMap::clearInstancePool();
            ContactOptionFormBuiderTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildContactOptionFormBuider or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildContactOptionFormBuider object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuiderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactOptionFormBuiderTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ContactOptionFormBuiderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactOptionFormBuiderTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // ContactOptionFormBuiderQuery
