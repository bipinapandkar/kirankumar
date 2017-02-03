<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1484876290.
 * Generated on 2017-01-20 07:08:10 by www-data
 */
class PropelMigration_1484876290
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

CREATE TABLE `pump_category`
(
    `pump_category_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(64) NOT NULL,
    `sortable_rank` INTEGER,
    `slug` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`pump_category_id`),
    UNIQUE INDEX `pump_category_slug` (`slug`(255))
) ENGINE=MyISAM;

CREATE TABLE `pump_model`
(
    `pump_model_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `price` DOUBLE NOT NULL,
    `pump_category_id` INTEGER NOT NULL,
    `sortable_rank` INTEGER,
    `slug` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`pump_model_id`),
    UNIQUE INDEX `pump_model_slug` (`slug`(255)),
    INDEX `pump_model_FI_1` (`pump_category_id`)
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

DROP TABLE IF EXISTS `pump_category`;

DROP TABLE IF EXISTS `pump_model`;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}