-- Static Content Module — install
CREATE TABLE IF NOT EXISTS `oc_static_content` (
  `content_id`  INT(11)      NOT NULL AUTO_INCREMENT,
  `page`        VARCHAR(32)  NOT NULL,
  `section`     VARCHAR(64)  NOT NULL,
  `key`         VARCHAR(64)  NOT NULL DEFAULT '',
  `type`        VARCHAR(16)  NOT NULL DEFAULT 'text',
  `value`       MEDIUMTEXT   NOT NULL,
  `language_id` INT(11)      NOT NULL DEFAULT 0,
  `sort_order`  INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `content_unique` (`page`, `section`, `key`, `language_id`),
  KEY `idx_page_lang` (`page`, `language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
