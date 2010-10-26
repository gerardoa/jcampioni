DROP TABLE `#__province`;
DROP TABLE `#__regioni`;
DROP TABLE `#__campioni_richieste`;
DELETE FROM `#__users` WHERE id >= 100 AND id <= 7730;
DELETE FROM `#__core_acl_aro` WHERE order_value >= 100 AND order_value <= 7730;
DELETE FROM `#__core_acl_groups_aro_map` WHERE aro_id >= 48 ANDaro_id <= 7678;
