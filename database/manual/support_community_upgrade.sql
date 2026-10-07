-- Use this only when Laravel migrations cannot be run on the hosted database.
-- Run once after uploading the matching application code. Do not run if migrations
-- 2026_10_07_000005 and 2026_10_07_000006 have already completed.

ALTER TABLE `contact_messages`
    ADD COLUMN `tool_slug` VARCHAR(120) NULL,
    ADD INDEX `contact_messages_tool_slug_index` (`tool_slug`),
    ADD COLUMN `user_resolved` TINYINT(1) NULL,
    ADD COLUMN `resolution_rating` TINYINT UNSIGNED NULL,
    ADD COLUMN `support_rating` TINYINT UNSIGNED NULL,
    ADD COLUMN `support_feedback` TEXT NULL,
    ADD COLUMN `email_updates` TINYINT(1) NOT NULL DEFAULT 0;

CREATE TABLE IF NOT EXISTS `community_posts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `title` VARCHAR(180) NOT NULL,
    `body` TEXT NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'published',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `community_posts_user_id_index` (`user_id`),
    KEY `community_posts_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `community_comments` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_id` BIGINT UNSIGNED NOT NULL,
    `user_id` INT(11) NOT NULL,
    `body` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `community_comments_post_id_index` (`post_id`),
    KEY `community_comments_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
