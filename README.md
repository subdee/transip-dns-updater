# TransIP DNS Updater

Easily update a domain with your current IP in your TransIP DNS settings.

[![Build Status](https://travis-ci.org/subdee/transip-dns-updater.svg?branch=master)](https://travis-ci.org/subdee/transip-dns-updater)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/subdee/transip-dns-updater/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/subdee/transip-dns-updater/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/subdee/transip-dns-updater/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/subdee/transip-dns-updater/?branch=master)

## Getting Started

You can choose whether you want to run the project natively or inside a small docker container (useful for NAS systems such as Synology)

### Native installation

1. Download the [latest release](https://github.com/subdee/transip-dns-updater/releases/latest).

2. Edit the `updatedns.sh` script to add your configuration and add your key pair in the transip.key file.

3. Setup `cron` to run the `updatedns.sh` script.

### Docker

1. Save your keypair in a file on your system (ie. `mydomain.key`)

2. Use the below command with the proper configuration to run the docker container:

```
docker run --rm --name dnsupdater \
    -e "TRANSIP_USER=user" \
    -e "TRANSIP_DOMAIN=mydomain.com" \
    -e "TRANSIP_SUBDOMAIN=www" \
    -v "/path/pf/mydomain.key:/app/transip.key"
    -d subdee/transip-dns-updater
```

## Contributing

This project provides very basic functionality and can be extended as my needs arise. Feel free to create PRs or issues for any bugs or features you would like to see.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

