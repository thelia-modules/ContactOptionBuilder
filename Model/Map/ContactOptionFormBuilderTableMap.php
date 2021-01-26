<?php

namespace ContactOptionBuilder\Model\Map;

use ContactOptionBuilder\Model\ContactOptionFormBuilder;
use ContactOptionBuilder\Model\ContactOptionFormBuilderQuery;
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
 * This class defines the structure of the 'contact_option_form_builder' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ContactOptionFormBuilderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'ContactOptionBuilder.Model.Map.ContactOptionFormBuilderTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'contact_option_form_builder';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilder';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ContactOptionBuilder.Model.ContactOptionFormBuilder';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the ID_COFB field
     */
    const ID_COFB = 'contact_option_form_builder.ID_COFB';

    /**
     * the column name for the TYPE_USER_COFB field
     */
    const TYPE_USER_COFB = 'contact_option_form_builder.TYPE_USER_COFB';

    /**
     * the column name for the ORDER_OPT_COFB field
     */
    const ORDER_OPT_COFB = 'contact_option_form_builder.ORDER_OPT_COFB';

    /**
     * the column name for the RAISON_SOCIALE_OPT_COFB field
     */
    const RAISON_SOCIALE_OPT_COFB = 'contact_option_form_builder.RAISON_SOCIALE_OPT_COFB';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdCofb', 'TypeUserCofb', 'OrderOptCofb', 'RaisonSocialeOptCofb', ),
        self::TYPE_STUDLYPHPNAME => array('idCofb', 'typeUserCofb', 'orderOptCofb', 'raisonSocialeOptCofb', ),
        self::TYPE_COLNAME       => array(ContactOptionFormBuilderTableMap::ID_COFB, ContactOptionFormBuilderTableMap::TYPE_USER_COFB, ContactOptionFormBuilderTableMap::ORDER_OPT_COFB, ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB, ),
        self::TYPE_RAW_COLNAME   => array('ID_COFB', 'TYPE_USER_COFB', 'ORDER_OPT_COFB', 'RAISON_SOCIALE_OPT_COFB', ),
        self::TYPE_FIELDNAME     => array('id_cofb', 'type_user_cofb', 'order_opt_cofb', 'raison_sociale_opt_cofb', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdCofb' => 0, 'TypeUserCofb' => 1, 'OrderOptCofb' => 2, 'RaisonSocialeOptCofb' => 3, ),
        self::TYPE_STUDLYPHPNAME => array('idCofb' => 0, 'typeUserCofb' => 1, 'orderOptCofb' => 2, 'raisonSocialeOptCofb' => 3, ),
        self::TYPE_COLNAME       => array(ContactOptionFormBuilderTableMap::ID_COFB => 0, ContactOptionFormBuilderTableMap::TYPE_USER_COFB => 1, ContactOptionFormBuilderTableMap::ORDER_OPT_COFB => 2, ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB => 3, ),
        self::TYPE_RAW_COLNAME   => array('ID_COFB' => 0, 'TYPE_USER_COFB' => 1, 'ORDER_OPT_COFB' => 2, 'RAISON_SOCIALE_OPT_COFB' => 3, ),
        self::TYPE_FIELDNAME     => array('id_cofb' => 0, 'type_user_cofb' => 1, 'order_opt_cofb' => 2, 'raison_sociale_opt_cofb' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('contact_option_form_builder');
        $this->setPhpName('ContactOptionFormBuilder');
        $this->setClassName('\\ContactOptionBuilder\\Model\\ContactOptionFormBuilder');
        $this->setPackage('ContactOptionBuilder.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID_COFB', 'IdCofb', 'INTEGER', true, null, null);
        $this->addColumn('TYPE_USER_COFB', 'TypeUserCofb', 'BOOLEAN', false, 1, false);
        $this->addColumn('ORDER_OPT_COFB', 'OrderOptCofb', 'BOOLEAN', false, 1, false);
        $this->addColumn('RAISON_SOCIALE_OPT_COFB', 'RaisonSocialeOptCofb', 'BOOLEAN', false, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContactOptionFormBuilderI18n', '\\ContactOptionBuilder\\Model\\ContactOptionFormBuilderI18n', RelationMap::ONE_TO_MANY, array('id_cofb' => 'id_cofb', ), 'CASCADE', null, 'ContactOptionFormBuilderI18ns');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'subject_cofb, message_cofb, email_to_cofb', 'locale_column' => 'locale', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to contact_option_form_builder     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ".$this->getClassNameFromBuilder($joinedTableTableMapBuilder)." instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
                ContactOptionFormBuilderI18nTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)];
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

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)
                        ];
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
        return $withPrefix ? ContactOptionFormBuilderTableMap::CLASS_DEFAULT : ContactOptionFormBuilderTableMap::OM_CLASS;
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
     * @return array (ContactOptionFormBuilder object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ContactOptionFormBuilderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ContactOptionFormBuilderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ContactOptionFormBuilderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ContactOptionFormBuilderTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ContactOptionFormBuilderTableMap::addInstanceToPool($obj, $key);
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
            $key = ContactOptionFormBuilderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ContactOptionFormBuilderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ContactOptionFormBuilderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ContactOptionFormBuilderTableMap::ID_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderTableMap::TYPE_USER_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderTableMap::ORDER_OPT_COFB);
            $criteria->addSelectColumn(ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB);
        } else {
            $criteria->addSelectColumn($alias . '.ID_COFB');
            $criteria->addSelectColumn($alias . '.TYPE_USER_COFB');
            $criteria->addSelectColumn($alias . '.ORDER_OPT_COFB');
            $criteria->addSelectColumn($alias . '.RAISON_SOCIALE_OPT_COFB');
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
        return Propel::getServiceContainer()->getDatabaseMap(ContactOptionFormBuilderTableMap::DATABASE_NAME)->getTable(ContactOptionFormBuilderTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(ContactOptionFormBuilderTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(ContactOptionFormBuilderTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new ContactOptionFormBuilderTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a ContactOptionFormBuilder or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ContactOptionFormBuilder object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ContactOptionBuilder\Model\ContactOptionFormBuilder) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ContactOptionFormBuilderTableMap::DATABASE_NAME);
            $criteria->add(ContactOptionFormBuilderTableMap::ID_COFB, (array) $values, Criteria::IN);
        }

        $query = ContactOptionFormBuilderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { ContactOptionFormBuilderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { ContactOptionFormBuilderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the contact_option_form_builder table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ContactOptionFormBuilderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ContactOptionFormBuilder or Criteria object.
     *
     * @param mixed               $criteria Criteria or ContactOptionFormBuilder object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ContactOptionFormBuilder object
        }

        if ($criteria->containsKey(ContactOptionFormBuilderTableMap::ID_COFB) && $criteria->keyContainsValue(ContactOptionFormBuilderTableMap::ID_COFB) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ContactOptionFormBuilderTableMap::ID_COFB.')');
        }


        // Set the correct dbName
        $query = ContactOptionFormBuilderQuery::create()->mergeWith($criteria);

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

} // ContactOptionFormBuilderTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ContactOptionFormBuilderTableMap::buildTableMap();
