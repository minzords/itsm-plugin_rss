<?php
/**
 * ---------------------------------------------------------------------
 * ITSM-NG
 * Copyright (C) 2015-2022 Teclib' and contributors.
 * Copyright (C) 2023 ITSM-NG and contributors.
 *
 * https://www.itsm-ng.org
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of ITSM-NG.
 *
 * ITSM-NG is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * ITSM-NG is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ITSM-NG. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 **/
 
 /**
  * Install plugin function
  *
  * @return boolean
  */
function plugin_rssfeed_install(): bool {
    global $DB;

    $migration = new Migration(101);
    
    if (!$DB->tableExists("glpi_plugin_rssfeed_rssfeeds")) {
        $query = "CREATE TABLE glpi_plugin_rssfeed_rssfeeds (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NULL DEFAULT NULL,
            users_id INT(11) NOT NULL DEFAULT '0',
            comment TEXT NULL,
            url TEXT NULL,
            refresh_rate INT(11) NOT NULL DEFAULT '86400',
            max_items INT(11) NOT NULL DEFAULT '20',
            have_error TINYINT(1) NOT NULL DEFAULT '0',
            is_active TINYINT(1) NOT NULL DEFAULT '0',
            date_mod DATETIME NULL,
            date_creation DATETIME NULL,
            PRIMARY KEY (id)
        );
        ";
        $DB->queryOrDie($query, $DB->error());
    }

    if (!$DB->tableExists("glpi_plugin_rssfeed_entities")) {
        $query = "CREATE TABLE glpi_plugin_rssfeed_entities (
            id INT(11) NOT NULL AUTO_INCREMENT,
            rssfeeds_id INT(11) NOT NULL DEFAULT '0',
            entities_id INT(11) NOT NULL DEFAULT '0',
            is_recursive TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        );
        ";
        $DB->queryOrDie($query, $DB->error());
    }

    if (!$DB->tableExists("glpi_plugin_rssfeed_groups")) {
        $query = "CREATE TABLE glpi_plugin_rssfeed_groups (
            id INT(11) NOT NULL AUTO_INCREMENT,
            rssfeeds_id INT(11) NOT NULL DEFAULT '0',
            groups_id INT(11) NOT NULL DEFAULT '0',
            entities_id INT(11) NOT NULL DEFAULT '-1',
            is_recursive TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        );
        ";
        $DB->queryOrDie($query, $DB->error());
    }

    if (!$DB->tableExists("glpi_plugin_rssfeed_profiles")) {
        $query = "CREATE TABLE glpi_plugin_rssfeed_profiles (
            id INT(11) NOT NULL AUTO_INCREMENT,
            rssfeeds_id INT(11) NOT NULL DEFAULT '0',
            profiles_id INT(11) NOT NULL DEFAULT '0',
            entities_id INT(11) NOT NULL DEFAULT '-1',
            is_recursive TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        );
        ";
        $DB->queryOrDie($query, $DB->error());
    }

    if (!$DB->tableExists("glpi_plugin_rssfeed_users")) {
        $query = "CREATE TABLE glpi_plugin_rssfeed_users (
            id INT(11) NOT NULL AUTO_INCREMENT,
            rssfeeds_id INT(11) NOT NULL DEFAULT '0',
            users_id INT(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        );
        ";
        $DB->queryOrDie($query, $DB->error());
    }
    return true ;
}

/**
 * Uninstall plugin function
 *
 * @return boolean
 */
function plugin_rssfeed_uninstall(): bool {
    global $DB;

    if($DB->tableExists('glpi_plugin_rssfeed_rssfeeds')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_rssfeed_rssfeeds`",$DB->error());
    }

    if($DB->tableExists('glpi_plugin_rssfeed_entities')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_rssfeed_entities`",$DB->error());
    }

    if($DB->tableExists('glpi_plugin_rssfeed_groups')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_rssfeed_groups`",$DB->error());
    }

    if($DB->tableExists('glpi_plugin_rssfeed_profiles')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_rssfeed_profiles`",$DB->error());
    }

    if($DB->tableExists('glpi_plugin_rssfeed_users')) {
        $DB->queryOrDie("DROP TABLE `glpi_plugin_rssfeed_users`",$DB->error());
    }

    return true;
}