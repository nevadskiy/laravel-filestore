alias artisan='docker-compose exec --user "$(id -u):$(id -g)" php-cli php artisan'
alias doc-php='docker-compose exec php-cli'
alias doc-node='docker-compose exec node'

alias test='docker-compose exec php-cli vendor/bin/phpunit'
alias tf='docker-compose exec php-cli vendor/bin/phpunit --filter'
