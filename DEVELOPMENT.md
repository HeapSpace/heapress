# Development

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