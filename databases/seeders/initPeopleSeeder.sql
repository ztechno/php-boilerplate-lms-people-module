INSERT INTO `roles` (`name`) VALUES ('Instructor');
INSERT INTO `role_routes` (`route_path`, `role_id`) VALUES 
    ('dashboard', (SELECT LAST_INSERT_ID())),
    ('courses/*', (SELECT LAST_INSERT_ID()));
INSERT INTO `roles` (`name`) VALUES ('Participant');
INSERT INTO `role_routes` (`route_path`, `role_id`) VALUES 
    ('dashboard', (SELECT LAST_INSERT_ID())),
    ('courses/*', (SELECT LAST_INSERT_ID()));