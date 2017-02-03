<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1486087193.
 * Generated on 2017-02-03 07:29:53 by www-data
 */
class PropelMigration_1486087193
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

DROP TABLE IF EXISTS `termcondition`;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT(256);

CREATE TABLE `term_delivery`
(
    `term_delivery_id` INTEGER NOT NULL AUTO_INCREMENT,
    `delivery` TEXT,
    `delivery_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_delivery_id`)
) ENGINE=MyISAM;

CREATE TABLE `term_paymentterm`
(
    `term_paymentterm_id` INTEGER NOT NULL AUTO_INCREMENT,
    `paymentterm` TEXT,
    `paymentterm_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_paymentterm_id`)
) ENGINE=MyISAM;

CREATE TABLE `term_fright`
(
    `term_delivery_id` INTEGER NOT NULL AUTO_INCREMENT,
    `fright` TEXT,
    `fright_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_delivery_id`)
) ENGINE=MyISAM;

CREATE TABLE `term_octinsurance`
(
    `term_octinsurance_id` INTEGER NOT NULL AUTO_INCREMENT,
    `octinsurance` TEXT,
    `octinsurance_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_octinsurance_id`)
) ENGINE=MyISAM;

CREATE TABLE `term_validity`
(
    `term_validity_id` INTEGER NOT NULL AUTO_INCREMENT,
    `validity` TEXT,
    `validity_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_validity_id`)
) ENGINE=MyISAM;

CREATE TABLE `term_warranty`
(
    `term_warranty_id` INTEGER NOT NULL AUTO_INCREMENT,
    `warranty` TEXT,
    `warranty_description` TEXT,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`term_warranty_id`)
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

DROP TABLE IF EXISTS `term_delivery`;

DROP TABLE IF EXISTS `term_paymentterm`;

DROP TABLE IF EXISTS `term_fright`;

DROP TABLE IF EXISTS `term_octinsurance`;

DROP TABLE IF EXISTS `term_validity`;

DROP TABLE IF EXISTS `term_warranty`;

ALTER TABLE `customer` CHANGE `company_name` `company_name` TEXT;

CREATE TABLE `termcondition`
(
    `termcondition_id` INTEGER NOT NULL AUTO_INCREMENT,
    `delivery` TEXT,
    `payment_term` TEXT,
    `fright` TEXT,
    `oct_insurance_other` TEXT,
    `validity` TEXT,
    `warranty` TEXT,
    `sortable_rank` INTEGER,
    `slug` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`termcondition_id`),
    UNIQUE INDEX `termcondition_slug` (`slug`(255))
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}