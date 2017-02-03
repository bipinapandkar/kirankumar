<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1484587160.
 * Generated on 2017-01-16 22:49:20 by www-data
 */
class PropelMigration_1484587160
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

ALTER TABLE `customer` CHANGE `address` `address` TEXT(256);

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT(256);

ALTER TABLE `customer` DROP `company_weburl`;

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

ALTER TABLE `customer` CHANGE `address` `address` TEXT;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT;

ALTER TABLE `customer`
    ADD `company_weburl` TEXT AFTER `company_name`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}