/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

ALTER TABLE /*TABLE_PREFIX*/t_user_cf ADD `i_min` INT NULL DEFAULT NULL AFTER `s_options`, ADD `i_max` INT NULL DEFAULT NULL AFTER `i_min`;
