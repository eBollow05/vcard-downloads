# vCard Downloads

First, you need to have a [child theme](https://github.com/eBollow05/child-theme) installed and acitvated on your site. Also, you need to have:

A custom post type with [meta fields that make sense for a vCard](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L19-L29), such as:

- First and last name
- Email address
- Phone number
- Etc.

PHP variables which you can load into your JavaScript file with `wp_localize_script()`, in our case we need the [AJAX URL of the site](https://github.com/eBollow05/child-theme/blob/main/functions.php#L21) and the [current post ID](https://github.com/eBollow05/child-theme/blob/main/functions.php#L22).

---

1. Log into your website via FTP
2. Create a folder under `/wp-content/uploads/` called `vcards`
3. Go into the created folder and create another folder called like the desired post type for which you want to use the vCard downlod feature, in our case: `example` (only ASCII lowercase letters, use hyphens instead of spaces)
4. Paste the `functions.php` snippet into the `functions.php` file of your [child theme](https://github.com/eBollow05/child-theme)
5. Paste the `style.css` snippet into the `style.css` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L27)) of your [child theme](https://github.com/eBollow05/child-theme)
6. Paste the `main.js` snippet into the `main.js` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L27)) of your [child theme](https://github.com/eBollow05/child-theme)


https://github.com/eBollow05/child-theme/blob/main/functions.php#L20-L28
wir brauchen 
ajaxUrl
currPostId

---

Additional info:

- More info about the [vCard 3.0 format specification](https://www.evenx.com/vcard-3-0-format-specification)

If you've setup a [.htaccess password protection](https://github.com/eBollow05/.htaccess-password-protection) for your entire site, images are not shown in the `.vcf` file, because the function `file_get_contents()` (which is needed in the `functions.php` snippet to render the profile picture), by default, can't work properly.
