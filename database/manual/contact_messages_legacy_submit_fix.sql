-- Use this only for the older Hostinger contact_messages table described in
-- the support thread. First check Structure in phpMyAdmin; run only the ADD
-- clauses for columns that are still missing. Do not run an ADD for a column
-- that already appears in Structure.
ALTER TABLE `contact_messages`
    ADD COLUMN `tool_slug` VARCHAR(120) NULL,
    ADD COLUMN `user_resolved` TINYINT(1) NULL,
    ADD COLUMN `resolution_rating` TINYINT UNSIGNED NULL,
    ADD COLUMN `support_rating` TINYINT UNSIGNED NULL,
    ADD COLUMN `support_feedback` TEXT NULL,
    ADD COLUMN `email_updates` TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN `category` VARCHAR(40) NOT NULL DEFAULT 'general',
    ADD COLUMN `status` VARCHAR(24) NOT NULL DEFAULT 'new',
    ADD COLUMN `internal_note` TEXT NULL,
    ADD COLUMN `last_replied_at` TIMESTAMP NULL DEFAULT NULL,
    ADD COLUMN `updated_at` TIMESTAMP NULL DEFAULT NULL;
