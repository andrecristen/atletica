cd ..
php vendor\doctrine\orm\bin\doctrine.php orm:schema-tool:update --dump-sql > scriptsSQL.sql
pause