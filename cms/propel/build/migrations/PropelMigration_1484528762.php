<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1484528762.
 * Generated on 2017-01-16 06:36:02 by www-data
 */
class PropelMigration_1484528762
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

CREATE TABLE `customer`
(
    `customer_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(256) NOT NULL,
    `address` TEXT(256),
    `email` VARCHAR(256) NOT NULL,
    `telno` VARCHAR(256) NOT NULL,
    `company_name` TEXT(256),
    `company_weburl` TEXT(256),
    `enquiry_description` TEXT NOT NULL,
    `is_customer` TINYINT(1) DEFAULT 1,
    `sortable_rank` INTEGER,
    `slug` VARCHAR(255),
    PRIMARY KEY (`customer_id`),
    UNIQUE INDEX `customer_slug` (`slug`(255))
) ENGINE=MyISAM;

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

DROP TABLE IF EXISTS `customer`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}