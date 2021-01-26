<?php

namespace ContactOptionBuilder\Model\Base;

use \Exception;
use \PDO;
use ContactOptionBuilder\Model\ContactOptionFormBuilder as ChildContactOptionFormBuilder;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18n as ChildContactOptionFormBuilderI18n;
use ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery as ChildContactOptionFormBuilderI18nQuery;
use ContactOptionBuilder\Model\ContactOptionFormBuilderQuery as ChildContactOptionFormBuilderQuery;
use ContactOptionBuilder\Model\Map\ContactOptionFormBuilderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

abstract class ContactOptionFormBuilder implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\ContactOptionBuilder\\Model\\Map\\ContactOptionFormBuilderTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_cofb field.
     * @var        int
     */
    protected $id_cofb;

    /**
     * The value for the type_user_cofb field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $type_user_cofb;

    /**
     * The value for the order_opt_cofb field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $order_opt_cofb;

    /**
     * The value for the raison_sociale_opt_cofb field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $raison_sociale_opt_cofb;

    /**
     * @var        ObjectCollection|ChildContactOptionFormBuilderI18n[] Collection to store aggregation of ChildContactOptionFormBuilderI18n objects.
     */
    protected $collContactOptionFormBuilderI18ns;
    protected $collContactOptionFormBuilderI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildContactOptionFormBuilderI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $contactOptionFormBuilderI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->type_user_cofb = false;
        $this->order_opt_cofb = false;
        $this->raison_sociale_opt_cofb = false;
    }

    /**
     * Initializes internal state of ContactOptionBuilder\Model\Base\ContactOptionFormBuilder object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>ContactOptionFormBuilder</code> instance.  If
     * <code>obj</code> is an instance of <code>ContactOptionFormBuilder</code>, delegates to
     * <code>equals(ContactOptionFormBuilder)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return ContactOptionFormBuilder The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return ContactOptionFormBuilder The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id_cofb] column value.
     *
     * @return   int
     */
    public function getIdCofb()
    {

        return $this->id_cofb;
    }

    /**
     * Get the [type_user_cofb] column value.
     *
     * @return   boolean
     */
    public function getTypeUserCofb()
    {

        return $this->type_user_cofb;
    }

    /**
     * Get the [order_opt_cofb] column value.
     *
     * @return   boolean
     */
    public function getOrderOptCofb()
    {

        return $this->order_opt_cofb;
    }

    /**
     * Get the [raison_sociale_opt_cofb] column value.
     *
     * @return   boolean
     */
    public function getRaisonSocialeOptCofb()
    {

        return $this->raison_sociale_opt_cofb;
    }

    /**
     * Set the value of [id_cofb] column.
     *
     * @param      int $v new value
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setIdCofb($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_cofb !== $v) {
            $this->id_cofb = $v;
            $this->modifiedColumns[ContactOptionFormBuilderTableMap::ID_COFB] = true;
        }


        return $this;
    } // setIdCofb()

    /**
     * Sets the value of the [type_user_cofb] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param      boolean|integer|string $v The new value
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setTypeUserCofb($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->type_user_cofb !== $v) {
            $this->type_user_cofb = $v;
            $this->modifiedColumns[ContactOptionFormBuilderTableMap::TYPE_USER_COFB] = true;
        }


        return $this;
    } // setTypeUserCofb()

    /**
     * Sets the value of the [order_opt_cofb] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param      boolean|integer|string $v The new value
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setOrderOptCofb($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->order_opt_cofb !== $v) {
            $this->order_opt_cofb = $v;
            $this->modifiedColumns[ContactOptionFormBuilderTableMap::ORDER_OPT_COFB] = true;
        }


        return $this;
    } // setOrderOptCofb()

    /**
     * Sets the value of the [raison_sociale_opt_cofb] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param      boolean|integer|string $v The new value
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setRaisonSocialeOptCofb($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->raison_sociale_opt_cofb !== $v) {
            $this->raison_sociale_opt_cofb = $v;
            $this->modifiedColumns[ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB] = true;
        }


        return $this;
    } // setRaisonSocialeOptCofb()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->type_user_cofb !== false) {
                return false;
            }

            if ($this->order_opt_cofb !== false) {
                return false;
            }

            if ($this->raison_sociale_opt_cofb !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ContactOptionFormBuilderTableMap::translateFieldName('IdCofb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_cofb = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ContactOptionFormBuilderTableMap::translateFieldName('TypeUserCofb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type_user_cofb = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ContactOptionFormBuilderTableMap::translateFieldName('OrderOptCofb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_opt_cofb = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ContactOptionFormBuilderTableMap::translateFieldName('RaisonSocialeOptCofb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->raison_sociale_opt_cofb = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = ContactOptionFormBuilderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \ContactOptionBuilder\Model\ContactOptionFormBuilder object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildContactOptionFormBuilderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collContactOptionFormBuilderI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ContactOptionFormBuilder::setDeleted()
     * @see ContactOptionFormBuilder::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildContactOptionFormBuilderQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ContactOptionFormBuilderTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->contactOptionFormBuilderI18nsScheduledForDeletion !== null) {
                if (!$this->contactOptionFormBuilderI18nsScheduledForDeletion->isEmpty()) {
                    \ContactOptionBuilder\Model\ContactOptionFormBuilderI18nQuery::create()
                        ->filterByPrimaryKeys($this->contactOptionFormBuilderI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->contactOptionFormBuilderI18nsScheduledForDeletion = null;
                }
            }

                if ($this->collContactOptionFormBuilderI18ns !== null) {
            foreach ($this->collContactOptionFormBuilderI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ContactOptionFormBuilderTableMap::ID_COFB] = true;
        if (null !== $this->id_cofb) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ContactOptionFormBuilderTableMap::ID_COFB . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::ID_COFB)) {
            $modifiedColumns[':p' . $index++]  = 'ID_COFB';
        }
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::TYPE_USER_COFB)) {
            $modifiedColumns[':p' . $index++]  = 'TYPE_USER_COFB';
        }
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::ORDER_OPT_COFB)) {
            $modifiedColumns[':p' . $index++]  = 'ORDER_OPT_COFB';
        }
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB)) {
            $modifiedColumns[':p' . $index++]  = 'RAISON_SOCIALE_OPT_COFB';
        }

        $sql = sprintf(
            'INSERT INTO contact_option_form_builder (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID_COFB':
                        $stmt->bindValue($identifier, $this->id_cofb, PDO::PARAM_INT);
                        break;
                    case 'TYPE_USER_COFB':
                        $stmt->bindValue($identifier, (int) $this->type_user_cofb, PDO::PARAM_INT);
                        break;
                    case 'ORDER_OPT_COFB':
                        $stmt->bindValue($identifier, (int) $this->order_opt_cofb, PDO::PARAM_INT);
                        break;
                    case 'RAISON_SOCIALE_OPT_COFB':
                        $stmt->bindValue($identifier, (int) $this->raison_sociale_opt_cofb, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCofb($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ContactOptionFormBuilderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdCofb();
                break;
            case 1:
                return $this->getTypeUserCofb();
                break;
            case 2:
                return $this->getOrderOptCofb();
                break;
            case 3:
                return $this->getRaisonSocialeOptCofb();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['ContactOptionFormBuilder'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ContactOptionFormBuilder'][$this->getPrimaryKey()] = true;
        $keys = ContactOptionFormBuilderTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdCofb(),
            $keys[1] => $this->getTypeUserCofb(),
            $keys[2] => $this->getOrderOptCofb(),
            $keys[3] => $this->getRaisonSocialeOptCofb(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collContactOptionFormBuilderI18ns) {
                $result['ContactOptionFormBuilderI18ns'] = $this->collContactOptionFormBuilderI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ContactOptionFormBuilderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdCofb($value);
                break;
            case 1:
                $this->setTypeUserCofb($value);
                break;
            case 2:
                $this->setOrderOptCofb($value);
                break;
            case 3:
                $this->setRaisonSocialeOptCofb($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ContactOptionFormBuilderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdCofb($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTypeUserCofb($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setOrderOptCofb($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setRaisonSocialeOptCofb($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ContactOptionFormBuilderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::ID_COFB)) $criteria->add(ContactOptionFormBuilderTableMap::ID_COFB, $this->id_cofb);
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::TYPE_USER_COFB)) $criteria->add(ContactOptionFormBuilderTableMap::TYPE_USER_COFB, $this->type_user_cofb);
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::ORDER_OPT_COFB)) $criteria->add(ContactOptionFormBuilderTableMap::ORDER_OPT_COFB, $this->order_opt_cofb);
        if ($this->isColumnModified(ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB)) $criteria->add(ContactOptionFormBuilderTableMap::RAISON_SOCIALE_OPT_COFB, $this->raison_sociale_opt_cofb);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ContactOptionFormBuilderTableMap::DATABASE_NAME);
        $criteria->add(ContactOptionFormBuilderTableMap::ID_COFB, $this->id_cofb);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCofb();
    }

    /**
     * Generic method to set the primary key (id_cofb column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdCofb($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdCofb();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \ContactOptionBuilder\Model\ContactOptionFormBuilder (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTypeUserCofb($this->getTypeUserCofb());
        $copyObj->setOrderOptCofb($this->getOrderOptCofb());
        $copyObj->setRaisonSocialeOptCofb($this->getRaisonSocialeOptCofb());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getContactOptionFormBuilderI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addContactOptionFormBuilderI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCofb(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \ContactOptionBuilder\Model\ContactOptionFormBuilder Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ContactOptionFormBuilderI18n' == $relationName) {
            return $this->initContactOptionFormBuilderI18ns();
        }
    }

    /**
     * Clears out the collContactOptionFormBuilderI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addContactOptionFormBuilderI18ns()
     */
    public function clearContactOptionFormBuilderI18ns()
    {
        $this->collContactOptionFormBuilderI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collContactOptionFormBuilderI18ns collection loaded partially.
     */
    public function resetPartialContactOptionFormBuilderI18ns($v = true)
    {
        $this->collContactOptionFormBuilderI18nsPartial = $v;
    }

    /**
     * Initializes the collContactOptionFormBuilderI18ns collection.
     *
     * By default this just sets the collContactOptionFormBuilderI18ns collection to an empty array (like clearcollContactOptionFormBuilderI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initContactOptionFormBuilderI18ns($overrideExisting = true)
    {
        if (null !== $this->collContactOptionFormBuilderI18ns && !$overrideExisting) {
            return;
        }
        $this->collContactOptionFormBuilderI18ns = new ObjectCollection();
        $this->collContactOptionFormBuilderI18ns->setModel('\ContactOptionBuilder\Model\ContactOptionFormBuilderI18n');
    }

    /**
     * Gets an array of ChildContactOptionFormBuilderI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContactOptionFormBuilder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildContactOptionFormBuilderI18n[] List of ChildContactOptionFormBuilderI18n objects
     * @throws PropelException
     */
    public function getContactOptionFormBuilderI18ns($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collContactOptionFormBuilderI18nsPartial && !$this->isNew();
        if (null === $this->collContactOptionFormBuilderI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collContactOptionFormBuilderI18ns) {
                // return empty collection
                $this->initContactOptionFormBuilderI18ns();
            } else {
                $collContactOptionFormBuilderI18ns = ChildContactOptionFormBuilderI18nQuery::create(null, $criteria)
                    ->filterByContactOptionFormBuilder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collContactOptionFormBuilderI18nsPartial && count($collContactOptionFormBuilderI18ns)) {
                        $this->initContactOptionFormBuilderI18ns(false);

                        foreach ($collContactOptionFormBuilderI18ns as $obj) {
                            if (false == $this->collContactOptionFormBuilderI18ns->contains($obj)) {
                                $this->collContactOptionFormBuilderI18ns->append($obj);
                            }
                        }

                        $this->collContactOptionFormBuilderI18nsPartial = true;
                    }

                    reset($collContactOptionFormBuilderI18ns);

                    return $collContactOptionFormBuilderI18ns;
                }

                if ($partial && $this->collContactOptionFormBuilderI18ns) {
                    foreach ($this->collContactOptionFormBuilderI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collContactOptionFormBuilderI18ns[] = $obj;
                        }
                    }
                }

                $this->collContactOptionFormBuilderI18ns = $collContactOptionFormBuilderI18ns;
                $this->collContactOptionFormBuilderI18nsPartial = false;
            }
        }

        return $this->collContactOptionFormBuilderI18ns;
    }

    /**
     * Sets a collection of ContactOptionFormBuilderI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $contactOptionFormBuilderI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setContactOptionFormBuilderI18ns(Collection $contactOptionFormBuilderI18ns, ConnectionInterface $con = null)
    {
        $contactOptionFormBuilderI18nsToDelete = $this->getContactOptionFormBuilderI18ns(new Criteria(), $con)->diff($contactOptionFormBuilderI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->contactOptionFormBuilderI18nsScheduledForDeletion = clone $contactOptionFormBuilderI18nsToDelete;

        foreach ($contactOptionFormBuilderI18nsToDelete as $contactOptionFormBuilderI18nRemoved) {
            $contactOptionFormBuilderI18nRemoved->setContactOptionFormBuilder(null);
        }

        $this->collContactOptionFormBuilderI18ns = null;
        foreach ($contactOptionFormBuilderI18ns as $contactOptionFormBuilderI18n) {
            $this->addContactOptionFormBuilderI18n($contactOptionFormBuilderI18n);
        }

        $this->collContactOptionFormBuilderI18ns = $contactOptionFormBuilderI18ns;
        $this->collContactOptionFormBuilderI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ContactOptionFormBuilderI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ContactOptionFormBuilderI18n objects.
     * @throws PropelException
     */
    public function countContactOptionFormBuilderI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collContactOptionFormBuilderI18nsPartial && !$this->isNew();
        if (null === $this->collContactOptionFormBuilderI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collContactOptionFormBuilderI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getContactOptionFormBuilderI18ns());
            }

            $query = ChildContactOptionFormBuilderI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactOptionFormBuilder($this)
                ->count($con);
        }

        return count($this->collContactOptionFormBuilderI18ns);
    }

    /**
     * Method called to associate a ChildContactOptionFormBuilderI18n object to this object
     * through the ChildContactOptionFormBuilderI18n foreign key attribute.
     *
     * @param    ChildContactOptionFormBuilderI18n $l ChildContactOptionFormBuilderI18n
     * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilder The current object (for fluent API support)
     */
    public function addContactOptionFormBuilderI18n(ChildContactOptionFormBuilderI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collContactOptionFormBuilderI18ns === null) {
            $this->initContactOptionFormBuilderI18ns();
            $this->collContactOptionFormBuilderI18nsPartial = true;
        }

        if (!in_array($l, $this->collContactOptionFormBuilderI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddContactOptionFormBuilderI18n($l);
        }

        return $this;
    }

    /**
     * @param ContactOptionFormBuilderI18n $contactOptionFormBuilderI18n The contactOptionFormBuilderI18n object to add.
     */
    protected function doAddContactOptionFormBuilderI18n($contactOptionFormBuilderI18n)
    {
        $this->collContactOptionFormBuilderI18ns[]= $contactOptionFormBuilderI18n;
        $contactOptionFormBuilderI18n->setContactOptionFormBuilder($this);
    }

    /**
     * @param  ContactOptionFormBuilderI18n $contactOptionFormBuilderI18n The contactOptionFormBuilderI18n object to remove.
     * @return ChildContactOptionFormBuilder The current object (for fluent API support)
     */
    public function removeContactOptionFormBuilderI18n($contactOptionFormBuilderI18n)
    {
        if ($this->getContactOptionFormBuilderI18ns()->contains($contactOptionFormBuilderI18n)) {
            $this->collContactOptionFormBuilderI18ns->remove($this->collContactOptionFormBuilderI18ns->search($contactOptionFormBuilderI18n));
            if (null === $this->contactOptionFormBuilderI18nsScheduledForDeletion) {
                $this->contactOptionFormBuilderI18nsScheduledForDeletion = clone $this->collContactOptionFormBuilderI18ns;
                $this->contactOptionFormBuilderI18nsScheduledForDeletion->clear();
            }
            $this->contactOptionFormBuilderI18nsScheduledForDeletion[]= clone $contactOptionFormBuilderI18n;
            $contactOptionFormBuilderI18n->setContactOptionFormBuilder(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_cofb = null;
        $this->type_user_cofb = null;
        $this->order_opt_cofb = null;
        $this->raison_sociale_opt_cofb = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collContactOptionFormBuilderI18ns) {
                foreach ($this->collContactOptionFormBuilderI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collContactOptionFormBuilderI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ContactOptionFormBuilderTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    ChildContactOptionFormBuilder The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildContactOptionFormBuilderI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collContactOptionFormBuilderI18ns) {
                foreach ($this->collContactOptionFormBuilderI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildContactOptionFormBuilderI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildContactOptionFormBuilderI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addContactOptionFormBuilderI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    ChildContactOptionFormBuilder The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildContactOptionFormBuilderI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collContactOptionFormBuilderI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collContactOptionFormBuilderI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildContactOptionFormBuilderI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [subject_cofb] column value.
         *
         * @return   string
         */
        public function getSubjectCofb()
        {
        return $this->getCurrentTranslation()->getSubjectCofb();
    }


        /**
         * Set the value of [subject_cofb] column.
         *
         * @param      string $v new value
         * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n The current object (for fluent API support)
         */
        public function setSubjectCofb($v)
        {    $this->getCurrentTranslation()->setSubjectCofb($v);

        return $this;
    }


        /**
         * Get the [message_cofb] column value.
         *
         * @return   string
         */
        public function getMessageCofb()
        {
        return $this->getCurrentTranslation()->getMessageCofb();
    }


        /**
         * Set the value of [message_cofb] column.
         *
         * @param      string $v new value
         * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n The current object (for fluent API support)
         */
        public function setMessageCofb($v)
        {    $this->getCurrentTranslation()->setMessageCofb($v);

        return $this;
    }


        /**
         * Get the [email_to_cofb] column value.
         *
         * @return   string
         */
        public function getEmailToCofb()
        {
        return $this->getCurrentTranslation()->getEmailToCofb();
    }


        /**
         * Set the value of [email_to_cofb] column.
         *
         * @param      string $v new value
         * @return   \ContactOptionBuilder\Model\ContactOptionFormBuilderI18n The current object (for fluent API support)
         */
        public function setEmailToCofb($v)
        {    $this->getCurrentTranslation()->setEmailToCofb($v);

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
