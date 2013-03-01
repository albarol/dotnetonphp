<?php

require_once(dirname(__FILE__) . "/../Object.php");

/**
 * Represents a row of data in a System.Data.DataTable.
 *
 * @access public
 * @name DataRow
 * @package System
 * @subpackage Data
 */
class DataRow extends Object {

    /**
     * Commits all the changes made to this row since the last time System.Data.DataRow.AcceptChanges was called.
     *
     * @access public
     * @throws System.Data.RowNotInTableException: The row does not belong to the table.
     * 
     */
    public function acceptChanges() {
        
    }

    /**
     * Starts an edit operation on a System.Data.DataRow object.
     *
     * @access public
     * @throws System.Data.InRowChangingEventException: The method was called inside the System.Data.DataTable.RowChanging event.
     * @throws System.Data.DeletedRowInaccessibleException: The method was called upon a deleted row.
     * 
     */
    public function beginEdit() {

    }


    /**
     * Cancels the current edit on the row.
     *
     * @access public
     * @throws System.Data.InRowChangingEventException: The method was called inside the System.Data.DataTable.RowChanging event. 
     */
    public function cancelEdit() {
        
    }

    /**
     * Clears the errors for the row. This includes the System.Data.DataRow.RowError and errors set with System.Data.DataRow.SetColumnError(System.Int32,System.String).
     *
     * @access public
     *
     */
    public function clearErrors(){
         
    }

    
    /**
     * Initializes a new instance of the DataRow. Constructs a row from the builder. Only for internal usage..
     *
     * @access protected
     * @param DataRowBuilder $builder Builder
     *
     */
    protected function __construct(DataRowBuilder $builder=null) {
         
    }

    /**
     * Deletes the System.Data.DataRow.
     *
     * @access public
     * @throws System.Data.DeletedRowInaccessibleException: The System.Data.DataRow has already been deleted.
     */
    public function delete() {
        
    }


    /**
     * Ends the edit occurring on the row.
     *
     * @access public
     * @throws System.Data.InRowChangingEventException: The method was called inside the System.Data.DataTable.RowChanging event.
     * @throws System.Data.ConstraintException: The edit broke a constraint.
     * @throws System.Data.ReadOnlyException: The row belongs to the table and the edit tried to change the value of a read-only column.
     * @throws System.Data.NoNullAllowedException: The edit tried to put a null value into a column where System.Data.DataColumn.AllowDBNull is false.
     *
     */
    public function endEdit() {
        
    }


    /**
     * Gets the child rows of a System.Data.DataRow using the specified System.Data.DataRelation.RelationName of a System.Data.DataRelation.
     *
     * @access public
     * @param String $relationName The System.Data.DataRelation.RelationName of the System.Data.DataRelation to use.
     * @param DataRowVersion $version One of the System.Data.DataRowVersion values specifying the version of the data to get. Possible values are Default, Original, Current, and Proposed.
     *
     * @return DataRow An array of System.Data.DataRow objects or an array of length zero.
     */
    public function getChildRows($relationName, $version=null) {
        
    }


    /**
     * Gets the error description for the column specified by index.
     *
     * @param DataColumn $column A System.Data.DataColumn. 
     *
     * @return String The text of the error description.
     */
    public function getColumnError(DataColumn $column){
        
    }


    /**
     * Gets an array of columns that have errors.
     *
     * @return DataColumn An array of System.Data.DataColumn objects that contain errors.
     */
    public function getColumnsInError() {

    }


    /**
     * Gets the parent row of a System.Data.DataRow using the specified System.Data.DataRelation.RelationName of a System.Data.DataRelation, and System.Data.DataRowVersion.
     *
     * @access public
     * @throws System.ArgumentException: The relation and row do not belong to the same table.
     * @throws System.ArgumentNullException: The relation is null.
     * @throws System.Data.RowNotInTableException: The row does not belong to the table.
     * @throws System.Data.VersionNotFoundException: The row does not have the requested System.Data.DataRowVersion.
     *
     *
     * @param String $relationName The System.Data.DataRelation.RelationName of a System.Data.DataRelation.
     * @param DataRowVersion $version One of the System.Data.DataRowVersion values.
     *
     * @return DataRow The parent System.Data.DataRow of the current row.
     */
    public function getParentRow($relationName, DataRowVersion $version=null) {
        
    }

    /**
     * Gets the parent rows of a System.Data.DataRow using the specified System.Data.DataRelation.RelationName of a System.Data.DataRelation, and System.Data.DataRowVersion.
     *
     * @access public
     * @throws System.ArgumentException: The relation and row do not belong to the same table.
     * @throws System.ArgumentNullException: The relation is null.
     * @throws System.Data.RowNotInTableException: The row does not belong to the table.
     * @throws System.Data.VersionNotFoundException: The row does not have the requested System.Data.DataRowVersion.
     *
     * @param String $relationName The System.Data.DataRelation.RelationName of a System.Data.DataRelation.
     * @param DataRowVersion $version One of the System.Data.DataRowVersion values specifying the version of the data to get. Possible values are Default, Original, Current, and Proposed.
     *
     * @return An array of System.Data.DataRow objects or an array of length zero.
     */
    public function getParentRows($relationName, DataRowVersion $version=null) {

    }


