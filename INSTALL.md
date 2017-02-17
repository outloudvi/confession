# How to install Confession?

1. Get a MySQL database.
2. Fill in the `config.sample.php` and rename it to `config.php`.
3. Run `install.php` and follow the process.
4. Delete the directory `install/`.
5. Enjoy!

# FAQ

* Does the application need any plugins of PHP?
    * No. I even don't know how to use them.
* I don't have a MySQL database, can I use Confession?
    * If you have a MariaDB database, it may works. (however, it is untested)
    * If you don't have either of them: No currently.
    * We may support plain text database as a further feature. (like [DokuWiki](https://dokuwiki.org))
* Is it safe to use `root` user for this?
    * **It's not safe to use root in any website application.** But we have done some filters in order to keep your database safe. Even so, we **extremely discourage** you to use `root` on it.
* Is it safe to launch/use a public anonymous confession website?
    * No. Use [Tor](https://torproject.org) or [ZeroNet](https://getzeronet.io) instead.
* How much time did it take to make a website like this?
    * ~6 hours until `v1.0`.