CREATE TABLE `contact_option_form_builder`
(
  `id_cofb` INTEGER NOT NULL AUTO_INCREMENT,
  `type_user_cofb` TINYINT(1) DEFAULT 0,
  `order_opt_cofb` TINYINT(1) DEFAULT 0,
  `raison_sociale_opt_cofb` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_cofb`)
) ENGINE=InnoDB;

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

