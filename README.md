# vCard Downloads
*WITHOUT ANY PLUGIN OR JQUERY CRAP ;)*

First, you need to have a [child theme](https://github.com/eBollow05/child-theme) installed and activated on your site. Also, you need to have:

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
5. Paste the `style.css` snippet into the `style.css` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L31)) of your [child theme](https://github.com/eBollow05/child-theme)
6. Paste the `main.js` snippet into the `main.js` file ([enqueue it](https://github.com/eBollow05/child-theme/blob/main/functions.php#L13-L31)) of your [child theme](https://github.com/eBollow05/child-theme)

Change following stuff in the `functions.php` snippet:

- The region name ([begin](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L6) and [end](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L93)) to the desired post type name
- The function name ending word, in our case: `example`, to the desired post type name ([here](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L7) and [here](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L91-L92))
- The [folder path](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L16) (the word after `vcards`, in our case: `example`, as you named the folder you created inside of the `vcards` folder)
- The [meta fields](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L19-L29) you want to include (if you aren't using a birthdate field, remove [these lines of code](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L43-L58))
- Remove the [else clause](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L39-L41) if you don't want to use a fallback image, or change the ID in `wp_get_attachment_image_url()` for the image you want to use as fallback
- Remove the [meta fields](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L69-L78) you aren't using that are included in the vCard

Change following stuff in the `main.js` snippet:

- The query selector where the download link action should be fired ([here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L9) and [here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L13)). The class name ending word, in our case: `example`, to the desired post type name. For the pseudo class function `:is()`, which is used in the query selector, you can target your needed elements.
- The [function parameter name](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L16), in our case: `edg_vcard_dls_example`, to the one you use in the `functions.php` snippet
- If you don't want to display the download link on [JetEngine listing items](https://crocoblock.com/widgets/listing-grid/), remove [these lines of code](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L19-L28)
- Repeat the process with the `JetEngine listing items` code

To add the download link functionality to your needed elements, use:

- The class name you specified [here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L9) and [here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L13) (for single post page)
- The class name you specified [here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L20) and [here](https://github.com/eBollow05/vcard-downloads/blob/main/main.js#L24) (for [JetEngine listing item](https://crocoblock.com/widgets/listing-grid/) of single post)

---

Additional info:

- More info about the [vCard 3.0 format specification](https://www.evenx.com/vcard-3-0-format-specification)

Instead of using the built-in [post thumbnail](https://github.com/eBollow05/vcard-downloads/blob/main/functions.php#L18) as profile picture, you also could use a meta field for that. But don't forget to put it's value in `wp_get_attachment_image_url()` if the field saves the values as image ID instead of a URL.

If you've setup a [.htaccess password protection](https://github.com/eBollow05/.htaccess-password-protection) for your entire site, images aren't shown in the generated vCard, because the function `file_get_contents()` (which is needed in the `functions.php` snippet to render the profile picture), by default, doesn't work properly.
