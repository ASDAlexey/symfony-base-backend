## symfony-base backend

### Added bundles
1. [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
2. [DoctrineMigrationsBundle](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html)
3. [DoctrineFixturesBundle](http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
4. [Alice - Expressive fixtures generator](https://github.com/nelmio/alice)

### Base symfony commands
1. ./bin/console doctrine:database:create // create DB
2. ./bin/console doctrine:database:drop --force // drop DB
3. ./bin/console doctrine:schema:update --force  // update the DB schema
4. ./bin/console doctrine:query:sql ‘SELECT * FROM table’  // view symphony object
5. ./bin/console doctrine:schema:update —dump-sql  // get sql dump
6. ./bin/console  // see all console commands
7. ./bin/console doctrine:migrations:diff // migrations based diff of what was added in the model
8. ./bin/console doctrine:migrations:migrate // to apply the new migration
9. ./bin/console doctrine:fixtures:load // to load the fixtures