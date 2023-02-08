# vCard Downloads

1. Create a folder under `/wp-content/uploads/ called `vcards` (only ASCII lowercase letters, use hyphens instead of spaces)
2. Log into your website via FTP
3. Paste the `functions.php` snippet into the `functions.php` file of your [child theme](https://github.com/eBollow05/child-theme)
4. Paste the `style.css` snippet into the `style.css` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L27)) of your [child theme](https://github.com/eBollow05/child-theme)
5. Paste the `main.js` snippet into the `main.js` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L27)) of your [child theme](https://github.com/eBollow05/child-theme)
htaccess if passwordentire site protection on, thumnail url file_get_contents() doesnt work for own website files resources standardmäßig

---

Additional info:

- More info about the [vCard 3.0 format specification](https://www.evenx.com/vcard-3-0-format-specification)

If you've setup a [.htaccess password protection](https://github.com/eBollow05/.htaccess-password-protection) for your entire site, images are not shown in the `.vcf` file, because the function `file_get_contents()` (which is needed in the `functions.php` snippet to render the profile picture), by default, can't work properly.
