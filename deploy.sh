openssl aes-256-cbc -K $encrypted_a6f388dddefc_key -iv $encrypted_a6f388dddefc_iv -in travis.enc -out travis -d
chmod 600 travis
rsync -r -e "ssh -p 2222 -i ./travis -o 'StrictHostKeyChecking no'" --delete-after ./ vu3015@ares.wrongware.cz:root/subdomains/projektak --exclude '.env'
ssh -p 2222 -i ./travis -o 'StrictHostKeyChecking no' vu3015@ares.wrongware.cz 'cd root/subdomains/projektak; composer update; rm -rf .git log laradock .codeclimate.yml .csslint .csslintrc .editorconfig .env.example .env.travis .eslintignore .eslintrc .gitattributes .gitignore .gitmodules .travis.yml deploy.sh index.html travis.enc travis.pub .php-version npm-debug.log; php artisan migrate:refresh --seed'
