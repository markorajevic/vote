module.exports = {
    apps: [{
        name: 'vote9601',
        script: 'pm2 startOrReload ecosystem.config.js --env production',
        env: {
            NODE_ENV: 'development'
        },
        env_production: {
            NODE_ENV: 'production'
        }
    }],

    deploy: {
        production: {
            user: 'markorajevic',
            host: '104.248.40.53',
            ref: 'origin/master',
            ssh_options: ['StrictHostKeyChecking=no', 'PasswordAuthentication=no'],
            repo: 'git@github.com:markorajevic/vote.git',
            path: '/home/markorajevic/sites/vote/',
            'post-deploy': 'cd vote-web && npm install && npm run build && pm2 restart vote9601'
        }
    }
};
