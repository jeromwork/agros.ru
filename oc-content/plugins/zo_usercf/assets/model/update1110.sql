/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

ALTER TABLE /*TABLE_PREFIX*/t_user_cf ADD `i_order` INT NOT NULL AFTER `e_position`;
SET @i = 0;
UPDATE /*TABLE_PREFIX*/t_user_cf SET `i_order` = @i:=@i+1;
