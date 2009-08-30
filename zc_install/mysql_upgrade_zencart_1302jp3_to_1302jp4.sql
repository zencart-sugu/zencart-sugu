UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-4' where project_version_id = '1';
UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-4' where project_version_id = '2';
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Main', '1', '3.0.2-l10n-jp-4', '', 'v1.3.0.2-l10n-jp-4', now());
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Database', '1', '3.0.2-l10n-jp-4', '', 'v1.3.0.2-l10n-jp-4', now());
