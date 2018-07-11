# Development

## First time

```
cd theme
yarn && yarn build
```

## Work

```
docker-compose up -d
cd theme
yarn start
```

Open [localhost:3000](http://localhost:3000)

### Misc

List all LINT issues:

```bash
yarn lint
```

## Important settings

### Colors

Colors are defined at several places:

+ `_global.scss` - CSS styles
+  `app/admin.php` - Theme Customization settings
+ `resources/assets/scripts/section-button.js` - UI button.

### Menus

Menus are added in `app/setup.php`. Search for: `register_nav_menus`.

### Custom editor styles

+ `app/filters.php` - list of classes for the editor.
+ `_shortcodes.scss` - class definitions.
+ `_tinymce.scss` - special styles for the editor.

### Shortcodes

+ `app/setup.php`
+ `_shortcodes.scss` - shortcode styles