    /**
     * Gets a value that indicates whether a specified version exists.
     *
     * @access public
     *
     * @param DataRowVersion $version One of the System.Data.DataRowVersion values that specifies the row version.
     *
     * @return Boolean true if the version exists; otherwise, false.
     */
    public function hasVersion(DataRowVersion $version) {

    }


    /**
     * Gets a value that indicates whether the specified System.Data.DataColumn contains a null value.
     *
     * @param DataColumn $column A System.Data.DataColumn.
     *
     * @return Boolean true if the column contains a null value; otherwise, false.
     */
    public function isNull(DataColumn $column) {
        
    }

    /**
     * Determines whether the specified System.Object instances are the same instance.
     *
     * @access public
     * 
     * @param Object $objA The first System.Object to compare.
     * @param Object $objB The second System.Object to compare.
     *
     * @return true if objA is the same instance as objB or if both are null references; otherwise, false.
     */
    public static function referenceEquals($objA, $objB) {
        
    }


    /**
     * Rejects all changes made to the row since System.Data.DataRow.AcceptChanges was last called.
     *
     * @access public
     *
     * @throws System.Data.RowNotInTableException: The row does not belong to the table.
     */
    public function rejectChanges() {
        
    }

    /**
     * Changes the System.Data.DataRow.Rowstate of a System.Data.DataRow to Added.
     *
     * @access public
     */
    public function setAdded() {

    }

    /**
     * Sets the error description for a column specified as a System.Data.DataColumn.
     *
     * @access public
     *
     * @param DataColumn $column The System.Data.DataColumn to set the error description for.
     * @param String $error The error description.
     *
     */
    public function setColumnError(DataColumn $column, $error) {

    }

    /**
     * Changes the System.Data.DataRow.Rowstate of a System.Data.DataRow to Modified.
     *
     * @access public
     */
    public function setModified() {
    
        
    }

    /**
     * Sets the value of the specified System.Data.DataColumn to a null value.
     *
     * @access public
     *
     * @param DataColumn $column A System.Data.DataColumn.
     */
    protected function setNull(DataColumn $column) {
        
    }


    /**
     * Sets the parent row of a System.Data.DataRow with specified new parent System.Data.DataRow and System.Data.DataRelation.
     *
     * @access public
     *
     * @throws System.Data.RowNotInTableException: One of the rows does not belong to a table
     * @throws System.ArgumentNullException: One of the rows is null.
     * @throws System.ArgumentException: The relation does not belong to the System.Data.DataRelationCollection of the System.Data.DataSet object.
     * @throws System.Data.InvalidConstraintException: The relation's child System.Data.DataTable is not the table this row belongs to.
     *
     * @param DataRow $parentRow The new parent System.Data.DataRow.
     * @param DataRelation $relation The relation System.Data.DataRelation to use.
     */
    public function setParentRow(DataRow $parentRow, DataRelation $relation=null) {
        
    }

    /**
     * Gets a value that indicates whether there are errors in a row.
     *
     * @access public
     *
     * @return Boolean true if the row contains an error; otherwise, false.
     */
    public function hasErrors() {
        
    }

    /**
     * Gets or sets all the values for this row through an array.
     *
     * @access public
     *
     * @throws System.ArgumentException: The array is larger than the number of columns in the table.
     * @throws System.InvalidCastException: A value in the array does not match its System.Data.DataColumn.DataType in its respective System.Data.DataColumn.
     * @throws System.Data.ConstraintException: An edit broke a constraint.
     * @throws System.Data.ReadOnlyException: An edit tried to change the value of a read-only column.
     * @throws System.Data.NoNullAllowedException: An edit tried to put a null value in a column where System.Data.DataColumn.AllowDBNull of the System.Data.DataColumn object is false.
     * @throws System.Data.DeletedRowInaccessibleException: The row has been deleted.
     *
     * @param Array $value List of object
     *
     * @return Array values for this row through an array
     */
    public function itemArray($value=null) {
        
    }

    /**
     * Gets or sets the custom error description for a row.
     *
     * @access public
     *
     * @param String $value Description of error.
     *
     * @return String custom error description
     */
    public function rowError($value=null) {

    }


    /**
     * Gets the current state of the row with regard to its relationship to the System.Data.DataRowCollection.
     *
     * @access public
     *
     * @return DataRowState One of the System.Data.DataRowState values.
     */
    public function rowState() {
        
    }
}
?>
