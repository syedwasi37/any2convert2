-- Create the public community board tables. Safe to run more than once.
-- These tables deliberately use indexed user IDs without foreign keys so they
-- work with the existing users.id type on older hosting databases.
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
