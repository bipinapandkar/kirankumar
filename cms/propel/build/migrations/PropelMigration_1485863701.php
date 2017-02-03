<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1485863701.
 * Generated on 2017-01-31 17:25:01 by www-data
 */
class PropelMigration_1485863701
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

CREATE TABLE `spare_part`
(
    `spare_part_id` INTEGER NOT NULL AUTO_INCREMENT,
    `spare_part_number` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `price` DOUBLE NOT NULL,
    `sortable_rank` INTEGER,
    `slug` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`spare_part_id`),
    UNIQUE INDEX `spare_part_slug` (`slug`(255))
) ENGINE=MyISAM;

CREATE TABLE `pump_spare`
(
    `pump_model_id` INTEGER NOT NULL,
    `spare_part_id` INTEGER NOT NULL,
    PRIMARY KEY (`pump_model_id`,`spare_part_id`),
    INDEX `pump_spare_FI_2` (`spare_part_id`)
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

DROP TABLE IF EXISTS `spare_part`;

DROP TABLE IF EXISTS `pump_spare`;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}