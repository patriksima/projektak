rsync -r -e "ssh -p 2222 -o 'StrictHostKeyChecking no'" --delete-after $TRAVIS_BUILD_DIR/. vu3015@ares.wrongware.cz:root/subdomains/projektak
ssh -p 2222 -o 'StrictHostKeyChecking no' vu3015@ares.wrongware.cz 'cd root/subdomains/projektak; composer install; composer update; npm update; php artisan migrate:refresh --seed;'
