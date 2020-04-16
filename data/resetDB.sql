drop schema public cascade;
create schema public;
\i data/generateTables.sql
\i data/insertData.sql