# Redirect WP Author

Redirects author pages to the homepage in WordPress. This plugin ensures users can't access the author archive page, offering more control over how authorship is displayed on your website.

## Features

- **Simple Integration**: Just activate the plugin, and every author page gets redirected.
- **Configurable Redirect Type**: Choose between 301 (permanent) or 302 (temporary) redirects.
- **SEO Friendly**: By redirecting author pages, you can manage and streamline the URLs that search engines index.
- **Remove Author Links**: Automatically removes author links from your WordPress admin interface.
- **Multilingual Support**: Available in 11 languages including Dutch, German, French, Russian, Ukrainian, Spanish, Japanese, Portuguese, Persian (Farsi), Turkish, and Chinese.

## Installation

1. Clone or download the repository.
2. Upload the plugin files to your WordPress `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' screen in WordPress.
4. (Optional) Adjust settings under 'Settings > Redirect WP Author' to choose between permanent (301) or temporary (302) redirects.

## Configuration

1. Navigate to 'Settings > Redirect WP Author' in your WordPress admin panel.
2. Select your preferred redirect type:
   - 301 (Permanent Redirect) - Best for SEO, indicates the page has permanently moved
   - 302 (Temporary Redirect) - Indicates a temporary move

## Frequently Asked Questions

**Where can I find the plugin's configuration settings?**

You can configure the plugin under 'Settings > Redirect WP Author'. Here you can choose between 301 (permanent) or 302 (temporary) redirects.

**Why should I redirect author pages?**

Redirecting author pages can improve security by making it harder for attackers to enumerate users on your WordPress site. It also gives you more control over the content architecture of your site.

**How does this affect SEO?**

By default, the plugin uses 301 (permanent) redirects, which is the SEO-friendly way to redirect pages. Search engines will update their index to remove author pages and consolidate any authority to your homepage.

## Changelog

### 1.1.0
- Added settings page to configure redirect type (301 or 302)
- Added multilingual support for 11 languages
- Improved code organization and security
- Enhanced admin UI

### 1.0.0
- Initial release. Redirects all author pages to the homepage.

## Contributing

Contributions, issues, and feature requests are welcome. Feel free to check [issues page](https://github.com/virtualox/redirect-wp-author/issues) if you want to contribute.

## License

GNU General Public License v3.0. See `LICENSE` file for more information.

## Support

For support, please visit [our GitHub issues page](https://github.com/virtualox/redirect-wp-author/issues).

---

Made with ❤ by [VirtualOx B.V.](https://github.com/virtualox)
