<?php

namespace ContactOptionBuilder\Model\Map;

use ContactOptionBuilder\Model\ContactOptionFormBuilderI18n;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'contact_option_form_builder_i18n' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ContactOptionFormBuilderI18nTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'ContactOptionBuilder.Model.Map.ContactOptionFormBuilderI18nTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'contact_option_form_builder_i18n';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilderI18n';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ContactOptionBuilder.Model.ContactOptionFormBuilderI18n';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the ID_COFB field
     */
    const ID_COFB = 'contact_option_form_builder_i18n.ID_COFB';

    /**
     * the column name for the LOCALE field
     */
    const LOCALE = 'contact_option_form_builder_i18n.LOCALE';

    /**
     * the column name for the SUBJECT_COFB field
     */
    const SUBJECT_COFB = 'contact_option_form_builder_i18n.SUBJECT_COFB';

    /**
     * the column name for the MESSAGE_COFB field
     */
    const MESSAGE_COFB = 'contact_option_form_builder_i18n.MESSAGE_COFB';

    /**
     * the column name for the EMAIL_TO_COFB field
     */
    const EMAIL_TO_COFB = 'contact_option_form_builder_i18n.EMAIL_TO_COFB';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdCofb', 'Locale', 'SubjectCofb', 'MessageCofb', 'EmailToCofb', ),
        self::TYPE_STUDLYPHPNAME => array('idCofb', 'locale', 'subjectCofb', 'messageCofb', 'emailToCofb', ),
        self::TYPE_COLNAME       => array(ContactOptionFormBuilderI18nTableMap::ID_COFB, ContactOptionFormBuilderI18nTableMap::LOCALE, ContactOptionFormBuilderI18nTableMap::SUBJECT_COFB, ContactOptionFormBuilderI18nTableMap::MESSAGE_COFB, ContactOptionFormBuilderI18nTableMap::EMAIL_TO_COFB, ),
        self::TYPE_RAW_COLNAME   => array('ID_COFB', 'LOCALE', 'SUBJECT_COFB', 'MESSAGE_COFB', 'EMAIL_TO_COFB', ),
        self::TYPE_FIELDNAME     => array('id_cofb', 'locale', 'subject_cofb', 'message_cofb', 'email_to_cofb', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdCofb' => 0, 'Locale' => 1, 'SubjectCofb' => 2, 'MessageCofb' => 3, 'EmailToCofb' => 4, ),
        self::TYPE_STUDLYPHPNAME => array('idCofb' => 0, 'locale' => 1, 'subjectCofb' => 2, 'messageCofb' => 3, 'emailToCofb' => 4, ),
        self::TYPE_COLNAME       => array(ContactOptionFormBuilderI18nTableMap::ID_COFB => 0, ContactOptionFormBuilderI18nTableMap::LOCALE => 1, ContactOptionFormBuilderI18nTableMap::SUBJECT_COFB => 2, ContactOptionFormBuilderI18nTableMap::MESSAGE_COFB => 3, ContactOptionFormBuilderI18nTableMap::EMAIL_TO_COFB => 4, ),
        self::TYPE_RAW_COLNAME   => array('ID_COFB' => 0, 'LOCALE' => 1, 'SUBJECT_COFB' => 2, 'MESSAGE_COFB' => 3, 'EMAIL_TO_COFB' => 4, ),
        self::TYPE_FIELDNAME     => array('id_cofb' => 0, 'locale' => 1, 'subject_cofb' => 2, 'message_cofb' => 3, 'email_to_cofb' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('contact_option_form_builder_i18n');
        $this->setPhpName('ContactOptionFormBuilderI18n');
        $this->setClassName('\\ContactOptionBuilder\\Model\\ContactOptionFormBuilderI18n');
        $this->setPackage('ContactOptionBuilder.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ID_COFB', 'IdCofb', 'INTEGER' , 'contact_option_form_builder', 'ID_COFB', true, null, null);
        $this->addPrimaryKey('LOCALE', 'Locale', 'VARCHAR', true, 5, 'en_US');
        $this->addColumn('SUBJECT_COFB', 'SubjectCofb', 'VARCHAR', true, 78, null);
        $this->addColumn('MESSAGE_COFB', 'MessageCofb', 'VARCHAR', false, 500, null);
        $this->addColumn('EMAIL_TO_COFB', 'EmailToCofb', 'VARCHAR', true, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContactOptionFormBuilder', '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilder', RelationMap::MANY_TO_ONE, array('id_cofb' => 'id_cofb', ), 'CASCADE', null);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n $obj A \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getIdCofb(), (string) $obj->getLocale()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n) {
                $key = serialize(array((string) $value->getIdCofb(), (string) $value->getLocale()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)]));
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ContactOptionFormBuilderI18nTableMap::CLASS_DEFAULT : ContactOptionFormBuilderI18nTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (ContactOptionFormBuilderI18n object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ContactOptionFormBuilderI18nTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ContactOptionFormBuilderI18nTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ContactOptionFormBuilderI18nTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ContactOptionFormBuilderI18nTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ContactOptionFormBuilderI18nTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ContactOptionFormBuilderI18nTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ContactOptionFormBuilderI18nTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ContactOptionFormBuilderI18nTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ContactOptionFormBuilderI18nTableMap::ID_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderI18nTableMap::LOCALE);
            $criteria->addSelectColumn(ContactOptionFormBuilderI18nTableMap::SUBJECT_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderI18nTableMap::MESSAGE_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderI18nTableMap::EMAIL_TO_COFB);
        } else {
            $criteria->addSelectColumn($alias . '.ID_COFB');
            $criteria->addSelectColumn($alias . '.LOCALE');
            $criteria->addSelectColumn($alias . '.SUBJECT_COFB');
            $criteria->addSelectColumn($alias . '.MESSAGE_COFB');
            $criteria->addSelectColumn($alias . '.EMAIL_TO_COFB');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME)->getTable(ContactOptionFormBuilderI18nTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(ContactOptionFormBuilderI18nTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new ContactOptionFormBuilderI18nTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a ContactOptionFormBuilderI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ContactOptionFormBuilderI18n object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ContactOptionFormBuilderI18nTableMap::ID_COFB, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ContactOptionFormBuilderI18nTableMap::LOCALE, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ContactOptionFormBuilderI18nQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { ContactOptionFormBuilderI18nTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { ContactOptionFormBuilderI18nTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the contact_option_form_builder_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ContactOptionFormBuilderI18nQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ContactOptionFormBuilderI18n or Criteria object.
     *
     * @param mixed               $criteria Criteria or ContactOptionFormBuilderI18n object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderI18nTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ContactOptionFormBuilderI18n object
        }


        // Set the correct dbName
        $query = ContactOptionFormBuilderI18nQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // ContactOptionFormBuilderI18nTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ContactOptionFormBuilderI18nTableMap::buildTableMap();
