# DokuWiki Recovery Script

This script is useful to regain access to a DokuWiki where:

* some plugins throw fatal errors
* you forgot your super user login credentials
* you misconfigured something important

This script will

* help to identify problems with the PHP environment
* reset some DokuWiki configuration (switching back to defaults and creating a new super user)

## Installation and Usage

1. Download the [dokuwiki-recover.php](https://raw.githubusercontent.com/splitbrain/dokuwiki-recover/release/dokuwiki-recover.php) script.
2. Upload it to your server. It has to be located in the same directory as DokuWiki's `doku.php` file
3. Visit `http://example.com/dokuwiki/dokuwiki-recover.php` (Adjust the address to match where your wiki resides)
4. Follow the on-screen instructions

Ask in the [forum](https://forum.dokuwiki.org) when you need help.

## Development

Development happens in the [master](https://github.com/splitbrain/dokuwiki-recover/tree/master) branch. The `dokuwiki-recover.php` is built from multiple source files with the `build.php` script. 