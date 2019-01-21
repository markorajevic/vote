#!/bin/sh

npm install
npm run build
pm2 delete vote9601
pm2 start --name "vote9601" npm -- run startrbln
sudo cp nginx/vote.avocode.rs /etc/nginx/sites-available/vote.avocode.rs
sudo ln -s -f /etc/nginx/sites-available/vote.avocode.rs /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
pm2 save




