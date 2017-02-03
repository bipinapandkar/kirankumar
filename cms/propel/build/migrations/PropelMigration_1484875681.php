<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1484875681.
 * Generated on 2017-01-20 06:58:01 by www-data
 */
class PropelMigration_1484875681
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

ALTER TABLE `termcondition` CHANGE `value` `delivery` TEXT;

ALTER TABLE `termcondition`
    ADD `payment_term` TEXT AFTER `delivery`,
    ADD `fright` TEXT AFTER `payment_term`,
    ADD `oct_insurance_other` TEXT AFTER `fright`,
    ADD `validity` VARCHAR(255) AFTER `oct_insurance_other`,
    ADD `warranty` VARCHAR(255) AFTER `validity`;

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

ALTER TABLE `termcondition` CHANGE `delivery` `value` TEXT;

ALTER TABLE `termcondition` DROP `payment_term`;

ALTER TABLE `termcondition` DROP `fright`;

ALTER TABLE `termcondition` DROP `oct_insurance_other`;

ALTER TABLE `termcondition` DROP `validity`;

ALTER TABLE `termcondition` DROP `warranty`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}