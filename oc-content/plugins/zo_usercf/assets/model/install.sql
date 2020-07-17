/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

CREATE TABLE IF NOT EXISTS /*TABLE_PREFIX*/t_user_cf (
    pk_i_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    s_name VARCHAR(60) NOT NULL,
    s_slug VARCHAR(60) NOT NULL,
    s_type VARCHAR(60) NOT NULL DEFAULT 'TEXT',
    s_options TEXT NULL,
    i_min INT NULL DEFAULT NULL,
    i_max INT NULL DEFAULT NULL,
    b_enabled TINYINT(1) NOT NULL DEFAULT '1',
    b_public TINYINT(1) NOT NULL DEFAULT '1',
    b_required TINYINT(1) NOT NULL DEFAULT '1',
    e_position ENUM('REG', 'DASH', 'BOTH') NOT NULL DEFAULT 'BOTH',
    i_order INT NOT NULL,

        PRIMARY KEY(pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';

CREATE TABLE IF NOT EXISTS /*TABLE_PREFIX*/t_user_meta (
    pk_i_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    fk_i_user_id INT(10) UNSIGNED NOT NULL,
    fk_i_field_id INT(10) UNSIGNED NOT NULL,
    s_value TEXT NOT NULL,

        PRIMARY KEY(pk_i_id),
        FOREIGN KEY (fk_i_user_id) REFERENCES /*TABLE_PREFIX*/t_user (pk_i_id),
        FOREIGN KEY (fk_i_field_id) REFERENCES /*TABLE_PREFIX*/t_user_cf (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';
