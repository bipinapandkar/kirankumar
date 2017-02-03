<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1486085069.
 * Generated on 2017-02-03 06:54:29 by www-data
 */
class PropelMigration_1486085069
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'curry' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT(256);

ALTER TABLE `termcondition` CHANGE `validity` `validity` TEXT;

ALTER TABLE `termcondition` CHANGE `warranty` `warranty` TEXT;

ALTER TABLE `termcondition` DROP `title`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'curry' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT;

ALTER TABLE `termcondition` CHANGE `validity` `validity` VARCHAR(255);

ALTER TABLE `termcondition` CHANGE `warranty` `warranty` VARCHAR(255);

ALTER TABLE `termcondition`
    ADD `title` VARCHAR(256) NOT NULL AFTER `termcondition_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}