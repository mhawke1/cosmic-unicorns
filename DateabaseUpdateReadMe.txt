ALTER TABLE `payments` ADD `coupon_code` VARCHAR(255) NULL DEFAULT NULL AFTER `childspicture`; 

ALTER TABLE `payments` ADD `discount` VARCHAR(255) NULL DEFAULT NULL AFTER `coupon_code`; 

ALTER TABLE `payments` ADD `amount` VARCHAR(255) NULL DEFAULT NULL AFTER `childspicture`; 

ALTER TABLE `payments` ADD `coupon_type` INT(11) NOT NULL DEFAULT '0' AFTER `discount`; 

ALTER TABLE `payments` ADD `order_id` INT(11) NOT NULL DEFAULT '0' AFTER `childspicture`; 

ALTER TABLE `payments` ADD `order_count` INT(11) NOT NULL DEFAULT '0' AFTER `order_id`; 

ALTER TABLE `payments` ADD `billing_info` TEXT NULL DEFAULT NULL AFTER `childspicture`;   

ALTER TABLE `payments` ADD `type_id` INT(11) NOT NULL DEFAULT '1' AFTER `childspicture`;

ALTER TABLE `coupon` ADD `min` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `discount`;

ALTER TABLE `payments` ADD `quantity` INT(11) NOT NULL DEFAULT '1' AFTER `childspicture`;