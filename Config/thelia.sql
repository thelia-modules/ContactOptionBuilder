
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- contact_option_form_buider
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_option_form_buider`;

CREATE TABLE `contact_option_form_buider`
(
    `id_cofb` INTEGER NOT NULL AUTO_INCREMENT,
    `subject_cofb` VARCHAR(78) NOT NULL,
    `type_user_cofb` TINYINT(1) DEFAULT 0,
    `order_opt_cofb` TINYINT(1) DEFAULT 0,
    `raison_sociale_opt_cofb` TINYINT(1) DEFAULT 0,
    `message_cofb` VARCHAR(500),
    `email_to_cofb` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_cofb`),
    UNIQUE INDEX `contact_option_form_buider_subject` (`subject_cofb`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
