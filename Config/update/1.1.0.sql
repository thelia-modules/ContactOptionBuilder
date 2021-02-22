
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- contact_option_form_builder
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_option_form_builder_i18n`;

CREATE TABLE `contact_option_form_builder_i18n`
(
  `id_cofb` INTEGER NOT NULL,
  `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
  `subject_cofb` VARCHAR(78) NOT NULL,
  `message_cofb` VARCHAR(500),
  `email_to_cofb` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_cofb`,`locale`),
  CONSTRAINT `contact_option_form_builder_i18n_FK_1`
  FOREIGN KEY (`id_cofb`)
  REFERENCES `contact_option_form_builder` (`id_cofb`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;